<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url($stylesheet) ?>">
    <link rel="stylesheet" href="<?= base_url($layout) ?>">
    <title> <?= esc($titles) ?> </title>
</head>
<body>
    <nav id='dashboard-nav'>
        <button class="close-nav" id='close-nav'>✕</button>
        <div class="title-container-nav">
            <h1 class="title-nav">XYZ POS</h1>
        </div>
        <div class="divider-nav"></div>
        <div class="links-nav">
            <a href="<?= site_url('/home') ?>">Home</a>
            <a href="<?= site_url('/about') ?>">About</a>
            <a href="<?= site_url('/customers') ?>">Customers</a>
            <a href="<?= site_url('/users') ?>">Users</a>
        </div>
    </nav>
    <div class="ui-backdrop" id='ui-backdrop-nav'></div>
    <section>
        <div class="content-dashboard">
            <?= $this->renderSection('content') ?>
        </div>
        <footer>
            <div class="logo-footer">
                <h1>XYZ POS</h1>
                <p>&copy since 2026</p>
            </div>
            <div class="socs-footer">
                <div class="socs-link-footer">
                    <p>Github:</p>
                    <a href="https://github.com/ardonreyes">ardonreyes</a>
                </div>
                <div class="socs-link-footer">
                    <p>E-mail:</p>
                    <p>arreyes@fit.edu.ph</p>
                </div>
            </div>
        </footer>
    </section>
</body>

<script src=" <?= base_url($js) ?>"></script>
</html>