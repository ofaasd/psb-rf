<style>
	
	.pcoded .pcoded-inner-content{
		padding:0 !important;
	}
</style>
<!--<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
		</ol>
		<div class="carousel-inner" role="listbox">
			<?php $active = 0;
				foreach($slide as $row){?>
			<div class="carousel-item <?php echo ($active == 0)?"active":""; $active = 1 ?>">
				<img class="d-block w-100" src="https://stifera.ac.id/siakad/demo/assets/slideshow/<?php echo $row->gambar ?>" alt="<?php echo $row->caption ?>">
			</div>
			<?php } ?>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
	<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
	<span class="carousel-control-next-icon" aria-hidden="true"></span>
	<span class="sr-only">Next</span>
	</a>
	</div> -->
<!-- <div class="row">
	<div class="col-md-12">
		<video width="100%" autoplay muted loop>
		  <source src="<?php echo base_url() ?>assets/video/cover.mp4" type="video/mp4">
		Your browser does not support the video tag.
		</video>
	</div>
</div> -->
<div class="jumbotron">
	<h4 class="text-center font-weight-bold">
		ANJUNGAN INFORMASI <br /><br />
		
		PENERIMAAN PESERTA DIDIK BARU (PPDB)<br /><br />

		PPATQ RAUDLATUL FALAH<br /><br />

		TAHUN AJARAN 2024/2025<br /><br />
	</h4>
</div>
<div class="card-block">
	<div class="row">
		<div class="col-md-8 bg-white">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
				</li>
				<!-- <li class="nav-item" role="presentation">
					<button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
				</li> -->
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
					<br /><br />
					<?php include('home.php');?>
				</div>
				<!-- <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
				<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div> -->
			</div>
		</div>
		<div class="col-md-4">
			<form action="<?php echo base_url()?>auth" method="post" class="j-pro" id="j-pro">
					<!-- end /.header -->
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
					<center><button type="submit" class="btn btn-primary btn-block" style="float:none">Masuk</button> <br /><br />ATAU <br /><br />
					<small><b>Bagi yang belum memiliki akun silahkan lakukan pendaftaran </b></small><br /><br />
					<a href="<?php echo base_url() ?>welcome/register" class="btn btn-success btn-block">Daftar Disini</a></center>
				</div>
				<!-- end /.footer -->
			</form>
		</div>
	</div>
</div>
