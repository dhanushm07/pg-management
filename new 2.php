<?php
$servername = "localhost"; // Your database server
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "pgmanagement"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch PGs
if (isset($_GET['action']) && $_GET['action'] == 'get_pg_list') {
    $result = $conn->query("SELECT PGID as id, PGName as name FROM pg");
    $pgList = [];
    while ($row = $result->fetch_assoc()) {
        $pgList[] = $row;
    }
    echo json_encode($pgList);
    exit();
}

// Function to fetch PG details
if (isset($_GET['action']) && $_GET['action'] == 'get_pg_details' && isset($_GET['id'])) {
    $pgID = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM pg WHERE PGID = $pgID");
    $pgDetails = $result->fetch_assoc();
    echo json_encode($pgDetails);
    exit();
}

// Function to fetch Room details
if (isset($_GET['action']) && $_GET['action'] == 'get_room_details' && isset($_GET['pgid'])) {
    $pgID = intval($_GET['pgid']);
    $result = $conn->query("SELECT * FROM room WHERE PGID = $pgID");
    $rooms = [];
    while ($row = $result->fetch_assoc()) {
        $rooms[] = $row;
    }
    echo json_encode($rooms);
    exit();
}

// Handle PG and Room data saving
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'pgroomadd') {
    // Handle PG details
    $pgID = isset($_POST['pgid']) ? intval($_POST['pgid']) : null;
    $pgName = $conn->real_escape_string($_POST['pgname']);
    $pgAddress = $conn->real_escape_string($_POST['pgaddress']);
    $pgMobile = $conn->real_escape_string($_POST['pgmobile']);
    $pgEmail = $conn->real_escape_string($_POST['pgmail']);
    $advance = $conn->real_escape_string($_POST['advance']);
    $pgGender = $conn->real_escape_string($_POST['pggender']);

    // Handle photo upload
    $pgPhoto = '';
    if (isset($_FILES['pgphoto']) && $_FILES['pgphoto']['error'] == UPLOAD_ERR_OK) {
        $pgPhoto = 'uploads/' . basename($_FILES['pgphoto']['name']);
        move_uploaded_file($_FILES['pgphoto']['tmp_name'], $pgPhoto);
    }

    // Determine whether to insert or update
    if ($pgID) {
        // Update existing PG
        $sql = "UPDATE pg SET 
                PGName='$pgName', 
                PGAddress='$pgAddress', 
                PGMobile='$pgMobile', 
                PGMail='$pgEmail', 
                Advance='$advance', 
                PGGender='$pgGender', 
                PGImage='$pgPhoto' 
                WHERE PGID=$pgID";
    } else {
        // Insert new PG
        $sql = "INSERT INTO pg (PGName, PGAddress, PGMobile, PGMail, Advance, PGGender, PGImage) 
                VALUES ('$pgName', '$pgAddress', '$pgMobile', '$pgEmail', '$advance', '$pgGender', '$pgPhoto')";
        $conn->query($sql);
        $pgID = $conn->insert_id; // Get the inserted PG ID
    }

    // Execute the PG query
    if ($conn->query($sql) === TRUE) {
        // Handle Room details
        $roomNames = $_POST['roomname'];
        $roomSharings = $_POST['roomsharing'];
        $roomRents = $_POST['roomrent'];
        $roomACs = $_POST['acnonac'];

        // Delete existing rooms if editing an existing PG
        if ($pgID) {
            $conn->query("DELETE FROM room WHERE PGID = $pgID");
        }

        foreach ($roomNames as $index => $roomName) {
            $roomName = $conn->real_escape_string($roomName);
            $roomSharing = $conn->real_escape_string($roomSharings[$index]);
            $roomRent = $conn->real_escape_string($roomRents[$index]);
            $roomAC = $conn->real_escape_string($roomACs[$index]);

            // Insert Room
            $sql = "INSERT INTO room (PGID, RoomName, Sharing, RoomRent, ACNonAC) 
                    VALUES ('$pgID', '$roomName', '$roomSharing', '$roomRent', '$roomAC')";
            $conn->query($sql);
        }

        echo json_encode(['status' => 'success', 'message' => 'Data submitted successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error saving PG details: ' . $conn->error]);
    }
}

$conn->close();
?>
