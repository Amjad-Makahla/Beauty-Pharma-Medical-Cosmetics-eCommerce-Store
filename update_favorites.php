<?php
require_once('config.php');

$request_method = "POST";
$required_fields = ["user_id", "product_id"];
validate_request_method($request_method);
$data = validate_request_body($request_method, $required_fields);

$user_id = intval($data["user_id"]);
$product_id = intval($data["product_id"]);

// Check if the favorite exists
$stmt = $conn->prepare("SELECT id, status FROM user_favorite WHERE user_id = ? AND product_id = ?");
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();
$exists = $result->fetch_assoc();

if ($exists) {
    $new_status = $exists['status'] == 1 ? 0 : 1;
    $update = $conn->prepare("UPDATE user_favorite SET status = ?, updated_at = NOW() WHERE id = ?");
    $update->bind_param("ii", $new_status, $exists['id']);
    $update->execute();

    $message = $new_status ? "Product added to favorites" : "Product removed from favorites";
    print_response(true, $message);
} else {
    $insert = $conn->prepare("INSERT INTO user_favorite (user_id, product_id, status) VALUES (?, ?, 1)");
    $insert->bind_param("ii", $user_id, $product_id);
    $insert->execute();

    print_response(true, "Product added to favorites");
}
