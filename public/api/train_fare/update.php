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
    if (!isset($_POST['id']) || empty($_POST['id']) || !isset($_POST['train_id']) || empty($_POST['train_id']) || !isset($_POST['class_id']) || empty($_POST['class_id']) || !isset($_POST['fare']) || empty($_POST['fare'])) {
        echo json_encode(array("status" => "error", "message" => "All fields are required"));
        exit();
    }
    
    $id = $conn->real_escape_string($_POST['id']);
    $train_id = $conn->real_escape_string($_POST['train_id']);
    $class_id = $conn->real_escape_string($_POST['class_id']);
    $fare = $conn->real_escape_string($_POST['fare']);
}

$sql = "UPDATE train_fare SET train_id = ?, class_id = ?, fare = ? WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iiii", $train_id, $class_id, $fare, $id);

$id = $_POST['id'];
$train_id = $_POST['train_id'];
$class_id = $_POST['class_id'];
$fare = $_POST['fare'];

if ($stmt->execute()) {
    echo json_encode(array("status" => "success", "message" => "Train fare with ID $id updated successfully"));
} else {
    echo json_encode(array("status" => "error", "message" => "Error updating train fare: " . $stmt->error));
}

$stmt->close();
$conn->close();
?>
