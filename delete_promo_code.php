<?php
require_once('config.php');

validate_request_method("GET");
$data = validate_request_body("GET", ["id"]);

$promo_id = intval($data['id']);

$stmt = $conn->prepare("UPDATE promo_codes SET status = 0 WHERE id = ?");
$stmt->bind_param("i", $promo_id);

if ($stmt->execute()) {
  print_response(true, "Promo code deleted successfully.");
} else {
  print_response(false, "Failed to delete promo code.");
}
?>
