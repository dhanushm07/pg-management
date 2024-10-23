<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add/Edit PG and Room</title>
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
        h2 {
            color: #0288D1;
            margin-bottom: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"], 
        input[type="number"], 
        input[type="email"], 
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        button {
            padding: 10px 15px;
            background-color: #0288D1;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #0277bd;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ccc;
        }

        th {
            background-color: #0288D1;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
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
    </style>
</head>
<body>
<header>
    <h1>Add or Edit PG</h1>
</header>

<div class="container">
    <h2>Add/Edit PG and Rooms</h2>
    <form id="pgForm" enctype="multipart/form-data">
        <div class="form-group">
            <label for="pgDropdown">Select PG:</label>
            <select id="pgDropdown" required>
                <option value="new_pg">Add New PG</option>
                <!-- PGs will be populated here -->
            </select>
        </div>

        <input type="hidden" id="pgID" name="pgid" value="">

        <div id="pgDetails">
            <div class="form-group">
                <label for="pgName">PG Name:</label>
                <input type="text" id="pgName" name="pgname" required>
            </div>
            <div class="form-group">
                <label for="pgAddress">PG Address:</label>
                <input type="text" id="pgAddress" name="pgaddress" required>
            </div>
            <div class="form-group">
                <label for="pgMobile">PG Mobile:</label>
                <input type="text" id="pgMobile" name="pgmobile" required>
            </div>
            <div class="form-group">
                <label for="pgMail">PG Email:</label>
                <input type="email" id="pgMail" name="pgmail" required>
            </div>
            <div class="form-group">
                <label for="advance">Advance:</label>
                <input type="number" id="advance" name="advance" required>
            </div>
            <div class="form-group">
                <label for="pgGender">PG Gender:</label>
                <select id="pgGender" name="pggender" required>
                    <option value="Men">Men</option>
                    <option value="Women">Women</option>
                </select>
            </div>
            <div class="form-group">
                <label for="pgPhoto">PG Photo:</label>
                <input type="file" id="pgPhoto" name="pgphoto" accept="image/*">
            </div>
        </div>

        <h3>Select PG Features</h3>
        <div class="form-group">
            <input type="checkbox" id="Fridge" name="features[]" value="Fridge">
            <label for="Fridge">Fridge</label>
        </div>
        <div class="form-group">
            <input type="checkbox" id="WashingMachine" name="features[]" value="WashingMachine">
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

        <h3>Room Details</h3>
        <table id="roomDetails">
            <thead>
                <tr>
                    <th>Room Name</th>
                    <th>Sharing</th>
                    <th>Rent</th>
                    <th>AC/Non-AC</th>
                    <th>Room Photo</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Room rows will be dynamically added here -->
            </tbody>
        </table>
        <button type="button" id="addRoom">Add Room</button><br>

        <button type="submit">Save PG and Room</button><br><br>

    </form>
</div>

<footer>
    <p>&copy; 2024 PG Management System</p>
</footer>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fetch PGs for dropdown
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'save_pg_room.php?action=get_pg_list', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                var pgList = JSON.parse(xhr.responseText);
                var pgDropdown = document.getElementById('pgDropdown');
                
                pgList.forEach(function(pg) {
                    var option = document.createElement('option');
                    option.value = pg.id;
                    option.textContent = pg.name;
                    pgDropdown.appendChild(option);
                });
            } else {
                console.error('Error fetching PG list');
            }
        };
        xhr.send();

        // Handle PG selection change
        document.getElementById('pgDropdown').addEventListener('change', function() {
            const pgID = this.value;
            if (pgID === 'new_pg') {
                document.querySelectorAll('#pgDetails input').forEach(input => input.value = '');
                document.querySelector('#roomDetails tbody').innerHTML = '';
                document.getElementById('pgID').value = ''; // Clear PG ID
            } else {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', `save_pg_room.php?action=get_pg_details&id=${pgID}`, true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var pg = JSON.parse(xhr.responseText);
                        document.getElementById('pgName').value = pg.PGName;
                        document.getElementById('pgAddress').value = pg.PGAddress;
                        document.getElementById('pgMobile').value = pg.PGMobile;
                        document.getElementById('pgMail').value = pg.PGMail;
                        document.getElementById('advance').value = pg.Advance;
                        document.getElementById('pgGender').value = pg.PGGender;
                        document.getElementById('pgID').value = pgID; // Store selected PG ID
                        loadRoomDetails(pgID);
                    }
                };
                xhr.send();
            }
        });

        // Load room details for selected PG
        function loadRoomDetails(pgID) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', `save_pg_room.php?action=get_room_details&pgid=${pgID}`, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var rooms = JSON.parse(xhr.responseText);
                    var roomDetails = document.querySelector('#roomDetails tbody');
                    roomDetails.innerHTML = '';
                    rooms.forEach(function(room) {
                        roomDetails.innerHTML += `
                            <tr>
                                <td><input type="text" name="roomname[]" class="form-control" value="${room.RoomName}" required></td>
                                <td><input type="number" name="roomsharing[]" class="form-control" value="${room.Sharing}" required></td>
                                <td><input type="number" name="roomrent[]" class="form-control" value="${room.RoomRent}" required></td>
                                <td>
                                    <select name="acnonac[]" class="form-control">
                                        <option value="AC" ${room.ACNonAC === 'AC' ? 'selected' : ''}>AC</option>
                                        <option value="Non-AC" ${room.ACNonAC === 'Non-AC' ? 'selected' : ''}>Non-AC</option>
                                    </select>
                                </td>
                                <td><input type="file" name="roomphoto[]" class="form-control-file" accept="image/*"></td>
                                <td><button type="button" class="btn btn-danger remove-room">Remove</button></td>
                            </tr>
                        `;
                    });
                }
            };
            xhr.send();
        }

        // Add new room row
        document.getElementById('addRoom').addEventListener('click', function() {
            var roomDetails = document.querySelector('#roomDetails tbody');
            roomDetails.innerHTML += `
                <tr>
                    <td><input type="text" name="roomname[]" class="form-control" required></td>
                    <td><input type="number" name="roomsharing[]" class="form-control" required></td>
                    <td><input type="number" name="roomrent[]" class="form-control" required></td>
                    <td>
                        <select name="acnonac[]" class="form-control">
                            <option value="AC">AC</option>
                            <option value="Non-AC">Non-AC</option>
                        </select>
                    </td>
                    <td><input type="file" name="roomphoto[]" class="form-control-file" accept="image/*"></td>
                    <td><button type="button" class="btn btn-danger remove-room">Remove</button></td>
                </tr>
            `;
        });

        // Remove room row
        document.querySelector('#roomDetails').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-room')) {
                e.target.closest('tr').remove();
            }
        });

        // Submit form
        document.getElementById('pgForm').addEventListener('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('action', 'pgroomadd');

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'save_pg_room.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var result = JSON.parse(xhr.responseText);
                    alert(result.message);
                    if (result.status === 'success') {
                        location.reload();
                    }
                }
            };
            xhr.send(formData);
        });
    });
</script>
</body>
</html>
