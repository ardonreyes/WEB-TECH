const navBar = document.getElementById('dashboard-nav')
const uiBackdropFilter = document.getElementById('ui-backdrop-nav')
const closeBtn = document.getElementById('close-nav')
const openBtn = document.getElementById('open-nav')

function syncBodyScrollLock() {
    const hasOpenModal = document.querySelector('.ui-modal-backdrop.show-modal') !== null
    const hasOpenMobileNav = window.innerWidth < 1024 && navBar?.classList.contains('nav-open')

    document.body.classList.toggle('block-scroll', hasOpenModal || hasOpenMobileNav)
}

function setMobileNav(isOpen) {
    navBar?.classList.toggle('nav-open', isOpen)
    uiBackdropFilter?.classList.toggle('show-nav-backdrop', isOpen)
    openBtn?.setAttribute('aria-expanded', String(isOpen))
    navBar?.setAttribute('aria-hidden', String(!isOpen))
    syncBodyScrollLock()
}

function closeMobileNav() {
    setMobileNav(false)
}

openBtn?.addEventListener('click', () => setMobileNav(true))
closeBtn?.addEventListener('click', closeMobileNav)
uiBackdropFilter?.addEventListener('click', closeMobileNav)

function syncNavWithViewport() {
    if (window.innerWidth >= 1024) {
        navBar?.classList.remove('nav-open')
        uiBackdropFilter?.classList.remove('show-nav-backdrop')
        openBtn?.setAttribute('aria-expanded', 'false')
        navBar?.setAttribute('aria-hidden', 'false')
    } else {
        navBar?.setAttribute('aria-hidden', String(!navBar.classList.contains('nav-open')))
    }

    syncBodyScrollLock()
}

window.addEventListener('resize', syncNavWithViewport)
syncNavWithViewport()

const modalTriggers = new WeakMap()

function showModal(modal, trigger = null) {
    if (!modal) {
        return
    }

    if (trigger) {
        modalTriggers.set(modal, trigger)
    }

    modal.classList.add('show-modal')
    modal.setAttribute('aria-hidden', 'false')
    syncBodyScrollLock()

    modal.querySelector('.modal-close, .cancel-btn, button')?.focus()
}

function hideModal(modal) {
    if (!modal) {
        return
    }

    modal.classList.remove('show-modal')
    modal.setAttribute('aria-hidden', 'true')
    syncBodyScrollLock()

    modalTriggers.get(modal)?.focus()
    modalTriggers.delete(modal)
}

function formModal(element) {
    showModal(document.getElementById(element.dataset.modalTarget), element)
}

function deleteModal(element) {
    showModal(document.getElementById(element.dataset.modalTarget), element)
}

function closeDeleteModal(element) {
    hideModal(element.closest('.ui-modal-backdrop'))
}

function closeFormModal(element) {
    hideModal(element.closest('.ui-modal-backdrop'))
}

const formConfirmModal = document.getElementById('form-confirm-modal')
const formConfirmTitle = document.getElementById('form-confirm-title')
const formConfirmMessage = document.getElementById('form-confirm-message')
const formConfirmSubmit = document.getElementById('form-confirm-submit')
let pendingForm = null
let pendingSubmitter = null
let pendingFormModal = null
let confirmedForm = null

function restorePendingFormModal() {
    if (!pendingFormModal) {
        return
    }

    pendingFormModal.inert = false
    pendingFormModal.setAttribute('aria-hidden', 'false')
    pendingFormModal = null
}

function openFormConfirmation(form, submitter) {
    pendingForm = form
    pendingSubmitter = submitter
    pendingFormModal = form.closest('.ui-modal-backdrop')

    if (pendingFormModal) {
        pendingFormModal.inert = true
        pendingFormModal.setAttribute('aria-hidden', 'true')
    }

    formConfirmTitle.textContent = form.dataset.confirmTitle || 'Confirm submission?'
    formConfirmMessage.textContent = form.dataset.confirmMessage || 'Please confirm before continuing.'
    formConfirmSubmit.textContent = form.dataset.confirmLabel || 'Confirm'

    showModal(formConfirmModal, submitter)
}

function closeFormConfirmation() {
    restorePendingFormModal()
    hideModal(formConfirmModal)
    pendingForm = null
    pendingSubmitter = null
}

function confirmFormSubmission() {
    if (!pendingForm) {
        return
    }

    const form = pendingForm
    const submitter = pendingSubmitter

    restorePendingFormModal()
    pendingForm = null
    pendingSubmitter = null
    hideModal(formConfirmModal)

    confirmedForm = form

    if (submitter) {
        form.requestSubmit(submitter)
    } else {
        form.requestSubmit()
    }

    confirmedForm = null
}

document.querySelectorAll('.modal-form').forEach((form) => {
    form.addEventListener('submit', (event) => {
        if (form === confirmedForm) {
            return
        }

        event.preventDefault()
        openFormConfirmation(form, event.submitter)
    })
})

document.querySelectorAll('.ui-modal-backdrop').forEach((backdrop) => {
    backdrop.addEventListener('click', (event) => {
        if (event.target === backdrop) {
            if (backdrop === formConfirmModal) {
                closeFormConfirmation()
            } else {
                hideModal(backdrop)
            }
        }
    })
})

document.addEventListener('keydown', (event) => {
    if (event.key !== 'Escape') {
        return
    }

    const openModals = document.querySelectorAll('.ui-modal-backdrop.show-modal')
    const topModal = openModals[openModals.length - 1]

    if (topModal === formConfirmModal) {
        closeFormConfirmation()
    } else {
        hideModal(topModal)
    }
})

const initialModal = document.querySelector('.ui-modal-backdrop.show-modal')

if (initialModal) {
    initialModal.setAttribute('aria-hidden', 'false')
    syncBodyScrollLock()
}

const profilePreviewUrls = new WeakMap()

document.querySelectorAll('.profile-picker input[type="file"]').forEach((profileInput) => {
    profileInput.addEventListener('change', () => {
        const [file] = profileInput.files

        if (!file || !['image/jpeg', 'image/png'].includes(file.type)) {
            return
        }

        const currentPreviewUrl = profilePreviewUrls.get(profileInput)

        if (currentPreviewUrl) {
            URL.revokeObjectURL(currentPreviewUrl)
        }

        const profilePreviewUrl = URL.createObjectURL(file)
        const profilePreview = profileInput.closest('.profile-picker')?.querySelector('img')

        profilePreviewUrls.set(profileInput, profilePreviewUrl)

        if (profilePreview) {
            profilePreview.src = profilePreviewUrl
        }
    })
})

window.addEventListener('beforeunload', () => {
    document.querySelectorAll('.profile-picker input[type="file"]').forEach((profileInput) => {
        const profilePreviewUrl = profilePreviewUrls.get(profileInput)

        if (profilePreviewUrl) {
            URL.revokeObjectURL(profilePreviewUrl)
        }
    })
})
