<div class="page-body">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h5>Tambah Masukan</h5>
				</div>
				<div class="card-block">
					<div class="dt-responsive table-responsive">
						<form action="<?php echo base_url('mhs/masukan/tambah/')?>" method="post">
						<table width="100%">
							<?php if(!empty($_GET['error']) && $_GET['error'] == 1){
								echo '<div class="alert alert-danger border-danger">
								
									Saran gagal ditambahkan
								</div>';
							}	
								if(!empty($_GET['succ']) && $_GET['succ'] == 1){
								echo '<div class="alert alert-success border-success">
								
									Saran Berhasil di tambahkan
								</div>';
							}
							?>
							<tr>
								<td></td>
								<td>Saran / Masukan</td>
								<td>:</td>
								<td><textarea name="saran" value="" class="form-control"></textarea></td>
							</tr>
							<tr align="right">
								<td colspan="4"><hr><input class="btn btn-success" type="submit" value="Update"></td>
							</tr>
						</table>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>