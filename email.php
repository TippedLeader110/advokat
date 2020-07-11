<div class="container" style="font-family:Arial, Helvetica, sans-serif; font-size:18px;">
	<div class="row">
		<div class="col align-self-center con border" style="margin-top: 25px;
		margin-bottom: 25px;
		padding: 20px 20px 20px 20px;
		">
			<p>Kepada, <span class="user" style="font-weight: 500;">'.$rowM->nama.'</span>!</p>
			<p>
				Permintaan bantuan kasus <b>'$rowM->deskripsi'</b> telah diterima dan akan diproses. Silahkan menghubungi pengacara yang bersangkutan berdasarkan data dibawah untuk perekaman data lebih lanjut<br>
			</p>
			<table>
				<tr>
					<td>Nama</td><td>:</td><td>'.$rowP->nama.' </td>
				</tr>
				<tr>
					<td>Nama</td><td>:</td><td>'.$rowP->email.' </td>
				</tr>
				<tr>
					<td>Nama</td><td>:</td><td>'.$rowP->nohp.' </td>
				</tr>
			</table>
			<p>
			<center>Jadwal Pemohon</center>
			<center>
				<table border="1">
					<tr>
						<th>ID pemohon</th><th>Nama Pemohon</th><th>Tanggal Jumpa</th><th>Kasus</th>
					</tr>
					<tr>
						<td>'.$id_masalah.'</td>
						<td>'.$rowM->nama.'</td>
						<td>'.$rowM->tanggal_jumpa.'</td>
						<td>'.$rowM->deskripsi.'</td>
					</tr>
				</table>
			</center>
			<p>Jika ada keluhan anda dapat menghubungi cs : emailperusahaan@gmail.com</p>
			<br>
			<p>
				Terima Kasih.
			</p>
			<br>
		</div>
	</div>
</div>