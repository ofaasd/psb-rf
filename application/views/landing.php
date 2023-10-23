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
<div class="row">
	<div class="col-md-12">
		<video width="100%" autoplay muted loop>
		  <source src="<?php echo base_url() ?>assets/video/cover.mp4" type="video/mp4">
		Your browser does not support the video tag.
		</video>
	</div>
</div>

<div class="card-block">
	<div class="row">
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-6">
					<h5>Pengumuman</h5>
					
				</div>
				<div class="col-md-6" >
					<div align="right"><a href="<?php echo base_url()?>welcome/artikel_all/1" style="text-align:right">Lihat Semua Pengumuman &raquo; </a></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<hr>
				</div>
			</div>
			<div class="row">
				
				<?php foreach($artikel1 as $row){?>
				<div class="col-md-3">
					<div class="card-header">
						<img src="https://stifera.ac.id/siakad/demo/assets/artikel/<?php echo $row->gambar ?>" width="100%">	
					</div>
					<div class="card-block">
						<a href="<?php echo base_url() ?>welcome/artikel/<?php echo $row->id ?>"><b><p><?php echo $row->judul ?></p></b></a>
					</div>
				</div>
				<?php } ?>
			</div>
			<div class="row">
				<div class="col-md-6">
					<h5>Agenda</h5>
					
				</div>
				<div class="col-md-6" >
					<div align="right"><a href="<?php echo base_url()?>welcome/artikel_all/2" style="text-align:right">Lihat Semua Agenda &raquo; </a></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<hr>
				</div>
			</div>
			<div class="row">
				
				<?php foreach($artikel2 as $row){?>
				<div class="col-md-3">
					<div class="card-header">
						<img src="https://stifera.ac.id/siakad/demo/assets/artikel/<?php echo $row->gambar ?>" width="100%">	
					</div>
					<div class="card-block">
						<a href="<?php echo base_url() ?>welcome/artikel/<?php echo $row->id ?>"><b><p><?php echo $row->judul ?></p></b></a>
					</div>
				</div>
				<?php } ?>
			</div>
			<div class="row">
				<div class="col-md-6">
					<h5>Berita</h5>
					
				</div>
				<div class="col-md-6" >
					<div align="right"><a href="<?php echo base_url()?>welcome/artikel_all/3" style="text-align:right">Lihat Semua Berita &raquo; </a></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<hr>
				</div>
			</div>
			<div class="row">
				
				<?php foreach($artikel3 as $row){?>
				<div class="col-md-3">
					<div class="card-header">
						<img src="https://stifera.ac.id/siakad/demo/assets/artikel/<?php echo $row->gambar ?>" width="100%">	
					</div>
					<div class="card-block">
						<a href="<?php echo base_url() ?>welcome/artikel/<?php echo $row->id ?>"><b><p><?php echo $row->judul ?></p></b></a>
					</div>
				</div>
				<?php } ?>
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
							<input type="email" id="login" name="email" placeholder="Email" style="font-size:14px">
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