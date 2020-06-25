<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<h5>Dashboard Admin | Kantor Advokat/Pengacara</h5>
			<hr>
			<h6>Daftar Pengacara</h6>
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
									<?php if ($value->status==2): ?>
										Tidak Aktif
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

<script type="text/javascript">
	$(document).ready(function () {
		$('#tablePengacara').DataTable();
		$('.dataTables_length').addClass('bs-select');
	});
</script>