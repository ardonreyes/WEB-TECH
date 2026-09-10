<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url($stylesheet)?>">
    <link rel="stylesheet" href="<?= base_url($layout)?>">
    <title><?= esc($title) ?></title>
</head>
<body>
    <a href="<?= site_url('/') ?>">←</a>
    <?= $this->renderSection('content') ?>
    <footer>
        XYC &copy 2026
    </footer>
</body>
</html>