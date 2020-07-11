<?php foreach ($info as $key => $value): ?>
<?php endforeach ?>
<div class="page">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-12">
				<h3>Kelola Kasus</h3>
					<button id="back" class="btn btn-outline-warning" style="margin-bottom: 15px">Kembali</button>
				<h5><?php echo $value->deskripsi ?></h5>
				<hr>
				<b>Informasi Dasar</b>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="table-responsive">
					<table class="table table-borderless">
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
								Tanggal Jumpa
							</td>
							<td>
								: &nbsp;
							</td>
							<td>
								<?php echo $value->tanggal_jumpa ?>	&nbsp;<a href="#" id="tgTanggalJumpa" style="color: blue">[ganti]</a>
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
								Pengacara Bertangung Jawab
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
								Kasus Ditutup
								<?php endif ?>
							</td>
						</tr>
						<tr>
							<td>
								Tempat Lahir
							</td>
							<td>
								: &nbsp;
							</td>
							<td>
								<?php echo $value->tempat_lahir ?>&nbsp;<a href="#" id="tgTmptLahir" style="color: blue">[tambah/ganti]</a>
							</td>
						</tr>
						<tr>
							<td>
								Tanggal Lahir
							</td>
							<td>
								: &nbsp;
							</td>
							<td>
								<?php echo $value->tanggal_lahir ?>&nbsp;<a href="#" id="tgTglLahir" style="color: blue">[tambah/ganti]</a>
							</td>
						</tr>
						<tr>
							<td>
								Pekerjaan
							</td>
							<td>
								: &nbsp;
							</td>
							<td>
								<?php echo $value->pekerjaan ?>&nbsp;<a href="#" id="tgPekerjaan" style="color: blue">[tambah/ganti]</a>
							</td>
						</tr>
					</table>
				</div>
				<hr>
				<b>Dokumen Pendukung</b>
				<hr>
				<div class="table-responsive">
					<div class="table table-borderless">
						<?php if ($berkas==true): ?>
								<div class="table-responsive">
									<table class="table table-borderless">
										<?php foreach ($berkasArray as $key => $Bvalue): ?>
											<tr>
												<td>
													<?php echo $Bvalue->nama_berkas ?>
												</td>
												<td>:</td>
												<td>
													<a target="_blank" href="<?php echo base_url('public/kasus/berkas/'); echo $Bvalue->file ?>" style="color: blue">Link Berkas</a>
													&nbsp;/&nbsp;
													<a style="color: blue" onclick="delBerkas(<?php echo $Bvalue->id_berkas ?>)">Hapus Berkas</a>
												</td>
											</tr>
										<?php endforeach ?>
									</table>
								</div>
						<?php endif ?>
						<button id="tambahDokumen" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;Tambah</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<hr>
				<?php if ($value->status!=3): ?>
					<button class="btn btn-success" id="selesai">Kasus Selesai</button>&nbsp;
				<?php endif ?>
				<?php if ($value->status!=4): ?>
					<button class="btn btn-danger" id="tutup">Tutup Kasus</button>&nbsp;
				<?php endif ?>
				<?php if ($value->status==4 || $value->status==3 ): ?>
					<button class="btn btn-primary" id="buka">Buka Kasus</button>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modalTG">
  	<div class="modal-dialog modal-lg" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h4 class="modal-title">Kelola Kasus</h4>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body">
        		
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      		</div>
    	</div>
  	</div>
</div>

