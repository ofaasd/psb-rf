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

	<div class="card-block" style="padding:0">
		<div class="row">
			<div class="col-md-12 bg-white" style="padding:20px;">
				<?php include('home.php');?>
			</div>
			<!-- di simpan di file logi backup -->
		</div>
	</div>
