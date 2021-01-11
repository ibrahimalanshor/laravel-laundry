<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <span class="sidebar-brand-icon d-md-none">{{ substr(setting('name'), 0, 3) }}</span>
    <div class="sidebar-brand-text mx-3">{{ setting('name') }}</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item {{ active('/') }}">

    <a class="nav-link" href="{{ route('home') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Master
  </div>

  <!-- Nav Item - User -->
  @can('isAdmin')
    <li class="nav-item {{ active('users', 'active', 'group') }}">

      <a class="nav-link" href="{{ route('users.index') }}">
        <i class="fas fa-fw fa-user-secret"></i>
        <span>Petugas</span></a>
    </li>
  @endcan

  <!-- Nav Item - Customer -->
  <li class="nav-item {{ active('customers', 'active', 'group') }}">

    <a class="nav-link" href="{{ route('customers.index') }}">
      <i class="fas fa-fw fa-users"></i>
      <span>Pelanggan</span></a>
  </li>

  <!-- Nav Item - Customer -->
  <li class="nav-item {{ active('packets', 'active', 'group') }}">

    <a class="nav-link" href="{{ route('packets.index') }}">
      <i class="fas fa-fw fa-boxes"></i>
      <span>Paket</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Menu
  </div>

  <!-- Nav Item - Customer -->
  <li class="nav-item {{ active('transactions', 'active', 'group') }}">

    <a class="nav-link" href="{{ route('transactions.index') }}">
      <i class="fas fa-fw fa-calculator"></i>
      <span>Transaksi</span></a>
  </li>

  @can('isAdmin')
    <!-- Nav Item - Customer -->
    <li class="nav-item {{ active('setting') }}">

      <a class="nav-link" href="{{ route('setting.index') }}">
        <i class="fas fa-fw fa-cog"></i>
        <span>Pengaturan</span></a>
    </li>
  @endcan

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>