<div class="card-block">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-md-1">
							<a href="#" onclick="goBack()"><i class="icofont icofont-arrow-left" style="font-size:40px;"></i></a>
						</div>
						<div class="col-md-11">
							<h3><?php echo $artikel->judul ?></h3>
						</div>
					</div>
				</div>
				<div class="card-block">
					<div class="row">
						<div class="col-md-12">
							<p><img src="https://stifera.ac.id/siakad/demo/assets/artikel/<?php echo $artikel->gambar ?>" width="20%" align="left" style="margin:10px;">	<?php echo $artikel->isi?></p>
							<small> <?php echo $artikel->tgl_awal ?></small><br />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>
<script>
function goBack() {
  window.history.back();
}
</script>