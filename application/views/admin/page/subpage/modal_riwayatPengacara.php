<?php foreach ($dataP as $key => $value): ?>
	
<?php endforeach ?>
<div class="container-fluid" id="contentModal">
	<div class="row">
		<div class="col-12 col-md-12">
			
			<div class="card text-left" style="margin-bottom: 10px;height: 240px;">
				<div class="card-body">
					<h5 class="card-title text-center">Profile Pengacara</h5>
				    <table>
						<tr>
							<td rowspan="4"><img src="<?php echo base_url('public/pengacara/foto/'); echo $value->foto ?>" style="max-width: 100px;"></td><td>&nbsp;&nbsp;&nbsp;Nama : <?php echo $value->nama ?></td>
						</tr>
						<tr>
							<td>&nbsp;&nbsp;&nbsp;Email : <?php echo $value->email ?></td>
						</tr>
						<tr>
							<td>&nbsp;&nbsp;&nbsp;No HP : <?php echo $value->nohp ?></td>
						</tr>
						<tr>
							<td>&nbsp;&nbsp;&nbsp;Status : 
								<?php if ($value->status==1): ?>
									Aktif
								<?php endif ?>
								<?php if ($value->status!=1): ?>
									Tidak Aktif
								<?php endif ?>
							</td>
						</tr>
					</table>
				 </div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top: 10px;">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="tablePengacara">
				<thead>
					<th>#</th>
					<th>Nomor Kasus</th>
					<th>Pengadu</th>
					<th>Tanggal</th>
					<th>Status</th>
					<th></th>
				</thead>
				<tbody>
					<?php $count = 1 ?>
					<?php foreach ($listTugas as $key => $value): ?>
						<tr>
							<td><?php echo $count; $count++; ?></td>
							<td><?php echo $value->nama; ?></td>
							<td><?php echo $value->email; ?></td>
							<td><?php echo $value->nohp; ?></td>
							<td>
								<?php if ($value->status==1): ?>
									Aktif
								<?php endif ?>
								<?php if ($value->status!=1): ?>
									Tidak Aktif
								<?php endif ?>
							</td>
							<td>
								<input type="text" id="status<?php echo $value->id ?>" hidden value="<?php echo $value->status ?>">
								<button class="btn btn-primary" id="kelolah" onclick="kelolah(<?php echo $value->id ?>, <?php echo $value->status ?>)">Kelolah</button>		
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>				
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

	$('#modal_editPengacara').click(function(event) {
        event.preventDefault();
        loadPage('modal_editPengacara?id=<?php echo $id ?>');
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
			            $('#modalKelolah').modal('hide');
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
						            $('#modalKelolah').modal('hide');
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