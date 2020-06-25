<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<h5>Dashboard Admin | Kantor Advokat/Pengacara</h5>
			<hr>
			<h6>Kelolah Pengacara</h6>
			<hr>
		</div>
	</div>
	<div class="row" style="margin-top: 0px;">
	<div class="col-12 col-md-4">
		<div class="card text-center" style="width: 18rem;margin-bottom: 10px">
			<div class="card-body">
				<h5 class="card-title">Tambah Pengacara</h5>
			    <p class="card-text">Menambah pengacara baru untuk menyesaikan masalah.</p>
			    <a href="#" class="btn btn-primary" id="tambahPengacara"><i class="fas fa-plus"></i>Tambah</a>
			 </div>
		</div>
	</div>
	<div class="col-12 col-md-4">
		<div class="card text-center" style="width: 18rem;margin-bottom: 10px">
			<div class="card-body">
				<h5 class="card-title">Aktif/Nonaktifkan Pengacara</h5>
			    <p class="card-text">Mengganti status pengacara.</p>
			    <a href="#" class="btn btn-success" id="statusPengacara">Ganti Status</a>
			 </div>
		</div>
	</div>
	<div class="col-12 col-md-4">
		<div class="card text-center" style="width: 18rem;margin-bottom: 10px">
			<div class="card-body">
				<h5 class="card-title">Hapus / Edit Pengacara</h5>
			    <p class="card-text">Mengganti atribut pengacara serta menghapus pengacara.</p>
			    <a href="#" class="btn btn-warning text-light" id="hapuseditPengacara">Hapus/Edit</a>
			 </div>
		</div>
	</div>
</div>

<script type="text/javascript">
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

	$('#tambahPengacara').click(function(event) {
        event.preventDefault();
        loadPage('tambahPengacara');
    });

    $('#statusPengacara').click(function(event) {
        event.preventDefault();
        loadPage('statusPengacara');
    });

    $('#hapuseditPengacara').click(function(event) {
        event.preventDefault();
        loadPage('hapuseditPengacara');
    });
</script>