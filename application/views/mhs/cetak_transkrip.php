<!DOCTYPE html>
<html>
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
  <?php 
  	echo '<style>
	'.file_get_contents("https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css").'
	</style>';
  ?>
</head>
<body>
	<font style="text-align: center; font-size: 10px;"><b>DAFTAR MATA KULIAH</b></font>
	<table class="table table-bordered" style="padding-left: -10px;">
		<thead>
		<tr>
			<th style="width: 260px; font-size: 10px;">Mata Kuliah<br><i>Courses</i></th>
			<th width="30px" style="font-size: 10px;">SKS<br><i>Credit</i></th>
			<th width="30px" style="font-size: 10px;">Nilai<br><i>Grade</i></th>
			<th style="width: 260px; font-size: 10px;">Mata Kuliah<br><i>Courses</i></th>
			<th style="width: 10px; font-size: 10px;">SKS<br><i>Credit</i></th>
			<th style="width: 10px; font-size: 10px;">Nilai<br><i>Grade</i></th>
		</tr>
		</thead>
		<tbody>
			<tr>
				<td style="font-size: 10px;">
				<table>
					<?php 
						foreach($mk->result() as $r){
							echo '<tr>
									<td style="font-size: 10px;">'.$r->kode_mata_kuliah.'</td>
									<td style="font-size: 10px;">'.$r->nama_mata_kuliah.'<br><i>'.$r->nama_mata_kuliah_eng.'</i></td>
								 </tr>';
						}
					?>
				</table>
			</td>
			<td style=""></td>
			<td style=""></td>
			<td style="font-size: 10px;">
				<table>
					<?php 
						foreach($mk1->result() as $r){
							echo '<tr>
									<td style="font-size: 10px;padding-top: 0px;">'.$r->kode_mata_kuliah.'</td>
									<td style="font-size: 10px;">'.$r->nama_mata_kuliah.'<br><i>'.$r->nama_mata_kuliah_eng.'</i></td>
								 </tr>';
						}
					?>
				</table>
			</td>
			<td style=""></td>
			<td style=""></td>
			</tr>
			<tr>
				<td colspan="6">
					<font style="font-size: 10px;">
					Keterangan/<i>Remark </i>:<br>
					Bobot/<i>Weight</i> : A = 4; AB = 3.5; B = 3; BC = 2.5; C = 2; CD = 1.5; D = 1; E = 0<br>
					Kategori Kelulusan/<i>Passing Grades</i><br>
					IPK / GPA : <br>
					2.00 - 2.75 = Memuaskan / <i>Satisfying</i><br>
					2.76 - 3.50 = Sangat Memuaskan / <i>Very Satisfying</i><br>
					3.51 - 4.00 = Cumlaude / <i>Cumlaude</i><br>
					<br>
					</font>
				</td>
			</tr>
		</tbody>
	</table>
	<font style="font-size: 10px;">
		Transkrip ini tidak berlaku jika ada koreksi dari siapapun<br>
	<i>This transcript is invalid if there are any correction whatsoever</i>
	</font>
	<table width="100%" border="0">
		<tr>
			<th width="30px"></th>
			<th width="450px"></th>
			<th style="text-align: left; font-size: 10px;">Semarang, </th>
		</tr>
		<tr>
			<th></th>
			<th style="text-align: left; font-size: 10px;">Ketua</th>
			<th style="text-align: left; font-size: 10px;">Ketua Prodi Diploma III Farmasi</th>
		</tr>
		<tr>
			<th></th>
			<th style="text-align: left; font-size: 10px;">Sekolah Tinggi Ilmu Farmasi Nusaputera</th>
			<th></th>
		</tr>
		<tr>
			<th height="100px"></th>
			<th height="100px"></th>
			<th height="100px"></th>
		</tr>
		<tr>
			<th></th>
			<th style="text-align: left; font-size: 10px;">Nama</th>
			<th style="text-align: left; font-size: 10px;">Nama</th>
		</tr>
		<tr>
			<th></th>
			<th style="text-align: left; font-size: 10px;">NIDN</th>
			<th style="text-align: left; font-size: 10px;">NIDN</th>
		</tr>
	</table>
	<div style="page-break-after: always">
	</div>
</body>
</html>