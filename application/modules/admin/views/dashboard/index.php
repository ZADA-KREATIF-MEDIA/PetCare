<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
    <div class="flash-danger" data-flashdata="<?= $this->session->flashdata('danger'); ?>"></div>
    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800">Dashboard</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 border-left-success">
    <!-- <a href="#collapseFilterData" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseFilterData">
        <h6 class="m-0 font-weight-bold text-primary">Filter Data</h6>
    </a> -->
        <div class="collapse show">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="row col-md-12">
                            <div class="col-md-12">
                            <form action="<?= base_url('admin/dashboard') ?>" id="" class="form-inline mb-5" method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Tanggal Awal</label>
                                            <input type="date" class="form-control col-md-12" name="date_start" required value="<?= set_value('date_start'); ?>">
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="alamat">Tanggal Akhir</label>
                                            <input type="date" class="form-control col-md-12" name="date_end" required value="<?= set_value('date_end'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mt-4">
                                            <input type="submit" name="submit" class="btn btn-primary" value="Filter">
                                            <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-secondary ml-2">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            </div>
                    </div>
                    <div class="row col-md-12">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pesanan</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pesanan ?> pesanan</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-box fa-2x text-gray-300"></i>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Pelanggan</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pelanggan ?> pelanggan</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Jarak</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_jarak ?> KM</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-biking fa-2x text-gray-300"></i>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pesanan Selesai</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pesanan_selesai ?> pesanan</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-check-square fa-2x text-gray-300"></i>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pesanan Hari Ini</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $order_hari_ini ?> pesanan</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->