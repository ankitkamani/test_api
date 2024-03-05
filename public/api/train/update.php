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
    if (!isset($_POST['train_id']) || empty($_POST['train_id']) || !isset($_POST['name']) || empty($_POST['name']) || !isset($_POST['path']) || empty($_POST['path']) || !isset($_POST['status']) || empty($_POST['status'])) {
        echo json_encode(array("status" => "error", "message" => "All fields are required"));
        exit();
    }
    
    $train_id = $conn->real_escape_string($_POST['train_id']);
    $name = $conn->real_escape_string($_POST['name']);
    $path = $conn->real_escape_string($_POST['path']);
    $status = $conn->real_escape_string($_POST['status']);
}

$sql = "UPDATE train_details SET name = ?, path = ?, status = ? WHERE train_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $name, $path, $status, $train_id);

$name = $_POST['name'];
$path = $_POST['path'];
$status = $_POST['status'];

if ($stmt->execute()) {
    echo json_encode(array("status" => "success", "message" => "Train details with train_id $train_id updated successfully"));
} else {
    echo json_encode(array("status" => "error", "message" => "Error updating train details: " . $stmt->error));
}

$stmt->close();
$conn->close();
?>
