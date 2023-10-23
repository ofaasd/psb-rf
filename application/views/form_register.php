<div class="card-block" style="padding:0">
	
			<div class="j-wrapper j-wrapper-400" style="padding:0;">
				<div class="j-header">
					<center><img src="<?php echo base_url();?>/assets/images/logo/logo.png" class="img-radius" alt="User-Profile-Image" width="150"></center>
				</div>
				<form action="<?php echo base_url()?>auth/register" method="post" class="j-pro" id="j-pro">
					<!-- end /.header -->
					<div class="j-content">
						
							<center><h3>Daftar</h3></center>
							<hr>
						<?php if(!empty($this->session->flashdata('gagal'))){
							echo '<div class="alert alert-danger border-danger">
							
								' . $this->session->flashdata('gagal') . '
							</div>';
						}?>
						<!-- start login -->
						<div class="j-unit">
							<div class="j-input">
								<label class="j-icon-right" for="nama">
									<i class="icofont icofont-ui-user"></i>
								</label>
								<input type="text" id="nama" name="nama" placeholder="Nama..." required>
							</div>
						</div>
						<div class="j-unit">
							<div class="j-input">
								<label class="j-icon-right" for="email">
									<i class="icofont icofont-ui-email"></i>
								</label>
								<input type="email" id="email" name="email" placeholder="Email..." required>
							</div>
						</div>
						<!-- end login -->
						<!-- start password -->
						<label for="tanggal_lahir">Tanggal Lahir</label> <br />
						<div class="j-unit">
							<div class="j-input">
								
								<label class="j-icon-right" for="tgl_lahir">
									<i class="icofont icofont-calendar"></i>
								</label>
								<input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" placeholder="Tanggal Lahir" required style="padding-bottom:15px;padding-top:10px;">
								
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