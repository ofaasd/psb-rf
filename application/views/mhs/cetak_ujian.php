<table width="100%">
<tr>
<td style="border: 1px solid black; border-collapse: collapse;">
<?php foreach ($biodata as $b){ ?>
<table width="100%">
	<tr>
		<td rowspan="6"><img src="<?php echo base_url();?>/assets/images/logo/logo.png" style="width: 90px; height: 90;"></td>
		<td colspan="7"><table width="100%">
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse;"><center><b>KARTU UJIAN</b></center></td>
                </tr>
            </table>
        </td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td style="font-size: 10px;">NIM</td>
		<td style="font-size: 10px;"> : </td>
		<td style="font-size: 10px;"><?php echo $b->nim ?></td>
		<td style="font-size: 10px; padding-left: 80px;">Semester</td>
		<td style="font-size: 10px;"> : </td>
		<td style="font-size: 10px;"><?php echo $status; ?></td>
	</tr>
	<tr>
		<td style="font-size: 10px;"></td>
		<td style="font-size: 10px;">Nama</td>
		<td style="font-size: 10px;"> : </td>
		<td style="font-size: 10px;"><?php echo $b->nama ?></td>
		<td style="font-size: 10px; padding-left: 80px;">Tahun Ajaran</td>
		<td style="font-size: 10px;"> : </td>
		<td style="font-size: 10px;"><?php echo $ta; ?></td>
	</tr>
	<tr>
		<td style="font-size: 10px;"></td>
		<td style="font-size: 10px;">Program Studi</td>
		<td style="font-size: 10px;"> : </td>
		<td style="font-size: 10px;"><?php echo $b->progdi ?></td>
		<td style="font-size: 10px; padding-left: 80px;">Dosen Wali</td>
		<td style="font-size: 10px;"> : </td>
		<td style="font-size: 10px;"><?php echo $dosen_wali = $b->nama_dosen; ?></td>
	</tr>
	<tr>
		<td style="font-size: 10px;"></td>
		<td style="font-size: 10px;">Fakultas</td>
		<td style="font-size: 10px;"> : </td>
		<td style="font-size: 10px;"><?php echo $fak = $b->fakultas; ?></td>
		<td style="font-size: 10px; padding-left: 80px;">Email Dosen</td>
		<td style="font-size: 10px;"> : </td>
		<td style="font-size: 10px;">-</td>
	</tr>
</table>
<?php } ?>
<br>
<table width="100%" style="border: 1px solid black; border-collapse: collapse;">
<thead>
    <tr>
        <th rowspan="2" style='font-size:8px; border: 1px solid black; border-collapse: collapse;'><center>No</center></th>
        <th rowspan="2" style='font-size:8px; border: 1px solid black; border-collapse: collapse;'><center>Kode</center></th>
        <th rowspan="2" style='font-size:8px; border: 1px solid black; border-collapse: collapse;'><center>Matakuliah</center></th>
        <th rowspan="2" style='font-size:8px; border: 1px solid black; border-collapse: collapse;'><center>SKS</center></th>
        <th rowspan="2" style='font-size:8px; border: 1px solid black; border-collapse: collapse;'><center>Ruang</center></th>
        <th rowspan="2" style='font-size:8px; border: 1px solid black; border-collapse: collapse;'><center>No. Kursi</center></th>
        <th colspan="2" style='font-size:8px; border: 1px solid black; border-collapse: collapse;'><center>Tanggal Ujian UTS</center></th>
        <th colspan="2" style='font-size:8px; border: 1px solid black; border-collapse: collapse;'><center>Tanggal Ujian UAS</center></th>
        <th rowspan="2" style='font-size:8px; border: 1px solid black; border-collapse: collapse;'><center>Paraf</center></th>
    </tr>
    <!--<tr>
      <th colspan="2" style='font-size:8px; border: 1px solid black; border-collapse: collapse;'><center>Teori</center></th>
      <th colspan="2" style='font-size:8px; border: 1px solid black; border-collapse: collapse;'><center>Praktek</center></th>
      <th colspan="2" style='font-size:8px; border: 1px solid black; border-collapse: collapse;'><center>Teori</center></th>
      <th colspan="2" style='font-size:8px; border: 1px solid black; border-collapse: collapse;'><center>Praktek</center></th>
    </tr>-->
    <tr>
      <td style='font-size:8px; border: 1px solid black; border-collapse: collapse;'><center>Tanggal</center></td>
      <td style='font-size:8px; border: 1px solid black; border-collapse: collapse;'><center>Waktu</center></td>
      <td style='font-size:8px; border: 1px solid black; border-collapse: collapse;'><center>Tanggal</center></td>
      <td style='font-size:8px; border: 1px solid black; border-collapse: collapse;'><center>Waktu</center></td>
      <!--<td style='font-size:8px; border: 1px solid black; border-collapse: collapse;'><center>Tanggal</center></td>
      <td style='font-size:8px; border: 1px solid black; border-collapse: collapse;'><center>Waktu</center></td>
      <td style='font-size:8px; border: 1px solid black; border-collapse: collapse;'><center>Tanggal</center></td>
      <td style='font-size:8px; border: 1px solid black; border-collapse: collapse;'><center>Waktu</center></td>-->
    </tr>
