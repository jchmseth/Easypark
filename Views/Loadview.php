<!DOCTYPE html>
<html>
<head>
	<title>Load</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="load.css">
    <style>
        body {
        background-image: url("2.png");
        background-size: cover;
        background-position: center;
        height: 100vh;
        margin: 0;
        }
        .sidenav {
        padding-top: 30px;
        }
        .main {
        padding-top: 30px;
        text-align: center;
        }
    </style>
</head>
<body>
    <div class="sidenav">
        <img src="EASYPARK.png" alt="Your Logo">
        <a href="<?= base_url('public/Dashboard')?>"><i class='bx bxs-dashboard'></i> DASHBOARD</a>
        <a href="<?= base_url('public/Users')?>"><i class='bx bx-user' ></i> PARKING USERS</a>
        <a href="<?= base_url('public/ParkingSlotController')?>"><i class='bx bx-car'></i> PARKING SLOTS</a>
        <a href="<?= base_url('public/AdminViewController')?>"><i class='bx bx-transfer' ></i> TRANSACTION HISTORY</a>
        <a href="<?= base_url('public/Load')?>"><i class='bx bx-wallet' ></i> LOAD BALANCE</a>
        <a href="<?= base_url('public/UserDashboard/logout')?>"><i class='bx bx-log-out' ></i> LOGOUT</a>
    </div>
    <div class="main">
        <h1>Load Balance</h1>
        <form id="loadForm" action="<?= base_url('public/Loadupdate') ?>" method="POST">
            <label for="rfid_data">RFID NUMBER:</label>
            <input type="text" name="rfid_data" required>
            <br>
            <label for="Load">LOAD AMOUNT:</label>
            <input type="number" name="Load" min="1" required>
            <br>
            <label for="password">PASSWORD:</label>
            <input type="password" name="password" required>
            <br>
            <button type="submit">Load</button>
       

        <div id="response"></div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // Intercept form submission
                $("#loadForm").submit(function(event) {
                    event.preventDefault(); // Prevent form from submitting normally

                    // Send AJAX request to server
                    $.ajax({
                        type: "POST",
                        url: $(this).attr("action"),
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(response) {
                            // Show response message
                            var message = response.message;
                            if (response.status == "success") {
                                message += " New balance: " + response.newBalance;
                            }
                            $("#response").html(message);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            $("#response").html("Error: " + textStatus + " - " + errorThrown);
                        }
                    });
                });
            });
        </script>
         </form>
    </div
</body>
</html>