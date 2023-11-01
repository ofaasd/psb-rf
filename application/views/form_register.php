<div class="card-block" style="padding:0">
	
			<div class="j-wrapper j-wrapper-400" style="padding:0;">
				<div class="j-header">
					<h3 class="text-center">PPDB - PPATQ RADLATUL FALAH PATI</h3>
				</div>
				<form action="<?php echo base_url()?>auth/register" method="post" class="j-pro" id="j-pro">
					<!-- end /.header -->
					<div class="j-content">
							<h3 class="text-center">Daftar</h3>
							<hr>
						<?php if(!empty($this->session->flashdata('error'))){
							echo '<div class="alert alert-danger border-danger">
							
								' . $this->session->flashdata('error') . '
							</div>';
						}?>
						<!-- start login -->
						<div class="j-unit">
							<div class="j-input">
								<label class="j-icon-right" for="nik">
									<i class="icofont-vcard"></i>
								</label>
								<input type="text" id="nik" name="nik" placeholder="NIK">
							</div>
						</div>
						<div class="j-unit">
							<div class="j-input">
								<label class="j-icon-right" for="nama">
									<i class="icofont icofont-ui-user"></i>
								</label>
								<input type="text" id="nama" name="nama" placeholder="Nama..." required>
							</div>
						</div>
						<!-- end login -->
						<!-- start password -->
						<label for="tanggal_lahir">Tanggal Lahir <span class='text-danger'>*</span></label> <br />
						<div class="j-unit">
							<div class="j-input">
								
								<label class="j-icon-right" for="tgl_lahir">
									<i class="icofont icofont-calendar"></i>
								</label>
								<input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" placeholder="Tanggal Lahir" required style="padding-bottom:15px;padding-top:10px;">
								
							</div>
						</div>
						
						
						<label for="tanggal_lahir">Alamat <span class='text-danger'>*</span></label> <br />
						<div class="j-unit">
							<div class="j-input">
								
								<textarea id="alamat" name="alamat" class="form-control" placeholder="Alamat" required style="padding-bottom:15px;padding-top:10px;"></textarea>
								
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="provinsi" style="margin-bottom:10px;">Provinsi <span class='text-danger'>*</span></label>
								<select name="prov_id" id="provinsi" class="select2" style="margin:10px 0" required>
									<option value=0>--Pilih Provinsi--</option>
									<?php
										foreach($provinsi as $row){
									?>
									<option value='<?=$row->prov_id?>'><?=$row->prov_name?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-md-6">
								<label for="kota" style="margin-bottom:10px;">Kota <span class='text-danger'>*</span></label>
								<select name="kota_id" id="kota" class="select2" style="margin:10px 0" required>
									
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="kecamatan" style="margin:10px 0">Kecamatan <span class='text-danger'>*</span></label>
								<input type="text" class="form-control form-control-sm" name="kecamatan" id="kecamatan" required>
							</div>
							<div class="col-md-6">
								<label for="kelurahan" style="margin:10px 0">Kelurahan / Desa <span class='text-danger'>*</span></label>
								<input type="text" class="form-control form-control-sm" name="kelurahan" id="kelurahan" required>
							</div>
						</div>
						<label for="kode_pos" style="margin-top:10px">Kode Pos <span class='text-danger'>*</span></label> <br />
						<div class="j-unit" >
							<div class="j-input">
								<input type="text" id="kode_pos" name="kode_pos" placeholder="kode pos" required>
							</div>
						</div>
						<label for="no_hp" style="margin-top:10px">No. HP <span class='text-danger'>*</span></label> <br />
						<div class="j-unit" >
							<div class="j-input">
								<input type="text" id="no_hp" name="no_hp" placeholder="No. HP. Cth : 08231192389" required>
							</div>
						</div>
						<!-- end password -->
						<!-- start reCaptcha -->
						<div class="j-unit">
							<!-- start an example of the site key -->
							<div class="g-recaptcha" data-sitekey="6LeF_hUdAAAAANMkRb40J3Jj1GMoRGqM1anQw-Jh"></div>
							<!-- end an example of the site key -->
							<!-- <div class="g-recaptcha" data-sitekey="your-site-key"></div> -->
						</div>
						<!-- end reCaptcha -->
						<!-- start response from server -->
						<div class="j-response"></div>
						<!-- end response from server -->
					</div>
					<!-- end /.content -->
					<div class="j-footer">
						<center><input type="submit" class="btn btn-success btn-block" style="float:none" value="Daftar"><br /><br />ATAU <br /><br /><small><b>Jika Sudah punya Akun silahkan </b></small><br /><br /><a href="<?php echo base_url() ?>" class="btn btn-primary btn-block">Login</a></center>
					</div>
					<!-- end /.footer -->
				</form>
			</div>
		</div>
<script>
	$(document).ready(function(){
		$("#provinsi").select2();
		$("#kota").select2();

	});
	$("#provinsi").change(function(){
		$.ajax({
			url:"<?= base_url('welcome/get_kota')?>",
			data:{id : $(this).val()},
			method:"POST",
			success : function (data){
				$("#kota").html(data);
			}
		});
	});
</script>
