<?php
require_once('config.php');

// === Configuration ===
$request_method = "POST";
$required_fields = ["username", "password"];
validate_request_method($request_method);
$data = validate_request_body($request_method, $required_fields);

// === Logic ===
function login($data) {
    global $pdo;

    $username = trim($data['username']);
    $password = trim($data['password']);

    // Check if user exists
    $stmt = $pdo->prepare("SELECT id, username, password FROM admin WHERE username = ? AND status = 1 LIMIT 1");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        print_response(false, "بيانات الدخول غير صحيحة.");
    }

    // Check password
    if (!password_verify($password, $user['password'])) {
        print_response(false, "بيانات الدخول غير صحيحة.");
    }

    // Optionally remove password before returning
    unset($user['password']);

    print_response(true, "تم تسجيل الدخول بنجاح.", $user);
}

// === Execute ===
login($data);

// === Helper function ===
function print_response($success, $message, $data = null) {
    $response = ['status' => $success ? 'ok' : 'error', 'message' => $message];
    if ($data) $response['data'] = $data;
    echo json_encode($response);
    exit;
}
?>
