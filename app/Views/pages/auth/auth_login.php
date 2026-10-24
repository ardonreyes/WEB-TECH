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
        <form action="<?= site_url('login') ?>" method="post">
            <?= csrf_field() ?>
            <div class="title-form">
                <h1 class="login-title">LOG IN</h1>
                <p class="welcome-title">Welcome to XYZ</p>
            </div>
            <?php if(session()->getFlashdata('loginFeedback') || session()->getFlashdata('errors')): ?>
                <div class="error-msg">
                    <?php if (session()->getFlashdata('errors')): ?>
                        <?php foreach ((array) session()->getFlashdata('errors') as $error): ?>
                            <p><?= esc($error) ?></p>
                        <?php endforeach; ?>
                    <?php endif; ?>            
                    <?php if ($feedback = session()->getFlashdata('loginFeedback')): ?>
                        <p><?= esc($feedback['messages']) ?></p>
                    <?php endif; ?>
                </div>
            <?php endIf; ?>

            <div class="fields-form">
                <label for="email">Username:</label>
                <input type="text" class="email-field" name="username" value="<?= esc(session()->getFlashdata('username') ?? '', 'attr') ?>">
                <label for="password">Password:</label>
                <input type="password" name="password" id="" class="password-field">
                <!-- <a href='' style='display: none;'>Forget Password</a> -->
            </div>
            <div class="navigation-btn">
                <input type="submit" value="Log In" class='submit-btn'>
                <!-- <a href="" class='register-btn' style='display: none;'> Don't have an Account?</a> -->
            </div>
            <footer>
                XYC &copy 2026
            </footer>
        </form>
    </div>
</body>
</html>