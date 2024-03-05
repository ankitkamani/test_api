<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "db_train";


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM train_refund";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();
    
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo "0 results";
}


$conn->close();
?>
