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
									<li role="presentation" class="active"><a href="<?php echo base_url() ?>admin/kelola/pemira/?hasil=<?php echo $this->input->get('hasil')?>&hima">Himpunan Mahasiswa</a></li>
									<li role="presentation"><a href="<?php echo base_url() ?>admin/kelola/pemira/?hasil=<?php echo $this->input->get('hasil')?>&blj">Badan Legislatif Jurusan</a></li>
								</ul>
								<br/>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<a href="<?php echo base_url() ?>admin/kelola/pemira/?hasil=<?php echo $this->input->get('hasil') ?>&cetakhima" class="btn btn-default form-control" target="_blank"><i class="fas fa-print"></i> Cetak Hasil</a><br/><br/>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<?php
									$berhakmemilih = $this->db->query("SELECT COUNT(*) as jumlah FROM mahasiswa WHERE CONCAT('20',SUBSTR(MAHASISWA_NPM,1,2)) IN ('$pemira_angkatan_join') AND MAHASISWA_STATUS = '1'");
									foreach($berhakmemilih->result() as $row){
										$jumlahberhakmemilih = $row->jumlah;
									}

									$pemira_id = $this->input->get('hasil');
									$mhsmemilih = $this->db->query("SELECT COUNT(*) as jumlah FROM voting_hima, kandidat_hima WHERE voting_hima.KH_ID = kandidat_hima.KH_ID AND kandidat_hima.PEMIRA_ID = '$pemira_id' AND CONCAT('20',SUBSTR(voting_hima.MAHASISWA_NPM,1,2)) IN ('$pemira_angkatan_join')");
									foreach($mhsmemilih->result() as $row){
										$mhspemilih = $row->jumlah;
									}

									$querykandidathima = $this->db->query("SELECT * FROM kandidat_hima WHERE PEMIRA_ID = '$pemira_id'");
									$i=0;
									foreach($querykandidathima->result() as $row){
										$kh_id = $row->KH_ID;
										$namakandidat = "";
										$querymhs = $this->db->query("SELECT * FROM detail_kandidat_hima, mahasiswa WHERE detail_kandidat_hima.MAHASISWA_NPM = mahasiswa.MAHASISWA_NPM AND detail_kandidat_hima.KH_ID = '$kh_id' ORDER BY DKH_STATUS ASC");
										foreach($querymhs->result() as $row1){
											$namakandidat .= $row1->MAHASISWA_NAMA."<br/>";
										}

										$queryjumlahsuara = $this->db->query("SELECT COUNT(*) as jumlah FROM voting_hima WHERE KH_ID = '$kh_id' AND CONCAT('20',SUBSTR(MAHASISWA_NPM,1,2)) IN ('$pemira_angkatan_join')");

										$kandidath[$i][0] = $namakandidat;
										foreach($queryjumlahsuara->result() as $row1){
											$kandidath[$i][1] = $row1->jumlah;
										}
										$i++;
									}
								?>
								<table class="table">
									<tr>
										<td width="30%">Mahasiswa Berhak Memilih</td>
										<td>:</td>
										<td><?php echo $jumlahberhakmemilih ?> Mahasiswa</td>
									</tr>
									<tr>
										<td>Total Mahasiswa Memilih</td>
										<td>:</td>
										<td><?php echo $mhspemilih ?> Mahasiswa</td>
									</tr>
									<tr>
										<td>Total Mahasiswa Tidak Memilih</td>
										<td>:</td>
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
										        				echo '{"name":"'.$kandidath[$a][0].'","y":'.$kandidath[$a][1].'}';
										        			}
										        			else{
										        				echo '{"name":"'.$kandidath[$a][0].'","y":'.$kandidath[$a][1].'},';
										        			}
										        		}
										        	?>
									            ]
									        }
									    ]
									});
								</script>

								<!-- <script src="https://code.highcharts.com/highcharts.js"></script>
								<script src="https://code.highcharts.com/modules/series-label.js"></script>
								<script src="https://code.highcharts.com/modules/exporting.js"></script>

								<div id="container" style="min-width: 310px; height: 500px; margin: 0 auto"></div>
								<script type="text/javascript">
									Highcharts.chart('container', {
									    title: {
									        text: 'Perolehan Suara'
									    },
									    xAxis: {
									        categories: [
									        	<?php
									        		for($a=0;$a<=$i-1;$a++){
									        			if($a==$i-1){
									        				echo "'".$kandidath[$a][0]."'";
									        			}
									        			else{
									        				echo "'".$kandidath[$a][0]."',";
									        			}
									        		}
									        	?>
									        ]
									    },
									    labels: {
									        items: [{
									            style: {
									                left: '0px',
									                top: '-10px',
									                color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
									            }
									        }]
									    },
									    series: [{
									        type: 'column',
									        name: 'Perolehan Suara',
									        data: [
									        	<?php
									        		for($a=0;$a<=$i-1;$a++){
									        			if($a==$i-1){
									        				echo $kandidath[$a][1];
									        			}
									        			else{
									        				echo $kandidath[$a][1].",";
									        			}
									        		}
									        	?>
									        ]
									    }, {
									        type: 'pie',
									        name: 'Total Mahasiswa',
									        data: [{
									            name: 'Memilih',
									            y: <?php echo $mhspemilih ?>,
									            color: Highcharts.getOptions().colors[2] // Jane's color
									        }, {
									            name: 'Tidak Memilih',
									            y: <?php echo $jumlahberhakmemilih-$mhspemilih ?>,
									            color: Highcharts.getOptions().colors[1] // Joe's color
									        }],
									        center: [320, 40],
									        size: 100,
									        showInLegend: false,
									        dataLabels: {
								                enabled: true,
								                format: '<b>{point.name}</b>: {point.y} ',
								                style: {
								                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
								                }
								            }
									    }]
									});
								</script> -->
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