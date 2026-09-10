<?php
    $this->extend('layouts/auth_layout');
    $this->section('content') 
?>
<form action="" method="post">
    <div class="title-form">
        <h1>RECORVER ACCOUNT</h1>
        <p>Enter your email to recover your account.</p>
    </div>
    <div class="fields-form">
        <label for="name">E-mail:</label>
        <input type="email" name="email" class="field-form" require>
    </div>
    <div class="title-form">
        <p>Once submitted, you should be getting an e-mail in your inbox.</p>
    </div>
    <input type="submit" value="Submit" class='submit-btn'>
</form>

<?= $this->endSection() ?>