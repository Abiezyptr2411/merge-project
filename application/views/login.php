<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>COHR - Login</title>
	<link rel="icon" type="image/x-icon" href="<?= base_url('assets') ?>/img/favicon.ico" />

	<!-- Custom fonts for this template-->
	<link href="<?= base_url('include') ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="<?= base_url('include') ?>/css/sb-admin-2.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>

<body class="bg-gradient-light">

	<div class="container">

		<!-- Outer Row -->
		<div class="row justify-content-center">


			<div class="col-xl-10 col-lg-12 col-md-9">
				<br><br><br>

				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
							<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
							<div class="col-lg-6">
								<div class="p-5">
									<div class="text-left">
										<div style="display: inline-block;">
											<img src="https://designreset.com/cork/html/src/assets/img/logo2.svg" width="28" alt="">
										</div>
										<div style="display: inline-block; vertical-align: middle;">
											<h5 class="mt-1"><strong><i style="color: #696969;">Human Resource Management</i></strong></h5>
										</div>
									</div>
									<hr>
									<form class="user" action="<?= site_url('login') ?>" method="post" id="loginForm">
										<div class="input-group mb-3">
											<div class="input-group-append">
												<span class="input-group-text">
													<i class="fas fa-envelope"></i>
												</span>
											</div>
											<input type="text" name="email_or_username" class="form-control form-control-user" placeholder="Email" id="emailField">
										</div>

										<div class="input-group mb-3">
											<div class="input-group-append">
												<span class="input-group-text">
													<i class="fas fa-lock"></i>
												</span>
											</div>
											<input type="password" name="password" class="form-control form-control-user" placeholder="Password" id="passwordField">
										</div>

										<div class="form-group ml-2">
											<div class="custom-control custom-checkbox small">
												<input type="checkbox" class="custom-control-input" id="customCheck">
												<label class="custom-control-label" for="customCheck" disabled>Show Password</label>
											</div>
										</div>

										<button type="button" class="btn btn-primary btn-user btn-block" id="submitBtn">
											<strong>Masuk</strong>
										</button>
									</form>
									<div class="text-center">

									</div>
									<div class="text-center">

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

	</div>

	<!-- Bootstrap core JavaScript-->
	<script src="<?= base_url('include') ?>/vendor/jquery/jquery.min.js"></script>
	<script src="<?= base_url('include') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="<?= base_url('include') ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="<?= base_url('include') ?>/js/sb-admin-2.min.js"></script>

	<script>
		const passwordField = document.getElementById('passwordField');
		const customCheck = document.getElementById('customCheck');

		customCheck.addEventListener('change', function() {
			if (customCheck.checked) {
				passwordField.type = 'text';
			} else {
				passwordField.type = 'password';
			}
		});
	</script>

	<script>
		document.getElementById('submitBtn').addEventListener('click', function() {
			const emailField = document.getElementById('emailField');
			const passwordField = document.getElementById('passwordField');

			// Periksa apakah kedua field kosong
			if (emailField.value.trim() === '' || passwordField.value.trim() === '') {
				Swal.fire({
					icon: 'error',
					title: 'Terjadi Kesalahan!',
					text: 'Field wajib diisi dengan benar',
				});
			} else {
				// Jika kedua field telah diisi, tampilkan sweetalert loading
				Swal.fire({
					title: 'Sedang diproses',
					onBeforeOpen: () => {
						Swal.showLoading();
					},
					allowOutsideClick: false,
					showConfirmButton: false
				});

				// Tunggu 2 detik
				setTimeout(function() {
					// Tutup sweetalert
					Swal.close();

					// Submit formulir
					document.getElementById('loginForm').submit();
				}, 2000);
			}
		});
	</script>

</body>

</html>