<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "pgmanagement";

// Establishing connection
$conn = mysql_connect($host, $dbusername, $dbpassword);
mysql_select_db($dbname, $conn);

if (!$conn) {
    die("Connection failed: " . mysql_error());
}

// Handle status update request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && isset($_POST['id'])) {
    $userID = intval($_POST['id']);
    $action = $_POST['action'];
    
    if ($action == 'accept') {
        $status = '1';  // Status 1 = Accepted
    } elseif ($action == 'deny') {
        $status = '2';  // Status 2 = Denied
    } else {
        $status = '0';  // Default status if no action is taken
    }
    
    // Update user status in the database
    $query = "UPDATE user SET status = '$status' WHERE ID = '$userID'";
    if (mysql_query($query)) {
        echo "<script>alert('Status updated successfully!');</script>";
    } else {
        echo "<script>alert('Error updating status: " . mysql_error() . "');</script>";
    }
}

// Fetch tenant details from the user table
$query = "SELECT * FROM user WHERE status = '0'"; // Only show pending requests (status = 0)
$result = mysql_query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Requests</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0; /* Light grey background */
        }
        header {
            background-color: #007bff; /* Blue header */
            color: white;
            padding: 10px 20px;
            text-align: center;
        }
        footer {
            background-color: #007bff; /* Blue footer */
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
        .container {
            max-width: 1200px;
            margin: 80px auto 60px; /* Adjust margin to avoid footer overlap */
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            padding: 5px 10px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            color: white;
        }
        button[name="action"][value="accept"] {
            background-color: #28a745; /* Green */
        }
        button[name="action"][value="deny"] {
            background-color: #dc3545; /* Red */
        }
    </style>
</head>
<body>
    <header>
        <h1>Validate the Tenant</h1>
    </header>

    <div class="container">
        <h2>Tenant Requests</h2>

        <?php if (mysql_num_rows($result) > 0) { ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysql_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['ID']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['mail']; ?></td>
                            <td><?php echo $row['phone']; ?></td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                                    <button type="submit" name="action" value="accept">Accept</button>
                                    <button type="submit" name="action" value="deny">Deny</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>No pending tenant requests.</p>
        <?php } ?>
    </div>

    <footer>
        <p>&copy; 2024 PG Management System</p>
    </footer>
</body>
</html>

<?php
mysql_close($conn);  // Close the database connection
?>
