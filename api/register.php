<?php
// Allow requests from the frontend
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Read the JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Simple validation
if (!isset($data['username'], $data['email'], $data['password'])) {
    echo json_encode(["success" => false, "message" => "Missing fields"]);
    exit;
}

$username = $data['username'];
$email = $data['email'];
$password = password_hash($data['password'], PASSWORD_DEFAULT); // Securely hash password

// OPTIONAL: Insert into database (you must configure this part)
$host = 'localhost';
$db   = 'your_database';
$user = 'your_db_user';
$pass = 'your_db_password';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $password]);

    echo json_encode(["success" => true, "message" => "User registered successfully"]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Database error: " . $e->getMessage()]);
}