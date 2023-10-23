                    <style>
                            * {
                              box-sizing: border-box;
                            }

                            body {
                              background-color: #f1f1f1;
                            }

                            #regForm {
                              background-color: #ffffff;
                              margin-left: 10px;
                              font-family: Raleway;
                              padding: 40px;
                              width: 100%;
                              min-width: 300px;
                            }

                            h1 {
                              text-align: center;  
                            }

                            input {
                              padding: 10px;
                              width: 100%;
                              font-size: 17px;
                              font-family: Raleway;
                              border: 1px solid #aaaaaa;
                            }

                            /* Mark input boxes that gets an error on validation: */
                            input.invalid {
                              background-color: #ffdddd;
                            }

                            /* Hide all steps by default: */
                            .tab {
                              display: none;
                            }

                            button {
                              background-color: #4CAF50;
                              color: #ffffff;
                              border: none;
                              padding: 10px 20px;
                              font-size: 17px;
                              font-family: Raleway;
                              cursor: pointer;
                            }

                            button:hover {
                              opacity: 0.8;
                            }

                            #prevBtn {
                              background-color: #bbbbbb;
                            }

                            /* Make circles that indicate the steps of the form: */
                            .step {
                              height: 15px;
                              width: 15px;
                              margin: 0 2px;
                              background-color: #bbbbbb;
                              border: none;  
                              border-radius: 50%;
                              display: inline-block;
                              opacity: 0.5;
                            }

                            .step.active {
                              opacity: 1;
                            }

                            /* Mark the steps that are finished and valid: */
                            .step.finish {
                              background-color: #4CAF50;
                            }
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
					<form id="create-pegawai" class="wizard-form" action="<?php echo base_url()?>formulir/cmhs_tambah_aksi" method="post" enctype="multipart/form-data">
						<h3> Informasi Pribadi </h3>
						<fieldset>
							<div class="row">
								<div class="col-sm-6">
									Nomor KTP <span class="text-danger">*</span> :
									<p><input type="number" class="form-control" placeholder="Nomor KTP" oninput="this.className = ''" name="ktp" required=""></p>
									NISN <span class="text-danger">*</span> :
									<p><input type="number" class="form-control" placeholder="NISN" oninput="this.className = ''" name="nisn" required="">
									Tidak Tahu NISN anda? <a href="https://nisn.data.kemdikbud.go.id/page/data" target="_blank">cek DISINI</a></p>
									Nama Lengkap <span class="text-danger">*</span> :
									<p><input type="text" class="form-control" placeholder="Nama Lengkap" oninput="this.className = ''" name="nama" required=""></p>
									Jenis Kelamin <span class="text-danger">*</span> :
									<p>
										<select name="jk" class="form-control" required="">
											<option selected="" disabled="">Jenis Kelamin</option>
											<option value="1">Laki - Laki</option>
											<option value="2">Perempuan</option>
										</select>
									</p>
									Agama <span class="text-danger">*</span> :
									<p>
										<select name="agama" class="form-control" required="">
											<option value="opt1" selected="" disabled="">Pilih Agama</option>
											<option value="1">Islam</option>
											<option value="2">Kristen</option>
											<option value="3">Katolik</option>
											<option value="4">Hindu</option>
											<option value="5">Budha</option>
											<option value="6">Konghucu</option>
											<option value="99">Lainnya</option>
										</select>
									</p>
									Nama Ibu <span class="text-danger">*</span> :
									<p><input type="text" class="form-control" placeholder="Nama Ibu" oninput="this.className = ''" name="ibu" required=""></p>
									Nama Ayah <span class="text-danger">*</span> :
									<p><input type="text" class="form-control" placeholder="Nama Ayah" oninput="this.className = ''" name="ayah" required=""></p>
									Nomor HP Orang Tua <span class="text-danger">*</span> :
									<p><input type="text" class="form-control" placeholder="Nomor HP Orang Tua" oninput="this.className = ''" name="hp_ortu" required=""></p>
									Alamat Semarang <span class="text-danger">*</span> :
									<p><textarea class="form-control" style="resize: none;" name="alamat_semarang" placeholder="Alamat Semarang" required="" ></textarea></p>
									Tinggi Badan <span class="text-danger">*</span> :
									<p><input type="number" class="form-control" placeholder="Tinggi Badan" oninput="this.className = ''" name="tb" required=""></p>
									Berat Badan <span class="text-danger">*</span> :
									<p><input type="number" class="form-control" placeholder="Berat Badan" oninput="this.className = ''" name="bb" required=""></p>
									Tempat Lahir <span class="text-danger">*</span> :
									<p><input type="text" class="form-control" placeholder="Tempat Lahir" oninput="this.className = ''" name="tl" required=""></p>
									Tanggal Lahir <span class="text-danger">*</span> :
									<p><input type="date" class="form-control" oninput="this.className = ''" name="tgl" required=""></p>
								</div>
								<div class="col-sm-6">
									Nomor Handphone <span class="text-danger">*</span> :
									<p><input type="text" class="form-control" placeholder="No Handphone" oninput="this.className = ''" name="hp" required=""></p>
									Nomor Telepon :
									<p><input type="text" class="form-control" placeholder="Nomor Telepon" oninput="this.className = ''" name="telepon" ></p>
									Status Warga Negara <span class="text-danger">*</span> :
									<p>
										<select name="warga_negara" id="wn" class="form-control" required="">
											<option selected="" disabled="">Pilih Warga Negara</option>
											<?php foreach($warga_negara as $w){?>
											<option value="<?php echo $w->id_negara?>"><?php echo $w->nm_negara ?></option>
											<?php } ?>
										</select>
									</p>
									Nama Provinsi <span class="text-danger">*</span> :
									<p>
										<select name="provinsi" id="provinsi" class="form-control" required="">
											<option selected="" disabled="">Pilih Provinsi</option>
											<?php foreach($wilayah as $w){?>
											<option value="<?php echo $w->id_wil ?>"><?php echo $w->nm_wil ?></option>
											<?php } ?>
										</select>
									</p>
									Nama Kota/Kabupaten <span class="text-danger">*</span> :
									<p>
										<select name="kotakab" id="kotakab" class="form-control" required=""> 
											<option selected="" disabled="">Pilih Kota/Kabupaten</option>
										</select>
									</p>
									Nama Kecamatan <span class="text-danger">*</span> :
									<p>
										<select name="kecamatan" id="kecamatan" class="form-control" required="">
											<option selected="" disabled="">Daftar Kecamatan</option>
										</select>
									</p>
									Kode POS <span class="text-danger">*</span> :
									<p><input type="text" class="form-control" placeholder="KODE POS" oninput="this.className = ''" name="pos" required=""></p>
									Nama Kelurahan <span class="text-danger">*</span> :
									<p><input type="text" class="form-control" placeholder="Nama Kelurahan" oninput="this.className = ''" name="kelurahan" required=""></p>
									Alamat <span class="text-danger">*</span> :
									<p><textarea class="form-control" style="resize: none;" name="alamat" placeholder="Hanya nama kampung, jalan dan nomor rumah saja" required="" ></textarea></p>
									<div class="row">
										<div class="col-sm-6">
											RT :
											<p><input type="text" class="form-control" placeholder="RT" oninput="this.className = ''" name="rt" required=""></p>
										</div>
										<div class="col-sm-6">
											RW :
											<p><input type="text" class="form-control" placeholder="RW" oninput="this.className = ''" name="rw" required=""></p>
										</div>
									</div>
									Sekolah Asal <span class="text-danger">*</span> :
									<p><select name="asal_sekolah" id="asal_sekolah" class="form-control js-example-basic-single" required="">
									</select></p>
									<div id="tambah-sekolah"></div>
									<div class="modal fade" id="modal_tambah_sekolah" tabindex="-1" role="dialog">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title">Tambah Sekolah</h4>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<div class="form-group">
														<label for="Nama Sekolah">Nama Sekolah</label>
														<input type="text" id="nama_sekolah" class="form-control">
														<input type="hidden" id="add_sekolah_provinsi" >
														<input type="hidden" id="add_sekolah_kota" >
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
													<button id="simpan_sekolah" type="button" class="btn btn-primary waves-effect waves-light ">Save changes</button> 
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</fieldset>
						<h3> Gelombang & Jalur </h3>
						<fieldset>
							<div class="row">
								<div class="col-md-12">
									Tahun Ajaran :
									<p>
										<?php 
										$curr_ta = "";
										$gel_ta = $this->db->get('pmb_ta')->result();
										foreach($gel_ta as $gel_ta){
											if($gel_ta->is_active == 1){
												$curr_ta = $gel_ta->awal;
											}
										} ?>
										<input type="text" class="form-control" name="gel_ta" value="<?php echo $curr_ta?>" readonly>
									</p>
									
									PILIH KELAS<span class="text-danger">*</span> :
									<p><select id="kelas" name="kelas" class="form-control" required="">
											<option value="opt1" selected="" disabled="">- Pilih Kelas -</option>
											<?php foreach($kelas as $kel){?>
											<option value="<?php echo $kel->jalur."-".$kel->id; ?>"><?php echo $kel->nama_kelas ?></option>
											<?php } ?>
										</select></p>
									PILIH JALUR<span class="text-danger">*</span> :
									<p><select id="jalur" name="jalur" class="form-control"  required="">
										</select></p>
										<div id="kerdiv" hidden="">
											JENIS KERJASAMA (JIKA JALUR KERJSAMA) :
											<p><select id="kerjasama" name="kerjasama" class="form-control">
												</select></p>
										</div>
									<div id="skl_mou" hidden="">
										<p id="mou_akfar"></p>
									</div>
									
									<div id="gel_text">PILIH GELOMBANG<span class="text-danger">*</span> :
										<p><select name="gelombang" id="gelombang" class="form-control" required="">
											<option selected="" disabled="">Gelombang Pendaftaran</option>
										<?php foreach($gelombang as $g){?>
											<option value="<?php echo $g->id ?>"><?php echo $g->nama_gel_long ?></option>
										<?php } ?>
										</select></p>
									</div>
								</div>
							</div>
						</fieldset>
						<h3> Nilai & Prestasi </h3>
						<fieldset>
							<div class="row">
								<div class="col-md-12">
									NILAI RATA - RATA SEMESTER 1<span class="text-danger">*</span> :
									<p><input type="number" value="<?php echo (!empty($rapor->nilai_smt1))?$rapor->nilai_smt1:""?>" placeholder="NILAI RATA - RATA SEMESTER 1" name="smt1" required="" class="form-control"></p>
									BERKAS RAPOR SEMESTER 1<span class="text-danger">*</span> :
									<p>
										<input type="file" name="file_smt1"  class="form-control" required=""><small>* File Max 1MB</small>
										<?php 
											if(!empty($rapor->file_smt1)){
												echo "<a href='" . base_url() . "assets/rapor/" . $rapor->file_smt1 . "' target='_blank' class='btn btn-primary btn-mini'>Lihat FIle</a>";
											}
										?>
									</p>
									NILAI RATA - RATA SEMESTER 2<span class="text-danger">*</span> :
									<p><input type="number" value="<?php echo (!empty($rapor->nilai_smt2))?$rapor->nilai_smt2:""?>" placeholder="NILAI RATA - RATA SEMESTER 2" name="smt2" required="" class="form-control"></p>
									BERKAS RAPOR SEMESTER 2<span class="text-danger">*</span> :
									<p>
										<input type="file" name="file_smt2"  class="form-control" required=""><small>* File Max 1MB</small>
										<?php 
											if(!empty($rapor->file_smt2)){
												echo "<a href='" . base_url() . "assets/rapor/" . $rapor->file_smt2 . "' target='_blank' class='btn btn-primary btn-mini'>Lihat FIle</a>";
											}
										?>
										
									</p>
									NILAI RATA - RATA SEMESTER 3<span class="text-danger">*</span> :
									<p><input type="number" value="<?php echo (!empty($rapor->nilai_smt3))?$rapor->nilai_smt3:""?>" placeholder="NILAI RATA - RATA SEMESTER 3" name="smt3" required="" class="form-control"></p>
									BERKAS RAPOR SEMESTER 3 :
									<p>
										<input type="file" name="file_smt3"  class="form-control" required=""><small>* File Max 1MB</small>
										<?php 
											if(!empty($rapor->file_smt3)){
												echo "<a href='" . base_url() . "assets/rapor/" . $rapor->file_smt3 . "' target='_blank' class='btn btn-primary btn-mini'>Lihat FIle</a>";
											}
										?>
									</p>
									NILAI RATA - RATA SEMESTER 4<span class="text-danger">*</span> :
									<p><input type="number" value="<?php echo (!empty($rapor->nilai_smt4))?$rapor->nilai_smt4:""?>" placeholder="NILAI RATA - RATA SEMESTER 4" name="smt4" required="" class="form-control"></p>
									BERKAS RAPOR SEMESTER 4 :
									<p>
										<input type="file" name="file_smt4"  class="form-control" required=""><small>* File Max 1MB</small>
										<?php 
											if(!empty($rapor->file_smt4)){
												echo "<a href='" . base_url() . "assets/rapor/" . $rapor->file_smt4 . "' target='_blank' class='btn btn-primary btn-mini'>Lihat FIle</a>";
											}
										?>
									</p>
									NILAI RATA - RATA SEMESTER 5<span class="text-danger">*</span> :
									<p><input type="number" value="<?php echo (!empty($rapor->nilai_smt5))?$rapor->nilai_smt5:""?>" placeholder="NILAI RATA - RATA SEMESTER 5" name="smt5" required="" class="form-control"></p>
									BERKAS RAPOR SEMESTER 5 :
									<p>
										<input type="file" name="file_smt5"  class="form-control" required=""><small>* File Max 1MB</small>
										<?php 
											if(!empty($rapor->file_smt5)){
												echo "<a href='" . base_url() . "assets/rapor/" . $rapor->file_smt5 . "' target='_blank' class='btn btn-primary btn-mini'>Lihat FIle</a>";
											}
										?>
									</p>
									SERTIFIKAT JUARA :
									<p><input type="file" name="file1"  class="form-control"></p>
									<p><input type="text" name="ket1" placeholder="Keterangan Sertifikat" class="form-control" value="<?php echo (!empty($piagam->ket1))?$piagam->ket1:""?>"></p>
									<p>
										<?php 
											if(!empty($piagam->file1)){
												echo "<a href='" . base_url() . "assets/sertifikat/" . $piagam->file1 . "' target='_blank' class='btn btn-primary btn-mini'>Lihat FIle</a>";
											}
										?>
									</p>
									SERTIFIKAT JUARA :
									<p><input type="file" name="file2" class="form-control"></p>
									<p><input type="text" name="ket2" placeholder="Keterangan Sertifikat" class="form-control" value="<?php echo (!empty($piagam->ket2))?$piagam->ket2:""?>"></p>
									<p>
										<?php 
											if(!empty($piagam->file2)){
												echo "<a href='" . base_url() . "assets/sertifikat/" . $piagam->file2 . "' target='_blank' class='btn btn-primary btn-mini'>Lihat FIle</a>";
											}
										?>
									</p>
									SERTIFIKAT JUARA :
									<p><input type="file" name="file3" class="form-control"></p>
									<p><input type="text" name="ket3" placeholder="Keterangan Sertifikat" class="form-control" value="<?php echo (!empty($piagam->ket3))?$piagam->ket3:""?>"></p>
									<p>
										<?php 
											if(!empty($piagam->file3)){
												echo "<a href='" . base_url() . "assets/sertifikat/" . $piagam->file3 . "' target='_blank' class='btn btn-primary btn-mini'>Lihat FIle</a>";
											}
										?>
									</p>
									Program Studi 1<span class="text-danger">*</span> : 
									<input type="hidden" value="1" name="pendaftaran" class="form-control" required="">
										<p><select name="pilihan1" class="form-control" required="">
										<option value="opt1" selected="" disabled="">- Pilih Program Studi 1 -</option>
										<?php foreach($prodi as $p){?>
										<option value="<?php echo $p->id ?>"><?php echo $p->jenjang." - ".$p->nama_jurusan ?></option>
										<?php } ?>
									</select></p>Program Studi 2 :
									<p><select name="pilihan2" class="form-control">
										<option value="opt1" selected="" disabled="">- Pilih Program Studi 1 -</option>
										<?php foreach($prodi as $p){?>
										<option value="<?php echo $p->id ?>"><?php echo $p->jenjang." - ".$p->nama_jurusan ?></option>
										<?php } ?>
									</select>
									</p>
								</div>
							</div>
						</fieldset>
						<h3> Foto </h3>
						<fieldset>
							<div class="row">
								<div class="col-md-12">
									<!-- bagian foto -->
									Dapat Info PMB darimana?
									  <p>
										  <select name="info_pmb" class="form-control" required="">
											<option value="opt1" selected="" disabled="">- Pilih -</option>
											<option value="1">Teman</option>
											<option value="2">Kerabat / Orang Tua</option>
											<option value="3">Sosial Media</option>
											<option value="4">Lainnya</option>
										  </select>
									  </p>
									  Ukuran Seragam
									  <p>
										  <select name="ukuran_seragam" class="form-control" required="">
											<option value="opt1" selected="" disabled="">- Pilih Ukuran Seragam -</option>
											<option value="S">S</option>
											<option value="M">M</option>
											<option value="L">L</option>
											<option value="XL">XL</option>
										  </select>
									  </p>
									  Upload Foto :
									  <p><input type='file' name="foto" onchange="readURL(this);" required="" />
										Maksimal 1 MB dengan background merah.</p>
									  <img id="blah" src="http://placehold.it/180" alt="your image" style="width:225px;height:280px;" />
									  <br><br><br>	
									
									<!--<div class="col-sm-2">
										<input type="submit" value="simpan" class="btn btn-primary">
									</div>-->
								</div>
							</div>
						</fieldset>
						<!--<h3> Jalur Pendaftaran </h3>
						<fieldset>
							
						</fieldset>-->
					</form>
				</section>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#blah')
				.attr('src', e.target.result);
		};

		reader.readAsDataURL(input.files[0]);
	}
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
	// If a field is empty...
	if (y[i].value == "") {
	  // add an "invalid" class to the field:
	  y[i].className += " invalid";
	  // and set the current valid status to false
	  valid = true;
	}
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
	document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
	x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
	$(document).ready(function(){
		
		
	    var form = $("#create-pegawai").show();

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
		      if (newIndex === 3 && Number($("#age-2").val()) < 18) {
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
		  		$("#create-pegawai").submit();
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
		$('#kelas').change(function(){
			var str = $(this).val();
			var str_explode = str.split('-');
			var kelas = str_explode[0];
			console.log(kelas);
			var isi = '';
			var data = '';
			if(kelas == 1){
				isi = '<option value="opt1" selected="" disabled="">- Pilih Jalur -</option><option value="1">PMDP</option><option value="2">Kerjasama</option><option value="3" selected>Umum</option>';
			}else if(kelas == 2){
				isi = '<option value="opt1" selected="" disabled="">- Pilih Jalur -</option><option value="3" selected>Umum</option><option value="2">Kerjasama</option>';
			}
			// $('#gelombang').html(data);
			$('#jalur').html(isi);
		});
		$('#jalur').change(function(){
			var pilihan = $(this).val();
			var get_kelas = $('#kelas').val();
			console.log(get_kelas);
			var str_explode = get_kelas.split('-');
			var kelas = str_explode[0];
			var hasil = '';
			if ((pilihan == 2) && (kelas == 1)) {
				hasil = '<option value="opt1" selected="" disabled="">- Pilih Kerjasama -</option><option value="1">MOU AKFAR</option><option value="2">Alumni SMK Nusaputera</option>';
				document.getElementById('kerdiv').hidden = false;
				document.getElementById('skl_mou').hidden = false;
			}else if((pilihan == 2) && (kelas == 2)){
				hasil = '<option value="opt1" selected="" disabled="">- Pilih Kerjasama -</option><option value="1">MOU AKFAR</option><option value="2">Alumni SMK Nusaputera</option><option value="3">PAFI</option><option value="4">Kimia Farma</option>';
				document.getElementById('kerdiv').hidden = false;
				document.getElementById('skl_mou').hidden = false;
			}else{
				document.getElementById('kerdiv').hidden = true;
				document.getElementById('skl_mou').hidden = true;
			}

			if (pilihan == 3) {
				document.getElementById('gel_text').hidden = false;
				document.getElementById('pmdp_text').hidden = true;
			}
			if (pilihan == 2) {
				document.getElementById('gel_text').hidden = false;
				//document.getElementById('pmdp_text').hidden = true;
			}
			if(pilihan == 1){
				document.getElementById('gel_text').hidden = false;
				//document.getElementById('pmdp_text').hidden = false;
			}
			if ((pilihan != 1) && (pilihan != 3) && (pilihan != 2)) {
				document.getElementById('gel_text').hidden = true;
				//document.getElementById('pmdp_text').hidden = true;
			}
			$('#kerjasama').html(hasil);
		});
		$('#kerjasama').change(function(){
			var mou_val = $(this).val();
			var html = '';
			if (mou_val == 1) {
				document.getElementById('skl_mou').hidden = false;
				$.ajax({
				url : "<?php echo base_url();?>pmb/daftar_mou/",
				method: "POST",
				data:{id:mou_val},
				async: false,
				dataType: "json",
				success: function(data){
						html += 'PILIH SEKOLAH : <p><select id="mou_akfar" name="nama_sekolah_mou" class="form-control">';
					var i;
					for (i = 0; i < data.length; i++) {
						html += '<option value="'+ data[i].id_sekolah +'">'+data[i].nama_sekolah+'</option>';
					}
						html += '</select></p>';
						
					}
				});
			}else{
				document.getElementById('skl_mou').hidden = true;
			}
			$('#mou_akfar').html(html);
		});
		$('#wn').change(function(){
			var id=$(this).val();
			$.ajax({
				url : "<?php echo base_url();?>pmb/daftar_prov/",
				method : "POST",
				data : {id: id},
				async : false,
				dataType : 'json',
				success: function(data){
					var html = '';
					var i;
					for(i=0; i<data.length; i++){
						html += '<option value="'+ data[i].prov_id +'">'+data[i].nama_prov+'</option>';
					}
					// $('#provinsi').html(html);
					 
				}
			});
		});
		/* $('#gelombang').change(function(){
			var val_gel = $(this).val();
			var nopen_pmdp = 20000;
			var nopen_gel = 50000;
			if(val_gel == 'PMDP'){
				$.ajax({
					url : "<?php echo base_url();?>pmb/nopen_pmdp/",
					method : "POST",
					data : {id: nopen_pmdp},
					async : false,
					dataType : 'json',
					success: function(data){
						var nopen_baru = '';
						var i;
						for(i=0; i<data.length; i++){
							// nopen_baru += data[i].nopen;
							nopen_baru += '<input type="text" class="form-control" readonly="" value="'+ data[i].nopen +'" name="nopen">';
						}
						// console.log(nopen_baru);
						$('#nopen').html(nopen_baru);
					}
				});
				document.getElementById('label1').innerHTML = "Kelas X Semester 1";
				document.getElementById('label2').innerHTML = "Kelas X Semester 2";
				document.getElementById('label3').innerHTML = "Kelas XI Semester 1";
				document.getElementById('label4').innerHTML = "Kelas XI Semester 2";
				document.getElementById('pmdp1').hidden = false;
				document.getElementById('pmdp2').hidden = false;
				document.getElementById('pmdp3').hidden = false;
				document.getElementById('pmdp4').hidden = false;
			}else{
				$.ajax({
					url : "<?php echo base_url();?>pmb/nopen_gel/",
					method : "POST",
					data : {id: nopen_gel},
					async : false,
					dataType : 'json',
					success: function(data){
						var nopen_baru = '';
						var i;
						for(i=0; i<data.length; i++){
							// nopen_baru += data[i].nopen;
							nopen_baru += '<input type="text" class="form-control" readonly="" value="'+ data[i].nopen +'" name="nopen">';
						}
						// console.log(nopen_baru);
						$('#nopen').html(nopen_baru);
					}
				});
				document.getElementById('label1').innerHTML = "";
				document.getElementById('label2').innerHTML = "";
				document.getElementById('label3').innerHTML = "";
				document.getElementById('label4').innerHTML = "";
				document.getElementById('pmdp1').hidden = true;
				document.getElementById('pmdp2').hidden = true;
				document.getElementById('pmdp3').hidden = true;
				document.getElementById('pmdp4').hidden = true;
			}
		}); */
		$('#provinsi').change(function(){
			//alert("asdasd");
			var id=$(this).val();
			$.ajax({
				url : "<?php echo base_url();?>pmb/daftar_kotakab/",
				method : "POST",
				data : {id: id},
				async : false,
				dataType : 'json',
				success: function(data){
					var html = '';
					var i;
					for(i=0; i<data.length; i++){
						html += '<option value="'+ data[i].id_wil +'">'+data[i].nm_wil+'</option>';
					}
					$('#kotakab').html(html);
					 
				}
			});
		});
		$('#kotakab').change(function(){
			var id=$(this).val();
			$.ajax({
				url : "<?php echo base_url();?>pmb/daftar_kec/",
				method : "POST",
				data : {id: id},
				async : false,
				dataType : 'json',
				success: function(data){
					var html = '';
					var i;
					for(i=0; i<data.length; i++){
						html += '<option value="'+ data[i].id_wil +'">'+data[i].nm_wil+'</option>';
					}
					$('#kecamatan').html(html);
					 
				}
			});
		});
		
		$('#provinsi').change(function(){
			var id_prov=$(this).val();
			$('#kotakab').change(function(){
				var id_kota=$(this).val();
				reload_daftar_sekolah(id_prov,id_kota);
			});
		});
		
		$("#simpan_sekolah").click(function(){
			var nama_sekolah = $("#nama_sekolah").val();
			var id_prov = $("#provinsi").val();
			var id_kota = $("#kotakab").val();
			//alert(nama_sekolah);
			$.ajax({
				url : "<?php echo base_url();?>formulir/simpan_sekolah/",
				method : "POST",
				data : {id_prov: id_prov,
						id_kota: id_kota,
						nama_sekolah: nama_sekolah},
				async : false,
				dataType : 'json',
				success: function(data){
					reload_daftar_sekolah(id_prov,id_kota);
					$("#asal_sekolah").val(data);
					$('#asal_sekolah').trigger('change');
					$('#modal_tambah_sekolah').modal("hide");
				}
			});
		});
	});
	function adjustIframeHeight() {
		var $body   = $('body'),
			$iframe = $body.data('iframe.fv');
		if ($iframe) {
			// Adjust the height of iframe
			$iframe.height($body.height());
		}
	}
	function reload_daftar_sekolah(id_prov,id_kota){
		$.ajax({
			url : "<?php echo base_url();?>pmb/daftar_sekolah/",
			method : "POST",
			data : {id_prov: id_prov,
					id_kota: id_kota},
			async : false,
			dataType : 'json',
			success: function(data){
				var html = '';
				var i;
				for(i=0; i<data.length; i++){
					html += '<option value="'+ data[i].id +'">'+data[i].nama+'</option>';
				}
				$('#asal_sekolah').html(html);
				$("#add_sekolah_provinsi").val(id_prov);
				$("#add_sekolah_kota").val(id_kota);
				$('#tambah-sekolah').html('Sekolah Tidak Ditemukan Klik <a href="#" id="btn_tambah_sekolah" class="" data-toggle="modal" data-target="#modal_tambah_sekolah">Disini</a> untuk menambah');
				}
			});
	}
</script>