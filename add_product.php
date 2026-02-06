<?php
require_once 'config.php';

header("Content-Type: application/json");

// Validate method
validate_request_method("POST");

// Validate required fields
$data = validate_request_body("POST", [
    "name", "brand", "price", "size", "weight", "description", "status"
]);

// Extract input data
$name        = $data['name'];
$name_ar     = $data['name_ar'] ?? null;
$brand       = $data['brand'];
$price       = floatval($data['price']);
$size        = $data['size'];
$weight      = floatval($data['weight']);
$description = $data['description'];
$status      = ($data['status'] == 1) ? 1 : 0;
$stock       = $data['stock'] ?? 100;
$category_ids = $data['category_ids'] ?? []; 
$imageBase64 = $data['image_base64'] ?? null;

// Define paths
$relative_folder = 'assets/images/products/';
$save_path       = '../' . $relative_folder; // from /admin/api/
$public_url_base = $base_urls['images_url'] . 'products/';

// Save Base64 image helper
function save_base64_image($base64_data, $savePath, $publicUrlBase) {
    if (strpos($base64_data, ',') !== false) {
        $base64_data = explode(',', $base64_data)[1];
    }

    $decoded_data = base64_decode($base64_data);
    if ($decoded_data === false) {
        print_response(false, "Invalid Base64 image data.");
        exit;
    }

    $filename  = uniqid('product_', true) . '.png';
    $full_path = $savePath . $filename;

    if (!file_put_contents($full_path, $decoded_data)) {
        print_response(false, "Failed to save the image.");
        exit;
    }

    return $publicUrlBase . $filename;
}

// Handle image
$image_url = null;
if ($imageBase64) {
    $image_url = save_base64_image($imageBase64, $save_path, $public_url_base);
}

// Build SQL dynamically (with or without image)
if ($image_url) {
    $sql = "INSERT INTO products (name, name_ar, brand, price, stock, size, weight, description, image_url, is_active, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdisdssi", $name, $name_ar, $brand, $price, $stock, $size, $weight, $description, $image_url, $status);
} else {
    $sql = "INSERT INTO products (name, name_ar, brand, price, stock, size, weight, description, is_active, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdisdsi", $name, $name_ar, $brand, $price, $stock, $size, $weight, $description, $status);
}

// Execute insert
if (!$stmt->execute()) {
    print_response(false, "Failed to add product: " . $stmt->error);
    exit;
}

$product_id = $stmt->insert_id;
$stmt->close();

// Handle categories
if (!empty($category_ids)) {
    $link_sql = "INSERT INTO product_categories (product_id, category_id) VALUES (?, ?)";
    if ($link_stmt = $conn->prepare($link_sql)) {
        foreach ($category_ids as $cat_id) {
            $cat_id = intval($cat_id);
            $link_stmt->bind_param("ii", $product_id, $cat_id);
            $link_stmt->execute();
        }
        $link_stmt->close();
    }
}

print_response(true, "Product added successfully", ["product_id" => $product_id]);

$conn->close();
