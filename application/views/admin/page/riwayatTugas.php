<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<h5>Dashboard Admin | Kantor Advokat/Pengacara</h5>
			<hr>
			<h6>Riwayat Tugas Pengacara</h6>
			<hr>
		</div>
	</div>
	<div class="row" style="margin-top: 0px;">
		<div class="col-12 col-md-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="tablePengacara">
					<thead>
						<th>#</th>
						<th>Nama</th>
						<th>Email</th>
						<th>NoHP</th>
						<th>Status</th>
						<th></th>
					</thead>
					<tbody>
						<?php $count = 1 ?>
						<?php foreach ($daftarPengacara as $key => $value): ?>
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
									<button class="btn btn-success" value="<?php echo $value->id ?>" id="kelola">Riwayat</button>		
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
        		<h4 class="modal-title">Riwayat Pengacara</h4>
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

	function kelola(id,status){
		// console.log(stat);
		$('.modal-body').load('<?php echo base_url('admin/modal_kelolaPengacara?id=') ?>' + id + '&status='+status);
		$('#modalKelola').modal('hide');
		$('.modal-backdrop').remove();
						$('body').removeClass('modal-open');
	}

	$('#kelola').click(function(event) {
		event.preventDefault();
		var id = $(this).val();
		// console.log(stat);
		$('.modal-body').load('<?php echo base_url('admin/modal_riwayatTugas?id=') ?>' + id);
		$('#modalKelola').modal('hide');
		$('.modal-backdrop').remove();
						$('body').removeClass('modal-open');
	});

</script>