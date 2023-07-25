<!DOCTYPE html>
<html>
<head>
    <title>User Balance</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type ="text/css" href="usermain.css">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<style>
  body {
    background-image: url('1.jpg');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: 100% 100%;
    overflow:hidden;
    font-family: 'Noto Sans', sans-serif;
  }
.main h1 {
    color: white;
    margin-top: -40vh;
    font-weight:bold;
    font-size:200%;
    font-family: 'Noto Sans', sans-serif;
}
.main h2{
    color:white;
    font-size:150%;
    font-family: 'Noto Sans', sans-serif;
}
.card {
    width:100%;
    margin-top:-10%;
    align-items: center;
}

.balance-container h3{
    color:#222222;
    font-size:135%;
    margin-top:-8%;
    align-items: center;
}

.header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 3%;
}
.buttons{
    margin-top:-5%;
}

</style>
<!-- Logo -->
<div class="header-container">
  <div class="logo-container">
    <div style="text-align: center;">
      <img src="EASYPAHABA2.png" alt="Logo" width="250" style="margin-top: -40px;">
    </div>
  </div>

<!-- Account Dropdown -->
<div class="dropdown">
  <button class="dropdown-toggle" type="button" id="accountDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style = margin-top:-5vh>
    <box-icon name='user-circle' color='#ffffff' size= 'lg' ></box-icon>
  </button>
  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDropdown">
    <div class="panel-slider">
      <!-- Account information can be added here -->
      <p>
       <?php 
        $session = session();
        $user_name = $session->get('user_name');
        echo $user_name;
        ?>
      </p>
      <p><?php 
        $session = session();
        $email = $session->get('email');
        echo $email;
        ?></p>
      <button type="button" class="logout-button" onclick="window.location.href='<?= base_url('public/UserDashboard/logout'); ?>'">Logout</button>
    </div>
  </div>
</div>
</div>
 <div class="container-md"> 
<div class="main">
    <h1>Good day, 
        <?php 
        $session = session();
        $user_name = $session->get('user_name');
        echo $user_name;
        ?>!
    </h1>
     <h2>RFID Number:
        <?php 
        $session = session();
        $rfid_no = $session->get('rfid_no');
        echo $rfid_no;
        ?>
    </h2>
   
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="balance-container">
                        <?php if (!empty($users)) { ?>
                            <?php foreach ($users as $user) { 
                                if($user['username'] == $user_name){
                            ?>
                                <h3>Available Balance</h3>
                                <h4>₱<?= number_format($user['balance'], 2); ?></h4>

                            <?php }} ?>
                        <?php } else { ?>
                            <p>No users found.</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="buttons">
    <div class="container mt-5">
            <div class="container" style="display: flex; justify-content: center;width:100%">
                <a href="<?= base_url('public/SlotsController'); ?>" class="button" style="background-color: #fff; color: #000;width:100%">View Parking Slots</a>
                <a href="<?= base_url('public/TransactionController'); ?>" class="button" style="background-color: #00008b; color: #fff;width:100%">Transaction History</a>
            </div>
    </div>
    </div>

</div>
</div>
</body>

<script>
// JavaScript code here
$(document).ready(function() {
  $('.dropdown-toggle').click(function() {
    $('.dropdown-menu').toggleClass('show');
  });
});
</script>

</html>