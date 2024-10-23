<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "pgmanagement");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$pg_id = intval($_GET['pg_id']); // Make sure pg_id is valid and sanitized

$query = "SELECT * FROM room WHERE PGID = $pg_id";
$result = $conn->query($query);

$rooms = array();
while ($row = $result->fetch_assoc()) {
    $rooms[] = $row;
}

echo json_encode($rooms);
$conn->close();
?>
