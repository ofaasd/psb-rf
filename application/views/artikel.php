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
							<h3><?php echo $kategori ?></h3>
						</div>
					</div>
				</div>
				<div class="card-block">
					<div class="row">
						<?php foreach($artikel as $row){?>
						<div class="col-md-3">
							<div class="card-header">
								<img src="https://stifera.ac.id/siakad/demo/assets/artikel/<?php echo $row->gambar ?>" width="100%">	
							</div>
							<div class="card-block">
								<a href="<?php echo base_url() ?>welcome/artikel/<?php echo $row->id ?>"><b><p><?php echo $row->judul ?></p></b></a>
							</div>
						</div>
						<?php
						}
						?>
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