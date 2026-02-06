<?php
require_once('config.php');

// === Configuration ===
$request_method = "POST";
$required_fields = ["name", "email", "phone", "password", "cpassword"];
validate_request_method($request_method);
$data = validate_request_body($request_method, $required_fields);

// === Logic ===
function signup($data) {
    global $conn;

    $name      = mysqli_real_escape_string($conn, trim($data['name']));
    $email     = mysqli_real_escape_string($conn, trim($data['email']));
    $phone     = mysqli_real_escape_string($conn, trim($data['phone']));
    $password  = trim($data['password']);
    $cpassword = trim($data['cpassword']);

    // 1. Validate inputs
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        print_response(false, "Invalid email format.");
    }

    if ($password !== $cpassword) {
        print_response(false, "Passwords do not match.");
    }

    // 2. Check if email already exists
    $check = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email' LIMIT 1");
    if ($check && mysqli_num_rows($check) > 0) {
        print_response(false, "Email already registered.");
    }

    // 3. Hash password
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // 4. Insert new user
    $sql = "INSERT INTO users (name, email, phone, password, status, created_at)
            VALUES (?, ?, ?, ?, 1, NOW())";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $phone, $password_hash);

    if (!mysqli_stmt_execute($stmt)) {
        print_response(false, "Database error: " . mysqli_error($conn));
    }

    // Optionally return user info (without password)
    $new_id = mysqli_insert_id($conn);
    $user = [
        "id"    => $new_id,
        "name"  => $name,
        "email" => $email,
        "phone" => $phone
    ];

    print_response(true, "Account created successfully.", $user);
}

// === Execute ===
signup($data);
