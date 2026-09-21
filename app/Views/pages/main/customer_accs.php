<?php 
    $this->extend('layouts/main_layout');
    $this->section('content');
?>

<div class="container-dashboard">
    <div class="titles-container-dashboard">
        <div class="titles-dashboard">
            <p>Registered customers in our system.</p>
        </div>
        <div class="icon-titles-dashboard">
            <button id='open-nav'>≡≡</button>
        </div>
    </div>
    
    
        <?php foreach($data as $key): ?>
            <div class="customer-node">
                <h1><?= esc(ucwords($key['first_name'].' '.$key['last_name'])) ?></h1>
                <p><?= esc('@'.$key['username']) ?></p>
                <p><?= esc($key['contact']) ?></p>
            </div>
        <?php endforeach ?>
</div>

<?= $this->endSection() ?>