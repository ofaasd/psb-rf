<!DOCTYPE html>
<html>
<head>
</head>
<body>
<table>
	<tr>
    	<td width="30%"><img src="<?php echo base_url(); ?>/assets/images/logo/logo.png" style="float:left"; width="70" height="60"><p style="font-size:10px;"><b>SEKOLAH TINGGI ILMU FARMASI NUSAPUTERA</b><br>Kampus: Jl. Medoho III No. 2 Semarang<br>Telp/Fax: (024) 6747012</p></td>    	
        <td><center><b>BERITA ACARA PERKULIAHAN<br>SEKOLAH TINGGI ILMU FARMASI NUSAPUTERA<br>TAHUN AKADEMIK <?php echo $ta.' '.$jenis_ta[$jenis]; ?></b></center></td>
	</tr>
</table>
<br>
<table width="100%">
	<tr>
    	<td>
        	<table>
            	<tr>
                	<td>Nama Dosen</td>
                    <td>:</td>
                    <td><?php echo $dosen ?></td>
                </tr>
                <tr>
                	<td>Nama Matakuliah</td>
                    <td>:</td>
                    <td><?php echo $matkul ?></td>
                </tr>
                <tr>
                	<td>Jam Perkuliahan</td>
                    <td>:</td>
                    <td><?php echo $sesi ?></td>
                </tr>
            </table>
        </td>
        <td>
        	<table>
            	<tr>
                	<td>Bobot SKS</td>
                    <td>:</td>
                    <td><?php echo $sks ?></td>
                </tr>
                <tr>
                	<td>Ruang</td>
                    <td>:</td>
                    <td><?php echo $ruang ?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table style="width:100%; border: 1px solid black;
  border-collapse: collapse;">
  <tr>
    <th rowspan="2" style="border: 1px solid black;
  border-collapse: collapse;">No.</th>
    <th rowspan="2" style="border: 1px solid black;
  border-collapse: collapse;">Rencana Tanggal Pertemuan</th> 
    <th rowspan="2" style="border: 1px solid black;
  border-collapse: collapse;">Materi Kontrak Perkuliahan</th>
  <th rowspan="2" style="border: 1px solid black;
  border-collapse: collapse;">Tanggal Pelaksanaan</th>
  <th rowspan="2" style="border: 1px solid black;
  border-collapse: collapse;">Sub Bahasan</th>
  <th colspan="2" style="border: 1px solid black;
  border-collapse: collapse;">Tanda Tangan</th>
  <th colspan="2" style="border: 1px solid black;
  border-collapse: collapse;">Jumlah Mahasiswa</th>
  </tr>
  <tr>
    <th style="border: 1px solid black;
    border-collapse: collapse;">Dosen</th>
    <th style="border: 1px solid black;
    border-collapse: collapse;">MHS</th>
    <th style="border: 1px solid black;
    border-collapse: collapse;">Hadir</th>
    <th style="border: 1px solid black;
    border-collapse: collapse;">Tidak Hadir</th>
  </tr>
  
  <?php $no = 1;
    foreach($temu as $t){
  ?>
  <tr height="80px">
    <td style="border: 1px solid black; border-collapse: collapse; height: 80px;"><center><?php echo $no++ ?></center></td>
    <td style="border: 1px solid black; border-collapse: collapse; height: 80px; padding-left: 5px;"><?php $date = date_create($t->tgl_pertemuan); echo date_format($date,"d/m/Y"); ?></td>
    <td style="border: 1px solid black; border-collapse: collapse; height: 80px;"></td>
    <td style="border: 1px solid black; border-collapse: collapse; height: 80px;"></td>
    <td style="border: 1px solid black; border-collapse: collapse; height: 80px;"></td>
    <td style="border: 1px solid black; border-collapse: collapse; height: 80px;"></td>
    <td style="border: 1px solid black; border-collapse: collapse; height: 80px;"></td>
    <td style="border: 1px solid black; border-collapse: collapse; height: 80px;"></td>
    <td style="border: 1px solid black; border-collapse: collapse; height: 80px;"></td>
  </tr>
  <?php } ?>
</table>
<br>
<br>
<table width="100%">
	<tr>
    	<td>
        	Mengetahui,<br>
            Ketua Sekolah Tinggi Ilmu Farmasi Nusaputera<br><br><br><u>apt. Yithro Serang M.Farm</u><br>
NIP. 070315005
        </td>
        <td>Ketua Prodi D III Farmasi<br><br><br><u>apt. Nurista Dida Ayuningtyas M.Sc</u><br>NIP. 070113152</td>
    </tr>
</table>
</body>
</html>