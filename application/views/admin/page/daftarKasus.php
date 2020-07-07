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
						<th>Tanggal Jumpa</th>
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
										[<b>Sedang Berjalan</b>]
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
									<?php echo $value->tanggal_jumpa ?>
								</td>
								<td>
									<button class="btn btn-primary" onclick="kelolah(<?php echo $value->id_masalah ?>)">Kelolah</button>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>				
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		$('#tablePengacara').DataTable();
		$('.dataTables_length').addClass('bs-modal');
	});

	function kelolah(id){
		$('#loading').show();
		$('#contentPage').load('<?php echo base_url('admin/kelolahKasus?id=') ?>' + id, function() {
			$('#loading').hide();
			$('#contentPage').removeClass('lodtime');
		});
	}

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
