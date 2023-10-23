<!DOCTYPE html>
<html>
<head>
	<title></title>
<style type="text/css">
/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 45%;
  padding: 10px;
  height: auto; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
</style>
</head>
<body>
<table width="100%">
	<tr>
		<td width="60px"><img src="<?php echo base_url();?>/assets/images/logo/logo.png" style="width: 90px; height: 90;"></td>
		<td colspan="3"><center><h4>SEKOLAH TINGGI ILMU FARMASI NUSAPUTERA</h4><p>Jalan Medoho 3 No.2, Telp/ Fax (024)6747012 Semarang <br /> E-mail : stiferanusaputera@gmail.com <br> Website: https://www.stifera.ac.id</p></center></td>
		<!-- <td><img src="<?php echo base_url().'assets/foto_mahasiswa/'.$biodata->foto_mhs;?>" style="width: 90px; height: 120;"></td> -->
		<td></td>
	</tr>
</table>
<h5 style="text-align: center;"><b>KARTU RENCANA STUDI</b></h5>
<div class="row">
  <div class="column">
    <table width="100%">
		<tr>
			<td style="font-size:12px;">Nama</td>
			<td style="font-size:12px;">:</td>
			<td style="font-size:12px;"><?php echo $biodata->nama ?></td>
		</tr>
		<tr>
			<td style="font-size:12px;">NIM</td>
			<td style="font-size:12px;">:</td>
			<td style="font-size:12px;"><?php echo $biodata->nim ?></td>
		</tr>
		<tr>
			<td style="font-size:12px;">Jurusan/Prodi</td>
			<td style="font-size:12px;">:</td>
			<td style="font-size:12px;">
				<?php
					$jurusan = explode(" ",$biodata->nama_jurusan);
					echo $jurusan[2];
					echo " / ";
					echo $jurusan[0];
					echo " ";
					echo $jurusan[1];
				?>
			</td>
		</tr>
	</table>
  </div>
  <div class="column">
    <table width="100%">
		<tr>
			<td style="font-size:12px;">Tahun Ajaran</td>
			<td style="font-size:12px;">:</td>
			<td style="font-size:12px;"><?php echo $ta ?></td>
		</tr>
		<tr>
			<td style="font-size:12px;">Semester</td>
			<td style="font-size:12px;">:</td>
			<td style="font-size:12px;"><?php echo $status ?></td>
		</tr>
		<tr>
			<td style="font-size:12px;">Dosen Wali</td>
			<td style="font-size:12px;">:</td>
			<td style="font-size:12px;"><?php echo $biodata->nama_dosen; ?></td>
		</tr>
	</table>
  </div>
</div>
<br>
<table width="100%">
	<tr bgcolor="#E0DCDB">
		<td rowspan="2"><center><b>No</b></center></td>
		<td rowspan="2"><center><b>Kode MK</b></center></td>
		<td rowspan="2"><center><b>Nama Mata Kuliah</b></center></td>
		<td rowspan="2"><center><b>SKS</b></center></td>
		<td colspan="2"><center><b>Jadwal</b></center></td>
	</tr>
	<tr bgcolor="#E0DCDB">
		<td><center><b>Hari, Jam</b></center></td>
		<td><center><b>Ruang</b></center></td>
	</tr>

	<!-- <tr  style="border: 1px solid black; border-collapse: collapse;">
		<td  style="border: 1px solid black; border-collapse: collapse;"><center>Hari, Jam</center></td>
		<td  style="border: 1px solid black; border-collapse: collapse;"><center>Ruang</center></td>
	</tr> -->
	<?php $no=1; $total = 0; foreach($krs as $a){?>
	<tr >
		<td><center><?php echo $no++;?></center></td>
		<td><center><?php echo $a->kode_mata_kuliah ?></center></td>
		<td><?php echo $a->mata_kuliah ?></td>
		<td><center><?php echo $a->jumlah_sks ?></center></td>
		<?php
		//if($a->is_publish == 0){
		?>
		<!--<td colspan="2" align="center" bgcolor="#dfdfdf">Belum Diverifikasi</td>-->
		<?php
		//}else{
		?>
		
		<td><center><?php echo $a->hari.", ".$a->sesi; ?></center></td>
		<td><center><?php echo urldecode($a->ruang) ?></center></td>
		<?php
		//}
		?>
		
	</tr>
	<?php $total += $a->jumlah_sks; 
	}?>

	<tr bgcolor="#E0DCDB">
		<td colspan="3" align="right"><b>Jumlah SKS</b></td>
		<td><center><b><?php echo $total; ?></b></center></td>
		<td colspan="2" bgcolor="white"></td>
	</tr>
	<tr>
		<td colspan="2" align="right"><b>IPS Sebelum :</b></td>
		<td><b><?php echo round($ips_sebelum, 2); ?></b></td>
		<td colspan="3" bgcolor="white"></td>
	</tr>
	<tr>
		<td colspan="2" align="right"><b>Batas SKS :</b></td>
		<td><b><?php echo $sks_maks; ?></b></td>
		<td colspan="3" bgcolor="white"></td>
	</tr>
</table>
<hr><br> 
<h5 style="text-align: center; font-size:12px;"><b>PERSETUJUAN KARTU STUDI</b></h5>
<table width="100%">
	<tr>
		<td width="33%"></td>
		<td width="33%"></td>
		<td width="33%" align="center" style="font-size:12px;">Semarang, <?php echo date('d M Y');?></td>
	</tr>
	<tr>
		<td align="center" style="font-size:12px;">Dosen Wali</td>
		<td align="center" style="font-size:12px;"></td>
		<td align="center" style="font-size:12px;">Mahasiswa</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<!-- <td>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;Fakultas <?php echo $fak;?></td> -->
		<td></td>
	</tr>
	<tr>
		<td align="center" style="font-size:12px;"><br><br><?php echo $biodata->nama_dosen; ?></td>
		<td align="center" style="font-size:12px;"><br><br>ORANG TUA WALI</td>
		<td align="center" style="font-size:12px;"><br><br><?php echo $biodata->nama ?></td>
	</tr>
	<tr>
		<td></td>
		<td align="center" style="font-size:12px;"></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<!-- <td>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;Fakultas <?php echo $fak;?></td> -->
		<td></td>
	</tr>
	<tr>
		<td align="center" style="font-size:12px;"><br><br></td>
		<td align="center" style="font-size:12px;"><br><br>.....................</td>
		<td align="center" style="font-size:12px;"><br><br></td>
	</tr>
</table>
</body>
</html>
