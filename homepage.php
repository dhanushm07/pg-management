<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PG Listings</title>
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

<header>
    <h1>Find Your Ideal PG</h1>
    <form action="eventlogin.php" method="post" class="login-form">
        <input type="text" name="usname" placeholder="Username" required>
        <input type="password" name="pass" placeholder="Password" required>
        <button type="submit" name="submit">Login</button>
    </form>
</header>

<div class="container">
    <h2>Available PGs</h2>
    <div class="pg-listing" id="pgListing">
        <!-- PG Items will be dynamically inserted here -->
    </div>

    <div class="room-details" id="roomDetails" style="display: none;">
        <h2>Available Rooms</h2>
        <div class="room-listing" id="roomListing"></div>
    </div>
</div>

<footer>
    <p>&copy; 2024 PG Management System</p>
</footer>

<script>
    fetch('fetch_pg.php')
        .then(response => response.json())
        .then(data => {
            const pgListing = document.getElementById('pgListing');
            data.forEach(pg => {
                const pgItem = document.createElement('div');
                pgItem.classList.add('pg-item');
                pgItem.innerHTML = `
                    <img src="pgphotos/${pg.PGImage}" alt="${pg.PGName}">
                    <div>
                        <h3>${pg.PGName} (${pg.PGGender}'s PG)</h3>
                        <p>${pg.PGAddress}</p>
                        <p>Contact: ${pg.PGMobile}</p>
                        <p>Email: ${pg.PGMail}</p>
                        <p>Advance: ₹${pg.Advance}</p>

                        <button onclick="viewDetails(${pg.PGID})" class="request-button">View Rooms</button>
                    </div>
                `;
                pgListing.appendChild(pgItem);
            });
        })
        .catch(error => console.log('Error fetching PG details:', error));

    function viewDetails(pgID) {
        fetch(`fetch_rooms_by_pg.php?pg_id=${pgID}`)
            .then(response => response.json())
            .then(rooms => {
                const roomListing = document.getElementById('roomListing');
                roomListing.innerHTML = ''; // Clear previous room details

                if (rooms.length === 0) {
                    roomListing.innerHTML = `<p>No rooms available for this PG.</p>`;
                } else {

                    rooms.forEach(room => {
    const roomItem = document.createElement('div');
    roomItem.classList.add('room-item');
    roomItem.innerHTML = `
        <img src="roomphotos/${room.RoomImage}" alt="${room.RoomName}">
        <div>
            <h3>${room.RoomName}</h3>
            <p><h4> ${room.Sharing}Sharing </h4></p>
            <p>Rent: ₹${room.RoomRent}</p>
            <p>AC/Non-AC: ${room.ACNonAC}</p>
            <p>Availability: ${room.vacancy}</p>
            <button class="request-button" 
                onclick="requestPG(${room.PGID}, ${room.RoomID}, ${room.vacancy}, ${room.Advance}, ${room.RoomRent})"
                ${room.vacancy == 0 ? 'disabled' : ''}>Request for PG</button>
        </div>
    `;
    roomListing.appendChild(roomItem);
});

                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    // rooms.forEach(room => {
                    //     const roomItem = document.createElement('div');
                    //     roomItem.classList.add('room-item');
                    //     roomItem.innerHTML = `
                    //         <img src="roomphotos/${room.RoomImage}" alt="${room.RoomName}">
                    //         <div>
                    //             <h3>${room.RoomName}</h3>
                    //             <p>Sharing: ${room.Sharing} persons</p>
                    //             <p>Rent: ₹${room.RoomRent}</p>
                    //             <p>AC/Non-AC: ${room.ACNonAC}</p>
                    //             <p>Vacancy: ${room.vacancy}</p>
                    //             <button class="request-button" 
                    //                 onclick="requestPG(${room.PGID}, ${room.RoomID}, ${room.vacancy})"
                    //                 ${room.vacancy == 0 ? 'disabled' : ''}>Request for PG</button>
                    //         </div>
                    //     `;
                    //     roomListing.appendChild(roomItem);
                    // });
                }

                document.getElementById('roomDetails').style.display = 'block';
                document.getElementById('roomDetails').scrollIntoView({ behavior: 'smooth' });
            })
            .catch(error => console.log('Error fetching room details:', error));
    }

    function requestPG(pgID, roomID, vacancy, Advance, RoomRent ) {
        if (vacancy > 0) {
            window.location.href = `tenantreg.php?pg_id=${pgID}&room_id=${roomID}&advance=${Advance}&rent=${RoomRent}`;
        } else {
            alert('There is no vacancy in this room.');
        }
    }
</script>

</body>
</html>
