<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "pgmanagement");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM pg";
$result = $conn->query($query);

$pgs = array();
while ($row = $result->fetch_assoc()) {
    $pgs[] = $row;
}

echo json_encode($pgs);
$conn->close();
?>
