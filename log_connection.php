<?php
// fetch_info.php
header('Content-Type: application/json');
require_once 'connect.php';

$sql = "SELECT id, name, role, email, website FROM owner_info ORDER BY id ASC LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(['status'=>'ok','data'=>$row]);
} else {
    echo json_encode(['status'=>'error','message'=>'No owner info found']);
}
$conn->close();
?>

<?php
include('db_connect.php'); // connects to MySQL

// Get visitor data
$ip = $_SERVER['REMOTE_ADDR'];
$browser = $_SERVER['HTTP_USER_AGENT'];
$time = date("Y-m-d H:i:s");

// Insert into database
$sql = "INSERT INTO connection_logs (ip_address, browser_info, connected_at)
        VALUES ('$ip', '$browser', '$time')";

if (mysqli_query($conn, $sql)) {
    echo "Connection logged successfully";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>