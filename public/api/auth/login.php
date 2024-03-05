<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "db_train";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($username) || empty($password)) {
        echo json_encode(array("status" => "error", "message" => "Both username and password are required"));
        exit();
    }

    
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo json_encode(array("status" => "success", "message" => "Login successful"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Invalid username or password"));
    }
}

$conn->close();
?>
