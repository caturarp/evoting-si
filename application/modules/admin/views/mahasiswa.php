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
<body onload="mahasiswa_view_all();">
	<div id="notifications">
        <?php
            echo $this->session->flashdata('msg');
        ?>
    </div>
    <script>   
        $('#notifications').slideDown('slow').delay(3000).slideUp('slow');
    </script>

    <form action="" method="post" enctype="multipart/form-data">
    <div class="modal fade bs-example-modal-sm" id="modalupload" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Upload Excel</h4>
				</div>
				<div class="modal-body">
					<input type="file" name="uploadexcel" accept=".xls">
					<br/>
					<center>
						<a href="<?php echo base_url('assets/template_pemira.xls') ?>" target="_blank">Download Template</a>
					</center>
				</div>
				<div class="modal-footer">
					<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
					<input type="submit" class="btn btn-success" name="btn_upload" value="Upload Excel"></button>
				</div>
			</div>
		</div>
	</div>
	</form>

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
							<li role="presentation" class="active"><a href="<?php echo base_url() ?>admin/kelola/mahasiswa"><i class="fas fa-users"></i> Kelola Mahasiswa</a></li>
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
							<b><i class="fas fa-users"></i> Kelola Mahasiswa</b>
						</div>
						<div class="row">
							<div class="col-md-12">
								<!-- Button trigger modal -->
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
								  	<i class="fas fa-plus-circle"></i> Tambah Mahasiswa
								</button>
								<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalupload">
								  	Upload Excel (.xls)
								</button>
								<br/><br/>

								<!-- Modal -->
								<div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  	<div class="modal-dialog modal-sm" role="document">
								    	<div class="modal-content">
								      	<div class="modal-header">
								        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        	<h4 class="modal-title" id="myModalLabel">Tambah Mahasiswa</h4>
								      	</div>
								      	<div class="modal-body">
								        	<div class="form-group">
								        		<label>NPM</label>
								        		<input type="text" name="mahasiswa_npm" id="mahasiswa_npm" class="form-control">
								        	</div>
								        	<div class="form-group">
								        		<label>Nama</label>
								        		<input type="text" name="mahasiswa_nama" id="mahasiswa_nama" class="form-control">
								        	</div>
								        	<div class="form-group">
								        		<label>Status</label>
								        		<select name="mahasiswa_status" id="mahasiswa_status" class="form-control">
								        			<option>-- Pilih Status --</option>
								        			<option value="1">Aktif</option>
								        			<option value="0">Tidak Aktif</option>
								        		</select>
								        	</div>
								        	<div id="pesan"></div>
								      	</div>
								      	<div class="modal-footer">
								        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								        	<button type="button" class="btn btn-success" onclick="mahasiswa_insert();">Simpan</button>
								      	</div>
								    	</div>
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
											<th>NPM</th>
											<th>Nama Mahasiswa</th>
											<th>Status</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody id="listmahasiswa">
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
	<script type="text/javascript">
		function mahasiswa_view_all(){
			$.ajax({
		      	type: "POST",
		  		url: "<?php echo base_url() ?>admin/kelola/mahasiswa/?view_all",
		      	// data: {user_id : id, kuesioner_judul : judul, kuesioner_responden : jmlresponden, kuesioner_keterangan : keterangan, btn_tambahkuesioner : btn},
		      	dataType: "json",
		      	beforeSend: function(e) {
		              	if(e && e.overrideMimeType) {
		                  	e.overrideMimeType("application/json;charset=UTF-8");
		              	}
		          	},
		      	success: function(response){
		        	$("#listmahasiswa").html(response.list);
		      	}

		    });
		}
		function mahasiswa_search(){
			$.ajax({
		      	type: "POST",
		  		url: "<?php echo base_url() ?>admin/kelola/mahasiswa/?view_search",
		      	data: {search : $("#textsearch").val()},
		      	dataType: "json",
		      	beforeSend: function(e) {
		              	if(e && e.overrideMimeType) {
		                  	e.overrideMimeType("application/json;charset=UTF-8");
		              	}
		          	},
		      	success: function(response){
		      		//alert("oke");
		      		console.log($("#textsearch").val());
		        	$("#listmahasiswa").html(response.list);
		      	}

		    });
		}
		function mahasiswa_insert(){
			$.ajax({
		      	type: "POST",
		  		url: "<?php echo base_url() ?>admin/kelola/mahasiswa/?insert",
		      	data: {mahasiswa_npm : $("#mahasiswa_npm").val(), mahasiswa_nama : $("#mahasiswa_nama").val(), mahasiswa_status : $("#mahasiswa_status").val()},
		      	dataType: "json",
		      	beforeSend: function(e) {
		              	if(e && e.overrideMimeType) {
		                  	e.overrideMimeType("application/json;charset=UTF-8");
		              	}
		          	},
		      	success: function(response){
		        	mahasiswa_view_all();
		        	$("#pesan").html(response.pesan);
		        	$('#pesan').slideDown('slow').delay(3000).slideUp('slow');
		        	$("#mahasiswa_npm").val("");
		        	$("#mahasiswa_nama").val("");
		        	$("#mahasiswa_status").val("");
		        	$("#mahasiswa_npm").focus();
		      	}

		    });
		}
	</script>
</body>
</html>