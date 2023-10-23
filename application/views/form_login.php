<div class="card-block" style="padding:0">
	
			<div class="j-wrapper j-wrapper-400" style="padding:0;">
				<div class="j-header">
					<center><img src="<?php echo base_url();?>/assets/images/logo/logo.png" class="img-radius" alt="User-Profile-Image" width="150"></center>
				</div>
				<form action="<?php echo base_url()?>auth" method="post" class="j-pro" id="j-pro">
					<!-- end /.header -->
					<div class="j-content">
						
							<center><h3>Login</h3></center>
							<hr>
						<?php if(!empty($this->session->flashdata('gagal'))){
							echo '<div class="alert alert-danger border-danger">
							
								' . $this->session->flashdata('gagal') . '
							</div>';
						}?>
						
						<?php if(!empty($this->session->flashdata('berhasil'))){
							echo '<div class="alert alert-success border-success">
							
								' . $this->session->flashdata('berhasil') . '
							</div>';
						}?>
						<!-- start login -->
						<div class="j-unit">
							<div class="j-input">
								<label class="j-icon-right" for="login">
			<i class="icofont icofont-ui-user"></i>
		</label>
								<input type="email" id="login" name="email" placeholder="Email">
							</div>
						</div>
						<!-- end login -->
						<!-- start password -->
						<div class="j-unit">
							<div class="j-input">
								<label class="j-icon-right" for="password">
			<i class="icofont icofont-lock"></i>
		</label>
								<input type="password" id="password" name="password" placeholder="Password">
								<span class="j-hint">
			<a href="#" class="j-link">Forgot password?</a>
		</span>
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
						<center><button type="submit" class="btn btn-primary btn-block" style="float:none">Masuk</button> <br /><br />ATAU <br /><br /><a href="<?php echo base_url() ?>welcome/register" class="btn btn-light btn-block">Daftar</a></center>
					</div>
					<!-- end /.footer -->
				</form>
			</div>
		</div>