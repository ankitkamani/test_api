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
    $class = isset($_POST['class']) ? sanitizeInput($_POST['class']) : '';

    
    if (empty($train_id) || empty($class)) {
        $response = array("status" => "error", "message" => "All fields are required");
        echo json_encode($response);
        exit();
    }
}

$sql = "INSERT INTO train_class (train_id, class) VALUES ('$train_id', '$class')";

if ($conn->query($sql) === TRUE) {
    $response = array("status" => "success", "message" => "Data inserted successfully");
    echo json_encode($response);
} else {
    $response = array("status" => "error", "message" => "Error: " . $sql . "<br>" . $conn->error);
    echo json_encode($response);
}

$conn->close();
?>
