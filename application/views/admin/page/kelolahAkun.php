<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<h5>Dashboard Admin | Kantor Advokat/Pengacara</h5>
			<hr>
			<h6>Kelolah Akun</h6>
			<hr>
		</div>
	</div>
	<div class="row" style="margin-top: 0px;">
		<div class="col-12 col-md-6">
			<div class="card text-center" style="margin-bottom: 10px">
				<div class="card-body">
					<h5 class="card-title">Tambah Akun Admin</h5>
				    <p class="card-text">Menambah akun admin baru untuk mengatur dan memonitor kerja sistem ini.</p>
				    <a href="#" class="btn btn-success" id="tambahAdm"><i class="fas fa-plus"></i>Tambah</a>
				 </div>
			</div>
		</div>
		<div class="col-12 col-md-6">
			<div class="card text-center" style="margin-bottom: 10px">
				<div class="card-body">
					<h5 class="card-title">Tambah Akun Direktur</h5>
				    <p class="card-text">Menambah akun direktur untuk mengelolah berkas dan jadwal masalah yang ada.</p>
				    <a href="#" class="btn btn-success" id="tambahDir"><i class="fas fa-plus"></i>Tambah</a>
				 </div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top: 30px;">
		<div class="col-12 col-md-12">
		<ul class="nav nav-tabs" id="myTab" role="tablist">
		    <li class="nav-item">
		    	<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Akun Admin</a>
		  	</li>
		  	<li class="nav-item">
		    	<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Akun Direktur</a>
		  	</li>
		</ul>
		<div class="tab-content" id="myTabContent">
		  	<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
		  		<div class="table-responsive-sm">
					<table id="adminTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead class="bg-custom text-white">
						<th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th></th>
						</thead>
						<tbody>
							<?php $count=0; ?>
							<?php foreach ($admin as $key => $ADvalue): ?>
								<?php $count++; ?>
								<tr>
									<td>
										<?php echo $count ?>
									</td>
									<td>
										<?php echo $ADvalue->nama ?>
									</td>
									<td>
										<?php echo $ADvalue->email ?>
									</td>
									<td><button class="btn btn-danger" id="hapusAdm" value="<?php echo $value->id ?>">Hapus</button></td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
		  	</div>
		  	<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
		  		<div class="table-responsive-sm">
					<table id="direkturTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead class="bg-custom text-white">
						<th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th></th>
						</thead>
						<tbody>
							<?php $count=0; ?>
							<?php foreach ($direktur as $key => $DIRvalue): ?>
								<?php $count++; ?>
								<tr>
									<td>
										<?php echo $count ?>
									</td>
									<td>
										<?php echo $DIRvalue->nama ?>
									</td>
									<td>
										<?php echo $DIRvalue->email ?>
									</td>
									<td><button class="btn btn-danger" value="<?php echo $DIRvalue->id ?>" id="hapusDir">Hapus</button></td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
		  	</div>
		  </div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		$('#adminTable').DataTable();
		$('.dataTables_length').addClass('bs-select');
		$('#direkturTable').DataTable();
		$('.dataTables_length').addClass('bs-select');
	});

	function loadTime(){
        $('#loading').show();
        $('#contentPage').addClass('lodtime',function() {
            $('#loading').hide();
            $('#contentPage').removeClass('lodtime');
        });   
    }

    function loadPage(page){
        loadTime();
        $('#contentPage').load('<?php echo base_url('Admin/')?>' + page,function() {
            $('#loading').hide();
            $('#contentPage').removeClass('lodtime');
        });
    }

	$('#tambahDir').click(function(event) {
        event.preventDefault();
        loadPage('tambahDirektur');
    });

    $('#tambahAdm').click(function(event) {
        event.preventDefault();
        loadPage('tambahAdmin');
    });
</script>