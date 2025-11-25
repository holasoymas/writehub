// admin drawer toggle and delete confirmation (vanilla JS)
document.addEventListener('DOMContentLoaded', function() {
    const drawer = document.getElementById('admin-drawer');
    const toggle = document.getElementById('admin-drawer-toggle');
    const closeBtn = document.getElementById('drawer-close');

    function openDrawer() { drawer.classList.add('open'); }
    function closeDrawer() { drawer.classList.remove('open'); }

    if (toggle) {
        toggle.addEventListener('click', function() {
            if (drawer.classList.contains('open')) closeDrawer();
            else openDrawer();
        });
    }
    if (closeBtn) closeBtn.addEventListener('click', closeDrawer);

    // close drawer if click outside (for mobile)
    document.addEventListener('click', function(e) {
        if (!drawer.contains(e.target) && !toggle.contains(e.target)) {
            closeDrawer();
        }
    });
});
