<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/style.css">
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/fontawesome/css/all.css">
	<script type="text/javascript" src="<?php echo base_url() ?>assets/ckeditor/ckeditor.js"></script>
</head>
<body onload="mahasiswa_view_all();">
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
							<li role="presentation"><a href="<?php echo base_url() ?>admin/dashboard/index"><i class="fas fa-home"></i> Home</a></li>
							<li role="presentation"><a href="<?php echo base_url() ?>admin/kelola/mahasiswa"><i class="fas fa-users"></i> Kelola Mahasiswa</a></li>
							<li role="presentation"><a href="<?php echo base_url() ?>admin/kelola/kandidat"><i class="fas fa-user-friends"></i> Kelola Kandidat</a></li>
							<li role="presentation" class="active"><a href="<?php echo base_url() ?>admin/kelola/pemira"><i class="fas fa-chart-bar"></i> Pemira</a></li>

						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-body" style="min-height: 500px;">
						<div style="border-bottom: blue solid 2px; margin-bottom: 10px; font-size: 14pt;">
							<b><i class="fas fa-chart-bar"></i> Pemira > Hasil</b>
						</div>
						<div class="row">
							<div class="col-md-12">
								<a href="<?php echo base_url() ?>admin/kelola/pemira/"><i class="fas fa-chevron-left"></i> Kembali</a>
								<br/><br/>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<a href="<?php echo base_url() ?>admin/kelola/pemira/?hasil=<?php echo $this->input->get('hasil') ?>&cetak" class="btn btn-default form-control"><i class="fas fa-print"></i> Cetak Hasil</a><br/><br/>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-body">
										<table class="table">
											<?php
												foreach($pemira as $row){
													$pemira_angkatan = explode(",", $row->PEMIRA_ANGKATAN);
													$pemira_angkatan_join = join("','",$pemira_angkatan);
											?>
											<tr>
												<td>Pemira Id</td>
												<td>:</td>
												<td><?php echo $row->PEMIRA_ID ?></td>
											</tr>
											<tr>
												<td>Pemira Nama</td>
												<td>:</td>
												<td><?php echo $row->PEMIRA_NAMA ?></td>
											</tr>
											<tr>
												<td>Angkatan Pemilih</td>
												<td>:</td>
												<td><?php echo $row->PEMIRA_ANGKATAN ?></td>
											</tr>
											<?php
												}
											?>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<ul class="nav nav-tabs nav-justified">
									<li role="presentation"><a href="<?php echo base_url() ?>admin/kelola/pemira/?hasil=<?php echo $this->input->get('hasil')?>&hima">Himpunan Mahasiswa</a></li>
									<li role="presentation" class="active"><a href="<?php echo base_url() ?>admin/kelola/pemira/?hasil=<?php echo $this->input->get('hasil')?>&blj">Badan Legislatif Jurusan</a></li>
								</ul>
								<br/>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<ul class="nav nav-tabs nav-justified">
									<?php
										foreach($pemira as $row){
											$pemira_id = $row->PEMIRA_ID;
											$angkatan = explode(",", $row->PEMIRA_ANGKATAN);
											for($i=0;$i<count($angkatan);$i++){
										?>
										<li role="presentation"><a href="<?php echo base_url() ?>admin/kelola/pemira/?hasil=<?php echo $this->input->get('hasil')?>&blj&angkatan=<?php echo $angkatan[$i] ?>">Angkatan <?php echo $angkatan[$i]?></a></li>
										<?php
											}
										}
									?>
								</ul>
								<br/>
							</div>
						</div>
					</div>
				</div>
				<br/>
				<br/>
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