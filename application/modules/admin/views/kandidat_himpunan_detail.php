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
							<li role="presentation"><a href="<?php echo base_url() ?>admin/dashboard/index"><i class="fas fa-home"></i> Home</a></li>
							<li role="presentation"><a href="<?php echo base_url() ?>admin/kelola/mahasiswa"><i class="fas fa-users"></i> Kelola Mahasiswa</a></li>
							<li role="presentation" class="active"><a href="<?php echo base_url() ?>admin/kelola/kandidat"><i class="fas fa-user-friends"></i> Kelola Kandidat</a></li>
							<li role="presentation"><a href="<?php echo base_url() ?>admin/kelola/pemira"><i class="fas fa-chart-bar"></i> Pemira</a></li>

						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-body" style="min-height: 500px;">
						<div style="border-bottom: blue solid 2px; margin-bottom: 10px; font-size: 14pt;">
							<b><i class="fas fa-user-friends"></i> Kelola Kandidat</b>
						</div>
						<div class="row">
							<div class="col-md-12">
								<ul class="nav nav-tabs nav-justified">
									<li role="presentation" class="active"><a href="<?php echo base_url() ?>admin/kelola/kandidat/?hima">Himpunan Mahasiswa</a></li>
									<li role="presentation"><a href="<?php echo base_url() ?>admin/kelola/kandidat/?blj">Badan Legislatif Jurusan</a></li>
								</ul>
								<br/>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<a href="<?php echo base_url() ?>admin/kelola/kandidat/?hima"><i class="fas fa-chevron-left"></i> Kembali</a>
								<br/><br/>
								<!-- Modal -->
								<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  	<div class="modal-dialog" role="document">
								  		<form action="" method="post">
								  		<?php
								  			foreach($himpunan as $row){
								  		?>
								    	<div class="modal-content">
									      	<div class="modal-header">
									        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									        	<h4 class="modal-title" id="myModalLabel">Edit Kandidat Himpunan</h4>
									      	</div>
									      	<div class="modal-body">
									        	<div class="form-group">
									        		<label>ID</label>
									        		<input type="text" name="kh_id" class="form-control" value="<?php echo $row->KH_ID ?>" readonly>
									        	</div>
									        	<div class="form-group">
									        		<label>Nama Team</label>
									        		<input type="text" name="kh_nama" value="<?php echo $row->KH_NAMA?>" class="form-control">
									        	</div>
									        	<div class="form-group">
									        		<label>Visi</label>
									        		<textarea name="kh_visi" id="kh_visi" class="form-control" maxlength="1024" required>
									        			<?php echo $row->KH_VISI ?>
									        		</textarea>
		        									<script>CKEDITOR.replace('kh_visi');</script>
									        	</div>
									        	<div class="form-group">
									        		<label>Misi</label>
									        		<textarea name="kh_misi" id="kh_misi" class="form-control" maxlength="1024" required>
									        			<?php echo $row->KH_MISI ?>
									        		</textarea>
		        									<script>CKEDITOR.replace('kh_misi');</script>
									        	</div>
									      	</div>
									      	<div class="modal-footer">
									        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									        	<input type="submit" name="btn_editkandidat" class="btn btn-success" value="Simpan">
									      	</div>
								    	</div>
								    	<?php
								    		}
								    	?>
								    	</form>
								  	</div>
								</div>
								<div class="panel panel-warning">
									<div class="panel-heading">
										<table width="100%">
											<tr>
												<td>Detail Kandidat</td>
												<td width="20%" style="text-align: right;">
													<button class="btn btn-warning" data-toggle="modal" data-target="#myModal"><i class="far fa-edit"></i></button>
												</td>
											</tr>
										</table>
									</div>
									<div class="panel-body">
										<table class="table">
											<?php
												foreach($himpunan as $row){
											?>
											<tr>
												<td width="20%">Id</td>
												<td width="5%">:</td>
												<td><?php echo $row->KH_ID?></td>
											</tr>
											<tr>
												<td>Nama Team</td>
												<td>:</td>
												<td><?php echo $row->KH_NAMA ?></td>
											</tr>
											<tr>
												<td valign="top">Visi</td>
												<td valign="top">:</td>
												<td valign="top"><?php echo $row->KH_VISI?></td>
											</tr>
											<tr>
												<td valign="top">Misi</td>
												<td valign="top">:</td>
												<td valign="top"><?php echo $row->KH_MISI?></td>
											</tr>
											<?php
												}
											?>
										</table>
									</div>
								</div>
								<br/>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1">
								  	<i class="fas fa-plus-circle"></i> Tambah Kandidat
								</button>
								<br/><br/>
								<!-- Modal -->
								<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  	<div class="modal-dialog" role="document">
								  		<form action="" method="post" enctype="multipart/form-data">
								    	<div class="modal-content">
									      	<div class="modal-header">
									        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									        	<h4 class="modal-title" id="myModalLabel">Tambah Kandidat Himpunan</h4>
									      	</div>
									      	<div class="modal-body">
									        	<div class="form-group">
									        		<label>NPM</label>
									        		<input type="text" name="mahasiswa_npm" id="mahasiswa_npm" onkeyup="view_mahasiswa();" class="form-control">
									        	</div>
									        	<div class="form-group">
									        		<label>Nama</label>
									        		<input type="text" name="mahasiswa_nama" id="mahasiswa_nama" class="form-control" readonly>
									        	</div>
									        	<div class="form-group">
									        		<label>Jabatan</label>
									        		<select name="dkh_status" class="form-control">
									        			<option>-- Pilih Jabatan --</option>
									        			<?php
									        				$kh = "tidak";
									        				$wkh = "tidak";
									        				foreach($detailhimpunan as $row){
									        					if($row->DKH_STATUS == "1"){
									        						$kh = "ya";
									        					}
									        					else{
									        						$wkh = "ya";
									        					}
									        				}
									        			?>
									        			<?php
									        				if($kh == "tidak"){
									        			?>
									        			<option value="1">Ketua Himpunan</option>
									        			<?php
									        				}
									        				if($wkh == "tidak"){
									        			?>
									        			<option value="2">Wakil Ketua Himpunan</option>
									        			<?php
									        				}
									        			?>
									        		</select>
									        	</div>
									        	<div class="form-group">
									        		<label>Foto</label>
									        		<input type="file" name="dkh_foto" accept="image/jpeg, image/png" class="form-control">
									        	</div>
									      	</div>
									      	<div class="modal-footer">
									        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									        	<input type="submit" name="btn_tambah" class="btn btn-success" value="Simpan">
									      	</div>
								    	</div>
								    	</form>
								  	</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div style="border-bottom: 2px blue solid; font-size: 14pt;">
									<center><b>Calon Ketua dan Wakil Ketua Himpunan</b></center>
								</div>
								<br/>
							</div>
						</div>
						<div class="row">
							<?php
								foreach($detailhimpunan as $row){
							?>
							<div class="col-md-6">
								<div class="panel panel-info">
									<div class="panel-heading">
										<table width="100%">
											<tr>
												<td>
													<?php
														if($row->DKH_STATUS == "1"){
															echo "Ketua Himpunan";
														}
														else{
															echo "Wakil Ketua Himpunan";
														}
													?>
												</td>
												<td width="20%" style="text-align: right;">
													<a href="<?php echo base_url() ?>admin/kelola/kandidat/?hima&kelola=<?php echo $this->input->get('kelola')?>&hapus=<?php echo $row->MAHASISWA_NPM ?>" class="btn btn-danger"><i class="fas fa-times"></i></a>
												</td>
											</tr>
										</table>
									</div>
									<div class="panel-body">
										<center>
											<img style="width: 150px; border-radius: 150px; border: 2px solid black;" src="<?php echo base_url() ?>admin/kelola/foto/hima/?kh_id=<?php echo $row->KH_ID ?>&mahasiswa_npm=<?php echo $row->MAHASISWA_NPM ?>"><br/><br/>
										</center>
										<table class="table">
											<tr>
												<td>NPM</td>
												<td>:</td>
												<td><?php echo $row->MAHASISWA_NPM ?></td>
											</tr>
											<tr>
												<td>Nama</td>
												<td>:</td>
												<td><?php echo $row->MAHASISWA_NAMA ?></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
							<?php
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br/><br/>
	<nav class="navbar navbar-default navbar-fixed-bottom">
		<div class="container">
			<div style="margin-top: 13px;">
				<center>
					&copy; <a href="https://mibnurizky.com" target="_blank">Mohamad Ibnu Rizky</a> | All Rights Reserved - 2018
				</center>
			</div>
		</div>
	</nav>
	<script type="text/javascript">
		function view_mahasiswa(){
			$.ajax({
		      	type: "POST",
		  		url: "<?php echo base_url() ?>admin/kelola/kandidat/?hima&carimhs",
		      	data: {mahasiswa_npm : $("#mahasiswa_npm").val()},
		      	dataType: "json",
		      	beforeSend: function(e) {
		              	if(e && e.overrideMimeType) {
		                  	e.overrideMimeType("application/json;charset=UTF-8");
		              	}
		          	},
		      	success: function(response){
		        	$("#mahasiswa_nama").val(response.nama);
		      	}

		    });
		}
	</script>
</body>
</html>