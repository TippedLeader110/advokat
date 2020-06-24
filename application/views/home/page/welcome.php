<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <h1>LOGO</h1>
        <h1 class="masthead-heading text-uppercase mb-0"> Advocat-Pengacara Ali Akbar Velayafi Siregar, SH</h1>
       	<!-- <p class="masthead-subheading font-weight-light mb-0" style="margin-top: 10px;"> TOMBOL</p> -->

    </div>

</header>

<section class="page-section" id="adu">

<div class="container">
    <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Kirim Pengaduan</h2>
    <div class="divider-custom">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
        <div class="divider-custom-line"></div>
    </div>
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <form id="aduForm" name="sentMessage" novalidate="novalidate">
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls mb-0 pb-2">
                        <label>Nama</label>
                        <input class="form-control" id="name" type="text" placeholder="Nama" required="required" data-validation-required-message="Tolong masukan nama." />
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls mb-0 pb-2">
                        <label>Alamat</label>
                        <input class="form-control" id="alamat" type="text" placeholder="Alamat" required="required" data-validation-required-message="Tolong masukan alamat." />
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls mb-0 pb-2">
                        <label>Nomor KTP</label>
                        <input class="form-control" id="ktp" type="tel" placeholder="Nomor KTP" required="required" data-validation-required-message="Tolong masukan NO KTP." />
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls mb-0 pb-2">
                        <label>Email</label>
                        <input class="form-control" id="email" type="email" placeholder="Alamat Email" required="required" data-validation-required-message="Tolong masukan email." />
                           <p class="help-block text-danger"></p>
                       </div>
                   </div>
                   <div class="control-group">
                       <div class="form-group floating-label-form-group controls mb-0 pb-2">
                           <label>Nomor HP</label>
                           <input class="form-control" id="phone" type="tel" placeholder="Nomor HP" required="required" data-validation-required-message="Tolong masukan nomor HP." />
                           <p class="help-block text-danger"></p>
                       </div>
                   </div>
                   <div class="control-group">
                       <div class="form-group floating-label-form-group controls mb-0 pb-2">
                           <label>Dekskripsi Aduan</label>
                           <textarea class="form-control" id="message" rows="5" placeholder="Deksripsi Aduan" required="required" data-validation-required-message="Tolong isi dekskirpsi aduan."></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <br />
                    <div id="success"></div>
                    <div class="form-group"><button class="btn btn-primary btn-xl" id="kirimAduan" type="submit">Kirim</button></div>
                </form>
            </div>
        </div>
    </div>
</section>
<section class="page-section bg-primary text-white mb-0" id="contact">
    <div class="container">
        <!-- About Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-white">Kontak</h2>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- About Section Content-->
        <div class="row">
            <div class="col-lg-7 offset-lg-3 text-justify">
            	<p class="lead text-justify" style="padding: 0;margin: 0">Alamat : Jalan Rotan Baru No.-C89, Petisah Tengah, Medan Petisah</p>
            	<p class="lead text-justify" style="padding: 0;margin: 0">Telpon : (061) 42012428 - Medan, 20112 INDONESIA</p>
            	<p class="lead text-justify" style="padding: 0;margin: 0">Email  : akbarvelayafisiregar@gmail.com</p>
            </div>
            <!-- <div class="col-lg-4 mr-auto"><p class="lead"></p></div> -->
            <!-- <div class="col-lg-12 ml-auto" ><p class="lead">
            	Alamat : Jalan Rotan Baru No.-C89, Petisah Tengah, Medan Petisah
            	Telpon : (061) 42012428 - Medan, 20112 INDONESIA
            	Email  : akbarvelayafisiregar@gmail.com
            </p></div> -->
        </div>
    </div>
</section>

<script type="text/javascript">
	// $('#kirimAduan').click(function(event) {
	// 	event.preventDefault();
	// 	// alert('klik');
	// 	$('#aduForm').submit();
	// });

	$('#aduForm').submit(function(event) {
		event.preventDefault();
		Swal.fire({
		title: 'Apakah anda yakin data sudah benar?',
		text: "Pengiriman tidak dapat diundurkan!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Ya, saya yakin!!',
		cancelButtonText: 'Mungkin tidak'
		}).then((result) => {
			if (result.value) {
			    $.ajax({
			    	url: '<?php echo base_url('home/tambahAduan') ?>',
			    	type: 'post',
			    	data:new FormData(this),
		            processData:false,
		            contentType:false,
		            cache:false,
		            async:false,
			    	success: function(er){
			    		if (er==1) {
							console.log(er);
							Swal.fire({
						      title : 'Terkirim !',
						      text : 'Aduan anda dengan id #'+ value +' telah berhasil direkam!!.',
						      icon : 'success',
						      timer: 2000,
  							  timerProgressBar: true
						    }).then((result) => {
						    	location.reload(true)
						    });
						}
						else{
							console.log(er);
							Swal.fire('Gagal','Terjadi kesalahan', 'error');
						}

			    		
			    	},
			    	error: function(er){
			    		Swal.fire('Gagal','Terjadi kesalahan', 'error');
			    	}
			    });
			}
			else{
			}
		})
	});
</script>