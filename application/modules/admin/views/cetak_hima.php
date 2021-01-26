<?php
	foreach($pemira as $row){
		$pemira_angkatan = explode(",", $row->PEMIRA_ANGKATAN);
		$pemira_angkatan_join = join("','",$pemira_angkatan);
	}

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
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<div style="border-bottom: 5px solid #000000; margin-top: 20px; margin-bottom: 50px;">
	<center>
		<h2>Hasil Voting Pemilihan Ketua dan Wakil Ketua HIMASIFO</h2>
	</center>
</div>

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