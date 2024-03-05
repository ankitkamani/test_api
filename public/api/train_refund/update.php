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
    if (!isset($_POST['id']) || empty($_POST['id']) || !isset($_POST['train_id']) || empty($_POST['train_id']) || !isset($_POST['refund']) || empty($_POST['refund'])) {
        echo json_encode(array("status" => "error", "message" => "All fields are required"));
        exit();
    }
    
    $id = $conn->real_escape_string($_POST['id']);
    $train_id = $conn->real_escape_string($_POST['train_id']);
    $refund = $conn->real_escape_string($_POST['refund']);
}

$sql = "UPDATE train_refund SET train_id = ?, refund = ? WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("isi", $train_id, $refund, $id);

$id = $_POST['id'];
$train_id = $_POST['train_id'];
$refund = $_POST['refund'];

if ($stmt->execute()) {
    echo json_encode(array("status" => "success", "message" => "Train refund with ID $id updated successfully"));
} else {
    echo json_encode(array("status" => "error", "message" => "Error updating train refund: " . $stmt->error));
}

$stmt->close();
$conn->close();
?>
