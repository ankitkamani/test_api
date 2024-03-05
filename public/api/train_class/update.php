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
    if (!isset($_POST['id']) || empty($_POST['id']) || !isset($_POST['train_id']) || empty($_POST['train_id']) || !isset($_POST['class']) || empty($_POST['class'])) {
        echo json_encode(array("status" => "error", "message" => "All fields are required"));
        exit();
    }
    
    $id = $conn->real_escape_string($_POST['id']);
    $train_id = $conn->real_escape_string($_POST['train_id']);
    $class = $conn->real_escape_string($_POST['class']);
}

$sql = "UPDATE train_class SET train_id = ?, class = ? WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $train_id, $class, $id);

$id = $_POST['id'];
$train_id = $_POST['train_id'];
$class = $_POST['class'];

if ($stmt->execute()) {
    echo json_encode(array("status" => "success", "message" => "Train class with ID $id updated successfully"));
} else {
    echo json_encode(array("status" => "error", "message" => "Error updating train class: " . $stmt->error));
}

$stmt->close();
$conn->close();
?>
