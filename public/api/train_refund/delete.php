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
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        echo json_encode(array("status" => "error", "message" => "ID parameter is required"));
        exit();
    }
    
    $id = $conn->real_escape_string($_POST['id']);
}

$sql = "DELETE FROM train_refund WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

$id = $_POST['id'];

if ($stmt->execute()) {
    echo json_encode(array("status" => "success", "message" => "Train refund with ID $id deleted successfully"));
} else {
    echo json_encode(array("status" => "error", "message" => "Error deleting train refund: " . $stmt->error));
}

$stmt->close();
$conn->close();
?>
