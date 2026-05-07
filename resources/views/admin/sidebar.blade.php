<div class="sidebar">
    <div class="sidebar-brand">
        <img src="{{ asset('images/logo.jpeg') }}" alt="Logo">
        <span>URSA EVENT</span>
    </div>
    <ul class="sidebar-menu">
        <li><a href="{{ route('admin.dashboard') }}" class="active">Beranda</a></li>
        <li><a href="#">Edit Beranda Web</a></li>
        <li><a href="#">Kontak Kami</a></li>
        <li><a href="#">Daftar Event</a></li>
        <li><a href="#">Tambah Event</a></li>
        <li><a href="#">Admin</a></li>
        <li><a href="#">Tambah Admin</a></li>

        <li>
            <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
                @csrf
            </form>
            <a href="#" class="logout-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
        </li>
    </ul>
</div>

<style>
    /* Tambahkan sedikit CSS agar link logout berwarna merah atau berbeda */
    .logout-link {
        color: #ff4d4d !important; /* Warna merah untuk tanda logout */
        cursor: pointer;
    }
    .logout-link:hover {
        background-color: rgba(255, 77, 77, 0.1) !important;
    }
</style>