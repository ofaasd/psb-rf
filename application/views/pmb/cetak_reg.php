<?php $tgl_1 = date('Y')+1; 
function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "SATU", "DUA", "TIGA", "EMPAT", "LIMA", "ENAM", "TUJUH", "DELAPAN", "SEMBILAN", "SEPULUH", "SEBELAS");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " BELAS";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." PULUH". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " SERATUS" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " RATUS" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " SERIBU" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " RIBU" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " JUTA" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " MILYAR" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " TRILYUN" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
	}
foreach($cetak as $c){
$nilai_pmdp = $c->peringkat_pmdp;
$gelombang_pend = $c->gelombang; 
$jalur = $c->jalur_pendaftaran;
foreach($get_nilai as $n){ 
	$nilai_score = $n->total_score; 
}
$keuangan = $this->db->get_where('pmb_keuangan', array('kelas' => $c->kelas))->row();
?>
<table width="100%">
	<tr>
		<td width="60px"><img src="<?php echo base_url();?>/assets/images/logo/logo.png" style="width: 90px; height: 90;"></td>
		<td colspan="4" width="400px"><center><h5>PANITIA PENERIMAAN MAHASISWA BARU <?php $tgl = date('Y'); echo $tgl." - ".$tgl_1;?><br><font style="font-size: 12px;">SEKOLAH TINGGI ILMU FARMASI NUSAPUTERA</font><br><font style="font-size: 10px;">JL. MEDOHO III NO. 2 TELP.(024)6747012, SEMARANG</font></h5></center><hr></td>
		<td rowspan="2">
			<table border="1" width="100%">
				<tr>
					<td width="125px"><font style="font-size: 12px;"><h5>PMDP RANK ...<br><?php if($c->kelas == 2){ echo "KARYAWAN"; }else if($c->kelas == 1){ echo "REGULER"; }else if($c->kelas == 3){ echo "RPL"; }else if($c->kelas == 4){ echo "KIMIA FARMA"; }?><br><?php echo $c->gelombang; ?></h5></font></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="5"><p><b><font style="font-size: 12px; text-align: center;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;SURAT PERNYATAAN</font></b></p><p><font style="font-size: 12px;text-align: left;">Yang bertandatangan dibawah ini : </font></p></td>
	</tr>
	<tr>
		<td></td>
		<td><p><font style="font-size: 12px;text-align: left;">Nama</font></p></td>
		<td>:</td>
		<td><p><font style="font-size: 12px;text-align: left;"><?php echo $c->nama ?></font></p></td>
	</tr>
	<tr>
		<td></td>
		<td><p><font style="font-size: 12px;text-align: left;">Alamat</font></p></td>
		<td>:</td>
		<td><p><font style="font-size: 12px;text-align: left;"><?php echo $c->alamat.",   RT 0".$c->rt." / 0".$c->rw; ?></font></p></td>
	</tr>
	<tr>
		<td></td>
		<td><p><font style="font-size: 12px;text-align: left;">No. Telp</font></p></td>
		<td>:</td>
		<td><p><font style="font-size: 12px;text-align: left;"><?php echo $c->hp ?></font></p></td>
	</tr>
	<tr>
		<td></td>
		<td><p><font style="font-size: 12px;text-align: left;">No Pendaftaran</font></p></td>
		<td>:</td>
		<td><p><font style="font-size: 12px;text-align: left;"><?php echo $nomor_pendaftaran = $c->nopen ?></font></p></td>
	</tr>
</table>
<p align="justify"><font style="font-size: 12px;">Menyatakan bahwa saya telah diterima sebagai <b>Mahasiswa Program Studi <?php echo $this->bantuan->pilihan_prodi($c->pilihan1); ?> / <?php echo $this->bantuan->pilihan_prodi($c->pilihan1); ?> di Sekolah Tinggi Ilmu Farmasi Nusaputera Semarang </b>Tahun Akademik <?php $tgl = date('Y'); echo $tgl." - ".$tgl_1;?>, untuk selanjutnya saya menyatakan bersedia mengikuti rangkaian kegiatan sebagai berikut : </font></p>
<table width="100%">
	<tr>
		<td><p><font style="font-size: 12px;">&emsp;1. </font></p></td>
		<td><p><font style="font-size: 12px;">Mengikuti Tes Kesehatan pada Instansi Pemerintah (Puskesmas) yang ditunjuk.</font></p></td>
	</tr>
	<tr>
		<td><p><font style="font-size: 12px;">&emsp;2. </font></p></td>
		<td ><p><font style="font-size: 12px; text-align: justify;">Menyelesaikan persyaratan administrasi yang telah ditentukan oleh Akademi Farmasi Nusaputera, sebagai berikut : </font></p></td>
	</tr>
	<tr>
		<td></td>
		<td>
			<table width="80%">
				<tr>
					<td><p><font style="font-size: 12px;">a. Sumbangan Pendidikan Institusi</font></p></td>
					<td><p><font style="font-size: 12px;">:</font></p></td>
					<td><p><font style="font-size: 12px;">Rp. <?php if(strlen($t->spi) > 6){
							echo number_format($t->spi,2,',','.');
						}else{
							echo "&emsp;".number_format($t->spi,2,',','.');
							} ?></font></p></td>
					<td></td>
				</tr>
				<tr>
					<td><p><font style="font-size: 12px;">b. Uang SKS</font></p></td>
					<td><p><font style="font-size: 12px;">:</font></p></td>
					<td><p><font style="font-size: 12px;">Rp. <?php if(strlen($t->sks)  > 6){
							echo number_format($t->sks,2,',','.');
						}else{
							echo "&emsp;".number_format($t->sks,2,',','.');
							} 

							$jumlah = ($t->spi + $t->sks + $t->operasional + $t->kemahasiswaan + $t->seragam)- $t->potongan_spi;?></font></p></td>
					<td></td>
				</tr>
				<tr>
					<td><p><font style="font-size: 12px;">c. Uang Oprasional</font></p></td>
					<td><p><font style="font-size: 12px;">:</font></p></td>
					<td><p><font style="font-size: 12px;">Rp. <?php echo number_format($t->operasional,2,',','.'); ?></font></p></td>
					<td></td>
				</tr>
				<tr>
					<td><p><font style="font-size: 12px;">d. Uang Kemahasiswaan</font></p></td>
					<td><p><font style="font-size: 12px;">:</font></p></td>
					<td><p><font style="font-size: 12px;">Rp.&emsp;&nbsp;<?php echo number_format($t->kemahasiswaan,2,',','.'); ?></font></p></td>
					<td></td>
				</tr>
				<tr>
					<td><p><font style="font-size: 12px;">e. Uang Seragam dan Alat</font></p></td>
					<td><p><font style="font-size: 12px;">:</font></p></td>
					<td><p><font style="font-size: 12px;">Rp. <?php echo number_format($t->seragam,2,',','.'); ?></font></p></td>
					<td><p><font style="font-size: 12px;"></font></p></td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2"><hr></td>
				</tr>
				<tr>
					<td><p><font style="font-size: 12px;"><b>JUMLAH</b></font></p></td>
					<td><p><font style="font-size: 12px;">:</font></p></td>
					<td><p><font style="font-size: 12px;"><b>Rp. <?php echo number_format($jumlah, 2,',','.');?></b></font></p></td>
				</tr>
				<tr>
					<td colspan="4"><p><font style="font-size: 12px;">TERBILANG : <?php echo terbilang($jumlah)." RUPIAH";?></font></p></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table width="100%">
	<tr>
		<td colspan="3"><p><font style="font-size: 12px;">Ketentuan : </font></p></td>
	</tr>
	<tr>
		<td colspan="3"><p><font style="font-size: 12px;">1.&nbsp;&nbsp;Pembayaran : </font></p></td>
	</tr>
	<tr>
		<td colspan="2" width="10px"></td>
		<td><p><font style="font-size: 12px; text-align: justify-all;">&nbsp;&nbsp;•&nbsp;&nbsp;Pembayaran yang dibayarkan pada Tahap I adalah 50% dari total pembayaran atau sesuai &nbsp;dengan &nbsp;kesepakatan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;yaitu sebesar <u><b>Rp. <?php echo number_format($t->jml_tahap_1, 2,',','.'); ?></b></u> dan akan dibayarkan paling lambat tanggal <u><b><?php echo date_format(date_create($t->tgl_tahap_1), 'd-m-Y'); ?></b></u></font></p></td>
	</tr>
	<tr>
		<td colspan="2" width="10px"></td>
		<td><p><font style="font-size: 12px; text-align: justify-all;">&nbsp;&nbsp;•&nbsp;&nbsp;Pembayaran yang dibayarkan pada Tahap II adalah 25% dari total pembayaran atau sesuai dengan &nbsp;kesepakatan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;yaitu sebesar <u><b>Rp. <?php echo number_format($t->jml_tahap_2, 2,',','.'); ?></b></u> dan akan dibayarkan paling lambat tanggal <u><b><?php echo date_format(date_create($t->tgl_tahap_2), 'd-m-Y'); ?></b></u></font></p></td>
	</tr>
	<tr>
		<td colspan="2" width="10px"></td>
		<td><p><font style="font-size: 12px; text-align: justify-all;">&nbsp;&nbsp;•&nbsp;&nbsp;Pembayaran yang dibayarkan pada Tahap III adalah 25% dari total pembayaran atau sesuai dengan kesepakatan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;yaitu sebesar <u><b>Rp. <?php echo number_format($t->jml_tahap_3, 2,',','.'); ?></b></u> dan akan dibayarkan paling lambat tanggal <u><b><?php echo date_format(date_create($t->tgl_tahap_3), 'd-m-Y'); ?></u></b></font></p></td>
	</tr>
	<tr>
		<td colspan="3" style="padding-top: 8px;"><p><font style="font-size: 12px; text-align: justify-all;">2.&nbsp;&nbsp;Biaya yang dibayarkan tidak dapat diminta kembali dengan alasan &nbsp;apapun, kecuali mahasiswa yang &nbsp;bersangkutan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;tidak lulus UN.</font></p></td>
	</tr>
	<tr>
		<td colspan="3" style="padding-top: 8px;"><p><font style="font-size: 12px; text-align: justify;">3.&nbsp;&nbsp;Biaya yang dibayarkan oleh calon mahasiswa baru yang tidak lulus UN akan dikembalikan, <i>kecuali : </i></font></p></td>
	</tr>
	<tr>
		<td colspan="3"><p><font style="font-size: 12px; text-align: justify;">&emsp;&emsp;•&nbsp;&nbsp;Uang Pendaftaran</font></p></td>
	</tr>
	<tr>
		<td colspan="3"><p><font style="font-size: 12px; text-align: justify;">&emsp;&emsp;•&nbsp;&nbsp;Uang Seragam</font></p></td>
	</tr>
	<tr>
		<td colspan="3" style="padding-top: 8px;"><p><font style="font-size: 12px; text-align: justify-all;">4.&nbsp;&nbsp;Bersedia &nbsp;menerima &nbsp;sanksi &nbsp;/ &nbsp;kosekuensi &nbsp;sesuai &nbsp;aturan yang diterapkan Akademi Farmasi Nusaputera Semarang &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;apabila jadwal pembayaran yang telah disepakati tidak ditepati.</font></p></td>
	</tr>
	<tr>
		<td colspan="3" style="padding-top: 8px;"><p><font style="font-size: 12px; text-align: justify;">Demikian surat pernyataan ini saya buat dengan sebenarnya dan untuk dipergunakan sebagaimana mestinya.</font></p></td>
	</tr>
	<tr>
		<td colspan="3" style="padding-top: 8px;"><p><font style="font-size: 12px; text-align: right;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;Semarang,<?php echo date('d-m-Y');?></font></p></td>
	</tr>
</table>
<table width="100%">
	<tr>
		<td><p><font style="font-size: 12px; ">Petugas Pendaftaran</font></p></td>
		<td width="200px"></td>
		<td><p><font style="font-size: 12px; ">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Yang Menyatakan</font></p></td>
	</tr>
	<tr>
		<td></td>
		<td width="200px"></td>
		<td><center><table border="1"><tr><td><p align="left">&nbsp;&nbsp;Materai&nbsp;&nbsp;<br>&nbsp;&nbsp;10000&nbsp;&nbsp;</p></td></tr></table></center></td>
	</tr>
	<tr>
		<td>......................</td>
		<td width="200px"></td>
		<td><p><font style="font-size: 12px; ">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;............................</font></p></td>
	</tr>
</table>
<?php 
} ?>
