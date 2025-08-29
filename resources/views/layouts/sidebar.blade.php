<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ url('/dashboard') }}" class="brand-link">
    <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" 
         alt="Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">Posyandu</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
        
        {{-- Dashboard (semua role bisa lihat) --}}
        <li class="nav-item">
          <a href="{{ url('/dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        {{-- Superadmin --}}
        @if(auth()->check() && auth()->user()->role === 'superadmin')
        <li class="nav-item">
          <a href="{{ url('/users') }}" class="nav-link">
            <i class="nav-icon fas fa-users-cog"></i>
            <p>Kelola User</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/desa') }}" class="nav-link">
            <i class="nav-icon fas fa-map-marker-alt"></i>
            <p>Data Desa</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/posyandu') }}" class="nav-link">
            <i class="nav-icon fas fa-hospital"></i>
            <p>Data Posyandu</p>
          </a>
        </li>
        @endif

        {{-- Admin Kecamatan --}}
        @if(auth()->check() && auth()->user()->role === 'admin')
        <li class="nav-item">
          <a href="{{ url('/desa') }}" class="nav-link">
            <i class="nav-icon fas fa-map"></i>
            <p>Data Desa</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/posyandu') }}" class="nav-link">
            <i class="nav-icon fas fa-hospital"></i>
            <p>Data Posyandu</p>
          </a>
        </li>
        @endif

        {{-- Operator Desa --}}
        @if(auth()->check() && auth()->user()->role === 'operator')
        <li class="nav-item">
          <a href="{{ url('/posyandu') }}" class="nav-link">
            <i class="nav-icon fas fa-hospital-user"></i>
            <p>Data Posyandu Desa</p>
          </a>
        </li>
        @endif

      </ul>
    </nav>
  </div>
</aside>
