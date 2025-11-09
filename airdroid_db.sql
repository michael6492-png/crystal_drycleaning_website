-- Create database
CREATE DATABASE IF NOT EXISTS airdroid_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE airdroid_db;

-- contact_form table
CREATE TABLE IF NOT EXISTS contact_form (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  email VARCHAR(150) NOT NULL,
  message TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- connection_logs table
CREATE TABLE IF NOT EXISTS connection_logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  ip_address VARCHAR(50),
  device_info VARCHAR(255),
  connected_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- owner_info table
CREATE TABLE IF NOT EXISTS owner_info (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150),
  role VARCHAR(150),
  email VARCHAR(150),
  website VARCHAR(255),
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Insert your info (Ajijala Michael)
INSERT INTO owner_info (name, role, email, website)
VALUES ('Ajijala Michael', 'Software Engineer', 'ajijalamichael@gmail.com', 'www.michaeldigital.tech')
ON DUPLICATE KEY UPDATE name=VALUES(name);
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

CREATE TABLE messages (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100),
  message TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);