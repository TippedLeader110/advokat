<?php foreach ($dataMasalah as $key => $value): ?>
<?php endforeach ?>
<?php if ($this->session->userdata('level')==1): ?>
	<?php foreach ($pengacara as $key => $valueP): ?>
	<?php endforeach ?>
<?php endif ?>
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
								Pengacara
							</td>
							<td>
								: &nbsp;
							</td>
							<td>
								<?php if ($this->session->userdata('level')==1): ?>
									<?php echo $valueP->nama ?>&nbsp;
								<?php endif ?>
								<?php if ($this->session->userdata('level')==2): ?>
									<?php echo $this->session->userdata('full_name') ?>
								<?php endif ?>
							</td>
						</tr>
						<tr>
						<tr>
							<td>
								Status	
							</td>
							<td>
								: &nbsp;
							</td>
							<td>
								<?php if ($value->status==2): ?>
								Kasus Berjalan
								<?php endif ?>
								<?php if ($value->status==3): ?>
								Kasus Terselesaikan
								<?php endif ?>
								<?php if ($value->status==4): ?>
								Kasus Dibatalkan
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
				<?php if ($this->session->userdata('level')==1): ?>
					<div class="card-body">
						<h5 class="card-title">Kelolah Kasus</h5>
					    <p class="card-text">Memilih pengacara yang akan bertanggung jawab ke kasus ini</p>
					 </div>
					 <div class="card-footer">
					 	<a href="#" class="btn btn-warning" id="select_pilihPengacara">Kelolah</a>
					 </div>
				<?php endif ?>
				<?php if ($this->session->userdata('level')==2): ?>
					<?php if ($value->status==4): ?>
						<div style="opacity: 80%;display: block;">
							<div class="card-body">
								<h5 class="card-title">Kelolah Kasus</h5>
							    <p class="card-text">Menentukan jadwal jumpa dan mengisi infromasi tambahan</p>
							</div>
							<div class="card-footer">
							 	<button disabled class="btn btn-warning" id="select_pilihPengacara">Kelolah</button>
							</div>
						</div>
					<?php endif ?>
					<?php if ($value->status!=4): ?>
						<div>
							<div class="card-body">
								<h5 class="card-title">Kelolah Kasus</h5>
							    <p class="card-text">Menentukan jadwal jumpa dan mengisi infromasi tambahan</p>
							</div>
							<div class="card-footer">
							 	<button class="btn btn-warning" id="kelolah_tanggal">Kelolah</button>
							</div>
						</div>
					<?php endif ?>
				<?php endif ?>
			</div>
		</div>
		<div class="col-12 col-md-6">
			<div class="card text-center" style="margin-bottom: 10px;height: 200px;">
				<div class="card-body">
					<h5 class="card-title">Status Masalah</h5>
				    <p class="card-text">Mengganti status Masalah.</p>
				    
				 </div>
				 <div class="card-footer">
				    <a href="#" class="btn
				    <?php if ($value->status==0 || $value->status==4): ?>
				    	btn-success
				    <?php endif ?>
				    <?php if ($value->status!=0): ?>
				    	btn-danger
				    <?php endif ?>
				    " id="status_masalah">
				    	<?php if ($value->status==1): ?>
				    		Tolak Kasus
				    	<?php endif ?>
				    	<?php if ($value->status==2): ?>
				    		Tutup Kasus
				    	<?php endif ?>
				    	<?php if ($value->status==0 || $value->status==4): ?>
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

    function loadPageKasusBerjalan(page){
        loadTime();
        $('#contentModal').load('<?php echo base_url('Admin/')?>' + page,function() {
            $('#loading').hide();
            $('#contentModal').removeClass('lodtime');
        });
    }

    $('#kelolah_tanggal').click(function(event) {
    	event.preventDefault();
    	loadPageKasusBerjalan('kelolahTanggal?id=<?php echo $value->id_masalah ?>');
    });

	$('#select_pilihPengacara').click(function(event) {
        event.preventDefault();
        loadPageKasusBerjalan('select_pilihPengacaraBerjalan?id=<?php echo $id ?>');
    });

    $('#status_masalah').click(function(event) {
        event.preventDefault();
        Swal.fire({
		title: 'Apakah anda ingin mengganti status kasus ini?',
		text: "Perubahan tidak dapat diundurkan!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Ya, saya yakin!!',
		cancelButtonText: 'Mungkin tidak'
		}).then((result) => {
			if (result.value) {
				var branch = 0;
			    $.ajax({
		        	url: '<?php echo base_url('admin/select_statusMasalah') ?>',
		        	type: 'POST',
		        	data: {id: '<?php echo $id ?>'},
		        	success: function(event){
		        		if (event==1) {
		        			Swal.fire('Berhasil', "Status kasus berhasil diganti !!!", 'success');
		        			$('#loading').show();
							$('#contentPage').addClass('lodtime',function() {
						        $('#contentPage').removeClass('lodtime');
						    });   
						  	<?php if ($this->session->userdata('level')==1): ?>
						  		$('#contentPage').load("<?php 
						  				$stat = $value->status;
						  				echo base_url('Admin/daftarMasalah?tipe=');
						  				echo $stat;
						  			?>",function() {
						        	$('#loading').hide();
						        	$('#contentPage').removeClass('lodtime');
						        	$('#modalKelolah').modal('hide');
						    	}); 
						  	<?php endif ?>
						  	<?php if ($this->session->userdata('level')==2): ?>
						  		<?php 
						  		if ($value->status==2) {
						  			$stat = 22;
						  		} 
						  		elseif ($value->status==3) {
						  			$stat = 33;
						  		} 
						  		else{
						  			$stat = 44;
						  		}
						  		?>
						  		$('#contentPage').load("<?php 
						  				echo base_url('Admin/daftarMasalah?tipe=');
						  				echo $stat;
						  			?>",function() {
						        	$('#loading').hide();
						        	$('#contentPage').removeClass('lodtime');
						        	$('#modalKelolah').modal('hide');
						    	}); 
						  	<?php endif ?>
		        			$('#modalKelolah').modal('hide');
		        		}
		        		else{
		        			Swal.fire('Kesalahan', "Status kasus gagal diganti !!!", 'error');
		        		}
		        	},
		        	error: function(err){
		        		console.log(err);
		        		Swal.fire('Error', "Mengembalikan error : " + JSON.stringify(err) + " , tolong hubungi administrator untuk info lebih lanjut", 'error');
		        	}
		        });
			}
			else{
			}
		})
    });

    
</script>