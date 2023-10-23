
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<table>
	<tr>
    	<td width="30%"><img src="<?php echo base_url(); ?>/assets/images/logo/logo.png" style="float:left"; width="60" height="60"><p style="font-size:10px;"><b>SEKOLAH TINGGI ILMU FARMASI NUSAPUTERA</b><br>Kampus: Jl. Medoho III No. 2 Semarang<br>Telp/Fax: (024) 6747012</p></td>    	
        <td width="70%"><center><b>ABSENSI KEHADIRAN MAHASISWA<br>SEKOLAH TINGGI ILMU FARMASI NUSAPUTERA<br>PROGRAM STUDI <?php echo $prodi ?><br>
TAHUN AKADEMIK <?php echo $ta ?></b></center></td>
	</tr>
</table>
<br>
<table style="width:100%; border: 1px solid black;
  border-collapse: collapse; height: 200px;">
  <tr>
    <th rowspan="2" style="border: 1px solid black;
    border-collapse: collapse;">No.</th>
    <th rowspan="2" style="border: 1px solid black;
    border-collapse: collapse;">NIM</th>
    <th rowspan="2" style="border: 1px solid black;
    border-collapse: collapse;">Nama Mahasiswa</th>
    <th colspan="32" style="border: 1px solid black;
    border-collapse: collapse;"><center>Tanggal</center></th>
  </tr>
  <tr>
    <?php
      foreach($temu as $a){?>
        <th style="border: 1px solid black; border-collapse: collapse;"><?php $date = date_create($a->tgl_pertemuan); echo date_format($date,"d/m"); ?></th>
        <th style="border: 1px solid black; border-collapse: collapse; width: 50px;"></th>
    <?php } ?>
  </tr>
  <?php
    $no = 1;
    foreach($data as $d){
  ?>
    <tr height="50px">
      <td style="height: 50px; border: 1px solid black;
      border-collapse: collapse;"><center><?php echo $no++ ?></center></td>
      <td style="height: 50px; border: 1px solid black;
      border-collapse: collapse; padding-left: 3px; padding-right: 3px;"><b><?php echo $d->nim ?></b></td>
      <td style="height: 50px; border: 1px solid black;
      border-collapse: collapse; padding-left: 3px; padding-right: 3px; width: 200px;"><b><?php echo strtoupper($d->nama); ?></b></td>
      <?php
      foreach($temu as $c){?>
          <td style="height: 50px; border: 1px solid black; border-collapse: collapse;"></td>
          <td style="height: 50px; border: 1px solid black; border-collapse: collapse;"></td>
      <?php } ?>
    </tr>
  <?php } ?>
</table>
<br>
<table width="100%">
	<tr>
    	<td>Ketua Prodi D III Farmasi<br><br><br><br><br><u>apt. Nurista Dida Ayuningtyas M.Sc</u><br>NIP. 070113152</td>
    	<td>
        	Semarang, <?php echo date('d-m-Y');?><br>
            Dosen Pengampu<br><br><br><br><br><?php echo $dosen ?><br>
NIP. <?php echo $nidn ?>
        </td>
    </tr>
</table>
</body>
</html>
