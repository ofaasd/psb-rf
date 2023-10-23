<style>
	.table {
	  border-collapse: collapse;
	}

	.table, .td, .th {
	  border: 1px solid black;
	}
	.table, .td {
	  padding-left: 10px;
	}
</style>
<?php $tgl_1 = date('Y')+1; 
	foreach($cetak as $c){
		$nilai_pmdp = $c->peringkat_pmdp;
		?>
<table width="100%">
	<tr>
		<td width="60px" style="padding-bottom: 0px; padding-right: 0px;"><img src="<?php echo base_url();?>/assets/images/logo/logo.png" style="width: 90px; height: 90;"></td>
		<td colspan="5" style="padding-bottom: 0px; padding-left: 0px;"><center><h5><font style="font-size: 14px;">PANITIA PENERIMAAN MAHASISWA BARU</font><br><font style="font-size: 16px;">SEKOLAH TINGGI ILMU FARMASI NUSAPUTERA SEMARANG</font><br><font style="font-size: 14px;">TAHUN AKADEMIK <?php $tgl = date('Y'); echo $tgl." - ".$tgl_1;?></font><br><font style="font-size: 12px;">JL. MEDOHO III NO. 2 SEMARANG, TELP/FAX (024)6747012</font></h5></center></td>
	</tr>
	<tr><td colspan="6" style="padding-top: 0px;"><img src="<?php echo base_url('assets/images/line.jpg')?>"></td></tr>
	<tr><td colspan="6"><p><font style="font-size: 14px;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;Semarang, <?php echo date('d-m-Y');?><br>
	No&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;: 001/S-D/P-PMB/AKFAR-IX/<?php echo $nomor_pendaftaran = $c->nopen; ?><br>
	Hal&emsp;&emsp;&emsp;&emsp; : Pemberitahuan Hasil Seleksi Uji Tulis dan Kebijakan Keuangan<br>
	Lampiran&emsp;&nbsp;: - <br><br>
	Kepada Yth.<br>
	Sdr.i <?php echo $c->nama ?><br>
	Di Tempat<br><br>
	&emsp;&emsp;Dengan Hormat,<br>
	<?php foreach($get_gelombang as $gel){
		$tgl_akhir = $gel->tgl_akhir;?>
	Berdasarkan hasil Seleksi Penerimaan Mahasiswa Baru Akademi Farmasi Nusaputera Gelombang <?php if($gel->nama_gel != "PMDP"){ $gelombang = explode(' ', $gel->nama_gel_long);
	echo $gelombang[1];}else{
		echo $gel->nama_gel_long;
		}?> Tahun Akademik <?php $tgl = date('Y'); echo $tgl." - ".$tgl_1;?><br>
	Nama&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp; : <?php echo $c->nama ?><br>
	No. Pendaftaran&emsp;&emsp;&nbsp;&nbsp;&nbsp;: <?php echo $c->nopen ?><br>
	Program Studi&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;: <?php echo $this->bantuan->pilihan_prodi($c->pilihan1); ?>/<?php echo $this->bantuan->pilihan_prodi($c->pilihan2); ?><br>
	Jalur/Kelas&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;: <?php if($gel->nama_gel != "PMDP"){ echo "Umum/<strike>Khusus</strike>**)"; }else{
		echo "<strike>Umum/</strike>Khusus **)";
		}
	 }if($c->kelas == 1){ 
	 	echo "Reguler/<strike>Karyawan</strike>"; 
	 }else{
		echo "<strike>Reguler/</strike>Karyawan **)";
		}
	 ?><br>
	Nilai Tes Masuk&emsp;&emsp;&emsp;: <?php $gelombang_pend = $c->gelombang; $jalur = $c->jalur_pendaftaran; if(($c->jalur_pendaftaran != 2) || ($c->jalur_pendaftaran != 1))
												{
													foreach($get_nilai as $n){ 
													echo $nilai_score = $n->total_score; 
													}
												}echo $nilai_pmdp;?> 
												(dalam skala 100)<br><br></font>
	<font style="font-size: 18px">&emsp;&emsp;<b>DITERIMA / <strike>TIDAK DITERIMA</strike></b><br>&emsp;&emsp;SEBAGAI MAHASISWA SEKOLAH TINGGI ILMU FARMASI NUSAPUTERA</font><br><br><font style="font-size: 14px;">Berkaitan dengan hal tersebut, mahasiswa yang bersangkutan diberikan ketentuan sebagai berikut :<br>&emsp; •&emsp;<b>Melaksanakan Pembayaran I sampai dengan tanggal <?php $batas_date = date_create($tgl_tahap_1); echo date_format($batas_date,"d-m-Y"); ?></b><br>&emsp; •&emsp;<b>Besar SPI yang harus dibayarkan adalah RP <?php echo number_format($spi,2,',','.'); ?></b><br>&emsp;&emsp;&emsp;Dengan rincian pembayaran sebagai berikut : <br></font></p></td></tr>
	<?php } ?>
