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
                            </style>

<div class="page-body">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<?php echo $this->session->userdata('status_update'); 
								$this->session->set_userdata('status_update', ''); ?>
					<h5>FORM TAMBAH CALON MAHASISWA BARU</h5>
				</div>
				<div class="card-block">
				<h4 class="sub-title">DATA CALON MAHASISWA</h4>
				 <form id="" action="<?php echo base_url()?>formulir/cmhs_tambah_aksi" method="post" enctype="multipart/form-data">
					  <!-- One "tab" for each step in the form: -->
					<p>
						<input type="hidden" name="gelombang" value="<?php echo $gelombang->nama_gel ?>">
					</p>
					  PILIH KELAS :
						<p><select id="kelas" name="kelas" class="form-control" required="">
								<option value="opt1" selected="" disabled="">- Pilih Kelas -</option>
								<?php foreach($kelas as $kel){?>
								<option value="<?php echo $kel->jalur."-".$kel->id; ?>"><?php echo $kel->nama_kelas ?></option>
								<?php } ?>
							</select></p>
							PILIH JALUR :
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
						<!-- Program Studi Pilihan -->
						<h4>Program Studi Pilihan</h4>
						<hr />
							JENIS PENDAFTARAN : 
							<input type="hidden" value="1" name="pendaftaran" class="form-control" required="">
								<p><select name="pilihan1" class="form-control" required="">
								<option value="opt1" selected="" disabled="">- Pilih Program Studi 1 -</option>
								<?php foreach($prodi as $p){?>
								<option value="<?php echo $p->id ?>"><?php echo $p->jenjang." - ".$p->nama_jurusan ?></option>
								<?php } ?>
							</select></p>Program Studi 2 :
							<p><select name="pilihan2" class="form-control" required="">
								<option value="opt1" selected="" disabled="">- Pilih Program Studi 1 -</option>
								<?php foreach($prodi as $p){?>
								<option value="<?php echo $p->id ?>"><?php echo $p->jenjang." - ".$p->nama_jurusan ?></option>
								<?php } ?>
							</select>
							</p>
						<!--Data Pribadi -->
						<h4>Data Pribadi</h4>
						<hr />
						<div class="row">
							<div class="col-sm-6">
								Nomor KTP :
								<p><input type="number" class="form-control" placeholder="Nomor KTP" oninput="this.className = ''" name="ktp" required=""></p>
								NISN :
								<p><input type="number" class="form-control" placeholder="NISN" oninput="this.className = ''" name="nisn" required="">
								Tidak Tahu NISN anda? <a href="https://nisn.data.kemdikbud.go.id/page/data" target="_blank">cek DISINI</a></p>
								Nama Lengkap :
								<p><input type="text" class="form-control" placeholder="Nama Lengkap" oninput="this.className = ''" name="nama" required=""></p>
								Jenis Kelamin :
								<p>
									<select name="jk" class="form-control" required="">
										<option selected="" disabled="">Jenis Kelamin</option>
										<option value="1">Laki - Laki</option>
										<option value="2">Perempuan</option>
									</select>
								</p>
								Agama :
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
								Nama Ibu :
								<p><input type="text" class="form-control" placeholder="Nama Ibu" oninput="this.className = ''" name="ibu" required=""></p>
								Nama Ayah :
								<p><input type="text" class="form-control" placeholder="Nama Ayah" oninput="this.className = ''" name="ayah" required=""></p>
								Nomor HP Orang Tua :
								<p><input type="text" class="form-control" placeholder="Nomor HP Orang Tua" oninput="this.className = ''" name="hp_ortu" required=""></p>
								Alamat Semarang :
								<p><textarea class="form-control" style="resize: none;" name="alamat_semarang" placeholder="Alamat Semarang" required="" ></textarea></p>
								Tinggi Badan :
								<p><input type="number" class="form-control" placeholder="Tinggi Badan" oninput="this.className = ''" name="tb" required=""></p>
								Berat Badan :
								<p><input type="number" class="form-control" placeholder="Berat Badan" oninput="this.className = ''" name="bb" required=""></p>
								Tempat Lahir :
								<p><input type="text" class="form-control" placeholder="Tempat Lahir" oninput="this.className = ''" name="tl" required=""></p>
								Tanggal Lahir :
								<p><input type="date" class="form-control" oninput="this.className = ''" name="tgl" required=""></p>
							</div>
							<div class="col-sm-6">
								Nomor Handphone :
								<p><input type="text" class="form-control" placeholder="No Handphone" oninput="this.className = ''" name="hp" required=""></p>
								Nomor Telepon :
								<p><input type="text" class="form-control" placeholder="Nomor Telepon" oninput="this.className = ''" name="telepon" required=""></p>
								Status Warga Negara :
								<p>
									<select name="warga_negara" id="wn" class="form-control" required="">
										<option selected="" disabled="">Pilih Warga Negara</option>
										<?php foreach($warga_negara as $w){?>
										<option value="<?php echo $w->id_negara?>"><?php echo $w->nm_negara ?></option>
										<?php } ?>
									</select>
								</p>
								Nama Provinsi :
								<p>
									<select name="provinsi" id="provinsi" class="form-control" required="">
										<option selected="" disabled="">Pilih Provinsi</option>
										<?php foreach($wilayah as $w){?>
										<option value="<?php echo $w->id_wil ?>"><?php echo $w->nm_wil ?></option>
										<?php } ?>
									</select>
								</p>
								Nama Kota/Kabupaten :
								<p>
									<select name="kotakab" id="kotakab" class="form-control" required=""> 
										<option selected="" disabled="">Pilih Kota/Kabupaten</option>
									</select>
								</p>
								Nama Kecamatan :
								<p>
									<select name="kecamatan" id="kecamatan" class="form-control" required="">
										<option selected="" disabled="">Daftar Kecamatan</option>
									</select>
								</p>
								Kode POS :
								<p><input type="text" class="form-control" placeholder="KODE POS" oninput="this.className = ''" name="pos" required=""></p>
								Nama Kelurahan :
								<p><input type="text" class="form-control" placeholder="Nama Kelurahan" oninput="this.className = ''" name="kelurahan" required=""></p>
								Alamat :
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
								Sekolah Asal :
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
							<div class="col-sm-12">
								<input type="submit" value="simpan" class="btn btn-primary">
							</div>
						</div>
					</form>
			  </div>
			 </div>
			</div>
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
				document.getElementById('pmdp_text').hidden = true;
			}
			if(pilihan == 1){
				document.getElementById('gel_text').hidden = true;
				document.getElementById('pmdp_text').hidden = false;
			}
			if ((pilihan != 1) && (pilihan != 3) && (pilihan != 2)) {
				document.getElementById('gel_text').hidden = true;
				document.getElementById('pmdp_text').hidden = true;
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
		$('#gelombang').change(function(){
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
		});
	});
	$(document).ready(function(){
		$('#provinsi').change(function(){
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
	});
	$(document).ready(function(){
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