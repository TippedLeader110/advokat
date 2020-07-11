<div class="page">
	<div class="container">
		<form id="form">
		<div class="row">
			<div class="col-12 col-md-12">
				<div class="row">
					<!-- <div class="col-6 col-md-12"> -->
						<!-- <div class="form-group"> -->
							<input type="text" hidden name="id" value="<?php echo $id ?>">
							<!-- <label class="form-control-label" for="namaP">Plih Tanggal Jumpa</label>
							<select class="form-control" id="namaP" name="nama">
									<option value="none">-- Pilih Pengacara --</option>
								<?php foreach ($daftarPengacara as $key => $dfValue): ?>
									<option value="<?php echo $dfValue->id ?>">
										<?php echo $dfValue->nama ?>
									</option>
								<?php endforeach ?>
							</select>
								<div class="invalid-feedback">Tolong isi nama Pengacara</div>
						</div> -->
						<!-- <div class="form-group">
							<label class="form-control-label" for="deskripsiSeleksi">Deskripsi Pengacara</label>
							<textarea name="deskripsi" class="form-control" id="deskripsiSeleksi"></textarea>
								<div class="invalid-feedback">Tolong isi deskripsi</div>
						</div> -->
					<!-- </div> -->
					<div class="col-6 col-md-12">
						<div class="form-group">
							<label class="form-control-label" for="nohp">Tanggal Pertemuan</label>
							<input type="date" required class="form-control" id="tanggal" name="tanggal">
								<div class="invalid-feedback">Tolong isi Tanggal</div>
						</div>
					</div>
				</div>
				<div class="row">
				<div class="col-12 col-md-12" style="margin-top: 20px;padding-left: 0px;margin-left: 0px">
					<div class="container">
						<button id="save" disabled class="btn btn-primary">Simpan</button>
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>


<script type="text/javascript">
	$('#tanggal').on('click change', function(event) {
		
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
		Swal.fire({
		title: 'Apakah anda ingin mengatur tanggal jumpa dengan client?',
		text: "Client akan dikirim email tentang laporan jumpa dan kontak pengacara!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Ya, dan kirim email!!',
		cancelButtonText: 'Mungkin tidak'
		}).then((result) => {
			if (result.value) {
			    $.ajax({
				url: '<?php echo base_url('admin/simpanTanggal') ?>',
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
	            	Swal.fire('Berhasil !!', 'Perubahan berhasil disimpan dan email terkirim. Status kasus berubah menjadi "Kasus Berjalan" !!', 'success')
					$('#modalTG').modal('hide');
					$('#loading').show();
					$('#contentPage').addClass('lodtime');
	            	$('#contentPage').load('<?php echo base_url('admin/kelolaKasus?id='); echo $id ?>', function(){
						$('#loading').hide();
						$('#contentPage').removeClass('lodtime');
					});
	            	}
	            	else if (data=='NotSEND') {
	            		Swal.fire('Kesalahan!!', 'Auto email tidak terkirim!!', 'error')
	            	}
	            	else
	            		Swal.fire('Kesalahan!!', 'Gagal upload !!', 'error')
	            }
			})
			}
			else{
			}
		})
		
	});

	$('#return').click(function(event) {
		event.preventDefault();
		$('#loading').show();
		$('#contentModal').addClass('lodtime');
		$('#contentModal').load('<?php echo base_url('admin/modal_kelolaMasalahBerjalan?id='); echo $id; ?>', function(){
			$('#loading').hide();
			$('#contentModal').removeClass('lodtime');
		});
	});
</script>