<?php
require_once('config.php');

$request_method = "POST";
$required_fields = [
  "code", "discount", "discount_type", "min_purchase",
  "max_usage", "expiry_date"
  // "status" removed, we will use is_active
];

validate_request_method($request_method);
$data = validate_request_body($request_method, $required_fields);

$ambassador_id = isset($data['ambassador_id']) ? intval($data['ambassador_id']) : null;

// Always set is_active = 1 for new promo codes
$is_active = 1;
$status =1;
$stmt = $conn->prepare("INSERT INTO promo_codes 
  (code, discount, discount_type, min_purchase, usage_limit, expiry_date, status, is_active, ambassador_id)
  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param(
  "sdsdisiii",
  $data['code'],
  $data['discount'],
  $data['discount_type'],
  $data['min_purchase'],
  $data['max_usage'],
  $data['expiry_date'],
  $status,
  $is_active,
  $ambassador_id
);


if ($stmt->execute()) {
  print_response(true, "Promo code added successfully.");
} else {
  print_response(false, "Failed to add promo code.");
}
?>
