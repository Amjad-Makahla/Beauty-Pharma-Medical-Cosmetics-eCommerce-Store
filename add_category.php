<?php
require_once 'config.php';
header("Content-Type: application/json");

// Validate method
validate_request_method("POST");

// Required fields
$data = validate_request_body("POST", ['name']);

// Extract input
$name        = $data['name'];
$name_ar     = $data['name_ar'] ?? null;
$status      = 1; // دايمًا 1
$parent_id   = isset($data['parent_category_id']) ? intval($data['parent_category_id']) : null;
$imageBase64 = $data['image_base64'] ?? null;

// Ensure folder exists
$relative_folder  = 'assets/images/categories/';
$save_path        = '../' . $relative_folder;
$public_url_base  = $base_urls['images_url'] . 'categories/';

if (!file_exists($save_path)) {
    mkdir($save_path, 0777, true);
}

// Save base64 image
function save_base64_image($base64_data, $savePath, $publicUrlBase) {
    if (strpos($base64_data, ',') !== false) {
        $base64_data = explode(',', $base64_data)[1];
    }
    $decoded_data = base64_decode($base64_data);
    if ($decoded_data === false) {
        print_response(false, "Invalid Base64 image data."); exit;
    }
    $filename  = uniqid('category_', true) . '.png';
    $full_path = $savePath . $filename;
    if (!file_put_contents($full_path, $decoded_data)) {
        print_response(false, "Failed to save the image."); exit;
    }
    return $publicUrlBase . $filename;
}

$imageFilePath = null;
if ($imageBase64) {
    $imageFilePath = save_base64_image($imageBase64, $save_path, $public_url_base);
}

// Insert into categories
$sql = "INSERT INTO categories (name, name_ar, parent_category_id, image, status, created_at)
        VALUES (?, ?, ?, ?, ?, NOW())";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("ssisi", $name, $name_ar, $parent_id, $imageFilePath, $status);

    if ($stmt->execute()) {
        $category_id = $stmt->insert_id;

        print_response(true, "Category added successfully", [
            "category_id"       => $category_id,
            "name"              => $name,
            "name_ar"           => $name_ar,
            "parent_category_id"=> $parent_id,
            "image_url"         => $imageFilePath,
            "status"            => $status
        ]);
    } else {
        print_response(false, "Failed to add category: " . $stmt->error);
    }
    $stmt->close();
} else {
    print_response(false, "Database error: " . $conn->error);
}

$conn->close();
