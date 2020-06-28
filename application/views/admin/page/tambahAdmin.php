<div class="page">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-12">
				<h5>Tambah Admin baru</h5>
				<hr>
			</div>
		</div>
		<form id="form">
		<div class="row">
			<div class="col-12 col-md-12">
				<div class="row">
					<div class="col-6 col-md-6">
						<div class="form-group">
							<input type="text" hidden name="id" value="<?php echo $this->session->userdata('panitia-id'); ?>">
							<label class="form-control-label" for="namaP">Nama Admin</label>
							<input type="text" class="form-control" id="namaP" name="nama">
								<div class="invalid-feedback">Tolong isi nama Pengacara</div>
						</div>
						<!-- <div class="form-group">
							<label class="form-control-label" for="deskripsiSeleksi">Deskripsi Pengacara</label>
							<textarea name="deskripsi" class="form-control" id="deskripsiSeleksi"></textarea>
								<div class="invalid-feedback">Tolong isi deskripsi</div>
						</div> -->
					</div>
					<input type="text" value="1" name="level" hidden>
					<div class="col-6 col-md-6">
						<div class="form-group">
							<label class="form-control-label" for="emailP">Email</label>
							<input type="email" class="form-control" id="email" name="email">
								<div class="invalid-feedback">Tolong isi Email</div>
						</div>
					</div>
					<div class="col-6 col-md-6">
						<div class="form-group">
							<label class="form-control-label" for="nohp">Username</label>
							<input type="text" class="form-control" id="username" name="username">
								<div class="invalid-feedback">Tolong isi Username</div>
						</div>
					</div>
					<div class="col-6 col-md-6">
						<div class="form-group">
							<label class="form-control-label" for="emailP">Password</label>
							<input type="password" class="form-control" id="password" name="password">
								<div class="invalid-feedback">Tolong isi Password</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-12" style="margin-top: 20px;padding-left: 0px;margin-left: 0px">
					<button class="btn btn-outline-primary">Tambah</button>&nbsp;<button class="btn btn-outline-warning" id="return">Kembali</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>


<script type="text/javascript">
	var go = false;

	$('#foto').on('change',function(){
    	var fileName = $(this).val();
        $(this).next('.custom-file-label').html(fileName);
    })

    $('#logo').on('change',function(){
    	var fileName = $(this).val();
        $(this).next('.custom-file-label').html(fileName);
    })

	$('#username').on('change click keyup', function(event) {
    	var ur = $('#username').val()
    	$.ajax({
    		url: '<?php echo base_url('admin/cekUsername') ?>',
    		type: 'post',
    		data: {ur: ur},
    		success: function(event){
    			if (event==1) {
    				go = true;
    				console.log('event = ' + event + " && go = " + go);
    			}
    			else{
    				go = false;
    				console.log('event = ' + event + " && go = " + go);
    			}
    		},
    		error: function(data){
	            	Swal.fire('Cek username gagal!!', 'Gagal menghubungkan ke server !!', 'error')
	        }
    	})
    });

	$('#form').submit(function(event) {
		event.preventDefault(); 
		if (go==true) {
			$.ajax({
				url: '<?php echo base_url('admin/prosestambahAdminDirektur') ?>',
				type: 'POST',
				data:new FormData(this),
	            processData:false,
	            contentType:false,
	            cache:false,
	            async:false,
	            error: function(data){
	            	Swal.fire('Kesalahan!!', 'Gagal menghubungkan ke server !!', 'error')
	            },
	            success: function(data){
	            	if (data==1) {
	            	Swal.fire('Berhasil !!', 'Akun Direktur berhasil ditambahkan !!', 'success')
	            	var delay = 1500; 
					setTimeout(function(){ 
						$('#loading').show();
						$('#contentPage').addClass('lodtime');
						$('#contentPage').load('<?php echo base_url('admin/kelolahAkun') ?>', function(){
							$('#loading').hide();
							$('#contentPage').removeClass('lodtime');
						})}, delay);
	            	}
	            	else
	            		Swal.fire('Kesalahan!!', 'Gagal upload !!', 'error')
	            }
			})
		}
		else{
			Swal.fire('Kesalahan!!', 'Username telah digunakan !!', 'error');
		}
	});

	$('#return').click(function(event) {
		event.preventDefault();
		$('#loading').show();
		$('#contentPage').addClass('lodtime');
		$('#contentPage').load('<?php echo base_url('admin/kelolahAkun') ?>', function(){
			$('#loading').hide();
			$('#contentPage').removeClass('lodtime');
		});
	});
</script>