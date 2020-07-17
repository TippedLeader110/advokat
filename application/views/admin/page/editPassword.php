<div class="page">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-12">
				<h5>Ganti Password</h5>
				<hr>
			</div>
		</div>
		<form id="form">
		<div class="row">
			<div class="col-12 col-md-12">
				<div class="row">
					<div class="col-12 col-md-12">
						<div class="form-group">
							<?php if ($this->input->get('id')==NULL): ?>
								<input hidden type="text" name="id_u" value="<?php echo $this->session->userdata('id_u') ?>">
							<?php endif ?>
							<?php if ($this->input->get('id')!=NULL): ?>
								<input hidden type="text" name="id_u" value="<?php echo $this->input->get('id') ?>">
							<?php endif ?>
							<label class="form-control-label" for="passBaru">Password Baru</label>
							<input type="password" class="form-control" id="passBaru" name="passBaru">
								<div class="invalid-feedback inva">Password tidak sama</div>
						</div>
					</div>
					<div class="col-12 col-md-12">
						<div class="form-group">
							<label class="form-control-label" for="konfirmasipassBaru">Konfirmasi Password Baru</label>
							<input type="password" class="form-control" id="konfirmasipassBaru" name="konfirmasipassBaru">
								<div class="invalid-feedback inva">Password tidak sama</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-12" style="margin-top: 20px;padding-left: 0px;margin-left: 0px">
					<button class="btn btn-primary" disabled id="simpan">Simpan</button>&nbsp;<button class="btn btn-warning" id="return">Batal</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>


<script type="text/javascript">
	var go = false;

    function check()
    {
    	if (go==true) {
    		$('#simpan').attr('disabled', false);
    	}else{
    		$('#simpan').attr('disabled', true);
    	}
    }

	$('#konfirmasipassBaru').on('change keyup', function(event) {
		event.preventDefault();
		if ($(this).val()!=$('#passBaru').val()) {
			$('.inva').show();
			go = false;
		}
		else{
			$('.inva').hide();
			go = true;
		}
		check();
	});

	$('#passBaru').on('change keyup', function(event) {
		event.preventDefault();
		if ($(this).val()!=$('#konfirmasipassBaru').val()) {
			$('.inva').show();
			go = false;
		}
		else{
			$('.inva').hide();
			go = true;
		}
		check();
	});

	$('#form').submit(function(event) {
		event.preventDefault(); 
		if (go==true) {
			$.ajax({
				url: '<?php echo base_url('admin/proseseditPassword') ?>',
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
	            	Swal.fire('Berhasil !!', 'Password berhasil di ganti !!', 'success')
	            	var delay = 1500; 
					setTimeout(function(){ 
						$('#loading').show();
						$('#contentPage').addClass('lodtime');
						$('#contentPage').load('<?php echo base_url('admin/laporanSingkat') ?>', function(){
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
			Swal.fire('Kesalahan!!', 'Password tidak sama !!', 'error');
		}
	});

	$('#return').click(function(event) {
		event.preventDefault();
		$('#loading').show();
		$('#contentPage').addClass('lodtime');
		<?php if ($this->input->get('id')!=NULL): ?>
			$('#contentPage').load('<?php echo base_url('admin/kelolaAkun') ?>', function(){
				$('#loading').hide();
				$('#contentPage').removeClass('lodtime');
			});
		<?php endif ?>
		<?php if ($this->input->get('id')==NULL): ?>
			$('#contentPage').load('<?php echo base_url('admin/laporanSingkat') ?>', function(){
				$('#loading').hide();
				$('#contentPage').removeClass('lodtime');
			});	
		<?php endif ?>
	});
</script>