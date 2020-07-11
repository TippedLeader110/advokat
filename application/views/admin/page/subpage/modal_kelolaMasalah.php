<?php foreach ($dataMasalah as $key => $value): ?>
	
<?php endforeach ?>
<div class="container-fluid" id="contentModal">
	<div class="row">
		<div class="col-12 col-md-12">
			
			<div class="card text-left" style="margin-bottom: 10px;">
				<div class="card-body">
					<h5 class="card-title text-center">Deskripsi Masalah</h5>
				    <table>
						<tr>
							<td>
								Masalah
							</td>
							<td>
								: &nbsp;
							</td>
							<td style="max-width: 400px;overflow: auto;">
								<?php echo $value->deskripsi ?>
							</td>
						</tr>
						<tr>
							<td>
								Pemohon
							</td>
							<td>
								: &nbsp;
							</td>
							<td>
								<?php echo $value->nama ?>	
							</td>
						</tr>
						<tr>
							<td>
								KTP
							</td>
							<td>
								: &nbsp;
							</td>
							<td>
								<?php echo $value->ktp ?>
							</td>
						</tr>
						<tr>
							<td>
								Alamat
							</td>
							<td>
								: &nbsp;
							</td>
							<td>
								<?php echo $value->alamat ?>
							</td>
						</tr>
						<tr>
							<td>
								Email
							</td>
							<td>
								: &nbsp;
							</td>
							<td>
								<?php echo $value->email ?>
							</td>
						</tr>
						<tr>
							<td>
								No.HP
							</td>
							<td>
								: &nbsp;
							</td>
							<td>
								<?php echo $value->nohp ?>
							</td>
						</tr>
						<tr>
							<td>
								Status	
							</td>
							<td>
								: &nbsp;
							</td>
							<td>
								<?php if ($value->status==1): ?>
								 Masalah Baru
								<?php endif ?>
							</td>
						</tr>
					</table>
				 </div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top: 10px;">
		<hr>
		<div class="col-12 col-md-6">
			<div class="card text-center" style="margin-bottom: 10px;height: 200px;">
				<div class="card-body">
					<h5 class="card-title">Pilih Pengacara</h5>
				    <p class="card-text">Memilih pengacara yang bertanggung jawab.</p>
				    
				 </div>
				 <div class="card-footer">
				 	<a href="#" class="btn btn-warning" id="modal_pilihPengacara">Pilih</a>
				 </div>
			</div>
		</div>
		<div class="col-12 col-md-6">
			<div class="card text-center" style="margin-bottom: 10px;height: 200px;">
				<div class="card-body">
					<h5 class="card-title">Status Masalah</h5>
				    <p class="card-text">Mengganti status Masalah.</p>
				    
				</div>
				<div class="card-footer">
				    <a href="#" class="btn btn-danger" id="status_masalah">
				    	<?php if ($value->status==1): ?>
				    		Tolak Kasus
				    	<?php endif ?>
				    	<?php if ($value->status==2): ?>
				    		Tutup Kasus
				    	<?php endif ?>
				    	<?php if ($value->status==0): ?>
				    		Aktifkan
				    	<?php endif ?>
				    </a>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function loadTime(){
        $('#loading').show();
        $('#contentModal').addClass('lodtime',function() {
            $('#loading').hide();
            $('#contentModal').removeClass('lodtime');
            
        });   
    }

    function loadPage(page){
        loadTime();
        $('#contentModal').load('<?php echo base_url('Admin/')?>' + page,function() {
            $('#loading').hide();
            $('#contentModal').removeClass('lodtime');
        });
    }

	$('#modal_pilihPengacara').click(function(event) {
        event.preventDefault();
        loadPage('modal_pilihPengacara?id=<?php echo $id ?>');
    });

    $('#modal_statusPengacara').click(function(event) {
        event.preventDefault();
        $.ajax({
        	url: '<?php echo base_url('admin/modal_statusPengacara') ?>',
        	type: 'POST',
        	data: {id: '<?php echo $id ?>'},
        	success: function(event){
        		if (event==1) {
        			Swal.fire('Berhasil', "Status pengacara berhasil diganti !!!", 'success');
        			$('#loading').show();
				    $('#contentPage').addClass('lodtime',function() {
			            $('#loading').hide();
			            $('#contentPage').removeClass('lodtime');
			        });   
			  		$('#contentPage').load('<?php echo base_url('Admin/')?>daftarPengacara',function() {
			            $('#loading').hide();
			            $('#contentPage').removeClass('lodtime');
			            $('#modalKelola').modal('hide');
						$('.modal-backdrop').remove();
						$('body').removeClass('modal-open');
			        }); 
        		}
        		else{
        			Swal.fire('Kesalahan', "Status pengacara gagal diganti !!!", 'error');
        		}
        	},
        	error: function(err){
        		Swal.fire('Error', "Mengembalikan error : " + err + " , tolong hubungi administrator untuk info lebih lanjut", 'error');
        	}
        })
        
    });

    $('#modal_hapusPengacara').click(function(event) {
        event.preventDefault();
        Swal.fire({
		title: 'Apakah anda ingin menghapus pengacara ini?',
		text: "Perubahan tidak dapat diundurkan!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Ya, saya yakin!!',
		cancelButtonText: 'Mungkin tidak'
		}).then((result) => {
			if (result.value) {
			    $.ajax({
			    	url: '<?php echo base_url('admin/modal_hapusPengacara') ?>',
			    	type: 'post',
			    	data:{id  :  '<?php echo $id ?>'},
			    	success: function(er){
			    		if (er==1) {
							console.log(er);
							Swal.fire({
						      title : 'Terkirim !',
						      text : 'Pengacara berhasil dihapus!!.',
						      icon : 'success',
						      timer: 2000,
  							  timerProgressBar: true
						    }).then((result) => {
						    	$('#loading').show();
							    $('#contentPage').addClass('lodtime',function() {
						            $('#loading').hide();
						            $('#contentPage').removeClass('lodtime');
						        });   
						  		$('#contentPage').load('<?php echo base_url('Admin/')?>daftarPengacara',function() {
						            $('#loading').hide();
						            $('#contentPage').removeClass('lodtime');
						            $('#modalKelola').modal('hide');
									$('.modal-backdrop').remove();
						$('body').removeClass('modal-open');
						        }); 
						    });
						}
						else{
							console.log(er);
							if (er==0) {
								er = "Database ERROR: Check Network Log";
							}
							Swal.fire('Gagal','Terjadi kesalahan dengan error : ' + er + ' hubungi administrator untuk info lebih lanjut ', 'error');
						}
			    	},
			    	error: function(er){
			    		Swal.fire('Gagal','Terjadi kesalahan dengan error : ' + er + ' hubungi administrator untuk info lebih lanjut ', 'error');
			    	}
			    });
			}
			else{
			}
		})
    });
</script>