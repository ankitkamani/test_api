<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "db_train";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET['user_id']) || empty($_GET['user_id'])) {
        echo json_encode(array("status" => "error", "message" => "user_id parameter is required"));
        exit();
    }
    
    $user_id = filter_var($_GET['user_id'], FILTER_SANITIZE_NUMBER_INT);
}

$sql = "SELECT train_booking.train_id, train_details.name, train_details.path, train_details.status 
        FROM train_booking 
        INNER JOIN train_details ON train_booking.train_id = train_details.train_id 
        WHERE train_booking.user_id = '$user_id'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode(array("status" => "error", "message" => "No records found for the given user_id"));
}

$conn->close();
?>
