<?php
// fetch_room.php

$host = 'localhost';
$dbusername = 'root';
$dbpassword = '';
$dbname = 'pgmanagement';

// Connect to the database
$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

$pg_id = $_GET['pg_id'];

// Query to get room details for the selected PG
$query = "SELECT RoomName, Sharing, RoomImage, RoomRent, ACNonAC, vacancy, PGID, RoomID FROM room WHERE PGID = $pg_id";
$result = mysqli_query($conn, $query);

$rooms = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rooms[] = $row;
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($rooms);

mysqli_close($conn);
?>
