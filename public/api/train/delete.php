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
    if (!isset($_POST['train_id']) || empty($_POST['train_id'])) {
        echo json_encode(array("status" => "error", "message" => "train_id parameter is required"));
        exit();
    }
    
    $train_id = $_POST['train_id'];
}

$sql = "DELETE FROM train_details WHERE train_id = '$train_id'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("status" => "success", "message" => "Train details with train_id $train_id deleted successfully"));
} else {
    echo json_encode(array("status" => "error", "message" => "Error deleting train details: " . $conn->error));
}

$conn->close();
?>
