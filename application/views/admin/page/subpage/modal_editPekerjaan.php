<div class="page">
	<div class="container">
		<form id="form">
		<div class="row">
			<div class="col-12 col-md-12">
				<div class="row">
					<div class="col-12 col-md-12">
						<input type="text" hidden name="id" value="<?php echo $id ?>">
						<div class="form-group">
							<label class="form-control-label" for="someinput">Pekerjaan Client</label>
							<input type="text" name="pekerjaan" class="form-control" id="someinput">
								<div class="invalid-feedback">Tolong isi pekerjaan</div>
						</div>
					</div>
					<!-- <div class="col-6 col-md-12">
						<div class="form-group">
							<label class="form-control-label" for="nohp">Tanggal Pertemuan</label>
							<input type="date" required class="form-control" id="tanggal" name="tanggal">
								<div class="invalid-feedback">Tolong isi Tanggal</div>
						</div>
					</div> -->
				</div>
				<div class="row">
					<div class="col-12 col-md-12" style="margin-top: 20px;padding-left: 0px;margin-left: 0px">
						<div class="container">
								<a id="save" disabled class="btn btn-primary" style="color: white">Simpan</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>


<script type="text/javascript">
	$('#someinput').on('click change', function(event) {
		
		console.log($(this).val());
		if ($(this).val()=='none') {
			$('#save').prop('disabled', true);
		}
		else{
			$('#save').prop('disabled', false);	
		}
	});

	$('#save').click(function(event) {
		event.preventDefault();
		$('#form').submit();
	});

	$('#form').submit(function(event) {
		event.preventDefault(); 
		$.ajax({
			url: '<?php echo base_url('admin/simpanPekerjaan') ?>',
			type: 'POST',
			data:{id: <?php echo $id ?>, pekerjaan: $('#someinput').val()},
            error: function(data){
            	Swal.fire('Kesalahan!!', 'Gagal menghubungkan ke server !!', 'error')
            },
            success: function(data){
            	if (data==1) {
	            	Swal.fire('Berhasil !!', 'Perubahan berhasil disimpan !!', 'success')
					$('#modalTG').modal('hide');
					$('#loading').show();
					$('#contentPage').addClass('lodtime');
	            	$('#contentPage').load('<?php echo base_url('admin/kelolahKasus?id='); echo $id ?>', function(){
						$('#loading').hide();
						$('#contentPage').removeClass('lodtime');
					});
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
		$('#contentModal').load('<?php echo base_url('admin/modal_kelolahMasalahBerjalan?id='); echo $id; ?>', function(){
			$('#loading').hide();
			$('#contentModal').removeClass('lodtime');
		});
	});
</script>