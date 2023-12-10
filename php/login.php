<?php

$db_host = "localhost";
$db_name = "signup";
$db_username = "root";
$db_password = "";

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// $mongo = new MongoDB\Client("mongodb+srv://zeeshan14:zeeshanguvi@cluster0.eezchuz.mongodb.net/?retryWrites=true&w=majority");

// $redis = new Redis();
// $redis->connect('localhost', 6379);



if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Invalid request method");
}

$username = $_POST["username"];
$password = $_POST["password"];

$sql = "SELECT  password FROM logindata WHERE username = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("s", $username);

$stmt->execute();

$stmt->bind_result($user_id, $hashed_password);

$stmt->fetch();

if (password_verify($password, $hashed_password)) {
    // $session_id = uniqid();
    // $_SESSION["session_id"] = $session_id;

    // $redis->set($session_id, $user_id);

    header("Location: profile.html");
} else {
    echo "Invalid username or password";
}

$stmt->close();

$conn->close();
