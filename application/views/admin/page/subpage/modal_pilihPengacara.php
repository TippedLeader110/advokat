<div class="page">
	<div class="container">
		<form id="form">
		<div class="row">
			<div class="col-12 col-md-12">
				<div class="row">
					<div class="col-6 col-md-12">
						<div class="form-group">
							<input type="text" hidden name="id" value="<?php echo $id ?>">
							<label class="form-control-label" for="namaP">Plih Pengacara</label>
							<select class="form-control" id="namaP" name="nama">
									<option value="none">-- Pilih Pengacara --</option>
								<?php foreach ($daftarPengacara as $key => $dfValue): ?>
									<option value="<?php echo $dfValue->id ?>">
										<?php echo $dfValue->nama ?>
									</option>
								<?php endforeach ?>
							</select>
								<div class="invalid-feedback">Tolong isi nama Pengacara</div>
						</div>
						<!-- <div class="form-group">
							<label class="form-control-label" for="deskripsiSeleksi">Deskripsi Pengacara</label>
							<textarea name="deskripsi" class="form-control" id="deskripsiSeleksi"></textarea>
								<div class="invalid-feedback">Tolong isi deskripsi</div>
						</div> -->
					</div>
					<!-- <div class="col-6 col-md-6">
						<div class="form-group">
							<label class="form-control-label" for="nohp">Tanggal Pertemuan</label>
							<input type="date" required class="form-control" id="nohp" name="tanggal">
								<div class="invalid-feedback">Tolong isi Tanggal</div>
						</div>
					</div> -->
				</div>
				<div class="row">
				<div class="col-12 col-md-12" style="margin-top: 20px;padding-left: 0px;margin-left: 0px">
					<button id="save" disabled class="btn btn-primary">Simpan</button>&nbsp;<button class="btn btn-outline-warning" id="return">Kembali</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>


<script type="text/javascript">
	$('#namaP').on('click change', function(event) {
		event.preventDefault();
		console.log($(this).val());
		if ($(this).val()=='none') {
			$('#save').prop('disabled', true);
		}
		else{
			$('#save').prop('disabled', false);	
		}
	});

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
			url: '<?php echo base_url('admin/prosespilihPengacara') ?>',
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
            	Swal.fire('Berhasil !!', 'Perubahan berhasil disimpan. Status berubah menjadi "Kasus Berjalan" !!', 'success')
            	var delay = 1500; 
				setTimeout(function(){ 
					$('#loading').show();
					$('#contentPage').addClass('lodtime');
					$('#contentPage').load('<?php echo base_url('admin/daftarMasalah?tipe=1') ?>', function(){
						$('#loading').hide();
						$('#contentPage').removeClass('lodtime');
						$('#modalKelola').modal('hide');
						$('.modal-backdrop').remove();
						$('body').removeClass('modal-open');
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
		$('#contentModal').load('<?php echo base_url('admin/modal_kelolaMasalah?id='); echo $id; ?>', function(){
			$('#loading').hide();
			$('#contentModal').removeClass('lodtime');
		});
	});
</script>