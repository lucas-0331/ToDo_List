document.addEventListener('DOMContentLoaded', function () {
    const triggerEl = document.getElementById('triggerEl');
    const navbarCta = document.getElementById('navbar-cta');

    triggerEl.addEventListener('click', function () {
        navbarCta.classList.toggle('show');
    });
});
