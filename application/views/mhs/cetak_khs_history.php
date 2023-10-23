<?php
	error_reporting(0);
?>
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
<h5 style="text-align: center;"><b>HASIL STUDI SEMESTER</b></h5>
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
			<td style="font-size:12px;">Program Studi</td>
			<td style="font-size:12px;">:</td>
			<td style="font-size:12px;"><?php echo $this->bantuan->pilihan_prodi($biodata->id_program_studi); ?></td>
		</tr>
	</table>
  </div>
  <div class="column">
    <table width="100%">
		<tr>
			<td style="font-size:12px;">Semester</td>
			<td style="font-size:12px;">:</td>
			<td style="font-size:12px;"><?php echo $ta; ?></td>
		</tr>
		<tr>
			<td style="font-size:12px;">Dosen Wali</td>
			<td style="font-size:12px;">:</td>
			<td style="font-size:12px;"><?php echo $biodata->gelar_depan." ".$biodata->nama_lengkap." ".$biodata->gelar_belakang; ?></td>
		</tr>
	</table>
  </div>
</div>
<br>
<table width="100%" style="border: 1px solid black; border-collapse: collapse;">
	<tr  style="border: 1px solid black; border-collapse: collapse;">
		<td  style="border: 1px solid black; border-collapse: collapse; font-size:12px;"><center>No</center></td>
		<td  style="border: 1px solid black; border-collapse: collapse; font-size:12px;"><center>Kode MK</center></td>
		<td  style="border: 1px solid black; border-collapse: collapse; font-size:12px;"><center>Nama Mata Kuliah</center></td>
		<td  style="border: 1px solid black; border-collapse: collapse; font-size:12px;"><center>Nilai Simbol</center></td>
		<td  style="border: 1px solid black; border-collapse: collapse; font-size:12px;"><center>Nilai Angka</center></td>
		<td  style="border: 1px solid black; border-collapse: collapse; font-size:12px;"><center>SKS</center></td>
		<td  style="border: 1px solid black; border-collapse: collapse; font-size:12px;"><center>Kualitas</center></td>
	</tr>
	<?php $no=1; $total = 0; $total_point= 0; $jumlah_aktif =0;
	foreach($khs as $a){?>
	<tr  style="border: 1px solid black; border-collapse: collapse;">
		<td  style="border: 1px solid black; border-collapse: collapse; font-size:12px;"><center><?php echo $no++;?></center></td>
		<td  style="border: 1px solid black; border-collapse: collapse; font-size:12px;"><center><?php echo $a->kode_mata_kuliah ?></center></td>
		<td  style="border: 1px solid black; border-collapse: collapse; font-size:12px;"><?php echo $a->mata_kuliah ?></td>
		<td  style="border: 1px solid black; border-collapse: collapse; font-size:12px;"><center><?php $huruf = 'E'; if (is_null($a->nhuruf)) {
                                                                      # code...
                                                                      echo "-";
                                                                    }else{
                                                                      echo $a->nhuruf;
                                                                      	$huruf = $a->nhuruf;
                                                                      } ?></center></td>
		<td  style="border: 1px solid black; border-collapse: collapse; font-size:12px;"><center><?php 
																																		if (is_null($a->nakhir)) {
                                                                      # code...
                                                                      echo "-";
                                                                    }else{
                                                                      echo round($a->nakhir,2);
                                                                      } 
                                                                    ?></center></td>
		<td  style="border: 1px solid black; border-collapse: collapse; font-size:12px;"><center><?php echo $a->jumlah_sks ?></center></td>
		<td  style="border: 1px solid black; border-collapse: collapse; font-size:12px;"><center><?php echo $tb = $this->bantuan->nbobot($huruf) * $a->jumlah_sks; ?></center></td>

	</tr>
	<?php 
		$total += $a->jumlah_sks; 
		$total_point += $tb; 
	}?>
	<tr  style="border: 1px solid black; border-collapse: collapse;">
		<td  style="border: 1px solid black; border-collapse: collapse; font-size:12px;" colspan="5" align="right">Jumlah SKS</td>
		<td  style="border: 1px solid black; border-collapse: collapse; font-size:12px;"><center><?php echo $total; ?></center></td>
		<td  style="border: 1px solid black; border-collapse: collapse; font-size:12px;"><center><?php echo $total_point; ?></center></td>
	</tr>
	<tr>
		<td style="font-size:12px;" colspan="2">IP Semester</td>
		<td style="font-size:12px;">: <?php $ipss = $total_point / $total;
																		if (is_nan($ipss)) {
																			echo '0.00';
																		}else{
																			echo round($ipss,2);
																		}
																	?></td>
	</tr>
	<tr>
		<td style="font-size:12px;" colspan="2">Batas SKS</td>
		<td style="font-size:12px;">: <?php echo $this->bantuan->sksbatas($ipss); ?></td>
	</tr>
</table>
<br><br> 
<table width="100%">
	<tr>
		<td></td>
		<td></td>
		<td align="center" style="font-size:12px;">Mengetahui,</td>
	</tr>
	<tr>
		<td align="center" style="font-size:12px;" width="30%">Dosen Wali</td>
		<td align="center" style="font-size:12px;" width="30%">Orang Tua/Wali</td>
		<td align="center" style="font-size:12px;" width="40%">Pembantu Direktur I Bidang Akademik</td>
	</tr>
	<tr>
		<td></td>
		<!-- <td>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;Fakultas <?php echo $fak;?></td> -->
		<td></td>
	</tr>
	<tr>
		<td align="center" style="font-size:12px;"><br><br><br><?php echo $biodata->gelar_depan." ".$biodata->nama_lengkap." ".$biodata->gelar_belakang; ?></td>
		<td align="center" style="font-size:12px;"><br><br><br>........................</td>
		<td align="center" style="font-size:12px;"><br><br><br><?php echo $bid_akademik->pembantu_1 ?></td>
	</tr>
</table>
</body>
</html>
