<?php

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "pgmanagement";

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tenantname = $conn->real_escape_string(trim($_POST["tenantname"]));
    $tenantmail = $conn->real_escape_string(trim($_POST["tenantmail"]));
    $tenantphone = $conn->real_escape_string(trim($_POST["tenantphone"]));
    $gender = $conn->real_escape_string(trim($_POST["gender"]));
    $pgid = $conn->real_escape_string(trim($_POST["pg_id"]));
    $roomid = $conn->real_escape_string(trim($_POST["room_id"]));

    // Generate username and password
    $lastThreePhoneDigits = substr($tenantphone, -3);
    $username = strtolower($tenantname) . $lastThreePhoneDigits;
    $password = $username;  // Password same as the generated username

    // Handle document upload if exists
    $tenantdocName = '';
    if (isset($_FILES['tenantdoc']['name']) && $_FILES['tenantdoc']['name'] != '') {
        $tenantdocName = $_FILES['tenantdoc']['name'];
        $tenantdocTmpName = $_FILES['tenantdoc']['tmp_name'];
        $tenantdocDir = "tenantdoc/";
        $tenantdocPath = $tenantdocDir . basename($tenantdocName);

        if (!move_uploaded_file($tenantdocTmpName, $tenantdocPath)) {
            echo json_encode(['error' => 'Failed to upload file.']);
            exit;
        }
    }

    // Fetch PG Name and Room Name for the response
    $pgQuery = "SELECT PGName FROM pg WHERE PGID = '$pgid'";
    $roomQuery = "SELECT RoomName FROM room WHERE RoomID = '$roomid'";

    $pgResult = $conn->query($pgQuery);
    $roomResult = $conn->query($roomQuery);

    $pgName = ($pgResult && $pgResult->num_rows > 0) ? $pgResult->fetch_assoc()['PGName'] : 'Unknown PG';
    $roomName = ($roomResult && $roomResult->num_rows > 0) ? $roomResult->fetch_assoc()['RoomName'] : 'Unknown Room';

    // Insert into user table
    $query = "INSERT INTO user (name, mail, phone, username, password, status, rights, gender, RoomID, PgID) 
              VALUES ('$tenantname', '$tenantmail', '$tenantphone', '$username', '$password', '0', 'norights', '$gender', '$roomid', '$pgid')";

    if ($conn->query($query) === TRUE) {
        $userID = $conn->insert_id; // Get the last inserted ID

        // If there is a document, insert it into the documents table
        if ($tenantdocName != '') {
            $query2 = "INSERT INTO documents (DocumentFor, ForID, DocumentName) 
                       VALUES ('tenant', '$userID', '$tenantdocName')";
            $conn->query($query2);
        }

        // Return success response with generated username and password
        echo json_encode([
            'username' => $username,
            'password' => $password,
            'pgName' => $pgName,
            'roomName' => $roomName,
            'message' => 'Please log in with the generated username and password after receiving a confirmation email.'
        ]);
    } else {
        echo json_encode(['error' => 'Error: ' . $conn->error]);
    }

    // Close the connection
    $conn->close();
}
?>
