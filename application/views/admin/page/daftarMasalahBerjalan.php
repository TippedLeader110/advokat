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
								</td>
								<td><?php echo $value->nama; ?> (<?php echo $value->ktp; ?>)</td>
								<td>
									<button class="btn btn-primary" onclick="kelola(<?php echo $value->id_masalah ?>)">Kelola</button>
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
        		<h4 class="modal-title">Kelola Masalah</h4>
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

	// $('#kelola').click(function(event) {
	// 	event.preventDefault();
	// 	var id = $(this).val();
	// 	var stri = '#status'+id;
	// 	var stat = $(stri).val();
	// 	// console.log(stat);
	// 	$('.modal-body').load('<?php echo base_url('admin/modal_kelolaPengacara?id=') ?>' + id + '&status='+stat);
	// 	$('#modalKelola').modal('hide');
	// });

	$('#kembali').click(function(event) {
		event.preventDefault();
		$('#loading').show();
		$('#contentPage').addClass('lodtime');
		$('#contentPage').load('<?php echo base_url('admin/pilihMasalah') ?>', function(){
			$('#loading').hide();
			$('#contentPage').removeClass('lodtime');
		});
	});
</script>