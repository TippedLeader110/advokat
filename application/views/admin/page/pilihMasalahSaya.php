<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<h5>Dashboard Admin | Kantor Advokat/Pengacara</h5>
			<hr>
			<h6>Masalah / Kasus dari pemohon</h6>
			<hr>
		</div>
	</div>
	<div class="row" style="margin-top: 0px;">
	<div class="col-12 col-md-4">
		<div class="card text-center" style="height: 270px;margin-bottom: 10px">
			<div class="card-body">
				<h5 class="card-title">Kasus Baru</h5>
			    <p class="card-text">Melihat daftar kasus yang baru diterima.</p>
			 </div>
			 <div class="card-footer">
			 	<a href="#" class="btn btn-primary" id="masalahBerjalan">Lihat</a>
			 </div>
		</div>
	</div>
	<div class="col-12 col-md-4">
		<div class="card text-center" style="height: 270px;margin-bottom: 10px">
			<div class="card-body">
				<h5 class="card-title">Kasus Berjalan</h5>
			    <p class="card-text">Melihat daftar kasus yang sedang dikerjakan.</p>
			 </div>
			 <div class="card-footer">
			 	<a href="#" class="btn btn-primary" id="kasusBerjalan">Lihat</a>
			 </div>
		</div>
	</div>
	<div class="col-12 col-md-4">
		<div class="card text-center" style="height: 270px;margin-bottom: 10px">
			<div class="card-body">
				<h5 class="card-title">Kasus Selesai</h5>
			    <p class="card-text">Melihat daftar kasus yang sudah selesai.</p>
			 </div>
			 <div class="card-footer">
			 	<a href="#" class="btn btn-primary text-light" id="riwayatMasalah">Lihat</a>
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

    $('#masalahBerjalan').click(function(event) {
        event.preventDefault();
        loadPage('daftarMasalah?tipe=22');
    });

    $('#riwayatMasalah').click(function(event) {
        event.preventDefault();
        loadPage('daftarMasalah?tipe=33');
    });

    $('#hapuseditPengacara').click(function(event) {
        event.preventDefault();
        loadPage('daftarPengacara');
    });

    $('#kasusBerjalan').click(function(event) {
        event.preventDefault();
    	loadPage('daftarKasus');
    });
</script>