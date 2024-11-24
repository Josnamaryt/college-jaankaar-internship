<?php
require('config.php');
require('vendor/autoload.php');

use Razorpay\Api\Api;

header('Content-Type: application/json');

try {
    $api = new Api('rzp_test_p9ccnzVHbdWZkL', 'F7DG9MYbPufdAjo6sGo8hltX');

    $amount = isset($_POST['amount']) ? (int)$_POST['amount'] : 0;
    $currency = isset($_POST['currency']) ? $_POST['currency'] : 'INR';

    if ($amount <= 0) {
        throw new Exception('Invalid amount');
    }

    $orderData = [
        'receipt'         => 'rcpt_' . time(),
        'amount'          => $amount,
        'currency'        => $currency,
        'payment_capture' => 1
    ];

    $order = $api->order->create($orderData);

    echo json_encode([
        'status' => 'success',
        'order_id' => $order->id
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
