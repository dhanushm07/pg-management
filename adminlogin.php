<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f9;
            color: #333;
        }

        header {
            background-color: #0288D1;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-size: 1.5rem;
        }

        .login-form input {
            padding: 8px 10px;
            margin-right: 10px;
            border-radius: 4px;
            border: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .login-form button {
            padding: 8px 15px;
            background-color: white;
            color: #0288D1;
            border-radius: 4px;
            cursor: pointer;
            border: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        h2 {
            color: #0288D1;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .pg-listing, .room-listing {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .pg-item, .room-item {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .pg-item:hover, .room-item:hover {
            transform: scale(1.05);
        }

        .pg-item img, .room-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .pg-item div, .room-item div {
            padding: 15px;
        }

        .pg-item h3, .room-item h3 {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 10px;
        }

        .pg-item p, .room-item p {
            font-size: 0.9rem;
            color: #555;
        }

        .request-button {
            padding: 8px 12px;
            background-color: #0288D1;
            color: white;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            display: block;
            width: 100%;
            text-align: center;
            margin-top: 15px;
        }

        .request-button:disabled {
            background-color: #d9534f;
            cursor: not-allowed;
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


        button {
            background:  #0288D1; /* Blue background color for buttons */
            color: #fff; /* White text color */
            border: none; /* Remove border */
            padding: 8px 12px; /* Increased padding */
            border-radius: 4px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor on hover */
            font-size: 18px; /* Larger font size */
            margin: 10px; /* Spacing around button */
            transition: background 0.3s ease; /* Smooth background transition */
        }

        button:hover {
            background: #0056b3; /* Darker blue on hover */
        }

        button:active {
            background: #004494; /* Even darker blue when button is clicked */
        }
        @media (max-width: 768px) {
            header h1 {
                font-size: 1.2rem;
            }

            .pg-item img, .room-item img {
                height: 120px;
            }
        }
    </style>
</head>
<body>




</head>
<body>
    <header>
        <h1>PG Management</h1>
    </header>

    <div class="container">
        <center>
            <h1>Admin Panel</h1>
            <button onclick="add()">Add/Edit PG</button><br>
            <button onclick="request()">Tenant Requests</button><br>
            <button onclick="logout()">Logout</button>
        </center>
    </div>

    <footer>
        <p>&copy; 2024 PG Management System</p>
    </footer>

    <script>
        function add() {
            //header("Location: add_pg_room.php.php");

            window.location.href = "http://localhost/dhanush/add_pg_room.php";
        }
        
        function request() {
            window.location.href = "http://localhost/dhanush/requests.php";
        }

        function logout() {
            // Add your logout functionality here
            window.location.href = "http://localhost/dhanush/homepage.php"; // Adjust the logout URL as needed
        }
    </script>
</body>
</html>
