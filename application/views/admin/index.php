<!DOCTYPE html>
<html>
<head>
	<title>Notaris</title>
	<?php $this->load->view('template/headerAdmin') ?>
</head>
<body>

	<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <?php $this->load->view($sidebar) ?>
    </nav>

    <div id="content">
        <?php $this->load->view('template/navAdmin') ?>
        <div id="loading" style="position: absolute; top: 50%; left: 5%; height: 100%; width: 100%;">
            <center><img src='<?php echo base_url('assets/file/load.gif') ?>'/></center>
        </div>
        <div id="contentPage" class="shadow-sm p-3 mb-5 bg-white rounded " >
            
        </div>
    </div>
</div>
</body>

<script type="text/javascript" src="<?php echo base_url('/assets/js/popper.min.js') ?>"></script>
  <!-- Bootstrap core JavaScript -->
  <!-- MDB core JavaScript -->
<script type="text/javascript" src="<?php echo base_url('/assets/js/mdb.min.js') ?>"></script>
  <!-- Your custom scripts (optional) -->
<script type="text/javascript" src="<?php echo base_url('/assets/js/addons/datatables.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/admin.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/mmouse.js') ?>"></script>

<script type="text/javascript">
	$('#contentPage').load('<?php echo base_url('Admin/')?>laporanSingkat',function() {
            $('#loading').hide();
            $('#contentPage').removeClass('lodtime');
        });
</script>
</html>