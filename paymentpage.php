<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    header("Location: homepage.php");
    exit();
}

// Database connection
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "pgmanagement";

// Establish connection using mysqli
$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['amount'])) {
    $userID = $_SESSION['userID'];
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $pgID = mysqli_real_escape_string($conn, $_POST['pgID']);
    $roomID = mysqli_real_escape_string($conn, $_POST['roomID']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $status = 1; // Assuming 1 means completed

    // Prepare the payment query
    $query = "INSERT INTO payment (userID, pgID, roomID, amount, status, date, comment) 
              VALUES ('$userID', '$pgID', '$roomID', '$amount', '$status', NOW(), '$comment')";

    if (mysqli_query($conn, $query)) {
        // If payment is successful, update the vacancy in the room table
        $updateVacancyQuery = "UPDATE room SET vacancy = vacancy - 1 WHERE RoomID = '$roomID' AND vacancy > 0";
        if (mysqli_query($conn, $updateVacancyQuery)) {
            echo "<script>alert('Payment successful and vacancy updated!'); window.location.href='homepage.php';</script>";
        } else {
            echo "<script>alert('Payment successful but failed to update vacancy: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.history.back();</script>";
    }
}

// Fetch room details
if (isset($_GET['roomID'])) {
    $roomID = mysqli_real_escape_string($conn, $_GET['roomID']);
    $query = "SELECT RoomRent, Advance FROM room WHERE RoomID = '$roomID'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $roomData = mysqli_fetch_assoc($result);
        $roomRent = $roomData['RoomRent'];
        $advance = $roomData['Advance'];
        $totalAmount = $roomRent + $advance;
    } else {
        $roomRent = $advance = $totalAmount = 0;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        header {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<header>
    <h1>Payment Page</h1>
</header>

<div class="container">
    <form action="" method="POST">
        <label for="roomRent">Room Rent:</label>
        <input type="text" value="<?php echo $roomRent; ?>" readonly>

        <label for="advance">Advance:</label>
        <input type="text" value="<?php echo $advance; ?>" readonly>

        <label for="totalAmount">Total Amount:</label>
        <input type="text" name="amount" value="<?php echo $totalAmount; ?>" readonly>

        <input type="hidden" name="pgID" value="<?php echo $_GET['pgID']; ?>">
        <input type="hidden" name="roomID" value="<?php echo $_GET['roomID']; ?>">

        <label for="comment">Comment:</label>
        <input type="text" name="comment">

        <button type="submit">Pay</button>
    </form>
</div>

</body>
</html>

<?php
mysqli_close($conn);
?>
