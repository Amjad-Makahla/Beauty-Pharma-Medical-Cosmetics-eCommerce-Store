<?php
require_once('config.php');

validate_request_method("POST");
$data = validate_request_body("POST", ["ambassador_id", "amount"]);

$amount = floatval($data['amount']);
$ambassador_id = intval($data['ambassador_id']);

$stmt = $conn->prepare("INSERT INTO ambassador_withdrawals (ambassador_id, amount) VALUES (?, ?)");
$stmt->bind_param("id", $ambassador_id, $amount);

if ($stmt->execute()) {
    print_response(true, "Withdrawal recorded successfully");
} else {
    print_response(false, "Failed to record withdrawal");
}
