<?php
$this->extend('layouts/main_layout');
$this->section('content');
?>

<div class="container-dashboard">
    <div class="titles-container-dashboard">
        <div class="titles-dashboard">
            <h1>DASHBOARD</h1>
            <p>Welcome, manage your POS.</p>
        </div>
        <div class="icon-titles-dashboard">
            <button type="button" id="open-nav" class="nav-btn" aria-label="Open navigation" aria-controls="dashboard-nav" aria-expanded="false"><i class="fa-solid fa-bars" aria-hidden="true"></i></button>
        </div>
    </div>

    <div class="cards-data-home">
        <div class="cards-home">
            <h1>Status:</h1>
            <p>Deployed</p>
        </div>
        <div class="cards-home">
            <h1>Maintenance:</h1>
            <p>None</p>
        </div>
        <div class="cards-home">
            <h1>Customers:</h1>
            <p><?= esc($data['customers']) ?></p>
        </div>
        <div class="cards-home">
            <h1>Users:</h1>
            <p><?= esc($data['users']) ?></p>
        </div>
    </div>
    
    <div class="quick-action">
        <h1>Quick Actions</h1>
        <div class="cards-action-home">
            <div class="cards-home quick-action-btn">
                <a href="<?= site_url('/customers') ?>"><i class="fa-solid fa-users"></i>   Customers</a>
            </div>
            <div class="cards-home quick-action-btn">
                <a href="<?= site_url('/customers') ?>"><i class="fa-solid fa-user-group"></i> Users</a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
