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



$session_id = $_SESSION["session_id"];

if (!$redis->exists($session_id)) {
    header("Location: login.html");
}

$user_id = $redis->get($session_id);

$collection = $mongo->db->users;
$document = $collection->findOne(["_id" => new MongoDB\BSON\ObjectID($user_id)]);

$username = $document["username"];
$email = $document["email"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $age = $_POST["age"];
    $dob = $_POST["dob"];
    $contact = $_POST["contact"];

    $collection->updateOne(
        ["_id" => new MongoDB\BSON\ObjectID($user_id)],
        [
            "$set" => [
                "age" => $age,
                "dob" => $dob,
                "contact" => $contact,
            ],
        ]
    );

    echo "Profile updated successfully!";
}

echo "<h2>Username: $username</h2>";
echo "<h2>Email: $email</h2>";

if (isset($document["age"])) {
    echo "<h2>Age: " . $document["age"] . "</h2>";
}
if (isset($document["dob"])) {
    echo "<h2>Date of Birth: " . $document["dob"] . "</h2>";
}
if (isset($document["contact"])) {
    echo "<h2>Contact Number: " . $document["contact"] . "</h2>";
}
