<?php
// process_form.php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status'=>'error','message'=>'Method not allowed']);
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');
$contact = trim($_post['contact']?? ''); 

if ($name === '' || $email === '' || $message === '') {
    http_response_code(422);
    echo json_encode(['status'=>'error','message'=>'Please fill all fields.']);
    exit;
}

require_once 'connect.php';

$stmt = $conn->prepare("INSERT INTO contact_form (name, email, message) VALUES (?, ?, ?)");
if (!$stmt) {
    http_response_code(500);
    echo json_encode(['status'=>'error','message'=>'Prepare failed']);
    exit;
}
$stmt->bind_param('sss', $name, $email, $message);
$ok = $stmt->execute();
$stmt->close();
$conn->close();

if ($ok) {
    echo json_encode(['status'=>'success','message'=>'Message saved.']);
} else {
    http_response_code(500);
    echo json_encode(['status'=>'error','message'=>'Save failed.']);
}
?>