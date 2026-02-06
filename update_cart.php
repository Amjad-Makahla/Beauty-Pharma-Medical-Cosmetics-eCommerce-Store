<?php
session_start();
require_once 'config.php';
header('Content-Type: application/json');
error_reporting(0);

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Please login']);
    exit;
}

$userId = intval($_SESSION['user_id']);

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);
$productId = intval($data['product_id'] ?? 0);
$newQuantity = intval($data['quantity'] ?? 1);

if ($productId <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit;
}

if ($newQuantity < 1) {
    // 🔹 Soft delete → set status = 0
    $del = $conn->prepare("UPDATE user_cart SET status = 0 WHERE user_id = ? AND product_id = ?");
    $del->bind_param("ii", $userId, $productId);
    $del->execute();

    if ($del->affected_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Product not found in cart']);
        exit;
    }
} else {
    // 🔹 Update quantity (keep active status)
    $stmt = $conn->prepare("UPDATE user_cart SET quantity = ?, status = 1 WHERE user_id = ? AND product_id = ?");
    $stmt->bind_param("iii", $newQuantity, $userId, $productId);
    $stmt->execute();

    if ($stmt->affected_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Product not found in cart']);
        exit;
    }
}

// Fetch updated cart (only active items)
$cart_stmt = $conn->prepare("
    SELECT 
        c.id AS cart_id,
        p.id AS product_id,
        p.name,
        p.price,
        p.size,
        p.weight,
        p.image_url,
        c.quantity
    FROM user_cart c
    JOIN products p ON c.product_id = p.id
    WHERE c.user_id = ? AND c.status = 1 AND p.is_active = 1
");
$cart_stmt->bind_param("i", $userId);
$cart_stmt->execute();
$result = $cart_stmt->get_result();

$cartItems = [];
$subtotal = 0;

while ($row = $result->fetch_assoc()) {
    $row['subtotal'] = floatval($row['price']) * intval($row['quantity']);
    $subtotal += $row['subtotal'];

    $cartItems[] = [
        'cart_id'    => $row['cart_id'],
        'product_id' => $row['product_id'],
        'name'       => $row['name'],
        'price'      => floatval($row['price']),
        'size'       => $row['size'],
        'weight'     => $row['weight'],
        'image_url'  => $row['image_url'],
        'quantity'   => intval($row['quantity']),
        'subtotal'   => $row['subtotal']
    ];
}

// Placeholder for shipping & discount
$shipping = 5.00;
$discount = 0.00;
$total = $subtotal + $shipping - $discount;

echo json_encode([
    'success' => true,
    'cart'    => $cartItems,
    'subtotal'=> number_format($subtotal, 2),
    'shipping'=> number_format($shipping, 2),
    'discount'=> number_format($discount, 2),
    'total'   => number_format($total, 2)
]);
exit;
