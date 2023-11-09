<style>
    .input-group-prepend{
        background:#ecf0f1;
        padding:5px;
    }
    .wizard .content {
	    min-height: 100px;
	}
	.wizard .content > .body {
	    width: 100%;
	    height: auto;
	    padding: 15px;
	    position: relative;
	}
</style>
<style>
    .input-group-prepend{
        background:#ecf0f1;
        padding:5px;
    }
    .wizard .content {
	    min-height: 100px;
	}
	.wizard .content > .body {
	    width: 100%;
	    height: auto;
	    padding: 15px;
	    position: relative;
	}
</style>
<div class="card-block">
	<div class="row">
		<div class="col-md-12">
			<div id="wizard">
				<section>
					<form class="wizard-form" id="create-sanri-baru" action="#">
						<h3> Data Pribadi Calon Santri </h3>
						<fieldset>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="nik">NIK</label>
										<input type="text" name="nik" class="form-control" id="nik" value="<?=$psb_peserta->nik??''?>">
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
										<label for="nama_panggilan">Jenis Kelamin</label>
										<div class="form-check col-md-12" style="margin-left:10px;">
											<input type="radio" name="jenis_kelamin" class="form-check-input"  value='L' id="laki-laki" required>
											<label class="form-check-label" for="laki-laki">Laki-laki</label>
										</div>
										<div class="form-check col-md-12" style="margin-left:10px;">
											<input type="radio" name="jenis_kelamin" class="form-check-input" value='P' id="perempuan" required>
											<label class="form-check-label" for="perempuan">Perempuan</label>
										</div>
									</div>
									<div class="form-group">
										<label for="tempat_lahir">Tempat Lahir</label>
										<input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" value="<?=$user->tempat_lahir??''?>" required>
									</div>
									<div class="form-group">
										<label for="tanggal_lahir">Tanggal Lahir</label>
										<input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" value="<?=$user->tanggal_lahir??''?>" required>
									</div>
									<div class="form-group">
										<label for="usia_bulan">Usia</label>
										<div class="row" style="margin-left:0px;">
											<div class="col-md-2" style="padding:0">
												<input type="number" name="usia_tahun" class="form-control " id="usia_tahun" value="<?=$tahun_lahir??''?>" placeholder="Tahun" >
											</div>
											<div class="col-md-2" style="padding:5px">
												<label for="tempat_lahir">Tahun</label>
											</div>
											<div class="col-md-2" style="padding:0">
												<input type="number" name="usia_bulan" class="form-control" id="usia_bulan" value="<?=$bulan_lahir??''?>" placeholder="Bulan"  >
											</div>
											<div class="col-md-2" style="padding:5px">
												<label for="tempat_lahir">Bulan</label>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
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
												<option value="<?= $row->prov_id?>" ><?=$row->prov_name?></option>
											<?php } ?>
										</select>
									</div>
									<div class="form-group">
										<label for="kota">Kota</label>
										<select class="form-control" name="kota" id="kota">
											<option value=0>--Pilih Kota--</option>
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
								</div>
							</div>
							
									
						</fieldset>
						<h3> Data Wali Santri </h3>
						<fieldset>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="nama_ayah">Nama Ayah</label>
										<input type="text" name="nama_ayah" value="<?=$psb_wali->nama_ayah??''?>" class="form-control" id="nama_ayah">
									</div>
									<div class="form-group">
										<label for="pendidikan_ayah">Pendidikan Ayah</label>
										<select name="pendidikan_ayah" class="form-control" id="pendidikan_ayah">
											<option value=1 <?=(!empty($psb_wali) && $psb_wali->pendidikan_ayah == 1)?'selected':''?>>S2/S3</option>
											<option value=2 <?=(!empty($psb_wali) && $psb_wali->pendidikan_ayah == 2)?'selected':''?>>S1</option>
											<option value=3 <?=(!empty($psb_wali) && $psb_wali->pendidikan_ayah == 3)?'selected':''?>>Diploma</option>
											<option value=4 <?=(!empty($psb_wali) && $psb_wali->pendidikan_ayah == 4)?'selected':''?>>SMA/MA</option>
											<option value=5 <?=(!empty($psb_wali) && $psb_wali->pendidikan_ayah == 5)?'selected':''?>>SMP/MTs</option>
											<option value=6 <?=(!empty($psb_wali) && $psb_wali->pendidikan_ayah == 6)?'selected':''?>>SD/MI</option>
										</select>
									</div>
									<div class="form-group">
										<label for="pekerjaan_ayah">Pekerjaan Ayah</label>
										<input type="text" name="pekerjaan_ayah" value="<?=$psb_wali->pekerjaan_ayah??''?>" class="form-control" id="pekerjaan_ayah">
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
											<option value=1 <?=(!empty($psb_wali) && $psb_wali->pendidikan_ibu == 1)?'selected':''?>>S2/S3</option>
											<option value=2 <?=(!empty($psb_wali) && $psb_wali->pendidikan_ibu == 2)?'selected':''?>>S1</option>
											<option value=3 <?=(!empty($psb_wali) && $psb_wali->pendidikan_ibu == 3)?'selected':''?>>Diploma</option>
											<option value=4 <?=(!empty($psb_wali) && $psb_wali->pendidikan_ibu == 4)?'selected':''?>>SMA/MA</option>
											<option value=5 <?=(!empty($psb_wali) && $psb_wali->pendidikan_ibu == 5)?'selected':''?>>SMP/MTs</option>
											<option value=6 <?=(!empty($psb_wali) && $psb_wali->pendidikan_ibu == 6)?'selected':''?>>SD/MI</option>
										</select>
									</div>
									<div class="form-group">
										<label for="pekerjaan_ibu">Pekerjaan ibu</label>
										<input type="text" name="pekerjaan_ibu" value="<?=$psb_wali->pekerjaan_ibu??''?>" class="form-control" id="pekerjaan_ibu">
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
						</fieldset>
						<h3> Sekolah Asal </h3>
						<fieldset >
							<div class="form-group">
								<label for="jenjang">Dari</label>
								<select name="jenjang" class="form-control col-md-2" id="jenjang">
									<option value=1 <?=(!empty($psb_sekolah) && $psb_sekolah->jenjang == 1)?'selected':''?>>TK</option>
									<option value=2 <?=(!empty($psb_sekolah) && $psb_sekolah->jenjang == 2)?'selected':''?>>RA</option>
									<option value=3 <?=(!empty($psb_sekolah) && $psb_sekolah->jenjang == 3)?'selected':''?>>SD/MI</option>
									
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
						</fieldset>
					</form>			
				</section>				
			</div>					
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		

		function adjustIframeHeight() {
			var $body   = $('body'),
				$iframe = $body.data('iframe.fv');
			if ($iframe) {
				// Adjust the height of iframe
				$iframe.height($body.height());
			}
		}
		var form = $("#create-sanri-baru").show();

		form.steps({
			headerTag: "h3",
			bodyTag: "fieldset",
			transitionEffect: "slideLeft",
			onStepChanging: function(event, currentIndex, newIndex) {

				// Allways allow previous action even if the current form is not valid!
				if (currentIndex > newIndex) {
					return true;
				}
				// Forbid next action on "Warning" step if the user is to young
				if (newIndex === 3 && Number($("#page-2").val()) < 18) {
					return false;
				}
				// Needed in some cases if the user went back (clean up)
				if (currentIndex < newIndex) {
					// To remove error styles
					form.find(".body:eq(" + newIndex + ") label.error").remove();
					form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
				}
				form.validate().settings.ignore = ":disabled,:hidden";
				return form.valid();
			},
			onStepChanged: function(event, currentIndex, priorIndex) {

				// Used to skip the "Warning" step if the user is old enough.
				if (currentIndex === 2 && Number($("#age-2").val()) >= 18) {
					form.steps("next");
				}
				// Used to skip the "Warning" step if the user is old enough and wants to the previous step.
				if (currentIndex === 2 && priorIndex === 3) {
					form.steps("previous");
				}
			},
			onFinishing: function(event, currentIndex) {

				form.validate().settings.ignore = ":disabled";
				return form.valid();
			},
			onFinished: function(event, currentIndex) {
					//simpan data saat selesai
					//var npp = $("#initial_npp").val()+$("#nip").val();
					$.ajax({
						url : "<?php echo $url_insert_all ?>",
						method : "POST",
						data : form.serialize(),
						success: function(data){
							//alert("data berhasil disimpan"); 	
							switch(data){
								case "0" : 
									localStorage.setItem("msg", "Data Gagal Disimpan terdaftar");
									break;
								case "1" : 
									localStorage.setItem("msg", "Data berhasil disimpan");
									break;
								case "2" : 
									localStorage.setItem("msg", "Data sudah terdaftar");
									break;
							}
							window.location.href="<?php echo $redirect1 ?>";
							
							console.log(typeof(data));
						}
						
					});
			}
			}).validate({
			errorPlacement: function errorPlacement(error, element) {

				element.before(error);
			},
			rules: {
				confirm: {
					equalTo: "#password-2"
				}
			}
		});
		$("#provinsi").select2();
		$("#kota").select2();
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
	});
</script>
			