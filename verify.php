<?php
// verify.php
$data = json_decode(file_get_contents("php://input"), true);

$razorpay_order_id = $data['razorpay_order_id'];
$razorpay_payment_id = $data['razorpay_payment_id'];
$razorpay_signature = $data['razorpay_signature'];

$secret = "YOUR_SECRET_KEY"; // Keep this safe and never expose it in frontend

$generated_signature = hash_hmac('sha256', $razorpay_order_id . "|" . $razorpay_payment_id, $secret);

if ($generated_signature === $razorpay_signature) {
    echo "✅ Payment Verified Successfully";
    // You can update DB, mark order as paid etc.
} else {
    echo "❌ Invalid Signature - Payment Might Be Fake!";
}
?>
