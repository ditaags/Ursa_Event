<div class="sidebar">

    <div class="sidebar-brand">
        <img src="{{ asset('images/logo.jpeg') }}" alt="Logo">
        <span>URSA EVENT</span>
    </div>

    <ul class="sidebar-menu">

        {{-- BERANDA --}}
        <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}">
                Beranda
            </a>
        </li>

        {{-- KHUSUS SUPERADMIN --}}
        @if(Auth::user()->level === 'superadmin')

            <li class="{{ Request::is('admin/edit-beranda') ? 'active' : '' }}">
                <a href="{{ route('admin.edit_beranda') }}">
                    Edit Beranda Web
                </a>
            </li>

            <li class="{{ Request::is('admin/edit-kontak') ? 'active' : '' }}">
                <a href="{{ route('admin.edit_kontak') }}">
                    Kontak Kami
                </a>
            </li>

        @endif

        {{-- TAMBAH EVENT --}}
        <li class="{{ Request::is('admin/events/create') ? 'active' : '' }}">
            <a href="{{ route('admin.events.create') }}">
                Tambah Event
            </a>
        </li>

        {{-- DAFTAR EVENT --}}
        <li class="{{ Request::is('admin/events') && !Request::is('admin/events/create') ? 'active' : '' }}">
            <a href="{{ route('admin.events.index') }}">
                Daftar Event
            </a>
        </li>

          <li class="{{ Request::is('admin/users/create') ? 'active' : '' }}">
                <a href="{{ route('admin.users.create') }}">
                    Tambah User
                </a>
            </li>
    
            <li class="{{ Request::is('admin/users') ? 'active' : '' }}">
                <a href="{{ route('admin.users.index') }}">
                    Daftar User
                </a>
            </li>

        {{-- LOGOUT --}}
        <li class="logout-section">

            <form action="{{ route('logout') }}"
                  method="POST"
                  id="logout-form"
                  style="display: none;">
                @csrf
            </form>

            <a href="#"
               class="logout-link"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                <i class="fas fa-sign-out-alt"></i>
                Logout

            </a>
        </li>

    </ul>

</div>