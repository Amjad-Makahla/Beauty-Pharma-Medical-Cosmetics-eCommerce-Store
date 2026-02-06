<?php
session_start();
require_once 'config.php'; // DB connection
header('Content-Type: application/json');
error_reporting(0);

//  User must be logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "Please login first"]);
    exit;
}

$user_id = intval($_SESSION['user_id']);
$action  = $_GET['action'] ?? '';   // ?action=get_wishlist OR ?action=add_to_cart OR ?action=remove_favorite

// ===================== 1️ GET WISHLIST =====================
if ($action === 'get_wishlist') {

    $stmt = $conn->prepare("
        SELECT 
            uf.id AS favorite_id,
            p.id AS product_id,
            p.name,
            p.price,
            p.size,
            p.weight,
            p.image_url,
            p.is_active
        FROM user_favorite uf
        JOIN products p ON uf.product_id = p.id
        WHERE uf.user_id = ?
          AND uf.status = 1
          AND p.is_active = 1
        ORDER BY uf.created_at DESC
    ");

    if (!$stmt) {
        echo json_encode(["success" => false, "message" => "Database error"]);
        exit;
    }

    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $wishlist = [];
    while ($row = $result->fetch_assoc()) {
        $wishlist[] = [
            "favorite_id" => $row['favorite_id'],
            "product_id"  => $row['product_id'],
            "name"        => $row['name'],
            "price"       => floatval($row['price']),
            "size"        => $row['size'],
            "weight"      => $row['weight'],
            "image_url"   => $row['image_url']
        ];
    }

    echo json_encode(["success" => true, "wishlist" => $wishlist]);
    exit;
}

// ===================== 2️ ADD PRODUCT TO CART =====================
if ($action === 'add_to_cart') {

    $data       = json_decode(file_get_contents("php://input"), true);
    $product_id = intval($data['product_id'] ?? 0);
    $quantity   = max(1, intval($data['quantity'] ?? 1)); // default 1

    if ($product_id <= 0) {
        echo json_encode(["success" => false, "message" => "Invalid product"]);
        exit;
    }

    // Check if product exists and is active
    $check = $conn->prepare("SELECT id FROM products WHERE id = ? AND is_active = 1");
    $check->bind_param("i", $product_id);
    $check->execute();
    $check->store_result();
    if ($check->num_rows === 0) {
        echo json_encode(["success" => false, "message" => "Product not found"]);
        exit;
    }

    // If product already in cart -> update quantity
    $stmt = $conn->prepare("SELECT id, quantity FROM user_cart WHERE user_id = ? AND product_id = ? AND status = 1");
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($row = $res->fetch_assoc()) {
        $newQty = $row['quantity'] + $quantity;
        $update = $conn->prepare("UPDATE user_cart SET quantity = ?, updated_at = NOW() WHERE id = ?");
        $update->bind_param("ii", $newQty, $row['id']);
        $update->execute();
    } else {
        $insert = $conn->prepare("INSERT INTO user_cart (user_id, product_id, quantity, status, created_at, updated_at)
                                  VALUES (?, ?, ?, 1, NOW(), NOW())");
        $insert->bind_param("iii", $user_id, $product_id, $quantity);
        $insert->execute();
    }

    echo json_encode(["success" => true, "message" => "Product added to cart"]);
    exit;
}

// ===================== 3️ REMOVE FAVORITE (Soft Delete) =====================
if ($action === 'remove_favorite') {
    $data = json_decode(file_get_contents("php://input"), true);
    $favorite_id = intval($data['favorite_id'] ?? 0);

    if ($favorite_id <= 0) {
        echo json_encode(["success" => false, "message" => "Invalid favorite ID"]);
        exit;
    }

    $stmt = $conn->prepare("UPDATE user_favorite SET status = 0, updated_at = NOW() WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $favorite_id, $user_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(["success" => true, "message" => "Removed from favorites"]);
    } else {
        echo json_encode(["success" => false, "message" => "Favorite not found"]);
    }
    exit;
}

// ===================== Default =====================
echo json_encode(["success" => false, "message" => "Invalid action"]);
exit;
