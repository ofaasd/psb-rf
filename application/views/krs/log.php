<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Log KRS</title>
</head>
<body>
	<?php
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Rekap KRS.xls");
	?>
	<table border="1">
		<tr>
			<th>No</th>
			<th>Nomor Induk Mahasiswa</th>
			<th>Nama Mahasiswa</th>
			<th>Matakuliah</th>
			<th>SKS</th>
		</tr>
		<?php 
		$no = 1;
		foreach ($data as $d): ?>
			<tr>
				<td><?php echo $no++ ?></td>
				<td><?php echo $d->nim ?></td>
				<td><?php echo $d->nama ?></td>
				<td><?php echo $d->mata_kuliah ?></td>
				<td><?php echo $d->sks ?></td>
			</tr>	
		<?php endforeach ?>
	</table>
</body>
</html>