<table width="100%" border="1">
		<tr>
			<th>No.</th>
			<th>NIM</th>
			<th>Nama Mahasiswa</th>
			<th>Tugas</th>
			<th>UTS</th>
			<th>UAS</th>
			<th>Nilai Akhir</th>
			<th>Huruf</th>
		</tr>
	<?php $no = 1; foreach($result as $r){?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $r->nim; ?></td>
			<td><?php echo $r->nama; ?></td>
			<td><?php echo $this->openssl->convert("decrypt", $r->ntugas); ?></td>
			<td><?php echo $this->openssl->convert("decrypt", $r->nuts); ?></td>
			<td><?php echo $this->openssl->convert("decrypt", $r->nuas); ?></td>
			<td><?php echo $this->openssl->convert("decrypt", $r->nakhir); ?></td>
			<td><?php echo $this->openssl->convert("decrypt", $r->nhuruf); ?></td>
		</tr>
	<?php } ?>
</table>