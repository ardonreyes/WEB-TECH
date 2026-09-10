<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url($stylesheet)?>">
    <title><?= esc($title) ?></title>
</head>
<body>
    <div class="title-section">
        XYZ POS
    </div>
    <div class="login-section">
        <div class="logo-login">
            <img src="<?= base_url('favicon.ico')?>" alt="" srcset="">
        </div>
        <form action="" method="post">
            <div class="title-form">
                <h1 class="login-title">LOG IN</h1>
                <p class="welcome-title">Welcome to XYZ</p>
            </div>
            <div class="fields-form">
                <label for="email">E-mail:</label>
                <input type="text" class="email-field" name="email">
                <label for="password">Password:</label>
                <input type="password" name="password" id="" class="password-field">
                <a href=' <?= site_url('/forget')?>'>Forget Password</a>
            </div>
            <div class="navigation-btn">
                <input type="submit" value="Log In" class='submit-btn'>
                <a href="<?= site_url('/register') ?>" class='register-btn'> Don't have an Account?</a>
            </div>
            <footer>
                XYC &copy 2026
            </footer>
        </form>
    </div>
</body>
</html>