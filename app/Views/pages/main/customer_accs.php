<?php
    $this->extend('layouts/main_layout');
    $this->section('content');

    $openModal = $openModal ?? null;
    $formData = $formData ?? [];
?>

<div class="container-dashboard">
    <div class="titles-container-dashboard">
        <div class="titles-dashboard">
            <h1>CUSTOMERS</h1>
            <p>Registered customers in our system.</p>
        </div>
        <div class="icon-titles-dashboard">
            <button
                type="button"
                id="new-form-btn"
                data-modal-target="customer-add-modal"
                onclick="formModal(this)"
                aria-label="Add customer"
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
        class="ui-modal-backdrop <?= $openModal === 'customer-add-modal' ? 'show-modal' : '' ?>"
        id="customer-add-modal"
        role="dialog"
        aria-modal="true"
        aria-hidden="<?= $openModal === 'customer-add-modal' ? 'false' : 'true' ?>"
        aria-labelledby="customer-add-title"
    >
        <div class="modal-panel form-modal">
            <button type="button" class="modal-close" onclick="closeFormModal(this)" aria-label="Close form">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <h1 class="form-modal-title" id="customer-add-title">Add Customer</h1>

            <?php if ($openModal === 'customer-add-modal' && isset($messages)): ?>
                <div class="error-container">
                    <?php foreach ($messages as $value): ?>
                        <p class="msg-feedback"><?= esc($value) ?></p>
                    <?php endforeach ?>
                </div>
            <?php endif; ?>

            <form
                action="<?= site_url('customers/add') ?>"
                method="post"
                class="modal-form"
                data-confirm-title="Add this customer?"
                data-confirm-message="The entered customer information will be saved."
                data-confirm-label="Add Customer"
            >
                <?= csrf_field() ?>

                <div class="modal-form-field">
                    <label for="customer-add-name">Name:</label>
                    <input
                        type="text"
                        id="customer-add-name"
                        name="full_name"
                        value="<?= esc($openModal === 'customer-add-modal' ? ($formData['full_name'] ?? '') : '', 'attr') ?>"
                    >
                </div>

                <div class="modal-form-field">
                    <label for="customer-add-email">Email:</label>
                    <input
                        type="email"
                        id="customer-add-email"
                        name="email"
                        value="<?= esc($openModal === 'customer-add-modal' ? ($formData['email'] ?? '') : '', 'attr') ?>"
                    >
                </div>

                <div class="modal-form-field">
                    <label for="customer-add-phone">Phone:</label>
                    <input
                        type="text"
                        id="customer-add-phone"
                        name="phone"
                        value="<?= esc($openModal === 'customer-add-modal' ? ($formData['phone'] ?? '') : '', 'attr') ?>"
                    >
                </div>

                <div class="modal-form-actions">
                    <button type="submit" class="modal-submit">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <?php foreach ($data as $key): ?>
        <?php
            $editModalId = 'customer-edit-modal-' . $key['id'];
            $deleteModalId = 'customer-delete-modal-' . $key['id'];
            $editData = $openModal === $editModalId ? array_merge($key, $formData) : $key;
        ?>

        <div class="customer-node">
            <h1><?= esc($key['full_name']) ?></h1>
            <p><?= esc($key['email']) ?></p>
            <p><?= esc($key['phone']) ?></p>

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
                    Edit Customer #<?= esc($key['id']) ?>
                </h1>

                <?php if ($openModal === $editModalId && isset($messages)): ?>
                    <div class="error-container">
                        <?php foreach ($messages as $value): ?>
                            <p class="msg-feedback"><?= esc($value) ?></p>
                        <?php endforeach ?>
                    </div>
                <?php endif; ?>

                <form
                    action="<?= site_url('customers/edit/' . $key['id']) ?>"
                    method="post"
                    class="modal-form"
                    data-confirm-title="Save these changes?"
                    data-confirm-message="This customer's information will be updated."
                    data-confirm-label="Save Changes"
                >
                    <?= csrf_field() ?>

                    <div class="modal-form-field">
                        <label for="customer-edit-name-<?= esc($key['id'], 'attr') ?>">Name:</label>
                        <input
                            type="text"
                            id="customer-edit-name-<?= esc($key['id'], 'attr') ?>"
                            name="full_name"
                            value="<?= esc($editData['full_name'], 'attr') ?>"
                        >
                    </div>

                    <div class="modal-form-field">
                        <label for="customer-edit-email-<?= esc($key['id'], 'attr') ?>">Email:</label>
                        <input
                            type="email"
                            id="customer-edit-email-<?= esc($key['id'], 'attr') ?>"
                            name="email"
                            value="<?= esc($editData['email'], 'attr') ?>"
                        >
                    </div>

                    <div class="modal-form-field">
                        <label for="customer-edit-phone-<?= esc($key['id'], 'attr') ?>">Phone:</label>
                        <input
                            type="text"
                            id="customer-edit-phone-<?= esc($key['id'], 'attr') ?>"
                            name="phone"
                            value="<?= esc($editData['phone'], 'attr') ?>"
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
            <form action="<?= site_url('customers/delete/' . $key['id']) ?>" method="post" class="modal-panel delete-modal">
                <?= csrf_field() ?>
                <div class="delete-modal-icon" aria-hidden="true">
                    <i class="fa-solid fa-trash-can"></i>
                </div>
                <h1 id="<?= esc($deleteModalId . '-title', 'attr') ?>">Delete <?= esc($key['full_name']) ?>?</h1>
                <p>This customer will be permanently removed.</p>
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