<script type="text/javascript">
	function delBerkas(id)
	{
		Swal.fire({
		title: 'Apakah anda ingin menghapus berkas ini?',
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
			    	url: '<?php echo base_url('admin/hapusDokumen') ?>',
			    	type: 'post',
			    	data:{id  :  id},
			    	success: function(er){
			    		if (er==1) {
							console.log(er);
							Swal.fire({
						      title : 'Sukses !',
						      text : 'Berkas berhasil dihapus!!.',
						      icon : 'success',
						      timer: 2000,
  							  timerProgressBar: true
						    }).then((result) => {
						    	$('#loading').show();
							    $('#contentPage').addClass('lodtime',function() {
						        });   
						  		$('#contentPage').load('<?php echo base_url('admin/kelolaKasus?id='); echo $value->id_masalah; ?>',function() {
						            $('#loading').hide();
						            $('#contentPage').removeClass('lodtime');
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
	}

	$('#back').click(function(event) {
		$('#contentPage').load('<?php echo base_url('admin/daftarKasus') ?>', function() {
			$('#loading').hide();
			$('#contentPage').removeClass('lodtime');
		});
	});

	$('#tambahDokumen').click(function(event) {
		event.preventDefault();
		$('.modal-body').load('<?php echo base_url('admin/modal_tambahDokumen?id='); echo $value->id_masalah; ?>');
		$('#modalTG').modal('show');
	});	

	$('#tgTanggalJumpa').click(function(event) {
    	event.preventDefault();
    	$('.modal-body').load('admin/editTanggal?id=<?php echo $value->id_masalah ?>');
    	$('#modalTG').modal('show');
    });	

	$('#tgPekerjaan').click(function(event) {
		event.preventDefault();
		$('.modal-body').load('<?php echo base_url('admin/modal_editPekerjaan?id='); echo $value->id_masalah; ?>');
		$('#modalTG').modal('show');
	});

	$('#tgTmptLahir').click(function(event) {
		event.preventDefault();
		$('.modal-body').load('<?php echo base_url('admin/modal_editTempatLahir?id='); echo $value->id_masalah; ?>');
		$('#modalTG').modal('show');
	});

	$('#tgTglLahir').click(function(event) {
		event.preventDefault();
		$('.modal-body').load('<?php echo base_url('admin/modal_editTanggalLahir?id='); echo $value->id_masalah; ?>');
		$('#modalTG').modal('show');
	});

	$('#selesai').click(function(event) {
		event.preventDefault();
		Swal.fire({
		title: 'Apakah anda ingin menyelesaikan kasus ini?',
		text: "Status kasus akan berubah !!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Ya, saya yakin!!',
		cancelButtonText: 'Mungkin tidak'
		}).then((result) => {
			if (result.value) {
			    $.ajax({
			    	url: '<?php echo base_url('admin/statusKasus?stat=3') ?>',
			    	type: 'post',
			    	data:{id  :  <?php echo $value->id_masalah ?>},
			    	success: function(er){
			    		if (er==1) {
							console.log(er);
							Swal.fire({
						      title : 'Sukses !',
						      text : 'Kasus sudah selesai!!.',
						      icon : 'success',
						      timer: 2000,
  							  timerProgressBar: true
						    }).then((result) => {
						    	$('#loading').show();
							    $('#contentPage').addClass('lodtime',function() {
						        });   
						  		$('#contentPage').load('<?php echo base_url('admin/kelolaKasus?id='); echo $value->id_masalah; ?>',function() {
						            $('#loading').hide();
						            $('#contentPage').removeClass('lodtime');
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

	$('#tutup').click(function(event) {
		event.preventDefault();
		Swal.fire({
		title: 'Apakah anda ingin menutup kasus ini?',
		text: "Status kasus akan berubah !!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Ya, saya yakin!!',
		cancelButtonText: 'Mungkin tidak'
		}).then((result) => {
			if (result.value) {
			    $.ajax({
			    	url: '<?php echo base_url('admin/statusKasus?stat=4') ?>',
			    	type: 'post',
			    	data:{id  :  <?php echo $value->id_masalah ?>},
			    	success: function(er){
			    		if (er==1) {
							console.log(er);
							Swal.fire({
						      title : 'Sukses !',
						      text : 'Kasus ditutup!!.',
						      icon : 'success',
						      timer: 2000,
  							  timerProgressBar: true
						    }).then((result) => {
						    	$('#loading').show();
							    $('#contentPage').addClass('lodtime',function() {
						        });   
						  		$('#contentPage').load('<?php echo base_url('admin/kelolaKasus?id='); echo $value->id_masalah; ?>',function() {
						            $('#loading').hide();
						            $('#contentPage').removeClass('lodtime');
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

	$('#buka').click(function(event) {
		event.preventDefault();
		Swal.fire({
		title: 'Apakah anda ingin membuka kembali kasus ini?',
		text: "Status kasus akan berubah !!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Ya, saya yakin!!',
		cancelButtonText: 'Mungkin tidak'
		}).then((result) => {
			if (result.value) {
			    $.ajax({
			    	url: '<?php echo base_url('admin/statusKasus?stat=2') ?>',
			    	type: 'post',
			    	data:{id  :  <?php echo $value->id_masalah ?>},
			    	success: function(er){
			    		if (er==1) {
							console.log(er);
							Swal.fire({
						      title : 'Sukses !',
						      text : 'Kasus dibuka kembail!!.',
						      icon : 'success',
						      timer: 2000,
  							  timerProgressBar: true
						    }).then((result) => {
						    	$('#loading').show();
							    $('#contentPage').addClass('lodtime',function() {
						        });   
						  		$('#contentPage').load('<?php echo base_url('admin/kelolaKasus?id='); echo $value->id_masalah; ?>',function() {
						            $('#loading').hide();
						            $('#contentPage').removeClass('lodtime');
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