<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100-daftar">
            <div class="login100-pic js-tilt mt-200" data-tilt>
                <img src="<?php echo base_url();?>assets/frontend/img/anter_logo_crop.jpg" alt="IMG">
            </div>

            <form class="login100-form validate-form" action="<?php echo base_url()?>home/save_daftar" method="POST">
                <div class="alert alert-danger" role="alert">
                    Maaf, untuk sementara website ini masih dalam tahap pengujian. belum menerima orderan langsung. Web sudah bisa digunakan ketika informasi ini sudah tidak ada
                </div>
                <span class="login100-form-title">
                    Daftar Member
                </span>

                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="nama" placeholder="Masukkan Nama" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                    <i class="fa fa-user-circle"></i>
                    </span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Password is required">
                    <input class="input100" type="password" name="password" id="password" placeholder="Masukkan Password" required="" maxlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                </div>
                <small id="passwordHelpBlock" class="form-text text-primary text-center">
                    Password berupa angka dan panjang 6 digit
                </small>

                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="email" placeholder="Masukkan email" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Password is required">
                    <input class="input100" type="text" name="no_telpn"  placeholder="Masukkan Nomor Telepon" required="" maxlength="14" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-mobile" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="alamat" id="alamat" placeholder="Masukkan Alamat" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" type="submit">
                        Daftar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
