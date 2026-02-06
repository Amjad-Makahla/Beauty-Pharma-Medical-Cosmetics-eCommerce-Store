<?php
require_once('config.php');

validate_request_method("GET");
$data = validate_request_body("GET", ["ambassador_id"]);

$stmt = $conn->prepare("UPDATE ambassadors SET status = 0 WHERE id = ?");
$stmt->bind_param("i", $data['ambassador_id']);

if ($stmt->execute()) {
    print_response(true, "Ambassador deleted");
} else {
    print_response(false, "Delete failed");
}