</table>
<?php
	foreach($get_sks as $u){?>
<table width="100%" class="table">
	<tr>
		<th class="th">No</th>
		<th class="th">Uraian Pembayaran</th>
		<th class="th">Nominal</th>
	</tr>
	<tr>
		<td class="td">&emsp;&nbsp;&nbsp;&nbsp;1</td>
		<td class="td">SPI</td>
		<td class="td">Rp.<?php if(strlen($spi) > 6){
							echo " ".number_format($spi,2,',','.');
						}else{
							echo "&emsp;&nbsp;".number_format($spi,2,',','.');
							} ?></td>
	</tr>
	<tr>
		<td class="td">&emsp;&nbsp;&nbsp;&nbsp;2</td>
		<td class="td">SKS</td>
		<td class="td">Rp.<?php if(strlen($sks) > 6){
							echo " ".number_format($sks,2,',','.');
						}else{
							echo "&emsp;&nbsp;".number_format($sks,2,',','.');
							} ?></td>
	</tr>
	<tr>
		<td class="td">&emsp;&nbsp;&nbsp;&nbsp;3</td>
		<td class="td">Operasional</td>
		<td class="td">Rp. <?php echo number_format($operasional,2,',','.');?></td>
	</tr>
	<tr>
		<td class="td">&emsp;&nbsp;&nbsp;&nbsp;4</td>
		<td class="td">Kemahasiswaan</td>
		<td class="td">Rp.&emsp;&nbsp;<?php echo number_format($kemahasiswaan,2,',','.');?></td>
	</tr>
	<tr>
		<td class="td">&emsp;&nbsp;&nbsp;&nbsp;5</td>
		<td class="td">Seragam dan Alat Praktikum</td>
		<td class="td">Rp. <?php echo number_format($seragam,2,',','.');?></td>
	</tr>
	<tr>
		<td class="td"></td>
		<td class="td"><b>Total Pembayaran</b></td>
		<td class="td"><b>Rp. <?php $total = $spi + $sks + $operasional + $kemahasiswaan + $seragam; echo number_format($total,2,',','.'); ?></b></td>
	</tr>
</table>
<?php } ?>
<p align="justify"><font style="font-size: 14px; text-align: justify;">Demikian &nbsp;pemberitahuan kami, &nbsp;untuk informasi lebih lanjut dapat &nbsp;menghubungi &nbsp;Sekretariat PMB Sekolah Tinggi Ilmu Farmasi Nusaputera, Jl. Medoho III No.2 Semarang, Telp. (024)6747012 atau untuk konfirmasi pembayaran transfer kepada Ketua Biro Administrasi Keuangan (BAK) Rima Oktaliani 085875650995. <br><br>Atas perhatiannya diucapkan terimakasih.<br><br>
&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Hormat Kami,<br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Ketua PMB<br><br><br><br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<u>Sri Suwarni,M.Sc.,Apt</u><br>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;NIP. 060707084</font></p>