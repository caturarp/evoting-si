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
				<a class="navbar-brand" href="#">
					<?php
						foreach($namamahasiswa as $row){
							echo "EVOTING-SI (".$row->MAHASISWA_NAMA.")";
						}
					?>
				</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="<?php echo base_url() ?>public/login/logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container-fluid" style="margin-top: 60px;">
		<div class="row">
			<div class="col-md-12">
				<div style="border-bottom: solid blue 2px;">
					<center>
						<h3>Voting Calon Ketua dan Wakil Ketua HIMASIFO</h3>
					</center>
				</div>
				<br/>
			</div>
		</div>
		<?php
			foreach($himpunan as $row){
				$kh_id = $row->KH_ID;
		?>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<table width="100%" border="1">
							<tr>
								<td valign="top" width="20%">
									<br/>
									<?php
										$mahasiswa = $this->m_mahasiswa->voting_kh_view_kandidat($kh_id);
										foreach($mahasiswa->result() as $row1){
											$mahasiswa_npm = $row1->MAHASISWA_NPM;
									?>
									<center>
									<img style="width: 100px; border-radius: 100px; border: 2px solid black;" src="<?php echo base_url() ?>mahasiswa/voting/foto/hima/?kh_id=<?php echo $row->KH_ID ?>&mahasiswa_npm=<?php echo $row1->MAHASISWA_NPM ?>"><br/>
									<?php echo $row1->MAHASISWA_NAMA ?><br/>
									<?php
										if($row1->DKH_STATUS == "1"){
									?>
									<b><i>Calon Ketua Himpunan</i></b><br/><br/>
									<?php
										}
										else{
									?>
									<b><i>Calon Wakil Ketua Himpunan</i></b><br/><br/>
									<?php
										}
									?>
									</center>
									<?php
										}
									?>
									<!-- <img style="width: 150px; border-radius: 150px; border: 2px solid black;" src="<?php echo base_url() ?>admin/kelola/foto/hima/?kh_id=<?php echo $row->KH_ID ?>&mahasiswa_npm=<?php echo $row->MAHASISWA_NPM ?>"><br/><br/>
									<img style="width: 150px; border-radius: 150px; border: 2px solid black;" src="<?php echo base_url() ?>admin/kelola/foto/hima/?kh_id=<?php echo $row->KH_ID ?>&mahasiswa_npm=<?php echo $row->MAHASISWA_NPM ?>"><br/><br/> -->
								</td>
								<td valign="top" width="60%" style="padding: 10px;">
									<b>VISI:</b><br/>
									<?php
										echo $row->KH_VISI;
									?>
									<br/>
									<b>MISI:</b><br/>
									<?php
										echo $row->KH_MISI;
									?>
								</td>
								<td valign="center">
									<center>
										<a href="<?php echo base_url() ?>mahasiswa/voting/?pilihhima=<?php echo $kh_id ?>" class="btn btn-success btn-lg">PILIH</a>
									</center>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		<?php
			}
		?>
	</div>
	<br/>
	<br/>
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