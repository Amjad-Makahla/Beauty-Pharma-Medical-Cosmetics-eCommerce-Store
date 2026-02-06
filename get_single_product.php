<?php
require_once('config.php');

validate_request_method("GET");

if (!isset($_GET['product_id'])) {
    print_response(false, "Product ID is required");
    exit;
}

$product_id = intval($_GET['product_id']);

// === Get Product with Category ===
$stmt = $conn->prepare("
    SELECT 
        p.id,
        p.name,
        p.brand,
        p.price,
        p.size,
        p.weight,
        p.description,
        p.image_url AS image,
        c.id AS category_id,
        c.name AS category_name
    FROM products p
    LEFT JOIN product_categories pc ON p.id = pc.product_id
    LEFT JOIN categories c ON pc.category_id = c.id
    WHERE p.id = ? AND p.is_active = 1 AND p.status = 1
    LIMIT 1
");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    print_response(false, "Product not found or inactive");
    exit;
}

$product = $result->fetch_assoc();
$category_id = $product['category_id'];

// === Get Related Products (same category, exclude current product, random 4) ===
$relatedStmt = $conn->prepare("
    SELECT p.id, p.name, p.price, p.image_url AS image
    FROM products p
    JOIN product_categories pc ON p.id = pc.product_id
    WHERE p.is_active = 1 AND p.status = 1 AND pc.category_id = ? AND p.id != ?
    ORDER BY RAND()
    LIMIT 4
");
$relatedStmt->bind_param("ii", $category_id, $product_id);
$relatedStmt->execute();
$related_products = $relatedStmt->get_result()->fetch_all(MYSQLI_ASSOC);

// === Response ===
$response = [
    "product" => $product,
    "related_products" => $related_products
];

print_response(true, "Product data retrieved successfully", $response);
?>
