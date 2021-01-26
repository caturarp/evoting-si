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
									<li role="presentation"><a href="<?php echo base_url() ?>admin/kelola/kandidat/?hima">Himpunan Mahasiswa</a></li>
									<li role="presentation" class="active"><a href="<?php echo base_url() ?>admin/kelola/kandidat/?blj">Badan Legislatif Jurusan</a></li>
								</ul>
								<br/>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<!-- Button trigger modal -->
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
								  	<i class="fas fa-plus-circle"></i> Tambah Kandidat
								</button>
								<br/><br/>

								<!-- Modal -->
								<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  	<div class="modal-dialog" role="document">
								  		<form action="" method="post">
								    	<div class="modal-content">
									      	<div class="modal-header">
									        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									        	<h4 class="modal-title" id="myModalLabel">Tambah Kandidat BLJ</h4>
									      	</div>
									      	<div class="modal-body">
									        	<div class="form-group">
									        		<label>ID</label>
									        		<input type="text" name="kb_id" class="form-control">
									        	</div>
									        	<div class="form-group">
									        		<label>Nama Team</label>
									        		<input type="text" name="kb_nama" class="form-control">
									        	</div>
									        	<div class="form-group">
									        		<label>Visi</label>
									        		<textarea name="kb_visi" id="kb_visi" class="form-control" maxlength="1024" required></textarea>
		        									<script>CKEDITOR.replace('kb_visi');</script>
									        	</div>
									        	<div class="form-group">
									        		<label>Misi</label>
									        		<textarea name="kb_misi" id="kb_misi" class="form-control" maxlength="1024" required></textarea>
		        									<script>CKEDITOR.replace('kb_misi');</script>
									        	</div>
									      	</div>
									      	<div class="modal-footer">
									        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									        	<input type="submit" name="btn_tambahkandidat" class="btn btn-success" value="Simpan">
									      	</div>
								    	</div>
								    	</form>
								  	</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="input-group">
      								<input type="text" class="form-control" placeholder="Search for..." id="textsearch" onkeyup="mahasiswa_search();">
      								<span class="input-group-btn">
    									<button class="btn btn-default" type="button"><i class="fas fa-search"></i></button>
      								</span>
    							</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<table class="table table-hover">
									<thead>
										<tr>
											<th>No</th>
											<th>ID</th>
											<th>Nama Team</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$no=0;
											foreach($blj as $row){
												$no++;
										?>
										<tr>
											<td><?php echo $no ?></td>
											<td><?php echo $row->KB_ID ?></td>
											<td><?php echo $row->KB_NAMA ?></td>
											<td width="12%">
												<a href="<?php echo base_url() ?>admin/kelola/kandidat/?blj&kelola=<?php echo $row->KB_ID ?>" class="btn btn-success">Kelola</a>
											</td>
										</tr>
										<?php
											}
										?>
									</tbody>
								</table>
							</div>
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