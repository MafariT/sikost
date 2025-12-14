// Toggle Sidebar
const toggleBtn = document.getElementById('toggleBtn');
const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('mainContent');
const sidebarOverlay = document.getElementById('sidebarOverlay');
const sidebarLogo = document.getElementById('sidebarLogo');

// TIDAK PERLU MENGGUNAKAN {{ asset(...) }} LAGI DI SINI!
// Path diambil dari variabel global yang didefinisikan di Blade.

// Fungsi untuk mengganti logo berdasarkan status sidebar
function updateLogo() {
    // Gunakan variabel global yang sudah didefinisikan di Blade
    if (sidebar.classList.contains('collapsed')) {
        sidebarLogo.src = COLLAPSED_LOGO_PATH; 
    } else {
        sidebarLogo.src = FULL_LOGO_PATH; 
    }
}

// Event listener untuk tombol toggle
toggleBtn.addEventListener('click', function () {
    if (window.innerWidth > 768) {
        // Desktop: collapse sidebar
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('expanded');
        
        // Panggil fungsi untuk update logo
        updateLogo();

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

        // Pastikan logo kembali ke logo penuh jika tampilan desktop
        if (!sidebar.classList.contains('collapsed')) {
             sidebarLogo.src = FULL_LOGO_PATH;
        }

    } else {
        sidebar.classList.remove('collapsed');
        mainContent.classList.remove('expanded');
        // Di mode mobile, selalu gunakan logo penuh
        sidebarLogo.src = FULL_LOGO_PATH;
    }
});