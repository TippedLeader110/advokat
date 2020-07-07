<div class="page">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-12">
				<form id="tambahBerkasForm">
				<div class="row">
					<div class="col-12 col-md-12">
						<input type="text" hidden name="id" value="<?php echo $id ?>">
						<div class="form-group">
							<label class="form-control-label" for="someinput">Nama Berkas</label>
							<input type="text" name="namaBerkas" class="form-control" required="" id="someinput">
								<div class="invalid-feedback">Tolong isi nama dokumen</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-md-12">
						<div class="custom-file">
						    <input name="berkas" id="berkas" type="file" class="custom-file-input"  required>
						    <label class="custom-file-label" for="berkas">Upload berkas</label>
						    <div class="invalid-feedback">Tolong input file</div>
						</div>
					</div>
				</div>
				</form>
				<div class="row">
					<div class="col-12 col-md-12" style="margin-top: 20px;padding-left: 0px;margin-left: 0px">
						<div class="container">
								<a id="save" disabled class="btn btn-success" style="color: white"><i class="fas fa-plus"></i>&nbsp;Tambah</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	$('#berkas').on('change',function(){
    	var fileName = $(this).val();
        $(this).next('.custom-file-label').html(fileName);
    })

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
		$('#tambahBerkasForm').submit();
	});

	// data:{id: <?php echo $id ?>, pekerjaan: $('#someinput').val(), berkas: $('#berkas').prop('files')},

	$('#tambahBerkasForm').submit(function(event) {
		event.preventDefault(); 
		$.ajax({
			url: '<?php echo base_url('admin/tambahDokumen') ?>',
			type: 'POST',
			data: new FormData(this),
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            error: function(data){
            	Swal.fire('Kesalahan!!', 'Gagal menghubungkan ke server !!', 'error')
            },
            success: function(data){
            	if (data==1) {
	            	Swal.fire('Berhasil !!', 'Berkas berhasil ditambah !!', 'success')
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