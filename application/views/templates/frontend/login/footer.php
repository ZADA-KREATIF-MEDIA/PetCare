<!--===============================================================================================-->	
	<script src="<?php echo base_url()?>assets/frontend/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url()?>assets/frontend/login/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url()?>assets/frontend/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url()?>assets/frontend/login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url()?>assets/frontend/login/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="<?php echo base_url()?>assets/frontend/login/js/main.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script>
		<?php if(isset($_SESSION['msg'])&& $_SESSION['msg']=="sama"):?>
			Swal.fire({
				text: "Nomor Handphone telah digunakan",
				icon: 'error',
				showCancelButton: false,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'OK'
				}).then((result) => {
				if (result.value) {
					<?php unset($_SESSION['msg'])?>
				}
			});
		<?php endif;?>
		<?php if(isset($_SESSION['msg'])&& $_SESSION['msg']=="berhasil"):?>
			Swal.fire({
				text: "Registrasi berhasil",
				icon: 'success',
				showCancelButton: false,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'OK'
				}).then((result) => {
				if (result.value) {
					<?php unset($_SESSION['msg'])?>
				}
			});
		<?php endif;?>
		<?php if(isset($_SESSION['msg'])&& $_SESSION['msg']=="gagal_salah"):?>
			Swal.fire({
				text: "Nomor Handphone atau Password salah",
				icon: 'error',
				showCancelButton: false,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'OK'
				}).then((result) => {
				if (result.value) {
					<?php unset($_SESSION['msg'])?>
				}
			});
		<?php endif;?>
		<?php if(isset($_SESSION['msg'])&& $_SESSION['msg']=="gagal_kosong"):?>
			Swal.fire({
				text: "Nomor Handphone tidak ditemukan",
				icon: 'error',
				showCancelButton: false,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'OK'
				}).then((result) => {
				if (result.value) {
					<?php unset($_SESSION['msg'])?>
				}
			});
		<?php endif;?>
	</script>

</body>
</html>