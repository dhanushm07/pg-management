<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request for PG Joining</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        header {
            background-color: #0288D1;
            color: white;
            padding: 10px 20px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-top: 0;
            color: white;
        }

        form {
            background: #fff;
            padding: 18px;
            border-radius: 8px;
            max-width: 600px;
            margin: 50px auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #0056b3;
        }

        footer {
            background-color: #0288D1;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        #selectedPG {
            margin-top: 20px;
            background: #f1f1f1;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        #successMessage {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
            display: none;
        }
    </style>
</head>
<body>
    <header>
        <h1>Request for PG Joining</h1>
    </header>

    <form id="newTenant" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="pg_id" value="<?php echo isset($_GET['pg_id']) ? htmlspecialchars($_GET['pg_id']) : ''; ?>">
        <input type="hidden" name="room_id" value="<?php echo isset($_GET['room_id']) ? htmlspecialchars($_GET['room_id']) : ''; ?>">

        <label for="tenantname">Enter Name:</label>
        <input type="text" id="tenantname" name="tenantname" required>

        <label for="tenantphone">Enter Phone Number:</label>
        <input type="number" id="tenantphone" name="tenantphone" required>

        <label for="tenantmail">Enter Mail:</label>
        <input type="email" id="tenantmail" name="tenantmail" required>

        <label for="tenantdoc">Upload Document:</label>
        <input type="file" id="tenantdoc" name="tenantdoc"><br>

        <label for="gender">Choose Gender:</label>
        <select id="gender" name="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>

        <div id="selectedPG">
            <?php
                // Database connection details
                $host = "localhost";
                $dbusername = "root";
                $dbpassword = "";
                $dbname = "pgmanagement";

                // Create a connection
                $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                if (isset($_GET['pg_id']) && isset($_GET['room_id'])) {
                    $pgID = htmlspecialchars($_GET['pg_id']);
                    $roomID = htmlspecialchars($_GET['room_id']);

                    // Fetch PG and Room details
                    $pgQuery = "SELECT PGName FROM pg WHERE PGID = '$pgID'";
                    $roomQuery = "SELECT RoomName FROM room WHERE RoomID = '$roomID'";

                    $pgResult = $conn->query($pgQuery);
                    $roomResult = $conn->query($roomQuery);

                    if ($pgResult && $roomResult) {
                        $pgName = $pgResult->fetch_assoc()['PGName'];
                        $roomName = $roomResult->fetch_assoc()['RoomName'];

                        echo "<h3>Your Selected PG: " . htmlspecialchars($pgName) . "</h3>";
                        echo "<h4>Room: " . htmlspecialchars($roomName) . "</h4>";
                    } else {
                        echo "<h3>PG or Room not found.</h3>";
                    }

                    // Close the database connection
                    $conn->close();
                }
            ?>
        </div>

        <button type="submit">Submit Detail</button>

        <div id="successMessage"></div>
    </form>

    <footer>
        <p>&copy; 2024 PG Management System</p>
    </footer>

    <script>
        document.getElementById('newTenant').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent traditional form submission

            let formData = new FormData(this);

            fetch('savedata.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.username && data.password) {
                    let successMessage = document.getElementById('successMessage');
                    successMessage.style.display = 'block';
                    successMessage.innerHTML = `
                        <h4>Details submitted successfully!</h4>
                        <p><strong>Generated Username:</strong> ${data.username}</p>
                        <p><strong>Password:</strong> ${data.password}</p>
                        <p>Please log in with these credentials after receiving the confirmation email.</p>
                    `;
                } else if (data.error) {
                    alert('Error: ' + data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
