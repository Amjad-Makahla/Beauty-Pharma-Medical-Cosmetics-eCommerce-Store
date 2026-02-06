<?php
session_start();
require_once('config.php');
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "Not logged in"]);
    exit;
}

$user_id = intval($_SESSION['user_id']);

// ===== Fetch user profile info =====
$user_sql = "SELECT id, name, email, phone, created_at, updated_at 
             FROM users 
             WHERE id = ? LIMIT 1";
$user_stmt = $conn->prepare($user_sql);
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user = $user_stmt->get_result()->fetch_assoc();

if (!$user) {
    echo json_encode(["success" => false, "message" => "User not found"]);
    exit;
}

// ===== Fetch user orders =====
// status is now TEXT, so we return it directly
$order_sql = "SELECT id, total_price, address, status, created_at 
              FROM orders 
              WHERE user_id = ? AND is_active = 1
              ORDER BY created_at DESC";
$order_stmt = $conn->prepare($order_sql);
$order_stmt->bind_param("i", $user_id);
$order_stmt->execute();
$order_res = $order_stmt->get_result();

/*
 Map text status to display labels
 DB values must match the update API:
   pending
   being_processed
   out_for_delivery
   delivered
   canceled
*/
$statusMap = [
    "pending"         => "Pending",
    "being_processed" => "Being Processed",
    "out_for_delivery"=> "Out for Delivery",
    "delivered"       => "Delivered",
    "canceled"        => "Cancelled"
];

$orders = [];
while ($order = $order_res->fetch_assoc()) {
    // Fetch order items
    $item_sql = "SELECT oi.quantity, oi.price, p.name AS product_name
                 FROM order_items oi
                 JOIN products p ON p.id = oi.product_id
                 WHERE oi.order_id = ?";
    $item_stmt = $conn->prepare($item_sql);
    $item_stmt->bind_param("i", $order['id']);
    $item_stmt->execute();
    $item_res = $item_stmt->get_result();

    $items = [];
    while ($row = $item_res->fetch_assoc()) {
        $items[] = [
            "name"     => $row['product_name'],
            "quantity" => (int)$row['quantity'],
            "price"    => (float)$row['price']
        ];
    }

    $orders[] = [
        "id"      => $order['id'],
        "date"    => date("Y-m-d", strtotime($order['created_at'])),
        // ✅ Map text status to a friendly label
        "status"  => $statusMap[$order['status']] ?? "Unknown",
        "total"   => (float)$order['total_price'],
        "address" => $order['address'],
        "items"   => $items
    ];
}

echo json_encode([
    "success" => true,
    "user" => [
        "id"         => $user['id'],
        "name"       => $user['name'],
        "email"      => $user['email'],
        "phone"      => $user['phone'],
        "joined"     => date("Y-m-d", strtotime($user['created_at'])),
        "address"    => $orders[0]['address'] ?? null,
        "last_login" => date("Y-m-d H:i:s", strtotime($user['updated_at']))
    ],
    "orders" => $orders
]);
