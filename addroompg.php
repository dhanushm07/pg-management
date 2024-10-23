<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PG Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h1, h2, h3 {
            color: #333;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        .form-group {
            margin-bottom: 1.5em;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 0.5em;
        }
        input[type="text"],
        input[type="email"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="file"] {
            padding: 5px;
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #218838;
        }
        #addRoomBtn {
            background-color: #007bff;
        }
        #addRoomBtn:hover {
            background-color: #0056b3;
        }
        #roomContainer {
            margin-top: 30px;
        }
        #roomForms > div {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fafafa;
        }
    </style>
</head>
<body>
    <h1>Welcome Admin</h1>

    <!-- PG Form (visible by default) -->
    <form id="pgForm" action="addrpgroomphp.php" method="POST" enctype="multipart/form-data">
        <h2>Add PG Details</h2>
        <div class="form-group">
            <label for="pgname">PG Name:</label>
            <input type="text" id="pgname" name="pgname" required>
        </div>
        <div class="form-group">
            <label for="pgaddress">PG Address:</label>
            <input type="text" id="pgaddress" name="pgaddress" required>
        </div>
        <div class="form-group">
            <label for="pgmobile">PG Mobile:</label>
            <input type="text" id="pgmobile" name="pgmobile" required>
        </div>
        <div class="form-group">
            <label for="pgmail">PG Mail:</label>
            <input type="email" id="pgmail" name="pgmail" required>
        </div>
        <div class="form-group">
            <label for="pggender">PG Gender:</label>
            <select id="pggender" name="pggender" required>
                <option value="Men">Men</option>
                <option value="Women">Women</option>
            </select>
        </div>

        <!-- PG Features Section -->
        <h3>Select PG Features</h3>
        <div class="form-group">
            <input type="checkbox" id="Fridge" name="features[]" value="Fridge">
            <label for="Fridge">Fridge</label>
        </div>
        <div class="form-group">
            <input type="checkbox" id="WashingMachine" name="features[]" value="Washing Machine">
            <label for="WashingMachine">Washing Machine</label>
        </div>
        <div class="form-group">
            <input type="checkbox" id="Kettle" name="features[]" value="Kettle">
            <label for="Kettle">Kettle</label>
        </div>
        <div class="form-group">
            <input type="checkbox" id="Wifi" name="features[]" value="Wifi">
            <label for="Wifi">Wifi</label>
        </div>

        <div class="form-group">
            <label for="pgphoto">PG Photo:</label>
            <input type="file" id="pgphoto" name="pgphoto" required>
        </div>
        <div class="form-group">
            <label for="advance">PG Advance:</label>
            <input type="number" id="advance" name="advance" required>
        </div>

        <!-- Room Container -->
        <div id="roomContainer">
            <h2>Add Room Details</h2>

            <!-- Room 1 Form (visible by default) -->
            <div class="form-group room">
                <h3>Room 1 Details</h3>
                <div>
                    <label for="roomname0">Room Name:</label>
                    <input type="text" id="roomname0" name="roomname[]" required>
                </div>
                <div>
                    <label for="sharing0">Select Sharing:</label>
                    <select id="sharing0" name="sharing[]" required>
                        <option value="1">1 Sharing</option>
                        <option value="2">2 Sharing</option>
                        <option value="3">3 Sharing</option>
                        <option value="4">4 Sharing</option>
                        <option value="5">5 Sharing</option>
                    </select>
                </div>
                <div>
                    <label for="rent0">Room Rent:</label>
                    <input type="number" id="rent0" name="rent[]" required>
                </div>
                <div>
                    <label for="acNonAc0">Room Type:</label>
                    <select id="acNonAc0" name="acNonAc[]" required>
                        <option value="AC">AC</option>
                        <option value="Non-AC">Non-AC</option>
                    </select>
                </div>
                <div>
                    <label for="roomphoto0">Room Photo:</label>
                    <input type="file" id="roomphoto0" name="roomphoto[]" required>
                </div>
            </div>

            <!-- Additional Room Forms will appear here -->
            <div id="roomForms"></div>

            <button type="button" id="addRoomBtn">Add New Room</button>
        </div>

        <!-- Submit Button -->
        <button type="submit" name="submitPG">Submit PG Details</button>
    </form>

    <script>
        // Add a new room form when "Add New Room" button is clicked
        document.getElementById('addRoomBtn').addEventListener('click', function () {
            const roomForms = document.getElementById('roomForms');
            const roomIndex = roomForms.children.length + 1; // Increment by 1 to get the next room number

            // Create a new room form
            const roomForm = document.createElement('div');
            roomForm.classList.add('form-group');
            roomForm.innerHTML = `
                <h3>Room ${roomIndex + 1} Details</h3>
                <div>
                    <label for="roomname${roomIndex}">Room Name:</label>
                    <input type="text" id="roomname${roomIndex}" name="roomname[]" required>
                </div>
                <div>
                    <label for="sharing${roomIndex}">Select Sharing:</label>
                    <select id="sharing${roomIndex}" name="sharing[]" required>
                        <option value="1">1 Sharing</option>
                        <option value="2">2 Sharing</option>
                        <option value="3">3 Sharing</option>
                        <option value="4">4 Sharing</option>
                        <option value="5">5 Sharing</option>
                    </select>
                </div>
                <div>
                    <label for="rent${roomIndex}">Room Rent:</label>
                    <input type="number" id="rent${roomIndex}" name="rent[]" required>
                </div>
                <div>
                    <label for="acNonAc${roomIndex}">Room Type:</label>
                    <select id="acNonAc${roomIndex}" name="acNonAc[]" required>
                        <option value="AC">AC</option>
                        <option value="Non-AC">Non-AC</option>
                    </select>
                </div>
                <div>
                    <label for="roomphoto${roomIndex}">Room Photo:</label>
                    <input type="file" id="roomphoto${roomIndex}" name="roomphoto[]" required>
                </div>
            `;
            roomForms.appendChild(roomForm);
        });
    </script>
</body>
</html>
