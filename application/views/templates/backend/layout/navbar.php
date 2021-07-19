
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
    </button>


    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <!-- <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-search fa-fw"></i>
        </a> -->
        <!-- Dropdown - Messages -->
        <!-- <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
        <form class="form-inline mr-auto w-100 navbar-search">
            <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
            </div>
        </form>
        </div> -->
    <!-- </li> -->

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= ucwords($this->session->userdata('username')) ?></span>
        <img class="img-profile rounded-circle" src="<?= base_url('assets/backend/img/profile.png') ?>">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <?php if($this->session->userdata('level') != 3){ ?>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editpassword">
            <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
            Edit Password
        </a>
        <div class="dropdown-divider"></div>
        <?php } ?>
       
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Keluar
        </a>
        </div>
    </li>

    </ul>

</nav>
<!-- End of Topbar -->

<div class="modal fade" id="editpassword" tabindex="-1" role="dialog" aria-labelledby="editpasswordLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editpasswordLabel">Edit Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form class="user" id="form-editpassword" action="<?= base_url('admin/dashboard/changepassword'); ?>" method="post">
                <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="old_password"
                        name="old_password" placeholder="Password Sekarang.."
                        value="<?= set_value('old_password'); ?>">
                    <?= form_error('old_password', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="new_password1"
                        name="new_password1" placeholder="Masukkan Password Baru..."
                        value="<?= set_value('new_password1'); ?>">
                    <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="new_password2"
                        name="new_password2" placeholder="Konfirmasi Password Baru..."
                        value="<?= set_value('new_password2'); ?>">
                    <?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
        <button type="submit" form="form-editpassword" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>