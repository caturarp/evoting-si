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
				<a class="navbar-brand" href="#">EVOTING-SI</a>
			</div>
		</div>
	</nav>
	<div class="container" style="margin-top: 40px;">
		<div class="row">
			<div class="col-md-12">
				<center>
					<h3>EVOTING-SI</h3>
				</center>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<form action="" method="post">
						<div class="form-group">
							<label>User Id</label>
							<input type="text" name="user_id" class="form-control">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="user_password" class="form-control">
						</div>
						<div class="form-group">
							<input type="submit" name="btn_login" class="btn btn-success form-control" value="Masuk">
						</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				
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