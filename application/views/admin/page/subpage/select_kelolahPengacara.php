<div class="container-fluid" id="contentModal">
	<div class="row" style="margin-top: 0px;">
		<div class="col-12 col-md-4">
			<div class="card text-center" style="margin-bottom: 10px;height: 200px;">
				<div class="card-body">
					<h5 class="card-title">Edit Pengacara</h5>
				    <p class="card-text">Mengganti atribut pengacara.</p>
				    <a href="#" class="btn btn-warning" id="select_editPengacara">Edit</a>
				 </div>
			</div>
		</div>
		<div class="col-12 col-md-4">
			<div class="card text-center" style="margin-bottom: 10px;height: 200px;">
				<div class="card-body">
					<h5 class="card-title">Status Pengacara</h5>
				    <p class="card-text">Mengganti status pengacara.</p>
				    <?php if ($status==1): ?>
				    	<a href="#" class="btn btn-danger" id="select_statusPengacara">Nonaktifkan</a>
				    <?php endif ?>
				    <?php if ($status!=1): ?>
				    	<a href="#" class="btn btn-success" id="select_statusPengacara">Aktifkan</a>
				    <?php endif ?>
				 </div>
			</div>
		</div>
		<div class="col-12 col-md-4">
			<div class="card text-center" style="margin-bottom: 10px;height: 200px;">
				<div class="card-body">
					<h5 class="card-title">Hapus Pengacara</h5>
				    <p class="card-text">Menghapus entri pengacara.</p>
				    <a href="#" class="btn btn-danger text-light" id="select_hapusPengacara">Hapus</a>
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
            $('.modal-backdrop').remove();
        });   
    }

    function loadPage(page){
        loadTime();
        $('#contentModal').load('<?php echo base_url('Admin/')?>' + page,function() {
            $('#loading').hide();
            $('#contentModal').removeClass('lodtime');
        });
    }

	$('#select_editPengacara').click(function(event) {
        event.preventDefault();
        loadPage('select_editPengacara?id=<?php echo $id ?>');
    });

    $('#select_statusPengacara').click(function(event) {
        event.preventDefault();
        $.ajax({
        	url: '<?php echo base_url('admin/select_statusPengacara') ?>',
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
			  		$('#contentPage').load('<?php echo base_url('Admin/')?>select_statusPengacara',function() {
			            $('#loading').hide();
			            $('#contentPage').removeClass('lodtime');
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

    $('#select_hapusPengacara').click(function(event) {
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
			    	url: '<?php echo base_url('admin/select_hapusPengacara') ?>',
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
						    	loadTime();
        						loadPage('daftarPengacara');
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