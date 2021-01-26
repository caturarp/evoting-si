<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/style.css">
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/fontawesome/css/all.css">
</head>
<body>
	<div id="notifications">
        <?php
            echo $this->session->flashdata('msg');
        ?>
    </div>
    <script>   
        $('#notifications').slideDown('slow').delay(3000).slideUp('slow');
    </script>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">EVOTING-SI (Admin)</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="<?php echo base_url() ?>public/login/logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container" style="margin-top: 60px;">
		<div class="row">
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<div style="border-bottom: blue solid 2px; margin-bottom: 10px; font-size: 14pt;">
							<b><i class="fas fa-list-ul"></i> MENU</b>
						</div>
						<ul class="nav nav-pills nav-stacked">
							<li role="presentation" class="active"><a href="<?php echo base_url() ?>admin/dashboard/index"><i class="fas fa-home"></i> Home</a></li>
							<li role="presentation"><a href="<?php echo base_url() ?>admin/kelola/mahasiswa"><i class="fas fa-users"></i> Kelola Mahasiswa</a></li>
							<li role="presentation"><a href="<?php echo base_url() ?>admin/kelola/kandidat"><i class="fas fa-user-friends"></i> Kelola Kandidat</a></li>
							<li role="presentation"><a href="<?php echo base_url() ?>admin/kelola/pemira"><i class="fas fa-chart-bar"></i> Pemira</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-body" style="min-height: 500px;">
						<div style="border-bottom: blue solid 2px; margin-bottom: 10px; font-size: 14pt;">
							<b><i class="fas fa-home"></i> Home</b>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-default navbar-fixed-bottom">
		<div class="container">
			<div style="margin-top: 13px;">
				<center>
					&copy; <a href="https://mibnurizky.com" target="_blank">Mohamad Ibnu Rizky</a> | All Rights Reserved - 2018
				</center>
			</div>
		</div>
	</nav>
</body>
</html>