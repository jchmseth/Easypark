<!DOCTYPE html>
<html>
<head>
    <title>Easypark</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type ="text/css" href="<?php echo base_url('public/homepage.css'); ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        body {
            background-image: url('1.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
        }
    </style>
</head>
<body>

<div class="main">
    <div style="text-align: center;">
        <img src="EASYWHITE.png" alt="Logo" width="400"> <!-- Update width to desired size -->
    </div>
</div>


    <div class="container mt-5">

        <div class="container" style="display: flex; justify-content: center;">
            <a href="<?= base_url('public/LoginController'); ?>" class="button" style="background-color: #fff; color: #000;">Sign In</a>
        </div>
        
        <div class="container" style="display: flex; justify-content: center;">
            <a href="<?= base_url('public/LoginController/register'); ?>" class="button" style="background-color: #00008b; color: #fff;">Sign up</a>
        </div>

    </div>

</div>
</body>
</html>
