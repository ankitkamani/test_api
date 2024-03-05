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
        echo json_encode(array("status" => "error", "message" => "id parameter is required"));
        exit();
    }
    
    $id = $conn->real_escape_string($_POST['id']);
}

$sql = "DELETE FROM train_booking WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("status" => "success", "message" => "Record deleted successfully"));
} else {
    echo json_encode(array("status" => "error", "message" => "Error deleting record: " . $conn->error));
}

$conn->close();
?>
