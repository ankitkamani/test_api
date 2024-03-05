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
    $train_id = isset($_POST['train_id']) ? sanitizeInput($_POST['train_id']) : '';
    $refund = isset($_POST['refund']) ? sanitizeInput($_POST['refund']) : '';

    
    if (empty($train_id) || empty($refund)) {
        $response = array("status" => "error", "message" => "All fields are required");
        echo json_encode($response);
        exit();
    }
}


$sql = "INSERT INTO train_refund (train_id, refund) VALUES ('$train_id', '$refund')";


if ($conn->query($sql) === TRUE) {
    $response = array("status" => "success", "message" => "Data inserted successfully");
    echo json_encode($response);
} else {
    $response = array("status" => "error", "message" => "Error: " . $sql . "<br>" . $conn->error);
    echo json_encode($response);
}


$conn->close();
?>
