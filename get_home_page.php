<?php
require_once('config.php');

validate_request_method("GET");

// === Prepare response structure ===
$response = [
  "daily_deals" => [],
  "tiktok_viral" => [],
  "categories" => [],
  "bestsellers" => []
];

// === 1. Daily Deals Products ===
// We filter by category name 'Daily Deals' (adjust if your DB uses a different name)
// === 1. Daily Deals Products (latest 10 in 'Daily Deals' category) ===
$dailyDealsStmt = $conn->prepare("
  SELECT id, name, price, image_url AS image
  FROM products
  WHERE status = 1 AND is_active = 1
  ORDER BY RAND()
  LIMIT 20
");
$dailyDealsStmt->execute();
$response['daily_deals'] = $dailyDealsStmt->get_result()->fetch_all(MYSQLI_ASSOC);


// === 2. Tiktok Viral Products (20 random active products) ===
$tiktokStmt = $conn->prepare("
  SELECT id, name, price, image_url AS image
  FROM products
  WHERE status = 1 AND is_active = 1
  ORDER BY RAND()
  LIMIT 20
");
$tiktokStmt->execute();
$response['tiktok_viral'] = $tiktokStmt->get_result()->fetch_all(MYSQLI_ASSOC);

// === 3. Categories ===
$catStmt = $conn->query("
  SELECT id, name, name_ar, image 
  FROM categories 
  WHERE status = 1 
  ORDER BY name ASC
");
$response['categories'] = $catStmt->fetch_all(MYSQLI_ASSOC);

// === 4. Bestsellers (Top 15 products by total quantity ordered) ===
$bestsellerStmt = $conn->prepare("
  SELECT 
      p.id,
      p.name,
      p.price,
      p.image_url AS image,
      SUM(oi.quantity) AS total_ordered
  FROM order_items oi
  JOIN products p ON oi.product_id = p.id
  WHERE p.status = 1 
    AND p.is_active = 1
    AND oi.status = 1      -- only completed order_items (adjust if needed)
  GROUP BY p.id
  ORDER BY total_ordered DESC
  LIMIT 15
");
$bestsellerStmt->execute();
$response['bestsellers'] = $bestsellerStmt->get_result()->fetch_all(MYSQLI_ASSOC);

// === Final Response ===
print_response(true, "Home Page Data", $response);
