<?php
require_once('config.php');

$request_method = "POST";
$required_fields = ["user_id", "product_id"];
validate_request_method($request_method);
$data = validate_request_body($request_method, $required_fields);

$user_id = intval($data["user_id"]);
$product_id = intval($data["product_id"]);
$quantity = isset($data["quantity"]) ? intval($data["quantity"]) : 1;

// Check if the product is already in the cart
$stmt = $conn->prepare("SELECT id, quantity FROM user_cart WHERE user_id = ? AND product_id = ? AND status = 1");
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();
$existing = $result->fetch_assoc();

if ($existing) {
    // Product already in cart, update quantity
    $newQuantity = $existing['quantity'] + $quantity;
    $update = $conn->prepare("UPDATE user_cart SET quantity = ?, updated_at = NOW() WHERE id = ?");
    $update->bind_param("ii", $newQuantity, $existing['id']);
    $update->execute();

    print_response(true, "Cart updated successfully", ["quantity" => $newQuantity]);
} else {
    // Add new product to cart
    $insert = $conn->prepare("INSERT INTO user_cart (user_id, product_id, quantity, status, created_at, updated_at) VALUES (?, ?, ?, 1, NOW(), NOW())");
    $insert->bind_param("iii", $user_id, $product_id, $quantity);
    $insert->execute();

    print_response(true, "Product added to cart", ["quantity" => $quantity]);
}
?>
