<!DOCTYPE html>
<html>
	<head>
			<title>KARTU EVALUASI</title>
			<style type="text/css">
				@page { 
					margin: 0.125cm 0.125cm 0.125cm 0.125cm; 
				}
				#outtable {
					padding:10px 10px 50px 10px;
					margin: 0.5cm 0.5cm 0.5cm 0.5cm;
					border: 2px dashed #000000;
				}
				#outtable5 {
					width : 100%;
				}
				#watermark { 
					position: fixed; 
					top: 100px;
					left: 150px;
					width: 520px; 
					opacity: .1; 
				}
				table.tabel1 {
					width : 100%;
					font-family:  "Times New Roman", "Times", "serif";
					text-align: center;
					color:#000000;
				}
				table.tabel1 td {
					font-size: 18px;
					font-style:normal; 
					font-weight:bold
				}
				table.tabel2 {
					width : 100%;
					font-family: "arial";
					color:#000000;
				}
				table.tabel2 td {
					font-size: 15px;
				}
				table.tabel2 td.bold {
					font-weight: bold;
				}
				table.tabel2 td.td1 {
					font-size: 15px;
					font-weight: bold;
				}
				table.tabel3 {
					border-collapse: collapse;
					border: 1px solid black;
					width : 100%;
					font-family: arial;
					text-align: center;
					color:#000000;
				}
				table.tabel3 td {
					border: 1px solid black;
					height: 40px;
					vertical-align: middle;
				}
				table.tabel3 td.td1 {
					border: 1px solid black;
					font-weight: bold;
					height: 40px;
					vertical-align: middle;
				}
				table.tabel3 td.td2 {
					border: 1px solid black;
					height: 40px;
					text-align: left;
					vertical-align: middle;
					font-style:normal; 
					font-weight:normal; 
        		}
				table.tabel3 th {
					border: 1px solid black;
				}
		  	
		</style>
	</head>
	<body>
		<div id="outtable">
		  	<div id="watermark" ><img src="img/logo_SD.png" height="90%" width="90%">
		  	</div>
		  	<table class="tabel1">
		  		<tr>
		  			<td rowspan="3"><img src="img/UNUD.png" alt="" height=70 width=70></td>
		  			<td style='width: 300px;'>STUDENT DAY 2018</td>
		  			<td rowspan="3"><img src="img/TEKNIK_1.png" alt="" height=70 width=70></td>
		  		</tr>
		  		<tr>
		  			<td>FAKULTAS TEKNIK</td>
		  		</tr>
		  		<tr>
		  			<td>UNIVERSITAS UDAYANA</td>
		  		</tr>
		  		<tr>
		  			<td colspan="3" style='font-size: 1px; border-bottom: 4px solid #000000;'>&nbsp;</td>
		  		</tr>
		  	</table>
		  	<table class="tabel2">
		  		<tr>
		  			<td class="bold" colspan="3", style='text-align: center; font-size: 17px; border-top: 2px solid #000000; padding: 15px 0px 0px 0px;'>KARTU EVALUASI</td>
		  		</tr>
		  		<tr>
		  			<td colspan="2">&nbsp;</td>
		  			<td rowspan="4" style='text-align: left;'><img style="" src="img/foto2x3.jpg" alt="" height=100px width=80px></td>
		  		</tr>
		  		<tr>
		  			<td class="bold" style='padding: 0px 0px 0px 10px'>&nbsp;NAMA</td>
		  			<td style='width: 520px; text-transform: uppercase;'>: {{ $data->nama }}</td>
		  		</tr>
		  		<tr>
		  			<td class="bold" style='padding: 0px 0px 0px 10px; '>&nbsp;NIM</td>
		  			<td style='width: 520px; text-transform: uppercase;' >: {{ $data->nim }}</td>
		  		</tr>
		  		<tr>
		  			<td class="bold" style='padding: 0px 0px 0px 10px;'>&nbsp;PRODI</td>
		  			<td style='width: 520px; text-transform: uppercase;'>: {{ $data->prodi }}</td>
		  		</tr>
		  		<tr>
		  			<td colspan="3">&nbsp;</td>
		  		</tr>
		  	</table>
		  	<table class="tabel3 table-bordered">
		  		<tr>
		  			<td class="td1" rowspan="2" style="width:150px;">PELANGGARAN</td>
		  			<td class="td1" style="height:10px; width:160px;">TEGURAN</td>
					<td class="td1" style="height:10px; width:160px;">PERINGATAN</td>
					<td class="td1" style="height:10px;">TINDAKAN</td>
		  		</tr>
		  		<tr>
		  			<td style='font-style:normal; font-weight:normal;'></td>
		  			<td style='font-style:normal; font-weight:normal;'></td>
		  			<td style='font-style:normal; font-weight:normal;'></td>
		  		</tr>
			  </table>
			  <table class="tabel3 table-bordered" style="margin-top:20px;">
				<tr>
					<td class="td1" rowspan="2" style="width:150px;">PENUGASAN</td>
					<td class="td1" style="height:10px; width:160px;">TUGAS I</td>
					<td class="td1" style="height:10px; width:160px;">TUGAS II</td>
					<td class="td1" style="height:10px;">TUGAS KHUSUS</td>
				</tr>
				<tr>
					<td style='font-style:normal; font-weight:normal;'></td>
					<td style='font-style:normal; font-weight:normal;'></td>
					<td style='font-style:normal; font-weight:normal;'></td>
				</tr>
			</table>
	  	</div>
	</body>
</html>
