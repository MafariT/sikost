<style>
    .logout-btn {
        background: transparent;
        border: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
    }

    .logout-btn:hover {
        background: rgba(255, 107, 107, 0.1);
    }

</style>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" style="height: 40px;">
    </div>

    <ul class="sidebar-nav">
        <li class="nav-item">
            <a href="/admin/dashboard" class="nav-link-custom {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i>
                <span class="nav-text">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="/admin/pelaporan" class="nav-link-custom {{ Request::is('admin/pelaporan*') ? 'active' : '' }}">
                <i class="fas fa-flag"></i>
                <span class="nav-text">Pelaporan</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="/admin/kamar" class="nav-link-custom {{ Request::is('admin/kamar*') ? 'active' : '' }}">
                <i class="fas fa-bed"></i>
                <span class="nav-text">Kamar</span>
            </a>
        </li>
    </ul>

    <!-- LOGOUT -->
    <div class="logout-link">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="nav-link-custom logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span class="nav-text">Logout</span>
            </button>
        </form>
    </div>
</aside>
