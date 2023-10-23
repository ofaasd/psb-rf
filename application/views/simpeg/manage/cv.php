<link rel="stylesheet" href="<?php echo  base_url();?>/assets/css/cv.css">
<table width="100%" align="center" cellspacing="0" cellpadding="0">
	
		<tr>
			<td width="100" class="header">
				<div class="logo"><img src="<?php echo base_url();?>/assets/images/logo/logo.png" width="100" align="left">
				</div>
			</td>
			<td>
				<b class="name">DATA INDUK KARYAWAN <br /> AKADEMI FARMASI NUSAPUTERA</b>
				<b ></b>
			</td>
			<td align="right" style="padding-top:0px;">
				<p style="display:block;  margin:0 10px; padding:0;float:right" ><b><?php echo  $biodata->nama_lengkap?></b></p><br />
				<small style="display:block; margin:0 10px; padding:0;float:right"><b><?php echo $pegawai->npp ?></b></small><br /><br />
				<small style="display:block; margin:0 10px; padding:0;float:right"><b><?php echo $biodata->nidn ?></b></small>
			</td>
			<td width="100">
				<img src="<?php echo  base_url();?>assets/foto_pegawai/<?php echo  $biodata->foto; ?>" align="right" width="100" style="margin-top:10px;"><br />
			</td>
		</tr>
	
</table>
<table width="100%">
	<thead>
		<tr>
			<th colspan="4" style="padding:5px;" align="left">Biodata Umum</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>KTP</td>
			<td>: <?php echo $biodata->no_ktp?></td>
			<td>Homebase</td>
			<td>: <?php echo $homebase->nama_jurusan?></td>
		</tr>
		<tr>
			<td>Tempat Tanggal Lahir</td>
			<td>: <?php echo $biodata->tempat_lahir . ", " . date('d-m-Y',strtotime($biodata->tanggal_lahir))?></td>
			<td>Email</td>
			<td>: <?php echo $biodata->email1?></td>
		</tr>
		<tr>
			<td>Umur</td>
			<td>: <?php echo $biodata->tanggal_lahir?></td>
			<td>Alamat</td>
			<td>: <?php echo $biodata->alamat?></td>
		</tr>
		<tr>
			<td>Jenis Kelamin</td>
			<td>: <?php echo ($biodata->jenis_kelamin == "P")?"Perempuan":"Laki-laki" ?></td>
			<td>Kelurahan</td>
			<td>: <?php echo $biodata->kelurahan?></td>
		</tr>
		<tr>
			<td>Agama</td>
			<td>: <?php echo $biodata->agama?></td>
			<td>Kecamatan</td>
			<td>: <?php echo (empty($kecamatan->nm_wil))?"":$kecamatan->nm_wil ?></td>
		</tr>
		<tr>
			<td>Golongan Darah</td>
			<td>: <?php echo $biodata->golongan_darah?></td>
			<td>Kabupaten/Kota</td>
			<td>: <?php echo (empty($kotakab->nm_wil))?"":$kotakab->nm_wil?></td>
		</tr>
		<tr>
			<td>Status Perkawinan</td>
			<td>: <?php echo $biodata->status_nikah?></td>
			<td>Provinsi</td>
			<td>: <?php echo (empty($provinsi->nm_wil))?"":$provinsi->nm_wil?></td>
		</tr>
		<tr>
			<td>Telp</td>
			<td>: <?php echo $biodata->notelp?></td>
			<td>Hp</td>
			<td>: <?php echo $biodata->nohp?></td>
		</tr>
	</tbody>
</table>
<table width="100%">
	<thead>
		<tr>
			<th colspan="6" style="padding:5px;" align="left">Riwayat Pendidikan</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($pendidikan as $row){
				echo "<tr>
						<td>Jenjang</td>
						<td>: " . $row->jenjang . "</td>
						<td>Tahun</td>
						<td>: " . $row->tahun . "</td>
						<td> Asal Sekolah, Jurusan</td>
						<td>: ";
						echo (!empty($row->universitas))?$this->db->query("select nama_universitas from master_universitas where id=" . $row->universitas )->row()->nama_universitas:"-";
						echo ", ";
						echo (!empty($row->jurusan))?$this->db->query("select nama_jurusan from master_program_studi where id=" . $row->jurusan )->row()->nama_jurusan:"-";
						echo "</td>
					</tr>";

			}
		?>
	</tbody>
</table>
<table width="100%">
	<thead>
		<tr>
			<th colspan="6" style="padding:5px;" align="left">Golongan</th>
		</tr>
	</thead>
	<tbody>
		<?php
			
			echo "<tr>
					<td>Golongan</td>
					<td>: " . $golongan->nama . "</td>
					<td>No. Pengantar</td>
					<td>: " . $golongan->no_pengantar . "</td>
					<td> No. SK</td>
					<td>: " . $golongan->no_sk . "</td>
				</tr>";
			echo "<tr>
				<td>Tgl SK</td>
				<td>: " . date('d-m-Y', strtotime($golongan->tanggal_sk)) . "</td>
				<td>TMT SK</td>
				<td>: " .date('d-m-Y', strtotime($golongan->tmt)) . "</td>
			</tr>";
		?>
	</tbody>
</table>
<table width="100%">
	<thead>
		<tr>
			<th colspan="6" style="padding:5px;" align="left">Jabatan Fungsional</th>
		</tr>
	</thead>
	<tbody>
		<?php
			
			echo "<tr>
					<td>Jabatan Fungsional</td>
					<td>: " . $fungsional->jabatan_fungsional_sekarang . "</td>
					<td>No. SK</td>
					<td>: " . $fungsional->no_sk_fungsional . "</td>
					<td> Tanggal SK</td>
					<td>: " . date('d-m-Y', strtotime($fungsional->tgl_sk_fungsional)) . "</td>
				</tr>";
			echo "<tr>
				<td>TMT SK</td>
				<td>: " . date('d-m-Y', strtotime($fungsional->tmt_sk_fungsional)) . "</td>
			</tr>";
		?>
	</tbody>
</table>
<table width="100%">
	<thead>
		<tr>
			<th colspan="6" style="padding:5px;" align="left">Lain-lain</th>
		</tr>
	</thead>
	<tbody>
		<?php
			
			echo "<tr>
					<td>No. BPJS Kesehatan</td>
					<td>: " . $biodata->no_bpjs_kesehatan . "</td>
					<td>No. BPJS Ketenagakerjaan</td>
					<td>: " . $biodata->no_bpjs_ketenagakerjaan . "</td>
					
				</tr>";
		?>
	</tbody>
</table>
<p>Saya menyetujui isi diatas dengan sebenar-benarnya</p>
<table width="100%">
	<tr>
		<td width="75%">
			&nbsp;
		</td>
		<td align="center">
			<p>Semarang,<?php echo date('d M Y');?></p>
			<br />
			<br />
			<br />
			<br />
			<p>(<?php echo $biodata->nama_lengkap?>)</p>


		</td>
	</tr>
</table>
<table>
	<tr>
		<td>Generated By Simpeg Nusaputera</td>
	</tr>
</table>