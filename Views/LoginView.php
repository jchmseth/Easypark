<!DOCTYPE html>
<html>
<head>
    <title>Users List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="signin.css">
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
<div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
    <?= form_open(base_url('public/LoginController/login')) ?>
    <div style="text-align: center;">
        <img src="EASYPARK.png" alt="Logo" width="300">
    </div>
    <input type="text" name="email_or_username" placeholder="Email or Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <?php if(session()->get('msg')): ?>
        <p class="msg"><?= session()->get('msg') ?></p>
    <?php endif; ?>
    <button type="submit" style="margin-bottom: 10px;">Sign In</button>
    <div class="text-center">
        <span class="text-dont">Don't have an account?</span>
        <a href="<?= base_url('public/LoginController/register/') ?>" class="text-primary">Sign up</a>
    </div>
</div>
</body>
</html>