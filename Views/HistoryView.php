<!DOCTYPE html>
<html>
<head>
    <title>Users List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="sidenav">
    <a href="<?= base_url('public/UserDashboard')?>">Dashboard</a>
    <a href="<?= base_url('public/SlotsController')?>">Parking Slots</a>
    <a href="<?= base_url('public/HistoryController')?>">Transaction History</a>
    <a href="<?= base_url('public/LoginController')?>">Logout</a>
</div>
<div class ="main">
    <h1>Welcome
        <?php 
        $session = session(); $username = $session->get('user_name');
        echo $username;
        ?>!
    </h1>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="align">
                        <?php if (!empty($users)) { ?>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>RFID No.</th>
                                        <th>Balance</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user) { 
                                        if($user['user'] == $username){
                                    ?>
                                        <tr>
                                            <td><?= $user['user'] ?></td>
                                            <td><?= $user['rfidnum'] ?></td>
                                            <td><?= $user['newbalance'] ?></td>
                                            <td><?= $user['status'] ?></td>
                                            <td><?= $user['date'] ?></td>
                                        </tr>
                                    <?php }} ?>
                                </tbody>
                            </table>
                        

                            
                        <?php }
                        else{ ?>
                            <p>No users found.</p>
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
