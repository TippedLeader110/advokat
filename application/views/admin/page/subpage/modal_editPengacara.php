<div class="page">
	<div class="container">
		<form id="form">
		<div class="row">
			<div class="col-12 col-md-12">
				<div class="row">
					<div class="col-6 col-md-12">
						<?php foreach ($dataPengacara as $key => $value): ?>
						<?php endforeach ?>
						<div class="form-group">
							<input type="text" hidden name="id_p" value="<?php echo $value->id ?>">
							<label class="form-control-label" for="namaP">Nama Pengacara</label>
							<input type="text" class="form-control" id="namaP" name="nama" value="<?php echo $value->nama ?>">
								<div class="invalid-feedback">Tolong isi nama Pengacara</div>
						</div>
						<!-- <div class="form-group">
							<label class="form-control-label" for="deskripsiSeleksi">Deskripsi Pengacara</label>
							<textarea name="deskripsi" class="form-control" id="deskripsiSeleksi"></textarea>
								<div class="invalid-feedback">Tolong isi deskripsi</div>
						</div> -->
					</div>
					<div class="col-6 col-md-6">
						<div class="form-group">
							<label class="form-control-label" for="nohp">Nomor HP</label>
							<input type="number" class="form-control" id="nohp" name="nohp" value="<?php echo $value->nohp ?>">
								<div class="invalid-feedback">Tolong isi Nomor HP</div>
						</div>
					</div>
					<div class="col-6 col-md-6">
						<div class="form-group">
							<label class="form-control-label" for="emailP">Email</label>
							<input type="email" class="form-control" id="email" name="email" value="<?php echo $value->email ?>">
								<div class="invalid-feedback">Tolong isi email</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-md-12">
						<!-- <button class="btn btn-primary" id="gantiFoto">Ganti Foto</button> -->
						<div class="custom-file" id="fotoDiv">
						    <input name="foto" id="logo" type="file" class="custom-file-input" id="validatedCustomFile" required>
						    <label class="custom-file-label" for="validatedCustomFile">Upload foto pengacara</label>
						    <div class="invalid-feedback">Tolong input file</div>
							</div>
						</div>
					</div>
				<div class="col-12 col-md-12" style="margin-top: 20px;padding-left: 0px;margin-left: 0px">
					<button class="btn btn-outline-primary">Simpan</button>&nbsp;<button class="btn btn-outline-warning" id="return">Kembali</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>


<script type="text/javascript">
	$('#gantiFoto').click(function(event) {
		event.preventDefault();
		$('#fotoDiv').toggle('fast');
	});

	$('#foto').on('change',function(){
    	var fileName = $(this).val();
        $(this).next('.custom-file-label').html(fileName);
    })

    $('#logo').on('change',function(){
    	var fileName = $(this).val();
        $(this).next('.custom-file-label').html(fileName);
    })

	$('#form').submit(function(event) {
		event.preventDefault(); 
		$.ajax({
			url: '<?php echo base_url('admin/proseseditPengacara') ?>',
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
            	Swal.fire('Berhasil !!', 'Perubahan berhasil disimpan !!', 'success')
            	var delay = 1500; 
				setTimeout(function(){ 
					$('#loading').show();
					$('#contentPage').addClass('lodtime');
					$('#contentPage').load('<?php echo base_url('admin/daftarPengacara') ?>', function(){
						$('#loading').hide();
						$('#contentPage').removeClass('lodtime');
						$('#modalKelolah').modal('hide');
					})}, delay);
            	}
            	else
            		Swal.fire('Kesalahan!!', 'Gagal upload !!', 'error')
            }
		})
	});

	$('#return').click(function(event) {
		event.preventDefault();
		$('#loading').show();
		$('#contentModal').addClass('lodtime');
		$('#contentModal').load('<?php echo base_url('admin/modal_kelolahPengacara?id='); echo $value->id; ?>&status=<?php echo $value->status ?>', function(){
			$('#loading').hide();
			$('#contentModal').removeClass('lodtime');
		});
	});
</script>