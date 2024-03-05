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
    
    $id = $_POST['id'];
    
    $fieldsToUpdate = array();
    if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
        $fieldsToUpdate[] = "user_id = '" . $conn->real_escape_string($_POST['user_id']) . "'";
    }
    
    if (empty($fieldsToUpdate)) {
        echo json_encode(array("status" => "error", "message" => "At least one parameter other than id must be provided for update"));
        exit();
    }
    
    $sql = "UPDATE train_booking SET " . implode(", ", $fieldsToUpdate) . " WHERE id = '$id'";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "Record updated successfully"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error updating record: " . $conn->error));
    }
}

$conn->close();
?>
