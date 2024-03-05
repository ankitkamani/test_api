<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "db_train";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = isset($_POST['user_id']) ? sanitizeInput($_POST['user_id']) : '';
    $train_id = isset($_POST['train_id']) ? sanitizeInput($_POST['train_id']) : '';

    
    if (empty($user_id) || empty($train_id)) {
        $response = array("status" => "error", "message" => "All fields are required");
        echo json_encode($response);
        exit();
    }
}

$sql = "INSERT INTO train_booking (user_id, train_id) VALUES ('$user_id', '$train_id')";

if ($conn->query($sql) === TRUE) {
    $response = array("status" => "success", "message" => "Data inserted successfully");
    echo json_encode($response);
} else {
    $response = array("status" => "error", "message" => "Error: " . $sql . "<br>" . $conn->error);
    echo json_encode($response);
}

$conn->close();
?>
