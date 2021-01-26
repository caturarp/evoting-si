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
												if($angkatan[$i] == $this->input->get('angkatan')){
									?>
									<li role="presentation" class="active"><a href="<?php echo base_url() ?>admin/kelola/pemira/?hasil=<?php echo $this->input->get('hasil')?>&blj&angkatan=<?php echo $angkatan[$i] ?>">Angkatan <?php echo $angkatan[$i]?></a></li>
									<?php
												}
												else{
									?>
									<li role="presentation"><a href="<?php echo base_url() ?>admin/kelola/pemira/?hasil=<?php echo $this->input->get('hasil')?>&blj&angkatan=<?php echo $angkatan[$i] ?>">Angkatan <?php echo $angkatan[$i]?></a></li>
									<?php
												}
											}
										}
									?>
								</ul>
								<br/>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<a href="<?php echo base_url() ?>admin/kelola/pemira/?hasil=<?php echo $this->input->get('hasil') ?>&blj&angkatan=<?php echo $this->input->get('angkatan')?>&cetakblj" class="btn btn-default form-control" target="_blank"><i class="fas fa-print"></i> Cetak Hasil</a><br/><br/>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<?php
									$angkatanpilih = $this->input->get('angkatan');
									$berhakmemilih = $this->db->query("SELECT COUNT(*) as jumlah FROM mahasiswa WHERE CONCAT('20',SUBSTR(MAHASISWA_NPM,1,2)) = '$angkatanpilih' AND MAHASISWA_STATUS = '1'");
									foreach($berhakmemilih->result() as $row){
										$jumlahberhakmemilih = $row->jumlah;
									}

									$mhsvotingblj = $this->db->query("SELECT COUNT(*) as jumlah FROM voting_blj, kandidat_blj WHERE voting_blj.KB_ID = kandidat_blj.KB_ID AND kandidat_blj.PEMIRA_ID = '$pemira_id' AND CONCAT('20',SUBSTR(voting_blj.MAHASISWA_NPM,1,2)) = '$angkatanpilih'");
									foreach($mhsvotingblj->result() as $row){
										$mhspemilih = $row->jumlah;
									}


									$i=0;
									$querymhs = $this->db->query("SELECT * FROM kandidat_blj, detail_kandidat_blj, mahasiswa WHERE kandidat_blj.KB_ID = detail_kandidat_blj.KB_ID AND detail_kandidat_blj.MAHASISWA_NPM = mahasiswa.MAHASISWA_NPM AND CONCAT('20',SUBSTR(mahasiswa.MAHASISWA_NPM,1,2)) = '$angkatanpilih' AND kandidat_blj.PEMIRA_ID = '$pemira_id'");
									foreach($querymhs->result() as $row1){
										$namakandidat = $row1->MAHASISWA_NAMA;
										$kb_id = $row1->KB_ID;
										$queryjumlahsuara = $this->db->query("SELECT COUNT(*) as jumlah FROM voting_blj WHERE KB_ID = '$kb_id' AND CONCAT('20',SUBSTR(MAHASISWA_NPM,1,2)) = '$angkatanpilih'");

										$kandidatb[$i][0] = $namakandidat;
										if(!empty($queryjumlahsuara->row())){
											foreach($queryjumlahsuara->result() as $row1){
												$kandidatb[$i][1] = $row1->jumlah;
											}
										}
										else{
											$kandidatb[$i][1] = 0;
										}
										$i++;
									}


									// $querykandidatblj = $this->db->query("SELECT * FROM kandidat_blj WHERE PEMIRA_ID = '$pemira_id'");
									// $i=0;
									// foreach($querykandidatblj->result() as $row){
									// 	$kb_id = $row->KB_ID;
									// 	$namakandidat = "";
									// 	$querymhs = $this->db->query("SELECT * FROM detail_kandidat_blj, mahasiswa WHERE detail_kandidat_blj.MAHASISWA_NPM = mahasiswa.MAHASISWA_NPM AND detail_kandidat_blj.KB_ID = '$kb_id' AND CONCAT('20',SUBSTR(mahasiswa.MAHASISWA_NPM,1,2)) = '$angkatanpilih'");
									// 	foreach($querymhs->result() as $row1){
									// 		$namakandidat .= $row1->MAHASISWA_NAMA."<br/>";
									// 	}

									// 	$queryjumlahsuara = $this->db->query("SELECT COUNT(*) as jumlah FROM voting_blj WHERE KB_ID = '$kb_id' AND CONCAT('20',SUBSTR(MAHASISWA_NPM,1,2)) = '$angkatanpilih'");

									// 	$kandidatb[$i][0] = $namakandidat;
									// 	foreach($queryjumlahsuara->result() as $row1){
									// 		$kandidatb[$i][1] = $row1->jumlah;
									// 	}
									// 	$i++;
									// }

								?>
								<table class="table">
									<tr>
										<td width="30%">Angkatan <?php echo $this->input->get('angkatan') ?> berhak memilih</td>
										<td width="5%">:</td>
										<td><?php echo $jumlahberhakmemilih ?> Mahasiswa</td>
									</tr>
									<tr>
										<td width="30%">Total Mahasiswa Memilih</td>
										<td width="5%">:</td>
										<td><?php echo $mhspemilih ?> Mahasiswa</td>
									</tr>
									<tr>
										<td width="30%">Total Mahasiswa Tidak Memilih</td>
										<td width="5%">:</td>
										<td><?php echo $jumlahberhakmemilih-$mhspemilih ?> Mahasiswa</td>
									</tr>
								</table>

								<script src="https://code.highcharts.com/highcharts.js"></script>
								<script src="https://code.highcharts.com/modules/exporting.js"></script>
								<script src="https://code.highcharts.com/modules/export-data.js"></script>

								<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
								<script type="text/javascript">
									Highcharts.setOptions({
									    colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
									        return {
									            radialGradient: {
									                cx: 0.5,
									                cy: 0.3,
									                r: 0.7
									            },
									            stops: [
									                [0, color],
									                [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
									            ]
									        };
									    })
									});

									// Build the chart
									Highcharts.chart('container', {
									    chart: {
									        plotBackgroundColor: null,
									        plotBorderWidth: null,
									        plotShadow: false,
									        type: 'pie'
									    },
									    title: {
									        text: 'Ringkasan Suara'
									    },
									    tooltip: {
									        pointFormat: '{series.name}: <b>{point.y} Mahasiswa</b>'
									    },
									    plotOptions: {
									        pie: {
									            allowPointSelect: true,
									            cursor: 'pointer',
									            dataLabels: {
									                enabled: true,
									                format: '<b>{point.name}</b>: {point.y} Mahasiswa',
									                style: {
									                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
									                },
									                connectorColor: 'silver'
									            }
									        }
									    },
									    series: [{
									        name: 'Share',
									        data: [
									            { name: 'Memilih', y: <?php echo $mhspemilih ?> },
									            { name: 'Tidak Memilih', y: <?php echo $jumlahberhakmemilih-$mhspemilih ?> }
									        ]
									    }]
									});
								</script>

								<br/><br/>
								<script src="https://code.highcharts.com/modules/data.js"></script>
								<script src="https://code.highcharts.com/modules/drilldown.js"></script>
								<div id="containerhasil" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
								<script type="text/javascript">
									Highcharts.chart('containerhasil', {
									    chart: {
									        type: 'column'
									    },
									    title: {
									        text: 'Perolehan Suara'
									    },
									    subtitle: {
									        text: '<?php echo $this->input->get('hasil')?>'
									    },
									    xAxis: {
									        type: 'category'
									    },
									    yAxis: {
									        title: {
									            text: 'Total Suara'
									        }
									    },
									    legend: {
									        enabled: false
									    },
									    plotOptions: {
									        series: {
									            borderWidth: 0,
									            dataLabels: {
									                enabled: true,
									                format: '{point.y} Suara'
									            }
									        }
									    },

									    tooltip: {
									        pointFormat: '<span style="color:{point.color}"></span>: <b>{point.y} Suara</b> dari <?php echo $mhspemilih ?><br/>'
									    },

									    "series": [
									        {
									            "name": "Perolehan Suara",
									            "colorByPoint": true,
									            "data": [
									            	<?php
										        		for($a=0;$a<=$i-1;$a++){
										        			if($a==$i-1){
										        				echo '{"name":"'.$kandidatb[$a][0].'","y":'.$kandidatb[$a][1].'}';
										        			}
										        			else{
										        				echo '{"name":"'.$kandidatb[$a][0].'","y":'.$kandidatb[$a][1].'},';
										        			}
										        		}
										        	?>
									            ]
									        }
									    ]
									});
								</script>
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