<div class="page-body">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-md-2">
							<a href="<?=base_url('psb/index')?>" class="btn btn-primary"><i class='fa fa-arrow-left'></i></a>
						</div>
						<div class="col-md-8">
							<h4 class="text-center">Formulir Pendaftaran Calon Santri Baru</h4>
						</div>
						<div class="col-md-2">

						</div>
					</div>
					
				</div>
				<div class="card-body">
					<form action="javascript:void(0)" method="post" id="form_pendaftaran">
						<input type="hidden" name="id" value="<?=(!empty($id))?$id:""?>">
						<h4>Data Santri Baru</h4>
						<div class="form-group">
							<label for="nik">NIK</label>
							<input type="text" name="nik" class="form-control" id="nik" value="<?=$psb_peserta->nik??''?>" required>
						</div>
						<div class="form-group">
							<label for="nama">Nama Lengkap</label>
							<input type="text" name="nama" class="form-control" id="nama" value="<?=$psb_peserta->nama??''?>" required>
						</div>
						<div class="form-group">
							<label for="nama_panggilan">Nama Panggilan</label>
							<input type="text" name="nama_panggilan" class="form-control" value="<?=$psb_peserta->nama_panggilan??''?>" id="nama_panggilan">
						</div>
						<div class="form-group">
							<label for="nama_panggilan">Jenis Kelamin</label><br />
							<div class="form-check col-md-12" style="margin-left:10px;">
								<input type="radio" name="jenis_kelamin" class="form-check-input" <?=($psb_peserta->jenis_kelamin == 'L')?'checked':''?> value='L' id="laki-laki" required>
								<label class="form-check-label" for="laki-laki">Laki-laki</label>
							</div>
							<div class="form-check col-md-12" style="margin-left:10px;">
								<input type="radio" name="jenis_kelamin" class="form-check-input" <?=($psb_peserta->jenis_kelamin == 'P')?'checked':''?> value='P' id="perempuan" required>
								<label class="form-check-label" for="perempuan">Perempuan</label>
							</div>
						</div>
						<div class="form-group">
							<label for="tempat_lahir">Tempat Lahir</label>
							<input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" value="<?=$psb_peserta->tempat_lahir??''?>" required>
						</div>
						<div class="form-group">
							<label for="tanggal_lahir">Tanggal Lahir</label>
							<input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" value="<?=$psb_peserta->tanggal_lahir??''?>" required>
						</div>
						<div class="form-group">
							<label for="usia_bulan">Usia</label>
							<div class="row" style="margin-left:0px;">
								<input type="number" name="usia_tahun" class="form-control col-md-2" id="usia_tahun" value="<?=$psb_peserta->usia_tahun??''?>" placeholder="Tahun">
								<input type="number" name="usia_bulan" class="form-control col-md-2" id="usia_bulan" value="<?=$psb_peserta->usia_bulan??''?>" placeholder="Bulan" style="margin-left:10px;">
							</div>
						</div>
						<div class="form-group">
							<label for="jumlah_saudara">Jumlah Saudara Kandung</label>
							<input type="number" name="jumlah_saudara" class="form-control" id="jumlah_saudara" value="<?=$psb_peserta->jumlah_saudara??''?>">
						</div>
						<div class="form-group">
							<label for="anak_ke">Anak ke</label>
							<input type="number" name="anak_ke" class="form-control" id="anak_ke" value="<?=$psb_peserta->anak_ke??''?>">
						</div>
						<div class="form-group">
							<label for="alamat">Alamat Lengkap</label>
							<textarea class="form-control" name="alamat" id="alamat"><?=$psb_peserta->alamat??''?></textarea>
						</div>
						<div class="form-group">
							<label for="provinsi">Provinsi</label>
							<select class="form-control" name="provinsi" id="provinsi">
								<option value=0>--Pilih Provinsi--</option>
								<?php foreach($provinsi as $row){?>
									<option value="<?= $row->prov_id?>" <?=($psb_peserta->prov_id == $row->prov_id)?'selected':''?>><?=$row->prov_name?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="kota">Kota</label>
							<select class="form-control" name="kota" id="kota">
								<option value=0>--Pilih Kota--</option>
								<?php if(!empty($kota)) { 
									foreach($kota as $row){
									?>
									<option value="<?=$row->city_id?>" <?=($psb_peserta->kota_id == $row->city_id)?'selected':''?>><?=$row->city_name?></option>
								<?php }} ?>	
							</select>
						</div>
						<div class="form-group">
							<label for="kecamatan">Kecamatan</label>
							<input type="text" name="kecamatan" class="form-control" value="<?=$psb_peserta->kecamatan??''?>" id="kecamatan">
						</div>
						<div class="form-group">
							<label for="kelurahan">Keluarahan/Desa</label>
							<input type="text" name="kelurahan" class="form-control" value="<?=$psb_peserta->kelurahan??''?>" id="kelurahan">
						</div>
						<h4>Data Wali Santri</h4>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="nama_ayah">Nama Ayah</label>
									<input type="text" name="nama_ayah" value="<?=$psb_wali->nama_ayah??''?>" class="form-control" id="nama_ayah">
								</div>
								<div class="form-group">
									<label for="pendidikan_ayah">Pendidikan Ayah</label>
									<select name="pendidikan_ayah" class="form-control" id="pendidikan_ayah">
										<option value=1 <?=($psb_wali->pendidikan_ayah == 1)?'selected':''?>>S2/S3</option>
										<option value=2 <?=($psb_wali->pendidikan_ayah == 2)?'selected':''?>>S1</option>
										<option value=3 <?=($psb_wali->pendidikan_ayah == 3)?'selected':''?>>Diploma</option>
										<option value=4 <?=($psb_wali->pendidikan_ayah == 4)?'selected':''?>>SMA/MA</option>
										<option value=5 <?=($psb_wali->pendidikan_ayah == 5)?'selected':''?>>SMP/MTs</option>
										<option value=6 <?=($psb_wali->pendidikan_ayah == 6)?'selected':''?>>SD/MI</option>
									</select>
								</div>
								<div class="form-group">
									<label for="pekerjaan_ayah">Pekerjaan Ayah</label>
									<input type="text" name="nama_pekerjaan_ayahayah" value="<?=$psb_wali->pekerjaan_ayah??''?>" class="form-control" id="pekerjaan_ayah">
								</div>
								<div class="form-group">
									<label for="alamat_ayah">Alamat Lengkap</label>
									<textarea name="alamat_ayah" class="form-control" id="alamat_ayah"><?=$psb_wali->alamat_ayah??''?></textarea>
								</div>
								<div class="form-group">
									<label for="no_hp">No. Handphone (WA)</label>
									<input type="text" name="no_hp" class="form-control" value="<?=$psb_wali->no_hp??''?>" id="no_hp" />
								</div>		
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="nama_ibu">Nama ibu</label>
									<input type="text" name="nama_ibu" class="form-control" value="<?=$psb_wali->nama_ibu??''?>" id="nama_ibu">
								</div>
								<div class="form-group">
									<label for="pendidikan_ibu">Pendidikan ibu</label>
									<select name="pendidikan_ibu" class="form-control" id="pendidikan_ibu">
										<option value=1 <?=($psb_wali->pendidikan_ibu == 1)?'selected':''?>>S2/S3</option>
										<option value=2 <?=($psb_wali->pendidikan_ibu == 2)?'selected':''?>>S1</option>
										<option value=3 <?=($psb_wali->pendidikan_ibu == 3)?'selected':''?>>Diploma</option>
										<option value=4 <?=($psb_wali->pendidikan_ibu == 4)?'selected':''?>>SMA/MA</option>
										<option value=5 <?=($psb_wali->pendidikan_ibu == 5)?'selected':''?>>SMP/MTs</option>
										<option value=6 <?=($psb_wali->pendidikan_ibu == 6)?'selected':''?>>SD/MI</option>
									</select>
								</div>
								<div class="form-group">
									<label for="pekerjaan_ibu">Pekerjaan ibu</label>
									<input type="text" name="nama_pekerjaan_ibuibu" value="<?=$psb_wali->pekerjaan_ibu??''?>" class="form-control" id="pekerjaan_ibu">
								</div>
								<div class="form-group">
									<label for="alamat_ibu">Alamat Lengkap</label>
									<textarea name="alamat_ibu" class="form-control" id="alamat_ibu"><?=$psb_wali->alamat_ibu??''?></textarea>
								</div>
								<div class="form-group">
									<label for="no_telp">No. Telpon</label>
									<input type="text" name="no_telp" class="form-control" value="<?=$psb_wali->no_telp??''?>" id="no_telp" />
								</div>		
							</div>
						</div>				
						<h4>Sekolah Asal/Pindahan</h4>
						<div class="form-group">
							<label for="jenjang">Dari</label>
							<select name="jenjang" class="form-control col-md-2" id="jenjang">
								<option value=1 <?=($psb_sekolah->jenjang == 1)?'selected':''?>>TK</option>
								<option value=2 <?=($psb_sekolah->jenjang == 2)?'selected':''?>>RA</option>
								<option value=3 <?=($psb_sekolah->jenjang == 3)?'selected':''?>>SD/MI</option>
								
							</select>
						</div>
						<div class="form-group">
							<label for="kelas">Kelas Terakhir</label>
							<input type="text" name="kelas" class="form-control col-md-6" value="<?=$psb_sekolah->kelas??''?>" id="kelas" placeholder="Cth: TK B/SD Kelas 3">
						</div>
						<div class="form-group">
							<label for="nama_sekolah">Nama Sekolah</label>
							<input type="text" name="nama_sekolah" class="form-control col-md-6" value="<?=$psb_sekolah->nama_sekolah??''?>" id="nama_sekolah" placeholder="Cth: TK Tunas Bakti">
						</div>
						
						<div class="form-group">
							<label for="nss">NSM/NSS</label>
							<input type="text" name="nss" class="form-control col-md-6" id="nss" value="<?=$psb_sekolah->nss??''?>" placeholder="">
						</div>
						<div class="form-group">
							<label for="npsn">NPSN</label>
							<input type="text" name="npsn" class="form-control col-md-6" id="npsn" value="<?=$psb_sekolah->npsn??''?>" placeholder="">
						</div>
						<div class="form-group">
							<label for="nisn">NISN</label>
							<input type="text" name="nisn" class="form-control col-md-6" id="nisn" value="<?=$psb_sekolah->nisn??''?>" placeholder="">
						</div>
						<input type="submit" value="simpan" class="btn btn-primary">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$("#provinsi").select2();
		$("#kota").select2();

	});
	$("#form_pendaftaran").submit(function(e){
		e.preventDefault();
		const data = $(this).serialize();
		console.log(data);
		$.ajax({
			url:"<?= base_url('psb/simpan')?>",
			data:data,
			method:"POST",
			success : function (data){
				window.scrollTo(0, 0);
				if(data == 1){
					$(".card-body").prepend("<div class='alert bg-success text-light'>Data Berhasil Disimpan</div>")
				}else if(data == 2){
					$(".card-body").prepend("<div class='alert bg-danger text-light'>Data Sudah Pernah Dimasukan Seblumnya</div>")
				}else{
					$(".card-body").prepend("<div class='alert bg-danger text-light'>Data Gagal Disimpan</div>")
				}
			}
		})
	})
	$("#provinsi").change(function(){
		
		$.ajax({
			url:"<?= base_url('psb/get_kota')?>",
			data:{id : $(this).val()},
			method:"POST",
			success : function (data){
				$("#kota").html(data);
			}
		});
	});
</script>
