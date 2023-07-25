<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Information</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="tran.css">
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
<div class = "main">
    <h1>Parking Information</h1>
    <?php if (!empty($info)): ?>
        <table>
            <thead>
                <tr>
                    <th>RFID No</th>
                    <th>Entry Time</th>
                    <th>Exit Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($info as $row): ?>
                    <tr>
                        <td><?= $row['rfid_no'] ?></td>
                        <td><?= $row['entry_time'] ?></td>
                        <td><?= $row['exit_time'] ?></td>
                        <td>
                            <span class="<?= $row['flag'] == 1 ? 'paid' : 'not-paid' ?>">
                                <?= $row['flag'] == 1 ? 'Paid' : 'Not Paid' ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
<div class="pagination">
                                 <?= $pager->links() ?>
                            </div>
    <?php else: ?>
        <p>No parking information found.</p>
    <?php endif; ?>
</div>

</body>
</html>