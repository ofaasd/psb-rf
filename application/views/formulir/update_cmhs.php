<?php
	$jalur = array(1=>"PMDP","Kerjasama","Umum");
?>
<div class="page-body">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<?php echo $this->session->userdata('status_update'); 
								$this->session->set_userdata('status_update', ''); ?>
					<h5>FORM DETAIL CALON MAHASISWA BARU</h5>
				</div>
				<div class="card-block">
				<h4 class="sub-title">DATA CALON MAHASISWA</h4>
				 <form action="<?php echo base_url()?>formulir/update_detail" method="post" enctype="multipart/form-data">
					  
			<?php foreach($detail_cmhs as $d){ ?>
				PILIH KELAS :
					<p><select id="kelas" name="kelas" class="form-control" required="">
							<option value="opt1" selected="" disabled="">- Pilih Kelas -</option>
							<?php foreach($kelas as $kel){?>
							<option value="<?php echo $kel->jalur."-".$kel->id; ?>" <?php echo ($d->kelas==$kel->id)?"selected":""?>><?php echo $kel->nama_kelas ?></option>
							<?php } ?>
						</select></p>
						PILIH JALUR :
					<p><select id="jalur" name="jalur" class="form-control"  required="">
						<option value="opt1" selected="" disabled="">- Pilih Jalur -</option>
						<?php foreach($jalur as $key=>$value){
							echo '<option value="' . $key . '" ';
							echo ($key==$d->jalur_pendaftaran)?"selected":"";
							echo '>' . $value . '</option>';
						}?>
						</select></p>
						<div id="kerdiv" hidden="">
							JENIS KERJASAMA (JIKA JALUR KERJSAMA) :
							<p><select id="kerjasama" name="kerjasama" class="form-control">
								</select></p>
						</div>
					<div id="skl_mou" hidden="">
						<p id="mou_akfar"></p>
					</div>
					<h4>Data Pribadi</h4>
					<hr />
				<div class="form-group row">
					
					<div class="col-sm-6">
						<div class="col-sm-4">
							<label>No. Pendaftaran : </label>
						</div>
						<div class="col-sm-8">
							<input type="text" class="form-control" value="<?php echo $d->id ?>" name="id" hidden="">
							<input type="number" class="form-control" readonly="" name="nopen" value="<?php echo $d->nopen ?>"  maxlength="16">
						</div>
						<br />
						<div class="col-sm-12">
							<a href="#" class="btn btn-primary btn-mini" id="validasi_biodata" onclick="return validasi()">Validasi </a> Untuk Mendapatkan No. Pendaftaran</a>
						</div><br />
						<div class="col-sm-4">
							<label>Nomor KTP : </label>
						</div>
						<div class="col-sm-8">
							<input type="number" class="form-control" name="noktp" value="<?php echo $d->noktp ?>" maxlength="16">
						</div>
						<label class="col-sm-4 col-form-label">NISN : </label>
						<div class="col-sm-8">
							<input type="number" class="form-control" name="nisn" value="<?php echo $d->nisn ?>"  maxlength="15"><p>Tidak Tahu NISN anda? cek <a href="https://nisn.data.kemdikbud.go.id/page/data" target="_blank">DISINI</a></p>
						</div>
						<label class="col-sm-4 col-form-label">Nama Lengkap : </label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="nama" value="<?php echo $d->nama ?>" >
						</div>
						<label class="col-sm-4 col-form-label">Jenis Kelamin : </label>
						<div class="col-sm-8">
							<select name="jk" class="form-control" >
								<option selected="" value="<?php echo $d->jk ?>"><?php if($d->jk == 1){ echo "Laki - Laki"; }else{ echo "Perempuan"; } ?></option>
								<option value="1">Laki - Laki</option>
								<option value="2">Perempuan</option>
							</select>
						</div>
						<label class="col-sm-4 col-form-label">Agama : </label>
						<div class="col-sm-8">
							<select name="agama" class="form-control" >
								<option value="<?php echo $d->agama ?>" selected="" ><?php if($d->agama == 1 ){ 
										echo "Islam"; 
									}else if($d->agama == 2){ 
										echo "Kristen"; 
									}else if($d->agama == 3){ 
										echo "Katolik"; 
									}else if($d->agama == 4){ 
										echo "Hindu"; 
									}else if($d->agama == 5){ 
										echo "Budha"; 
									}else if($d->agama == 6){ 
										echo "Konghucu"; 
									}else{ 
										echo "Lainnya"; 
									}
								?></option>

								<option value="1">Islam</option>
								<option value="2">Kristen</option>
								<option value="3">Katolik</option>
								<option value="4">Hindu</option>
								<option value="5">Budha</option>
								<option value="6">Konghucu</option>
								<option value="99">Lainnya</option>
							</select>
						</div>
						<label class="col-sm-4 col-form-label">Nama Ibu : </label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="nama_ibu" value="<?php echo $d->nama_ibu ?>" >
						</div>
						<label class="col-sm-4 col-form-label">Nama Ayah : </label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="nama_ayah" value="<?php echo $d->nama_ayah ?>" >
						</div>
						<label class="col-sm-4 col-form-label">Tinggi Badan : </label>
						<div class="col-sm-8">
							<input type="number" class="form-control" name="tinggi_badan" value="<?php echo $d->tinggi_badan ?>" >
						</div>
						<label class="col-sm-4 col-form-label">Berat Badan : </label>
						<div class="col-sm-8">
							<input type="number" class="form-control" name="berat_badan" value="<?php echo $d->berat_badan ?>" >
						</div>
						<label class="col-sm-4 col-form-label">Tempat Lahir : </label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="tempat_lahir" value="<?php echo $d->tempat_lahir ?>" >
						</div>
						<label class="col-sm-4 col-form-label">Tanggal Lahir : </label>
						<div class="col-sm-8">
							<input type="date" class="form-control" name="tanggal_lahir" value="<?php echo $d->tanggal_lahir ?>" >
						</div>
						<label class="col-sm-3 col-form-label">No. HP : </label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="hp" value="<?php echo $d->hp ?>" >
						</div>
						<label class="col-sm-4 col-form-label">No. Telpon :</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="telpon" value="<?php echo $d->telpon ?>" >
						</div>
						<div class="col-sm-4">
							<label>Warga Negara : </label>
						</div>
						 <div class="col-sm-8">
							<select name="warga_negara" id="wn" class="form-control" >
								<option selected="" value="<?php echo $d->warga_negara ?>"><?php echo $data['nama_negara']?></option>
								<?php foreach($warga_negara as $w){?>
								<option value="<?php echo $w->id_negara?>"><?php echo $w->nm_negara ?></option>
								<?php } ?>
							</select>
						</div>
						<label class="col-sm-4 col-form-label">Nama Provinsi : </label>
						 <div class="col-sm-8">
							<select name="provinsi" id="provinsi" class="form-control" >
								<option selected="" value="<?php echo $d->provinsi ?>"><?php echo $data['nm_prop']; ?></option>
								<?php foreach($wilayah as $w){?>
								<option value="<?php echo $w->id_wil ?>"><?php echo $w->nm_wil ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<!-- Batas Column -->
					<div class="col-sm-6">
						<label class="col-sm-4 col-form-label">Kota / Kabupaten : </label>
						 <div class="col-sm-8">
							<select name="kotakab" id="kotakab" class="form-control" > 
								<option selected="" value="<?php echo $d->kotakab ?>"><?php echo $data['nm_kab']; ?></option>
							</select>
						</div>
						<label class="col-sm-3 col-form-label">Kecamatan : </label>
						<div class="col-sm-8">
							<select name="kecamatan" id="kecamatan" class="form-control" >
								<option selected="" value="<?php echo $d->kecamatan ?>"><?php echo $data['nm_kec']; ?></option>
							</select>
						</div>
						<label class="col-sm-3 col-form-label">Kode POS : </label>
						<div class="col-sm-8">
							<input type="number" class="form-control" name="kode_pos" value="<?php echo $d->kodepos ?>" >
						</div>
						<label class="col-sm-3 col-form-label">Kelurahan : </label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="kelurahan" value="<?php echo $d->kelurahan ?>" >
						</div>
						<label class="col-sm-4 col-form-label">Alamat : </label>
						<div class="col-sm-8">
							<textarea class="form-control" name="alamat" style="resize: none;" ><?php echo $d->alamat ?></textarea>
						</div>
						<label class="col-sm-4 col-form-label">RT :</label>
						<label class="col-sm-4 col-form-label">RW : </label>
						<div class="col-sm-8">
							<div class="row">
								<div class="col-sm-6">
									<input type="text" class="form-control" name="rt" value="<?php echo $d->rt ?>" >
								</div>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="rw" value="<?php echo $d->rw ?>" >
								</div>
							</div>
						</div>
						<label class="col-sm-3 col-form-label">Sekolah Asal :</label>
						 <div class="col-sm-8">
						 <select name="asal_sekolah" id="asal_sekolah" class="form-control js-example-basic-single">
								<option selected="" value="<?php echo $d->asal_sekolah ?>"><?php echo $data['nm_sekolah']; ?></option>
							</select>
						</div>
						 <div <?php if($d->jalur_pendaftaran != 2){ echo 'hidden=""'; }else{ echo '';}?>>
							<label class="col-sm-4 col-form-label">Jenis Kerjasama :</label>
							<div class="col-sm-8">
								<select name="kerjasama" class="form-control" readonly="">
									<option value="<?php echo $d->is_kerjasama ?>" selected="" readonly=""><?php if($d->is_kerjasama == 1){ echo "MOU AKADEMI FARMASI NUSAPUTERA"; }else if($d->is_kerjasama == 2){ echo "ALUMNI SMK NUSAPUTERA"; }else if($d->is_kerjasama == 3){ echo "PAFI"; }else if($d->is_kerjasama == 4){ echo "KIMIA FARMA"; }?></option>
								</select>
							</div>
							<div <?php if($d->is_kerjasama != 1){ echo 'hidden=""'; }else{ echo '';}?>>
								<label class="col-sm-4 col-form-label">Jenis Kerjasama :</label>
								<div class="col-sm-8">
									<select name="mou" class="form-control" readonly="">
										<option value="<?php echo $d->is_mou ?>" selected="" readonly=""><?php echo $data['mou']; ?></option>
									</select>
								</div>
							</div>
						 </div>
						<label class="col-sm-6 col-form-label">Pilih Jenis Pendaftaran :</label>
						 <div class="col-sm-8">
							<select name="pendaftaran" class="form-control" readonly="">
								<option value="<?php echo $d->jenis_pendaftaran ?>" selected="" readonly=""><?php if($d->jenis_pendaftaran == 1){ echo "Peserta Didik Baru"; }else if($d->jenis_pendaftaran == 2){ echo "Pindahan"; }else if($d->jenis_pendaftaran == 11){ echo "Alih Jenjang"; }else if($d->jenis_pendaftaran == 12){ echo "Lintas Jalur"; }?></option>
							</select>
						</div>
						<label class="col-sm-8 col-form-label">Gelombang Pendaftaran : </label>
						 <div class="col-sm-8">
							<select name="gelombang" id="gelombang" class="form-control" readonly="">
								<option value="<?php echo $d->gelombang ?>" selected="" readonly=""><?php echo $data['gelombang']; ?></option>
							</select>
						</div>
						<div <?php if ($d->jalur_pendaftaran != 1) { echo 'hidden=""';}else{ echo '';}?>>
							<label class="col-sm-4 col-form-label">Total Nilai PMDP : </label>
							<div class="col-sm-8">
								<input type="number" class="form-control" name="pmdp" value="<?php echo $d->peringkat_pmdp ?>" >
							</div>
						</div>
						<label class="col-sm-6 col-form-label">Pilih Program Studi 1 : </label>
						 <div class="col-sm-8">
							<select name="pilihan1" class="form-control" >
								<!-- <option value="<?php echo $d->pilihan1 ?>" selected=""><?php echo $data['jurusan1']; ?> </option> -->
								<?php foreach($prodi as $p){?>
								<option value="<?php echo $p->id ?>" <?=$p->id==$d->pilihan1? "selected": ""?>><?php echo $p->nama_jurusan ?></option>
								<?php } ?>
							</select>
						</div>
						<label class="col-sm-6 col-form-label">Pilih Program Studi 2 : </label>
						 <div class="col-sm-8">
							<select name="pilihan2" class="form-control" >
								<!-- <option value="<?php echo $d->pilihan2 ?>" selected="" ><?php echo $data['jurusan2']?></option> -->
								<?php foreach($prodi as $p){?>
								<option value="<?php echo $p->id ?>" <?=$p->id==$d->pilihan2? "selected": ""?>><?php echo $p->nama_jurusan ?></option>
								<?php } ?>
							</select>
						</div>
						<label class="col-sm-6 col-form-label">Dapat info PMB darimana?</label>
						<div class="col-sm-8">
							<select name="info_pmb" class="form-control" >
								<option value="<?php echo $d->info_pmb ?>" selected=""><?php if($d->info_pmb == 1){ echo "Teman"; }else if($d->info_pmb == 2){ echo "Kerabat / Orang Tua"; }else if($d->info_pmb == 3){ echo "Sosial Media"; }else if($d->info_pmb == 4){ echo "Lainnya"; }?></option>
								<option value="1">Teman</option>
								<option value="2">Kerabat / Orang Tua</option>
								<option value="3">Sosial Media</option>
								<option value="4">Lainnya</option>
							</select>
						</div>
						
						
					</div>
					
				</div>
				
				<?php } ?>
				<div class="form-group row">
					
					 <div class="col-sm-12">
						<input type="submit" value="simpan" class="btn btn-primary" style="width:100%">
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
	function validasi(){
		var r = confirm("Jika Anda melakukan validasi, maka data pendaftaran Anda akan dikirim ke sistem. Selanjutnya Anda tidak dapat mengubah data Anda dan akan diberikan nomor pendaftaran. Data yang tidak divalidasi akan diabaikan dari sistem pendaftaran.");
		if (r == true) {
			return window.location.href = "<?php echo base_url()?>formulir/validasi_biodata";
		} else {
			return false;
		}
	}
	$(document).ready(function(){
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
				document.getElementById('pmdp1').disabled= false;
				document.getElementById('pmdp2').disabled= false;
				document.getElementById('pmdp3').disabled= false;
				document.getElementById('pmdp4').disabled= false;
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
				document.getElementById('pmdp1').disabled= true;
				document.getElementById('pmdp2').disabled= true;
				document.getElementById('pmdp3').disabled= true;
				document.getElementById('pmdp4').disabled= true;
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
					 
					}
				});
			});
		});
	});
</script>
