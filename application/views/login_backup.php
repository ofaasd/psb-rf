<div class="col-md-4">
			<form action="<?php echo base_url()?>auth" method="post" class="j-pro" id="j-pro">
					<!-- end /.header -->
				<div class="j-header" style="background:#fff;padding:10px;">
					<div class="text-center">
						<small><b>Bagi yang belum memiliki akun silahkan lakukan pendaftaran ddengan mengklik tombol di bawah ini</b></small><br /><br />
						<a href="<?php echo base_url() ?>welcome/register" class="btn btn-success btn-block">Daftar Disini</a>
						<br /><br />ATAU <br /><br />
					</div>
				</div>
				<div class="j-content">
					
						<center><h5>Login</h5></center>
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
							<input type="text" id="login" name="username" placeholder="Username" style="font-size:14px">
						</div>
					</div>
					<!-- end login -->
					<!-- start password -->
					<div class="j-unit">
						<div class="j-input">
							<label class="j-icon-right" for="password">
								<i class="icofont icofont-lock"></i>
							</label>
							<input type="password" id="password" name="password" placeholder="Password" style="font-size:14px">
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
					<center>
						<button type="submit" class="btn btn-primary btn-block" style="float:none">Masuk</button>
					</center>
				</div>
				<!-- end /.footer -->
			</form>
		</div>
