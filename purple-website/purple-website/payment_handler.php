<?php
require('config.php');
require('vendor/autoload.php');

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

header('Content-Type: application/json');

// Set up error logging
ini_set('log_errors', 1);
ini_set('error_log', 'payment_error.log');

function logPayment($message, $data = null) {
    $timestamp = date('[d-M-Y H:i:s e] ');
    error_log($timestamp . $message);
    if ($data) {
        error_log($timestamp . print_r($data, true));
    }
}

logPayment("\n=== New Payment Request ===");
logPayment("POST data:", $_POST);

try {
    // Initialize Razorpay API
    $api = new Api('rzp_test_p9ccnzVHbdWZkL', 'F7DG9MYbPufdAjo6sGo8hltX');
    
    // Get payment data
    $payment_id = $_POST['razorpay_payment_id'];
    $order_id = $_POST['razorpay_order_id'];
    $signature = $_POST['razorpay_signature'];
    $amount = isset($_POST['amount']) ? (int)$_POST['amount'] / 100 : 0; // Convert from paise to rupees
    $email = $_POST['email'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    logPayment("Processing payment:");
    logPayment("Payment ID: " . $payment_id);
    logPayment("Order ID: " . $order_id);
    logPayment("Amount: " . $amount);
    logPayment("Email: " . $email);
    logPayment("Name: " . $name);
    logPayment("Phone: " . $phone);

    // Verify the payment signature
    logPayment("Verifying Payment:");
    logPayment("Payment ID: " . $payment_id);
    logPayment("Order ID: " . $order_id);
    logPayment("Signature: " . $signature);

    // Verify signature
    $attributes = array(
        'razorpay_order_id' => $order_id,
        'razorpay_payment_id' => $payment_id,
        'razorpay_signature' => $signature
    );

    $api->utility->verifyPaymentSignature($attributes);

    // Connect to database
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Check if payment already exists
    $stmt = $conn->prepare("SELECT id FROM payments WHERE payment_id = ?");
    $stmt->bind_param("s", $payment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        throw new Exception("Payment already processed");
    }

    // Insert payment details
    $stmt = $conn->prepare("INSERT INTO payments (payment_id, order_id, amount, email, name, phone, status) VALUES (?, ?, ?, ?, ?, ?, 'success')");
    $stmt->bind_param("ssdsss", $payment_id, $order_id, $amount, $email, $name, $phone);
    
    if (!$stmt->execute()) {
        throw new Exception("Failed to save payment details: " . $stmt->error);
    }

    $conn->close();

    logPayment("Payment processed successfully");
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Payment verified successfully'
    ]);

} catch (SignatureVerificationError $e) {
    logPayment("Signature verification failed");
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => 'Payment signature verification failed'
    ]);
} catch (Exception $e) {
    logPayment("Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
