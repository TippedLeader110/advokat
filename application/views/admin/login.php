<!DOCTYPE html>
<html>
<head>
	<title>Login Admin & Pengacara</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/login.css'); ?>">
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>
<body>
	<div class="login">
		<form class="fo">
		<h2 class="head" >Login Dashboard Admin & Pengacara</h2>
		<span id="span" style="margin-top: 10px;display: none;"></span>
		<input type="text" name="username" id="username" placeholder="Username" required="required" value="" class="input-box input-group">
		<input type="password" name="password" id="password" placeholder="Password" required="required" value="" class="input-box input-group">
		<button class="input-box" id="login">Login</button>
		<div class="d-flex justify-content-between">
			<!-- <span><a href="<?php echo base_url("repository/signup") ?>" class="forgot">Daftar akun</a></span> -->
			<span><a id="forgot" class="forgot">Lupa Password</a></span>
		</div>
		</form>
	</div>
</body>
</html>

<script type="text/javascript">
	$('#forgot').click(function(event) {
		event.preventDefault();
		Swal.fire({
			text : 'Untuk mengubah password dapat menguhubungi admin yang bertanggung jawab.',
			footer: 'Info lebih lanjut cs:adminadvokat_aliakbar@gmail.com',
			icon: 'info'
		})
	});

	$('#login').click(function(event) {
		event.preventDefault();
		var username = $('#username').val();
		var password = $('#password').val();
		if (username.length!=0 && password.length!=0) {
			$('#login').html("Memuat....");
			$.ajax({
				url: '<?php echo base_url('admin/prosesLogin') ?>',
				type: 'post',
				data: {user: username, pwd: password},
				success: function(re){
					console.log(re);
					if (re==1) {
						$('#span').addClass('text-success');
						$('#span').removeClass('text-danger');
						$('#span').html('<b>Selamat Datang</b>');
						$('#span').fadeIn('slow');
						$('#username').removeClass('fail');
						$('#password').removeClass('fail');
						$('#username').addClass('done');
						$('#password').addClass('done');
						// $('#login').removeClass('fail');
						$('#login').addClass('done');
						$('#login').html("Berhasil....");
						setTimeout(function() {
							window.location.replace("<?php echo base_url("admin") ?>")
						}, 900);
						
					}
					else{
						$('#span').addClass('text-danger');
						$('#span').removeClass('text-success');
						$('#span').html('<b>Username / Password tidak valid !! </b>');
						$('#span').fadeIn('slow');
						$('#username').removeClass('done');
						$('#password').removeClass('done');
						$('#username').addClass('fail');
						$('#password').addClass('fail');
						$('#login').html("Login");
					}
				},
				error: function(re){
					Swal.fire('Kesalahan !!', 'Terjadi kesalahan dengan server, silahkan hubungi admin ', 'error');
				}
			});
		}
		else{
			$('#span').html('<b>Tolong isi semua kolom !!</b>');
			$('#span').fadeIn('slow');
			$('#username').removeClass('done');
			$('#password').removeClass('done');
			$('#username').addClass('fail');
			$('#password').addClass('fail');
		}
	});

	$('input').each(function() {
		$(this).on('click change', function(event) {
			event.preventDefault();
			$('#username').removeClass('fail');
			$('#password').removeClass('fail');
			$('#span').hide();
		});
	});
</script>
