const navBar = document.getElementById('dashboard-nav')
const uiBackdropFilter = document.getElementById('ui-backdrop-nav')
const closeBtn = document.getElementById('close-nav')
const openBtn = document.getElementById('open-nav')

openBtn.addEventListener('click', () => {
    navBar.setAttribute('style', 'display: flex;')
    uiBackdropFilter.setAttribute('style', 'display: block;')
    document.body.classList.add('block-scroll')
})

closeBtn.addEventListener('click', () => {
    navBar.setAttribute('style', 'display: none;')
    uiBackdropFilter.setAttribute('style', 'display: none;')
    document.body.classList.remove('block-scroll')
})

window.addEventListener('resize', () => {
    if (window.innerWidth >= 1024) {
        navBar.setAttribute('style', 'display: flex;')
        uiBackdropFilter.setAttribute('style', 'display: none;')
    } else {
        navBar.setAttribute('style', 'display: none;')
        uiBackdropFilter.setAttribute('style', 'display: none;')
    }
})

