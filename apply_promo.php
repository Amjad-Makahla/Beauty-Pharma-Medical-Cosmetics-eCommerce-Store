<?php
session_start();
require_once 'config.php';
header('Content-Type: application/json');
error_reporting(0);

// Check login
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Please login']);
    exit;
}

$userId = intval($_SESSION['user_id']);

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);
$promoCode = trim($data['promo_code'] ?? '');
if (empty($promoCode)) {
    echo json_encode(['success' => false, 'message' => 'Promo code required']);
    exit;
}

// ===== Get current cart total =====
$cart_stmt = $conn->prepare("
    SELECT p.id, p.name, p.price, c.quantity
    FROM user_cart c
    JOIN products p ON c.product_id = p.id
    WHERE c.user_id = ? AND p.is_active = 1
");
$cart_stmt->bind_param("i", $userId);
$cart_stmt->execute();
$result = $cart_stmt->get_result();

$subtotal = 0;
while ($row = $result->fetch_assoc()) {
    $subtotal += floatval($row['price']) * intval($row['quantity']);
}

// ===== Check promo code =====
$promo_stmt = $conn->prepare("
    SELECT * FROM promo_codes
    WHERE code = ? AND is_active = 1 AND status = 1
    LIMIT 1
");
$promo_stmt->bind_param("s", $promoCode);
$promo_stmt->execute();
$promo = $promo_stmt->get_result()->fetch_assoc();

if (!$promo) {
    echo json_encode(['success' => false, 'message' => 'Invalid or inactive promo code']);
    exit;
}

// Check expiry
if (strtotime($promo['expiry_date']) < time()) {
    echo json_encode(['success' => false, 'message' => 'Promo code expired']);
    exit;
}

// Check min purchase
if ($subtotal < floatval($promo['min_purchase'])) {
    echo json_encode(['success' => false, 'message' => 'Cart does not meet minimum purchase for this promo']);
    exit;
}

// Calculate discount
$discountAmount = 0;
if ($promo['discount_type'] === 'percentage') {
    $discountAmount = ($subtotal * floatval($promo['discount'])) / 100;
} else {
    $discountAmount = floatval($promo['discount']);
}

$totalAfterDiscount = $subtotal - $discountAmount;

// Return result
echo json_encode([
    'success' => true,
    'subtotal' => number_format($subtotal, 2),
    'discount_amount' => number_format($discountAmount, 2),
    'total' => number_format($totalAfterDiscount, 2)
]);
exit;
