<?php
    $this->extend('layouts/main_layout');
    $this->section('content');
?>

<div class="container-dashboard">
    <div class="titles-container-dashboard">
        <div class="titles-dashboard">
            <h1>ABOUT</h1>
            <p>Understand about our system.</p>
        </div>
        <div class="icon-titles-dashboard">
            <button id='open-nav'>≡≡</button>
        </div>
    </div>

    <div class="description-about">
        <h1>XYZ POS</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
</div>

<?= $this->endSection(); ?>