</thead>
<tbody>
<?php $no = 1; $jumlah = 0; $val = 6.25; $kehadiran = 0;
foreach($detail as $a){
    $presensi = 0; 
    $get_status = $this->db->get_where('master_presensi', array('id_jadwal' => $a->jadwal_id, 'nim' => $this->session->userdata('nim')))->result();
    foreach ($get_status as $get_status) {
      # code...
      if (empty($get_status->status) || $get_status->status == 3) {
        # code...
        $kehadiran = 0;
      }elseif ($get_status->status == 1 || $get_status->status == 2) {
        # code...
        $kehadiran = 1;
      }
      $presensi += $kehadiran * $val;
    }
  ?>
    <tr>
        <td style='font-size:8px; border: 1px solid black; border-collapse: collapse;'><?php echo $no++ ?></td>
        <td style='font-size:8px; border: 1px solid black; border-collapse: collapse;'><?php echo $a->kode_mata_kuliah ?></td>
        <td style='font-size:8px; border: 1px solid black; border-collapse: collapse;'><?php echo $a->mata_kuliah ?></td>
        <td style='font-size:8px; border: 1px solid black; border-collapse: collapse;'><center><?php echo $a->jml_sks ?></center></td>
        <td style='font-size:8px; border: 1px solid black; border-collapse: collapse;'><center><?php echo $a->ruang ?></center></td>
        <td style='font-size:8px; border: 1px solid black; border-collapse: collapse;'><center><?php echo $a->no_kursi ?></center></td>
        <td style="border: 1px solid black; border-collapse: collapse; font-size:8px;"><center><?php 
            if($m->uts == 0){
              echo "<font style='font-size:8px;' color='red'><i>Aktif Keuangan</i></font>";
            }elseif (($a->tanggal_uts_t == '0000-00-00') || is_null($a->tanggal_uts_t) || empty($a->tanggal_uts_t)) {
                echo '-';
            }else{
                echo date_format(date_create($a->tanggal_uts_t),"d-m-Y");
            }
        ?></center></td>
        <td style="border: 1px solid black; border-collapse: collapse; font-size:8px;"><center><?php 
            if($m->uts == 0){
              echo "<font style='font-size:8px;' color='red'><i>Aktif Keuangan</i></font>";
            }elseif (($a->id_jam_uts_t == 0) || is_null($a->id_jam_uts_t) || empty($a->id_jam_uts_t)) {
                echo '-';
            }else{
                echo $this->bantuan->jam($a->id_jam_uts_t);
            }
        ?></center></td>
        <!--<td style="border: 1px solid black; border-collapse: collapse;"><center><?php 
            if($a->izin_ujian == 0){
              echo "<font style='font-size:8px;' color='red'><i>Aktif Keuangan</i></font>";
            }elseif (($a->tanggal_uts_p == '0000-00-00') || is_null($a->tanggal_uts_p) || empty($a->tanggal_uts_p)) {
                echo '-';
            }else{
                echo date_format(date_create($a->tanggal_uts_p),"d-m-Y");
            }
        ?></center></td>
        <td style="border: 1px solid black; border-collapse: collapse;"><center><?php 
            if($a->izin_ujian == 0){
              echo "<font style='font-size:8px;' color='red'><i>Aktif Keuangan</i></font>";
            }elseif (($a->id_jam_uts_p == 0) || is_null($a->id_jam_uts_p) || empty($a->id_jam_uts_p)) {
                echo '-';
            }else{
                echo $this->bantuan->jam($a->id_jam_uts_p);
            }
        ?></center></td>-->
        <td style="border: 1px solid black; border-collapse: collapse; font-size:8px;"><center><?php 
            if($presensi < 75){
              echo "<font style='font-size:8px;' color='red'><i>Kehadiran kurang 75%</i></font>";
            }elseif (($a->tanggal_uas_t == '0000-00-00') || is_null($a->tanggal_uas_t) || empty($a->tanggal_uas_t)) {
                echo '-';
            }elseif($m->uas == 0){
                echo "<font style='font-size:8px;' color='red'><i>Belum dipublikasi</i></font>";
            }else{
                echo date_format(date_create($a->tanggal_uas_t),"d-m-Y");
            }
        ?></center></td>
        <td style="border: 1px solid black; border-collapse: collapse; font-size:8px;"><center><?php 
            if($presensi < 75){
              echo "<font style='font-size:8px;' color='red'><i>Kehadiran kurang 75%</i></font>";
            }elseif (($a->id_jam_uas_t == 0) || is_null($a->id_jam_uas_t) || empty($a->id_jam_uas_t)) {
                echo '-';
            }elseif($m->uas == 0){
                echo "<font style='font-size:8px;' color='red'><i>Belum dipublikasi</i></font>";
            }else{
                echo $this->bantuan->jam($a->id_jam_uas_t);
            }
        ?></center></td>
        <!--<td style="border: 1px solid black; border-collapse: collapse;"><center><?php 
            if($presensi < 75){
              echo "<font style='font-size:8px;' color='red'><i>Kehadiran kurang 75%</i></font>";
            }elseif (($a->tanggal_uas_p == '0000-00-00') || is_null($a->tanggal_uas_p) || empty($a->tanggal_uas_p)) {
                echo '-';
            }else{
                echo date_format(date_create($a->tanggal_uas_p),"d-m-Y");
            }
        ?></center></td>
        <td style="border: 1px solid black; border-collapse: collapse;"><center><?php 
            if($presensi < 75){
              echo "<font style='font-size:8px;' color='red'><i>Kehadiran kurang 75%</i></font>";
            }elseif (($a->id_jam_uas_p == 0) || is_null($a->id_jam_uas_p) || empty($a->id_jam_uas_p)) {
                echo '-';
            }else{
                echo $this->bantuan->jam($a->id_jam_uas_p);
            }
        ?></center></td>-->
        <td style='font-size:8px; border: 1px solid black; border-collapse: collapse;'></td>
    </tr>
<?php } ?>
</tbody>
</table>
<br>
<br>
<br> 
<table width="100%">
	<tr>
		<td style="font-size: 10px;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Dosen Wali</td>
		<td style="font-size: 10px; padding-left: 260px;">Semarang, <?php echo date('d M Y');?></td>
	</tr>
	<tr>
		<td style="font-size: 10px;"></td>
		<td style="font-size: 10px; padding-left: 260px;">Kepala Tata Usaha</td>
	</tr>
	<tr>
		<td style="font-size: 10px;"></td>
		<td style="font-size: 10px; padding-left: 260px;">Fakultas <?php echo $fak;?></td>
	</tr>
	<tr>
		<td style="font-size: 10px;">&emsp;&emsp;&emsp;<?php echo $dosen_wali; ?></td>
	</tr>
</table>
<br>
<br>
<br>
</td>
</tr>
</table>