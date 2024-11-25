<?php
require('dbconnection.php');

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Razorpay credentials
$keyId = 'rzp_test_p9ccnzVHbdWZkL';
$keySecret = 'F7DG9MYbPufdAjo6sGo8hltX';

// Verify payment signature
function verifyPaymentSignature($razorpay_payment_id, $razorpay_order_id, $razorpay_signature) {
    global $keySecret;
    
    error_log("Verifying Payment - Payment ID: " . $razorpay_payment_id);
    error_log("Order ID: " . $razorpay_order_id);
    error_log("Signature: " . $razorpay_signature);
    
    $generated_signature = hash_hmac('sha256', $razorpay_payment_id . '|' . $razorpay_order_id, $keySecret);
    error_log("Generated Signature: " . $generated_signature);
    error_log("Received Signature: " . $razorpay_signature);
    
    if ($generated_signature == $razorpay_signature) {
        error_log("Signature verification successful");
        return true;
    }
    error_log("Signature verification failed");
    return false;
}

// Handle payment verification
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = array();
    error_log("Received POST request for payment verification");
    error_log("POST data: " . print_r($_POST, true));
    
    try {
        if (!isset($_POST['razorpay_payment_id']) || !isset($_POST['razorpay_order_id']) || !isset($_POST['razorpay_signature'])) {
            throw new Exception("Missing required payment parameters");
        }
        
        $razorpay_payment_id = $_POST['razorpay_payment_id'];
        $razorpay_order_id = $_POST['razorpay_order_id'];
        $razorpay_signature = $_POST['razorpay_signature'];
        
        if (verifyPaymentSignature($razorpay_payment_id, $razorpay_order_id, $razorpay_signature)) {
            // Get database connection
            $conn = getConnection();
            
            try {
                // Start transaction
                $conn->beginTransaction();
                
                // Insert payment record
                $stmt = $conn->prepare("INSERT INTO payments (razorpay_payment_id, razorpay_order_id, razorpay_signature, status) VALUES (?, ?, ?, 'success')");
                $stmt->execute([$razorpay_payment_id, $razorpay_order_id, $razorpay_signature]);
                
                // Commit transaction
                $conn->commit();
                error_log("Payment record saved successfully");
                
                $response = array(
                    'status' => 'success',
                    'message' => 'Payment verified successfully'
                );
            } catch (Exception $e) {
                // Rollback transaction on error
                $conn->rollBack();
                error_log("Database error: " . $e->getMessage());
                throw $e;
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Payment verification failed'
            );
        }
    } catch (Exception $e) {
        error_log("Error in payment processing: " . $e->getMessage());
        $response = array(
            'status' => 'error',
            'message' => $e->getMessage()
        );
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>
