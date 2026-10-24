<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url($stylesheet) ?>">
    <link rel="stylesheet" href="<?= base_url($layout) ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title> <?= esc($titles) ?> </title>
</head>
<body>
    <nav id="dashboard-nav" aria-label="Main navigation">
        <button type="button" class="close-nav" id="close-nav" aria-label="Close navigation">
            <i class="fa-solid fa-xmark" aria-hidden="true"></i>
        </button>
        <div class="title-container-nav">
            <h1 class="title-nav">CORP</h1>
        </div>
        <div class="divider-nav"></div>
        <div class="links-nav">
            <a href="<?= site_url('/home') ?>">Home</a>
            <a href="<?= site_url('/about') ?>">About</a>
            <a href="<?= site_url('/customers') ?>">Customers</a>
            <a href="<?= site_url('/users') ?>">Users</a>
        </div>
        <a href="<?= site_url('/logout') ?>" class='logout-btn'><i class="fa fa-sign-out"></i></a>
    </nav>
    <div class="ui-backdrop" id="ui-backdrop-nav" aria-hidden="true"></div>
    <section>
        <div class="content-dashboard">
            <?= $this->renderSection('content') ?>
        </div>
        <footer>
            <div class="logo-footer">
                <h1>CORP</h1>
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

    <div
        class="ui-modal-backdrop form-confirm-backdrop"
        id="form-confirm-modal"
        role="dialog"
        aria-modal="true"
        aria-hidden="true"
        aria-labelledby="form-confirm-title"
        aria-describedby="form-confirm-message"
    >
        <div class="modal-panel form-confirm-modal">
            <div class="form-confirm-modal-icon" aria-hidden="true">
                <i class="fa-solid fa-check"></i>
            </div>
            <h1 id="form-confirm-title">Confirm submission?</h1>
            <p id="form-confirm-message">Please confirm before continuing.</p>
            <div class="form-confirm-modal-actions">
                <button type="button" class="cancel-btn" onclick="closeFormConfirmation()">Cancel</button>
                <button type="button" class="form-confirm-submit" id="form-confirm-submit" onclick="confirmFormSubmission()">
                    Confirm
                </button>
            </div>
        </div>
    </div>
</body>

<script src=" <?= base_url($js) ?>"></script>
</html>
