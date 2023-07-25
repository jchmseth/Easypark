<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="dash.css">
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
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">PARKING SLOTS</div>
                    <div class="card-body">
                        <h1><?= $num_slots ?><i class='bx bx-car'></i></h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">CURRENT USERS</div>
                    <div class="card-body">
                        <h1><?= $num_users ?><i class='bx bx-user'></i></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
