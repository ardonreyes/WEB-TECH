<?php
    $this->extend('layouts/main_layout');
    $this->section('content');

    $feedback = session()->getFlashdata('userFeedback') ?? [];
    $messages = $feedback['messages'] ?? null;
    $openModal = $feedback['openModal'] ?? ($openModal ?? null);
    $formData = $feedback['formData'] ?? [];
?>

<div class="container-dashboard">
    <div class="titles-container-dashboard">
        <div class="titles-dashboard">
            <h1>USERS</h1>
            <p>Registered users in our system.</p>
        </div>
        <div class="icon-titles-dashboard">
            <button
                type="button"
                id="new-form-btn"
                data-modal-target="user-add-modal"
                onclick="formModal(this)"
                aria-label="Add user"
            >
                <i class="fa fa-plus"></i>
            </button>
            <button type="button" id="open-nav" class="nav-btn" aria-label="Open navigation" aria-controls="dashboard-nav" aria-expanded="false"><i class="fa-solid fa-bars" aria-hidden="true"></i></button>
        </div>
    </div>

    <?php if (isset($messages) && $openModal === null): ?>
        <?php isset($messages['success']) ? $classNameFeedback = 'success-container' : $classNameFeedback = 'error-container'; ?>
        <div class="container-accs-feedback">
            <div class="<?= $classNameFeedback ?>">
                <?php foreach ($messages as $value): ?>
                    <p class="msg-feedback"><?= esc($value) ?></p>
                <?php endforeach ?>
            </div>
        </div>
    <?php endif; ?>

    <div
        class="ui-modal-backdrop <?= $openModal === 'user-add-modal' ? 'show-modal' : '' ?>"
        id="user-add-modal"
        role="dialog"
        aria-modal="true"
        aria-hidden="<?= $openModal === 'user-add-modal' ? 'false' : 'true' ?>"
        aria-labelledby="user-add-title"
    >
        <div class="modal-panel form-modal">
            <button type="button" class="modal-close" onclick="closeFormModal(this)" aria-label="Close form">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <h1 class="form-modal-title" id="user-add-title">Add User</h1>

            <?php if ($openModal === 'user-add-modal' && isset($messages)): ?>
                <div class="error-container">
                    <?php foreach ($messages as $value): ?>
                        <p class="msg-feedback"><?= esc($value) ?></p>
                    <?php endforeach ?>
                </div>
            <?php endif; ?>

            <form
                action="<?= site_url('users/add') ?>"
                method="post"
                class="modal-form"
                enctype="multipart/form-data"
                data-confirm-title="Add this user?"
                data-confirm-message="The entered user information will be saved."
                data-confirm-label="Add User"
            >
                <?= csrf_field() ?>

                <label class="profile-picker" for="user-add-profile" title="Choose profile image">
                    <img src="<?= base_url('img/default-profile.jpg') ?>" alt="Profile preview">
                    <span class="profile-picker-overlay" aria-hidden="true">
                        <i class="fa-solid fa-camera"></i>
                    </span>
                    <input
                        type="file"
                        id="user-add-profile"
                        name="profile"
                        accept="image/jpeg,image/png"
                        aria-label="Choose profile image"
                    >
                </label>

                <div class="modal-form-field">
                    <label for="user-add-name">Name:</label>
                    <input
                        type="text"
                        id="user-add-name"
                        name="full_name"
                        value="<?= esc($openModal === 'user-add-modal' ? ($formData['full_name'] ?? '') : '', 'attr') ?>"
                        placeholder="First Last"
                    >
                </div>

                <div class="modal-form-field">
                    <label for="user-add-username">Username:</label>
                    <input
                        type="text"
                        id="user-add-username"
                        name="username"
                        value="<?= esc($openModal === 'user-add-modal' ? ($formData['username'] ?? '') : '', 'attr') ?>"
                        placeholder="username"
                    >
                </div>

                <div class="modal-form-actions">
                    <button type="submit" class="modal-su bmit">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <?php foreach ($data as $key): ?>
        <?php
            $editModalId = 'user-edit-modal-' . $key['id'];
            $deleteModalId = 'user-delete-modal-' . $key['id'];
            $editData = $openModal === $editModalId ? array_merge($key, $formData) : $key;
            $profileUrl = base_url(! empty($editData['profile']) ? 'img/' . $editData['profile'] : 'img/default-profile.jpg');
        ?>

        <div class="customer-node">
            <div class="profile-user">
                <img
                    src="<?= esc(base_url(! empty($key['profile']) ? 'img/' . $key['profile'] : 'img/default-profile.jpg'), 'attr') ?>"
                    alt="Profile Picture"
                >
            </div>
            <div>
                <h1><?= esc($key['full_name']) ?></h1>
                <p><?= esc($key['username']) ?></p>
                <p><?= esc($key['role']) ?></p>
            </div>

            <div class="customer-edit">
                <button
                    type="button"
                    class="edit-form-btn"
                    data-modal-target="<?= esc($editModalId, 'attr') ?>"
                    onclick="formModal(this)"
                    aria-label="Edit <?= esc($key['full_name'], 'attr') ?>"
                >
                    <i class="fa-solid fa-pencil"></i>
                </button>
                <button
                    type="button"
                    class="delete-form-btn"
                    data-modal-target="<?= esc($deleteModalId, 'attr') ?>"
                    onclick="deleteModal(this)"
                    aria-label="Delete <?= esc($key['full_name'], 'attr') ?>"
                >
                    <i class="fa-solid fa-trash-can"></i>
                </button>
            </div>
        </div>

        <div
            class="ui-modal-backdrop <?= $openModal === $editModalId ? 'show-modal' : '' ?>"
            id="<?= esc($editModalId, 'attr') ?>"
            role="dialog"
            aria-modal="true"
            aria-hidden="<?= $openModal === $editModalId ? 'false' : 'true' ?>"
            aria-labelledby="<?= esc($editModalId . '-title', 'attr') ?>"
        >
            <div class="modal-panel form-modal">
                <button type="button" class="modal-close" onclick="closeFormModal(this)" aria-label="Close form">
                    <i class="fa-solid fa-xmark"></i>
                </button>

                <h1 class="form-modal-title" id="<?= esc($editModalId . '-title', 'attr') ?>">
                    Edit User #<?= esc($key['id']) ?>
                </h1>

                <?php if ($openModal === $editModalId && isset($messages)): ?>
                    <div class="error-container">
                        <?php foreach ($messages as $value): ?>
                            <p class="msg-feedback"><?= esc($value) ?></p>
                        <?php endforeach ?>
                    </div>
                <?php endif; ?>

                <form
                    action="<?= site_url('users/edit/' . $key['id']) ?>"
                    method="post"
                    class="modal-form"
                    enctype="multipart/form-data"
                    data-confirm-title="Save these changes?"
                    data-confirm-message="This user's information will be updated."
                    data-confirm-label="Save Changes"
                >
                    <?= csrf_field() ?>

                    <label
                        class="profile-picker"
                        for="user-edit-profile-<?= esc($key['id'], 'attr') ?>"
                        title="Choose profile image"
                    >
                        <img src="<?= esc($profileUrl, 'attr') ?>" alt="Profile preview">
                        <span class="profile-picker-overlay" aria-hidden="true">
                            <i class="fa-solid fa-camera"></i>
                        </span>
                        <input
                            type="file"
                            id="user-edit-profile-<?= esc($key['id'], 'attr') ?>"
                            name="profile"
                            accept="image/jpeg,image/png"
                            aria-label="Choose profile image"
                        >
                    </label>

                    <div class="modal-form-field">
                        <label for="user-edit-name-<?= esc($key['id'], 'attr') ?>">Name:</label>
                        <input
                            type="text"
                            id="user-edit-name-<?= esc($key['id'], 'attr') ?>"
                            name="full_name"
                            value="<?= esc($editData['full_name'], 'attr') ?>"
                            placeholder="First Last"
                        >
                    </div>

                    <div class="modal-form-field">
                        <label for="user-edit-username-<?= esc($key['id'], 'attr') ?>">Username:</label>
                        <input
                            type="text"
                            id="user-edit-username-<?= esc($key['id'], 'attr') ?>"
                            name="username"
                            value="<?= esc($editData['username'], 'attr') ?>"
                            placeholder="username"
                        >
                    </div>

                    <div class="modal-form-actions">
                        <button type="submit" class="modal-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <div
            class="ui-modal-backdrop"
            id="<?= esc($deleteModalId, 'attr') ?>"
            role="dialog"
            aria-modal="true"
            aria-hidden="true"
            aria-labelledby="<?= esc($deleteModalId . '-title', 'attr') ?>"
        >
            <form action="<?= site_url('users/delete/' . $key['id']) ?>" method="post" class="modal-panel delete-modal">
                <?= csrf_field() ?>
                <div class="delete-modal-icon" aria-hidden="true">
                    <i class="fa-solid fa-trash-can"></i>
                </div>
                <h1 id="<?= esc($deleteModalId . '-title', 'attr') ?>">Delete <?= esc($key['full_name']) ?>?</h1>
                <p>This user will be permanently removed.</p>
                <div class="delete-modal-actions">
                    <button type="button" class="cancel-btn" onclick="closeDeleteModal(this)">Cancel</button>
                    <button type="submit" class="delete-btn">
                        <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                        Delete
                    </button>
                </div>
            </form>
        </div>
    <?php endforeach ?>
</div>

<?= $this->endSection() ?>
