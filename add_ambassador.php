<?php
require_once('config.php');

$request_method = "POST";
$required_fields = ["name", "email", "phone", "commission"];
validate_request_method($request_method);
$data = validate_request_body($request_method, $required_fields);

$name = trim($data['name']);
$email = trim($data['email']);
$phone = trim($data['phone']);
$commission = floatval($data['commission']);

// Generate a unique UUID
$uuid = bin2hex(random_bytes(16)); // 32-character hex string

// Prepare statement with created_at, updated_at, and uuid
$stmt = $conn->prepare("
    INSERT INTO ambassadors (name, email, phone, commission_percent, status, created_at, updated_at, uuid) 
    VALUES (?, ?, ?, ?, 1, NOW(), NOW(), ?)
");
$stmt->bind_param("ssdds", $name, $email, $phone, $commission, $uuid);

if ($stmt->execute()) {
    print_response(true, "Ambassador added successfully", ["uuid" => $uuid]);
} else {
    print_response(false, "Failed to add ambassador: " . $stmt->error);
}
