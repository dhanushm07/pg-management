<?php
error_reporting(0);

// Database connection details
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "pgmanagement";

// Establishing connection
$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle PG form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitPG'])) {
    $pgname = $_POST["pgname"];
    $pgaddress = $_POST["pgaddress"];
    $pgphone = $_POST["pgmobile"];
    $pgmail = $_POST["pgmail"];
    $pggender = $_POST["pggender"]; // New gender field
    $pgfeatures = isset($_POST["features"]) ? $_POST["features"] : []; // Handle features
    $advance = $_POST["advance"];

    // Handle PG Photo upload
    if (isset($_FILES['pgphoto']['name']) && $_FILES['pgphoto']['name'] != '') {
        $pgPhotoName = $_FILES['pgphoto']['name'];
        $pgPhotoTmpName = $_FILES['pgphoto']['tmp_name'];
        $pgPhotoDir = "pgphotos/";
        $pgPhotoPath = $pgPhotoDir . basename($pgPhotoName);
        move_uploaded_file($pgPhotoTmpName, $pgPhotoPath);
    } else {
        $pgPhotoName = ''; // Handle no photo uploaded case
    }

    // Insert PG details
    $query = "INSERT INTO pg (PGName, PGAddress, PGMobile, PGMail, PGGender, PGImage, Advance) 
              VALUES ('$pgname', '$pgaddress', '$pgphone', '$pgmail', '$pggender', '$pgPhotoName', '$advance')";
    if (mysqli_query($conn, $query)) {
        $pgID = mysqli_insert_id($conn); // Get the last inserted PG ID

        // Insert PG Features
        if (!empty($pgfeatures)) {
            foreach ($pgfeatures as $feature) {
                $featureQuery = "INSERT INTO feature (FeatureFor, ForID, Feature) VALUES ('PG', '$pgID', '$feature')";
                mysqli_query($conn, $featureQuery);
            }
        }

        // Handle Room form submission
        if (isset($_POST['roomname'])) {
            $roomnames = $_POST['roomname'];
            $sharings = $_POST['sharing'];
            $rents = $_POST['rent'];
            $acNonACs = $_POST['acNonAc'];
            $roomPhotos = $_FILES['roomphoto']['name'];

            foreach ($roomnames as $index => $roomname) {
                // Handle Room Photo upload
                if (isset($_FILES['roomphoto']['name'][$index]) && $_FILES['roomphoto']['name'][$index] != '') {
                    $roomPhotoTmpName = $_FILES['roomphoto']['tmp_name'][$index];
                    $roomPhotoDir = "roomphotos/";
                    $roomPhotoPath = $roomPhotoDir . basename($roomPhotos[$index]);
                    move_uploaded_file($roomPhotoTmpName, $roomPhotoPath);
                } else {
                    $roomPhotoPath = ''; // Handle no photo uploaded case
                }

                // Insert Room details
                $roomQuery = "INSERT INTO room (RoomName, Sharing, RoomImage, RoomRent, ACNonAC, PGID) 
                              VALUES ('$roomname', '$sharings[$index]', '$roomPhotoPath', '$rents[$index]', '$acNonACs[$index]', '$pgID')";
                mysqli_query($conn, $roomQuery);
            }
        }

        echo "<script>alert('PG and Room details stored successfully!');</script>";
    } else {
        echo "Error inserting PG data: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
