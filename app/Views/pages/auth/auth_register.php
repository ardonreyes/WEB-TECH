<?php
    $this->extend('layouts/auth_layout');
    $this->section('content') 
?>
<form action="" method="post">
    <div class="title-form">
        <h1>REGISTER</h1>
        <p>Create an account to manage your XYZ products in XYZ app for an easier, and effiecient experience.</p>
    </div>
    <div class="fields-form">
        <label for="name">Name:</label>
        <div class="fields-name">
            <input type="text" name="fname" class="field-form" require>
            <input type="text" name="lname" class="field-form" require>
        </div>
    </div>
    <div class="fields-form">
        <label for="name">E-mail:</label>
        <input type="email" name="email" class="field-form" require>
    </div>
    <div class="fields-form">
        <label for="name">Password:</label>
        <input type="password" name="password" class="field-form" require>
    </div>
    <div class="fields-form">
        <label for="name">Address:</label>
        <input type="text" name="address" class="field-form" require>
    </div>
    <div class="fields-form">
        <label for="name">Contact:</label>
        <input type="text" name="address" class="field-form" require>
    </div>
    <div class="title-form">
        <p>Thank you for taking your time to register for our website. We appreciate your stay with us. May you have a wonderful time.</p>
    </div>
    <input type="submit" value="Log In" class='submit-btn'>
</form>

<?= $this->endSection() ?>