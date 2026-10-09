<?php 
    $this->extend('layouts/main_layout');
    $this->section('content');
?>

<div class="container-dashboard">
    <div class="titles-container-dashboard">
        <div class="titles-dashboard">
            <h1>USER <?= isset($data['id']) ? esc("#".$data['id']) : "FORM" ?></h1>
            <p><?= isset($data['id']) ? esc("Edit information of ".$data['full_name']) : "Fill out the form to add a new user" ?>.</p>
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
        action="<?= isset($data['id']) ?  site_url('users/edit/'. $data['id']) : site_url('users/add') ?>" 
        method="post" 
        class="form-edit"
        enctype="multipart/form-data"
    >
        <?= csrf_field() ?>

        <div class="container-img-edit">
            <label class="profile-picker" for="avatar" title="Choose profile image">
                <img 
                    src="<?= esc(base_url(! empty($data['profile']) ? 'img/' . $data['profile'] : 'img/default-profile.jpg'), 'attr') ?>"
                    alt="Profile Picture"
                >
                <span class="profile-picker-overlay" aria-hidden="true">
                    <i class="fa-solid fa-camera"></i>
                </span>
                <input
                    type="file"
                    id="avatar"
                    name="profile"
                    accept="image/jpeg,image/png"
                    aria-label="Choose profile image"
                >
            </label>
        </div>
        <div class="container-field-edit" style="grid-template-columns: minmax(80px, 140px) minmax(0, 1fr);">
            <label for="">Name:</label>
            <input type="text" value="<?= isset($data['id']) ? esc($data['full_name']) : "" ?>" name="full_name">
        </div>
        <div class="container-field-edit" style="grid-template-columns: minmax(80px, 140px) minmax(0, 1fr);">
            <label for="">Username:</label>
            <input type="text" value="<?= isset($data['id']) ? esc($data['username']) : "" ?>" name="username">
        </div>
        <div class="container-action-edit">
            <input type="submit" value="Submit" class="submit-btn">
        </div>
    </form>
</div>

<?= $this->endSection() ?> 
