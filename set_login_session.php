<?php
require_once('config.php');

// === Configuration ===
$request_method = "POST";
$required_fields = ["user_id"];
validate_request_method($request_method);
$data = validate_request_body($request_method, $required_fields);

// === Logic ===
function login_user($data) {
    global $conn;

    $user_id = mysqli_real_escape_string($conn, $data['user_id']);

    $sql = "SELECT id FROM users WHERE id = '$user_id' AND status = 1 LIMIT 1";
    $res = mysqli_query($conn, $sql);

    if (!$res || mysqli_num_rows($res) === 0) {
        print_response(false, "Invalid email or password.");
    }

    $user = mysqli_fetch_assoc($res);

    session_start();
    $_SESSION['user_id'] = $user['id'];

    print_response(true, "Login successful.", [
        "user_id" => $user['id'],
    ]);
}

// === Execute ===
login_user($data);
