<table width="100%">
	<tr>
		<td width="60px"><img src="<?php echo base_url();?>/assets/images/logo/logo.png" style="width: 100px; height: 100;"></td>
		<td colspan="3"><center><h2>FORMULIR PENDAFTARAN<br>SEKOLAH TINGGI ILMU FARMASI NUSAPUTERA</h2><p>Alamat : Jalan Medoho 3 No.1,Gayamsari,Semarang || Email : akfarnusaputera@gmail.com || Telp. (024)6747012 <br> Website: http://www.stifera.ac.id</p></center></td>
	</tr>
	<tr>
		<td colspan="4"><img src="<?php echo base_url('assets/images/line.jpg')?>"></td>
	</tr>
</table>
<table width="80%">
<?php foreach($cetak as $c){?>
	<tr>
		<td colspan="3"><h4>&emsp;A. Data Pribadi</h4></td>
	</tr>
	<tr>
		<td>&emsp;&emsp;&emsp;Gelombang Pedaftaran</td>
		<td> : </td>
		<td> <?php echo $data['gelombang']; ?> </td>
	</tr>
	<tr>
		<td>&emsp;&emsp;&emsp;Nomor Pedaftaran</td>
		<td> : </td>
		<td> <?php echo $c->nopen ?> </td>
	</tr>
	<tr>
		<td>&emsp;&emsp;&emsp;Nomor KTP</td>
		<td> : </td>
		<td> <?php echo $c->noktp ?> </td>
	</tr>
	<tr>
		<td>&emsp;&emsp;&emsp;NISN</td>
		<td> : </td>
		<td> <?php echo $c->nisn ?> </td>
	</tr>
	<tr>
		<td>&emsp;&emsp;&emsp;Nama Lengkap</td>
		<td> : </td>
		<td> <?php echo $c->nama ?> </td>
	</tr>
	<tr>
		<td>&emsp;&emsp;&emsp;Jenis Kelamin</td>
		<td> : </td>
		<td> <?php if($c->jk == 1){echo "Laki - Laki";}else{echo "Perempuan";} ?> </td>
	</tr>
	<tr>
		<td>&emsp;&emsp;&emsp;Agama</td>
		<td> : </td>
		<td> <?php if($c->agama == 1){echo "Islam";}else if($c->agama == 2){echo "Kristen";}else if($c->agama == 3){echo "Katolik"; }else if($c->agama == 4){echo "Hindu";}else if($c->agama == 5){echo "Budha";}else if($c->agama == 6){echo "Konghucu";}else if($c->agama == 99){echo "Lainnya"; } ?> </td>
	</tr>
	<tr>
		<td>&emsp;&emsp;&emsp;Nama Ibu</td>
		<td> : </td>
		<td> <?php echo $c->nama_ibu ?> </td>
	</tr>
	<tr>
		<td>&emsp;&emsp;&emsp;Nama Ayah</td>
		<td> : </td>
		<td> <?php echo $c->nama_ayah ?> </td>
	</tr>
	<tr>
		<td>&emsp;&emsp;&emsp;Tinggi Badan</td>
		<td> : </td>
		<td> <?php echo $c->tinggi_badan ?> CM </td>
	</tr>
	<tr>
		<td>&emsp;&emsp;&emsp;Berat Badan</td>
		<td> : </td>
		<td> <?php echo $c->berat_badan ?> KG</td>
	</tr>
	<tr>
		<td>&emsp;&emsp;&emsp;Tempat & Tanggal Lahir</td>
		<td> : </td>
		<td> <?php echo $c->tempat_lahir ?>, <?php $tgl = date_create($c->tanggal_lahir); echo date_format($tgl, "d-m-Y"); ?> </td>
	</tr>
	<tr>
		<td>&emsp;&emsp;&emsp;Nomor Telpon</td>
		<td> : </td>
		<td> <?php echo $c->telpon ?></td>
	</tr>
	<tr>
		<td>&emsp;&emsp;&emsp;Nomor HP</td>
		<td> : </td>
		<td> <?php echo $c->hp ?></td>
	</tr>
	<tr>
		<td>&emsp;&emsp;&emsp;Alamat</td>
		<td> : </td>
		<td> <?php echo $c->alamat ?>,&emsp;&emsp;RT : <?php echo $c->rt ?>&emsp; RW : <?php echo $c->rw ?></td>
	</tr>
	<tr>
		<td>&emsp;&emsp;&emsp;Kelurahan</td>
		<td> : </td>
		<td> <?php echo $c->kelurahan ?></td>
	</tr>
	<tr>
		<td>&emsp;&emsp;&emsp;Kecamatan</td>
		<td> : </td>
		<td> <?php echo $data['nm_kec']; ?></td>
	</tr>
	<tr>
		<td>&emsp;&emsp;&emsp;Kota / Kabupaten</td>
		<td> : </td>
		<td> <?php echo $data['nm_kab']; ?></td>
	</tr>
	<tr>
		<td>&emsp;&emsp;&emsp;Provinsi</td>
		<td> : </td>
		<td> <?php echo $data['nm_prop']; ?></td>
	</tr>
	<tr>
		<td>&emsp;&emsp;&emsp;Warga Negara</td>
		<td> : </td>
		<td> <?php echo $data['nama_negara']; ?></td>
	</tr>
	<tr>
		<td>&emsp;&emsp;&emsp;Kode POS</td>
		<td> : </td>
		<td> <?php echo $c->kodepos ?></td>
	</tr>
	<tr>
		<td colspan="3"><br><h4>&emsp;B. Pendidikan Terakhir</h4></td>
	</tr>
	<tr>
		<td>&emsp;&emsp;&emsp;Asal Sekolah</td>
		<td> : </td>
		<td> <?php echo $data['nm_sekolah']; ?> </td>
	</tr>
	<tr>
		<td>&emsp;&emsp;&emsp;Kelas Dipilih</td>
		<td> : </td>
		<td> <?php if($c->kelas == 1){echo "Reguler";}else if($c->kelas == 2){echo "Karyawan";}else if($c->kelas == 3){echo "RPL";}else if($c->kelas == 4){echo "Kimia Farma";} ?></td>
	</tr>
	<tr>
		<td>&emsp;&emsp;&emsp;Jenis Pendaftaran</td>
		<td> : </td>
		<td> <?php if($c->jenis_pendaftaran == 1){echo "Peserta Didik Baru";}else if($c->jenis_pendaftaran == 2){echo "Pindahan";}else if($c->jenis_pendaftaran == 11){echo "Alih Jenjang";}else if($c->jenis_pendaftaran == 12){echo "Lintas Jalur";} ?></td>
	</tr>
	<tr>
		<td>&emsp;&emsp;&emsp;Pilihan Pertama</td>
		<td> : </td>
		<td> <?php echo $this->bantuan->pilihan_prodi($c->pilihan1); ?> </td>
	</tr>
	<tr>
		<td>&emsp;&emsp;&emsp;Pilihan Kedua</td>
		<td> : </td>
		<td> <?php echo $this->bantuan->pilihan_prodi($c->pilihan2); ?> </td>
	</tr>
	<tr>
		<td colspan="3"><br><br>&emsp;&emsp;&emsp;<img src="<?php echo base_url().'assets/foto_pmb_peserta/'.$c->foto_peserta;?>" style="width:125px;height:180px;border: 5px;" ></td>
	</tr>
<?php }?>
</table>