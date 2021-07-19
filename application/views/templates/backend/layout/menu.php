
<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon">
      <i class="fas fa-road"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Anter#Anter</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item <?= $this->uri->segment(2)=="dashboard" ? "active" : "" ?>">
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
  <li class="nav-item <?= $this->uri->segment(2)=="orders" ? "active" : "" ?>">
    <a class="nav-link" href="<?= base_url('admin/orders') ?>">
      <i class="fas fa-fw fa-box"></i>
      <span>Pesanan</span></a>
  </li>
  <li class="nav-item <?= $this->uri->segment(2)=="gantikurir" ? "active" : "" ?>">
    <a class="nav-link" href="<?= base_url('admin/gantikurir') ?>">
      <i class="fas fa-fw fa-retweet"></i>
      <span>Ganti Kurir</span></a>
  </li>


  <!-- Divider -->
  <hr class="sidebar-divider">
<?php if($this->session->userdata('level') == 1 OR $this->session->userdata('level') == 2){ ?>
  <!-- Heading -->
  <div class="sidebar-heading">
    Data Master
  </div>

  <!-- Nav Item - Charts -->
  <li class="nav-item <?= $this->uri->segment(2)=="drivers" ? "active" : "" ?>">
    <a class="nav-link" href="<?= base_url('admin/drivers') ?>">
      <i class="fas fa-fw fa-biking"></i>
      <span>Kurir</span></a>
  </li>

  <!-- Nav Item - Tables -->
  <li class="nav-item <?= $this->uri->segment(2)=="customers" ? "active" : "" ?>">
    <a class="nav-link" href="<?= base_url('admin/customers') ?>">
      <i class="fas fa-fw fa-users"></i>
      <span>Pelanggan</span></a>
  </li>
  <li class="nav-item <?= $this->uri->segment(2)=="tarif" ? "active" : "" ?>">
    <a class="nav-link" href="<?= base_url('admin/tarif') ?>">
      <i class="fas fa-fw fa-money-check-alt"></i>
      <span>Setting Tarif & Iklan</span></a>
  </li>
  <li class="nav-item <?= $this->uri->segment(2)=="users" ? "active" : "" ?>">
    <a class="nav-link" href="<?= base_url('admin/users') ?>">
      <i class="fas fa-fw fa-users"></i>
      <span>Users</span></a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider">
<?php } ?>

  <!-- Heading -->
  <div class="sidebar-heading">
    Laporan
  </div>

  <li class="nav-item <?= $this->uri->segment(2)=="laporan" ? "active" : "" ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan" aria-expanded="true" aria-controls="collapseLaporan">
          <i class="fas fa-fw fa-file-excel"></i>
          <span>Laporan</span>
        </a>
        <div id="collapseLaporan" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?= $this->uri->segment(3)=="omset_jarak" ? "active" : "" ?>" href="<?= base_url('admin/laporan/omset_jarak') ?>">Omset dan Jarak </a>
            <a class="collapse-item <?= $this->uri->segment(2)=="omset_member" ? "active" : "" ?>" href="<?= base_url('admin/laporan/omset_member') ?>">Omset By Member </a>
            <!-- <a class="collapse-item" href="forgot-password.html">Forgot Password</a> -->
           
          </div>
        </div>
      </li>
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->