<?php

$db_host = "localhost";
$db_name = "signup";
$db_username = "root";
$db_password = "";

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$mongo = new MongoDB\Client("mongodb+srv://zeeshan14:zeeshanguvi@cluster0.eezchuz.mongodb.net/?retryWrites=true&w=majority");

$redis = new Redis();
$redis->connect('localhost', 6379);



if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Invalid request method");
}

$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO logindata (username, email, password) VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param("sss", $username, $email, $hashed_password);

if ($stmt->execute()) {
    echo "User registered successfully!";
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();

$conn->close();

