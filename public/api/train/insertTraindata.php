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
    $name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : '';
    $path = isset($_POST['path']) ? sanitizeInput($_POST['path']) : '';
    $status = isset($_POST['status']) ? sanitizeInput($_POST['status']) : '';

    
    if (empty($name) || empty($path) || empty($status)) {
        $response = array("status" => "error", "message" => "All fields are required");
        echo json_encode($response);
        exit();
    }
}

$sql = "INSERT INTO train_details (name, path, status) VALUES ('$name', '$path', '$status')";

if ($conn->query($sql) === TRUE) {
    $response = array("status" => "success", "message" => "Data inserted successfully");
    echo json_encode($response);
} else {
    $response = array("status" => "error", "message" => "Error: " . $sql . "<br>" . $conn->error);
    echo json_encode($response);
}

$conn->close();
?>
