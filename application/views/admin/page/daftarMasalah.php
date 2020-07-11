<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<h5>Dashboard Admin | Kantor Advokat/Pengacara</h5>
			<hr>
			<h6>Daftar Kasus</h6>
			<hr>
		</div>
	</div>
	<div class="row" style="margin-top: 0px;">
		<div class="col-12 col-md-12">
			<button class="btn btn-warning" id="kembali">Kembali</button>
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="tablePengacara">
					<thead>
						<th>#</th>
						<th>Kasus</th>
						<th>Nama Pemohon</th>
						<th></th>
					</thead>
					<tbody>
						<?php $count = 1 ?>
						<?php foreach ($masalah as $key => $value): ?>
							<tr>
								<td><?php echo $count; $count++; ?></td>
								<td style="overflow: scroll;max-width: 500px;">
									<?php echo $value->deskripsi ?>
									<?php if ($value->status==1): ?>
										[<b>Belum Diterima</b>]
									<?php endif ?>
									<?php if ($value->status==2): ?>
										<?php if ($this->session->userdata('level')==2): ?>
											<?php if ($value->tanggal_jumpa==''): ?>
												[<b>Kasus Baru</b>]
											<?php endif ?>
										<?php endif ?>
										<?php if ($this->session->userdata('level')==1): ?>
											[<b>Kasus Diproses</b>]
										<?php endif ?>
									<?php endif ?>
									<?php if ($value->status==3): ?>
										[<b>Kasus Selesai</b>]
									<?php endif ?>
									<?php if ($value->status==4): ?>
										[<b>Kasus Dibatalkan</b>]
									<?php endif ?>
								</td>
								<td><?php echo $value->nama; ?> (<?php echo $value->ktp; ?>)</td>
								<td>
									<?php if ($tipe==1): ?>
										<button class="btn btn-primary" onclick="kelola(<?php echo $value->id_masalah ?>)">Kelola</button>
									<?php endif ?>
									<?php if ($tipe==2 || $tipe==4 || $tipe==3): ?>
										<button class="btn btn-primary" onclick="kelolaBerjalan(<?php echo $value->id_masalah ?>)">Kelola</button>
									<?php endif ?>
									<?php if ($tipe==22 || $tipe==44 || $tipe==33): ?>
										<button class="btn btn-primary" onclick="kelolaBerjalanSaya(<?php echo $value->id_masalah ?>)">Kelola</button>
									<?php endif ?>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>				
			</div>
		</div>
	</div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modalKelola">
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
	$(document).ready(function () {
		$('#tablePengacara').DataTable();
		$('.dataTables_length').addClass('bs-modal');
	});

	function kelola(id){
		// console.log(stat);
		$('.modal-body').load('<?php echo base_url('admin/modal_kelolaMasalah?id=') ?>' + id);
		$('#modalKelola').modal('show');
	}

	function kelolaBerjalan(id){
		// console.log(stat);
		$('.modal-body').load('<?php echo base_url('admin/modal_kelolaMasalahBerjalan?id=') ?>' + id);
		$('#modalKelola').modal('show');
	}

	function kelolaBerjalanSaya(id){
		// console.log(stat);
		$('.modal-body').load('<?php echo base_url('admin/modal_kelolaMasalahBerjalan?id=') ?>' + id);
		$('#modalKelola').modal('show');
	}

	// $('#kelola').click(function(event) {
	// 	event.preventDefault();
	// 	var id = $(this).val();
	// 	var stri = '#status'+id;
	// 	var stat = $(stri).val();
	// 	// console.log(stat);
	// 	$('.modal-body').load('<?php echo base_url('admin/modal_kelolaPengacara?id=') ?>' + id + '&status='+stat);
	// 	$('#modalKelola').modal('hide');
						// $('.modal-backdrop').remove();
						$('body').removeClass('modal-open');
	// });

	$('#kembali').click(function(event) {
		event.preventDefault();
		$('#loading').show();
		$('#contentPage').addClass('lodtime');
		$('#contentPage').load('<?php
		 								if ($this->session->userdata('level')==2) {
		 									echo base_url('admin/pilihMasalahSaya');
		 								}
		 								else{
		 									echo base_url('admin/pilihMasalah');
		 								}
		 						?>', function(){
			$('#loading').hide();
			$('#contentPage').removeClass('lodtime');
		});
	});
</script>