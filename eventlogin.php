<?php
session_start();


if (isset($_POST['submit'])) {
    $username = $_POST['usname'];
    $password = $_POST['pass'];

    // Check if the user is admin
    if ($username === 'admin' && $password === 'admin') {
        $_SESSION['username'] = $username;
        header("Location: adminlogin.php");
        exit();
    }

    // Database connection
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "pgmanagement";

    // Establishing connection
    $conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Escape the input to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to check if the username, password, and status are correct in the `user` table
    $query = "SELECT * FROM user WHERE username='$username' AND password='$password' AND status='1'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        // Set session variables
        $_SESSION['username'] = $username;
        $_SESSION['userID'] = $row['ID'];
        $_SESSION['RoomID'] = $row['RoomID'];

        // Redirect to the payment page
        header("Location: paymentpage.php?pgID={$row['PGID']}&roomID={$row['RoomID']}");
        exit();
    } else {
        echo "<script>alert('Invalid username, password, or user is inactive.'); window.history.back();</script>";
    }

    mysqli_close($conn);
}
?>
