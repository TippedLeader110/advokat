<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<h5>Dashboard Admin | Kantor Advokat/Pengacara</h5>
			<hr>
			<h6>Laporan Singkat</h6>
			<hr>
		</div>
	</div>
	<div class="row" style="margin-top: 0px;">
		

	<div class="col-12 col-md-4">
		<div class="card text-white bg-info mb-3" style="max-width: 18rem;">
		    <div class="card-header text-capitalize text-center">Total Masalah</div>
		  	<div class="card-body">
		  		<div>
		    		<h1 class="card-title text-center">
						
		    		</h1>
	    		</div>
	  		</div>
		</div>
	</div>
	<div class="col-12 col-md-4">
		<div class="card text-white bg-info mb-3" style="max-width: 18rem;">
	  	<div class="card-header text-capitalize text-center">Total Pengacara</div>
	  		<div class="card-body">
	  			<div>
	    			<h1 class="card-title text-center">
						
	    			</h1>
	    		</div>
	  		</div>
		</div>
	</div>
	<div class="col-12 col-md-4">
		<div class="card text-white bg-info mb-3" style="max-width: 18rem;">
	  	<div class="card-header text-capitalize text-center">Masalah belum di cek </div>
	  		<div class="card-body">
	  			<div>
	    			<h1 class="card-title text-center">
						
	    			</h1>
	    		</div>
	  		</div>
		</div>
	</div>
	<div class="col-12 col-md-4">
		<div class="card text-white bg-success mb-3" style="max-width: 18rem;">
	  	<div class="card-header text-capitalize text-center">Masalah diterima</div>
	  		<div class="card-body">
	  			<div>
	    			<h1 class="card-title text-center">
						
	    			</h1>
	    		</div>
	  		</div>
		</div>
	</div>
	<div class="col-12 col-md-4">
		<div class="card text-white bg-success mb-3" style="max-width: 18rem;">
	  	<div class="card-header text-capitalize text-center">Pengacara yang tersedia</div>
	  		<div class="card-body">
	  			<div>
	    			<h1 class="card-title text-center">
						
	    			</h1>
	    		</div>
	  		</div>
		</div>
	</div>
	<div class="col-12 col-md-4">
		<div class="card text-white bg-success mb-3" style="max-width: 18rem;">
	  	<div class="card-header text-capitalize text-center">Masalah selesai</div>
	  		<div class="card-body">
	  			<div>
	    			<h1 class="card-title text-center">
						
	    			</h1>
	    		</div>
	  		</div>
		</div>
	</div>
	<div class="col-12 col-md-4">
		<div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
	  	<div class="card-header text-capitalize text-center">Masalah berjalan</div>
	  		<div class="card-body">
	  			<div>
	    			<h1 class="card-title text-center">
						
	    			</h1>
	    		</div>
	  		</div>
		</div>
	</div>
	
	<div class="col-12 col-md-4">
		<div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
	  	<div class="card-header text-capitalize text-center">Masalah berhenti</div>
	  		<div class="card-body">
	  			<div>
	    			<h1 class="card-title text-center">
						
	    			</h1>
	    		</div>
	  		</div>
		</div>
	</div>
	<div class="col-12 col-md-4">
		<div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
	  	<div class="card-header text-capitalize text-center">Pengacara cuti</div>
	  		<div class="card-body">
	  			<div>
	    			<h1 class="card-title text-center">

	    			</h1>
	    		</div>
	  		</div>
		</div>
	</div>
	</div>
	<div class="row">
		<div class="col-12 col-md-12">
			<div>
				<h6>Jenis Kompetisi</h6>
				<hr>
			</div>
		</div>
		<div class="col-12">
			<div class="table-responsive">
				<table class="table table-active table-hover">
					<thead class="bg-custom text-white">
						<tr>
							<th>#</th><th>Nama Kompetisi</th><th>Jumlah Tim</th>
						</tr>
					</thead>
					<?php $count = 0 ?>
					<?php foreach ($reTahapkompe as $key => $Dtable): ?>
						<?php $count++; ?>
						<tr>
							<td><?php echo $count ?></td>
							<td><?php echo $Dtable->nama_lomba ?></td>
							<td><?php echo $Dtable->jumlah_tim ?></td>
						</tr>			
					<?php endforeach ?>
				</table>
			</div>
		</div>
	</div>
	</div>