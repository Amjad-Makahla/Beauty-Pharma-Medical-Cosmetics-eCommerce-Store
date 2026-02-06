<?php
session_start();
require_once 'config.php'; // DB connection
header('Content-Type: application/json');
error_reporting(0);

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "Please login"]);
    exit;
}

$user_id = intval($_SESSION['user_id']);

// ===== Fetch cart items (only active) =====
$stmt = $conn->prepare("
    SELECT 
        uc.id AS cart_id,
        p.id AS product_id,
        p.name,
        p.price,
        p.size,
        p.weight,
        p.image_url,
        uc.quantity
    FROM user_cart uc
    JOIN products p ON uc.product_id = p.id
    WHERE uc.user_id = ?
      AND p.is_active = 1
      AND uc.status = 1       -- ✅ only rows with status = 1
");

if (!$stmt) {
    echo json_encode(["success" => false, "message" => "Database error"]);
    exit;
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$cartItems = [];
$total = 0;

while ($row = $result->fetch_assoc()) {
    $row['subtotal'] = floatval($row['price']) * intval($row['quantity']);
    $total += $row['subtotal'];
    $cartItems[] = $row;
}

// Return JSON
echo json_encode([
    "success" => true,
    "cart"    => $cartItems,
    "total"   => number_format($total, 2)
]);
exit;
