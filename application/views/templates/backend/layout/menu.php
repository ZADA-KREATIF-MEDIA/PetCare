<!-- Page Wrapper -->
<div id="wrapper">
  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon">
        <img src="<?= base_url('assets/favicon/') ?>favicon-32x32.png">
      </div>
      <div class="sidebar-brand-text mx-3">PetCare</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $this->uri->segment(2) == "dashboard" ? "active" : "" ?>">
      <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
      Transaksi
    </div>
    <li class="nav-item <?= $this->uri->segment(2) == "pesanan" ? "active" : "" ?>">
      <a class="nav-link" href="<?= base_url('admin/pesanan') ?>">
        <i class="fas fa-fw fa-box"></i>
        <span>Pesanan</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
      Master Data
    </div>
    <li class="nav-item <?= $this->uri->segment(2) == "produk" ? "active" : "" ?>">
      <a class="nav-link" href="<?= base_url('admin/produk') ?>">
        <i class="fas fa-fw fa-box"></i>
        <span>Produk</span></a>
    </li>
    <li class="nav-item <?= $this->uri->segment(2) == "kategori" ? "active" : "" ?>">
      <a class="nav-link" href="<?= base_url('admin/kategori') ?>">
        <i class="fas fa-fw fa-box"></i>
        <span>Kategori Produk</span></a>
    </li>
    <li class="nav-item <?= $this->uri->segment(2) == "tarif" ? "active" : "" ?>">
      <a class="nav-link" href="<?= base_url('admin/tarif') ?>">
        <i class="fas fa-fw fa-box"></i>
        <span>Tarif Ongkir</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
      Manajemen Pengguna
    </div>
    <!-- Divider -->
   
    <li class="nav-item <?= $this->uri->segment(2) == "pelanggan" ? "active" : "" ?>">
      <a class="nav-link" href="<?= base_url('admin/pelanggan') ?>">
        <i class="fas fa-fw fa-box"></i>
        <span>Pelanggan</span></a>
    </li>
    <li class="nav-item <?= $this->uri->segment(2) == "admin" ? "active" : "" ?>">
      <a class="nav-link" href="<?= base_url('admin/admin') ?>">
        <i class="fas fa-fw fa-box"></i>
        <span>Admin</span></a>
    </li>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
  </ul>
  <!-- End of Sidebar -->