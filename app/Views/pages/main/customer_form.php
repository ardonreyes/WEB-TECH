<?php 
    $this->extend('layouts/main_layout');
    $this->section('content');
?>

<div class="container-dashboard">
    <div class="titles-container-dashboard">
        <div class="titles-dashboard">
            <h1>CUSTOMER <?= isset($data['id']) ? esc("#".$data['id']) : "FORM" ?></h1>
            <p><?= isset($data['id']) ? esc("Edit information of ".$data['full_name']) : "Fill out the form to add a new customer" ?>.</p>
        </div>
        <div class="icon-titles-dashboard">
            <button type="button" id="open-nav" class="nav-btn" aria-label="Open navigation" aria-controls="dashboard-nav" aria-expanded="false"><i class="fa-solid fa-bars" aria-hidden="true"></i></button>
        </div>
    </div>

    <?php 
        if (isset($messages)):
            isset($messages['success']) ? $classNameFeedback = 'success-container' : $classNameFeedback = 'error-container'; 
    ?>
            <div class="<?= $classNameFeedback ?>">
                <?php foreach ($messages as $key => $value): ?>
                    <p class="msg-feedback"><?= esc($value) ?></p>
                <?php endforeach ?>
            </div>
    <?php endif; ?>

    <form 
        action="<?= isset($data['id']) ?  site_url('customers/edit/'. $data['id']) : site_url('customers/add') ?>" 
        method="post" 
        class="form-edit"
    >
        <?= csrf_field() ?>

        <div class="container-field-edit">
            <label for="">Name:</label>
            <input type="text" value="<?= isset($data['id']) ? esc($data['full_name']) : "" ?>" name="full_name">
        </div>
        <div class="container-field-edit">
            <label for="">Email:</label>
            <input type="email" value="<?= isset($data['id']) ? esc($data['email']) : "" ?>" name="email">
        </div>
        <div class="container-field-edit">
            <label for="">Phone:</label>
            <input type="text" value="<?= isset($data['id']) ? esc($data['phone']) : "" ?>" name="phone">
        </div>
        <div class="container-action-edit">
            <input type="submit" value="Submit" class="submit-btn">
        </div>
    </form>
</div>

<?= $this->endSection() ?> 
