<?php
require_once('config.php');

$request_method = "POST";
$required_fields = ["user_id", "product_id"];
validate_request_method($request_method);
$data = validate_request_body($request_method, $required_fields);

$user_id = intval($data["user_id"]);
$product_id = intval($data["product_id"]);

// Check if the favorite exists
$stmt = $conn->prepare("SELECT id FROM user_favorite WHERE user_id = ? AND product_id = ? AND status = 1");
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();
$exists = $result->fetch_assoc();

if ($exists) {
    // Product already in wishlist, don't remove
    print_response(true, "Product is already in the wishlist", ["status" => 1]);
} else {
    // Add to wishlist
    $insert = $conn->prepare("INSERT INTO user_favorite (user_id, product_id, status) VALUES (?, ?, 1)");
    $insert->bind_param("ii", $user_id, $product_id);
    $insert->execute();

    print_response(true, "Product added to wishlist", ["status" => 1]);
}
?>
