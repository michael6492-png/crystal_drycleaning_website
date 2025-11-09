<?php
// connect.php - database connection
$servername = "localhost";
$username = "root";
$password = ""; // default XAMPP password is empty
$database = "airdroid_db";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    http_response_code(500);
    die("Database connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
?>