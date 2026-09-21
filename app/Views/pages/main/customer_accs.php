<?php 
    $this->extend('layouts/main_layout');
    $this->section('content');
?>

<div class="container-dashboard">
    <div class="titles-container-dashboard">
        <div class="titles-dashboard">
            <h1>CUSTOMERS</h1>
            <p>Registered customers in our system.</p>
        </div>
        <div class="icon-titles-dashboard">
            <button id='open-nav'>≡≡</button>
        </div>
    </div>
    
    
    <?php foreach($data as $key): ?>
        <div class="customer-node">
            <h1><?= esc($key['full_name']) ?></h1>
            <p><?= esc($key['email']) ?></p>
            <p><?= esc($key['phone']) ?></p>
        </div>
    <?php endforeach ?>
</div>

<?= $this->endSection() ?>