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
$contact = trim($ post['contact'] ?? '');

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

<?php
include('db_connect.php');

$sql = "SELECT * FROM connection_logs ORDER BY connected_at DESC LIMIT 10";
$result = mysqli_query($conn, $sql);

$logs = [];
while ($row = mysqli_fetch_assoc($result)) {
    $logs[] = $row;
}

header('Content-Type: application/json');
echo json_encode($logs);

mysqli_close($conn);
?>
<?php
// Database connection
$servername = "sqlXXX.epizy.com";  // 🔹 Replace with your host
$username = "epiz_12345678";       // 🔹 Replace with your username
$password = "yourpassword";        // 🔹 Replace with your password
$dbname = "epiz_12345678_airdroid_db"; // 🔹 Replace with your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get data from form
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Insert into database
$sql = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";

if ($conn->query($sql) === TRUE) {
  echo "✅ Message sent successfully!";
} else {
  echo "❌ Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>