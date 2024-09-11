<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                @if (auth()->check())
                    <img alt="image" src="{{ Storage::url(auth()->user()->avatar) }}" class="rounded-circle mr-1"
                        style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                    <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
                @else
                    <div class="d-sm-none d-lg-inline-block">Hi, Guest</div>
                @endif
            </a>
            @if (auth()->check())
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-title">Logged in 5 min ago</div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> Profile
                    </a>
                    <a href="#" class="dropdown-item has-icon">
                        <i class="fas fa-cog"></i> Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="#"
                            onclick="event.preventDefault();
                    this.closest('form').submit();"
                            class="dropdown-item has-icon text-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </form>
                </div>
            @endif
        </li>
    </ul>
</nav>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Company Profile</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">CP</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ setSidebarActive(['admin.dashboard']) }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-fire">
                    </i><span>Dashboard</span>
                </a>
            </li>

            <li class="menu-header">Starter</li>

            <li class="{{ setSidebarActive(['admin.artikel.*']) }}">
                <a class="nav-link" href="{{ route('admin.artikel.index') }}"><i class="fas fa-address-card"></i>
                    <span>Artikel</span>
                </a>
            </li>

            <li
                class="dropdown {{ setSidebarActive(['admin.hero-sections.*', 'admin.principles.*', 'admin.statistics.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-globe"></i>
                    <span>Landing Page</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setSidebarActive(['admin.hero-sections.*']) }}">
                        <a class="nav-link" href="{{ route('admin.hero-sections.index') }}">Hero Section</a>
                    </li>
                    <li class="{{ setSidebarActive(['admin.principles.*']) }}">
                        <a class="nav-link" href="{{ route('admin.principles.index') }}">Our Principles</a>
                    </li>
                    <li class="{{ setSidebarActive(['admin.statistics.*']) }}">
                        <a class="nav-link" href="{{ route('admin.statistics.index') }}">Company Stats</a>
                    </li>
                </ul>
            </li>

            <li class="{{ setSidebarActive(['admin.teams.*']) }}">
                <a class="nav-link" href="{{ route('admin.teams.index') }}"><i class="fas fa-address-card"></i>
                    <span>Our Teams</span>
                </a>
            </li>

            <li class="{{ setSidebarActive(['admin.products.*']) }}">
                <a class="nav-link" href="{{ route('admin.products.index') }}"><i class="fas fa-address-card"></i>
                    <span>Our Product</span>
                </a>
            </li>

            <li class="dropdown {{ setSidebarActive(['admin.testimonials.*', 'admin.clients.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-globe"></i>
                    <span>Stories</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setSidebarActive(['admin.testimonials.*']) }}">
                        <a class="nav-link" href="{{ route('admin.testimonials.index') }}">Testimonials</a>
                    </li>
                    <li class="{{ setSidebarActive(['admin.clients.*']) }}">
                        <a class="nav-link" href="{{ route('admin.clients.index') }}">Our Clients</a>
                    </li>
                </ul>
            </li>

            <li class="{{ setSidebarActive(['admin.abouts.*']) }}">
                <a class="nav-link" href="{{ route('admin.abouts.index') }}"><i class="fas fa-address-card"></i>
                    <span>About</span>
                </a>
            </li>

            <li class="{{ setSidebarActive(['admin.appointments.*']) }}">
                <a class="nav-link" href="{{ route('admin.appointments.index') }}"><i class="fas fa-address-card"></i>
                    <span>Appointment</span>
                </a>
            </li>

            <li class="dropdown {{ setSidebarActive(['admin.footer-info.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-stream"></i>
                    <span>Footer Setting</span></a>
                <ul class="dropdown-menu">
                    {{--  <li class="{{ setSidebarActive(['admin.footer-social.*']) }}">
                        <a class="nav-link" href="{{ route('admin.footer-social.index') }}">Social Links</a>
                    </li>  --}}
                    <li class="{{ setSidebarActive(['admin.footer-info.*']) }}">
                        <a class="nav-link" href="{{ route('admin.footer-info.index') }}">Footer Info</a>
                    </li>
                    {{--  <li class="{{ setSidebarActive(['admin.footer-grid-one.*']) }}">
                        <a class="nav-link" href="{{ route('admin.footer-grid-one.index') }}">Footer Grid One</a>
                    </li>
                    <li class="{{ setSidebarActive(['admin.footer-grid-two.*']) }}">
                        <a class="nav-link" href="{{ route('admin.footer-grid-two.index') }}">Footer Grid Two</a>
                    </li>
                    <li class="{{ setSidebarActive(['admin.footer-grid-three.*']) }}">
                        <a class="nav-link" href="{{ route('admin.footer-grid-three.index') }}">Footer Grid Three</a>
                    </li>
                    <li class="{{ setSidebarActive(['admin.footer-grid-four.*']) }}">
                        <a class="nav-link" href="{{ route('admin.footer-grid-four.index') }}">Footer Grid Four</a>
                    </li>  --}}
                </ul>
            </li>

            {{--  <li class="{{ setSidebarActive(['admin.artikel.*']) }}">
                <a class="nav-link" href="{{ route('admin.artikel.index') }}"><i class="fas fa-address-card"></i>
                    <span>Our Teams</span>
                </a>
            </li>  --}}

        </ul>
    </aside>
</div>
