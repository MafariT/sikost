// Toggle Sidebar
const toggleBtn = document.getElementById('toggleBtn');
const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('mainContent');
const sidebarOverlay = document.getElementById('sidebarOverlay');

toggleBtn.addEventListener('click', function () {
    if (window.innerWidth > 768) {
        // Desktop: collapse sidebar
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('expanded');
    } else {
        // Mobile: show/hide sidebar
        sidebar.classList.toggle('show');
        sidebarOverlay.classList.toggle('show');
    }
});

// Close sidebar when clicking overlay (mobile)
sidebarOverlay.addEventListener('click', function () {
    sidebar.classList.remove('show');
    sidebarOverlay.classList.remove('show');
});

// Handle window resize
window.addEventListener('resize', function () {
    if (window.innerWidth > 768) {
        sidebar.classList.remove('show');
        sidebarOverlay.classList.remove('show');
    } else {
        sidebar.classList.remove('collapsed');
        mainContent.classList.remove('expanded');
    }
});
