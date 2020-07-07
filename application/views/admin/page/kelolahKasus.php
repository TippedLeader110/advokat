<?php foreach ($info as $key => $value): ?>
<?php endforeach ?>
<div class="page">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-12">
				<h4>Kelolah Kasus</h5>
					<button id="back" class="btn btn-outline-warning" style="margin-bottom: 15px">Kembali</button>
				<h3><?php echo $value->deskripsi ?></h5>
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
								Kasus Dibatalkan
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
						<?php if ($berkas==false): ?>
							<button id="tambahDokumen" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;Tambah</button>
						<?php endif ?>
						<?php if ($berkas==true): ?>
							<?php foreach ($berkas as $key => $Bvalue): ?>
							
							<?php endforeach ?>
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<hr>
				<button class="btn btn-success">Kasus Selesai</button>&nbsp;<button class="btn btn-danger">Tutup Kasus</button>
			</div>
		</div>
	</div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modalTG">
  	<div class="modal-dialog modal-lg" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h4 class="modal-title">Kelolah Kasus</h4>
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
	$('#back').click(function(event) {
		$('#contentPage').load('<?php echo base_url('admin/daftarKasus') ?>', function() {
			$('#loading').hide();
			$('#contentPage').removeClass('lodtime');
		});
	});

	$('#tambahDokumen').click(function(event) {
		event.preventDefault();
		$('.modal-body').load('<?php echo base_url('admin/select_tambahDokumen?id='); echo $value->id_masalah; ?>');
		$('#modalTG').modal('show');
	});	

	$('#tgPekerjaan').click(function(event) {
		event.preventDefault();
		$('.modal-body').load('<?php echo base_url('admin/select_editPekerjaan?id='); echo $value->id_masalah; ?>');
		$('#modalTG').modal('show');
	});

	$('#tgTmptLahir').click(function(event) {
		event.preventDefault();
		$('.modal-body').load('<?php echo base_url('admin/select_editTempatLahir?id='); echo $value->id_masalah; ?>');
		$('#modalTG').modal('show');
	});

	$('#tgTglLahir').click(function(event) {
		event.preventDefault();
		$('.modal-body').load('<?php echo base_url('admin/select_editTanggalLahir?id='); echo $value->id_masalah; ?>');
		$('#modalTG').modal('show');
	});
</script>