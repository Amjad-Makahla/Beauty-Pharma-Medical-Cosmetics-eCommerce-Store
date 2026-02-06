<?php
require_once 'config.php';

header("Content-Type: application/json");

// Validate method
validate_request_method("POST");

// Validate required fields
$data = validate_request_body("POST", ["product_id"]);

$id = intval($data['product_id']);

// Soft delete = set is_active = 0
$sql = "UPDATE products SET status= 0, updated_at = NOW() WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        print_response(true, "Product deleted successfully", ["product_id" => $id]);
    } else {
        print_response(false, "Failed to delete product: " . $stmt->error);
    }
    $stmt->close();
} else {
    print_response(false, "Database error: " . $conn->error);
}

$conn->close();
