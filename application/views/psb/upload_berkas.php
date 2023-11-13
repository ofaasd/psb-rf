<div class="page-body">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4>Daftar Santri PSB</h4>
				</div>
				<div class="card-body">
					<?php 
						if(empty($peserta)){
							echo "<div class='alert alert-danger bg-danger text-light'>Belum ada calon santri yang di validasi. Harap Validasi Data terlebih dahulu. Silahkan Klik <a href='" . base_url('psb/index') . "' class='btn btn-primary btn-sm'>Disini</a> untuk Validasi. Kemudian klik tombol validasi</div>";
						}
					
						if(!empty($_SESSION['msg'])){ 
							echo "<div class='alert bg-primary text-light'>" . $_SESSION['msg'] . "</div>"	;
							$_SESSION['msg'] = NULL;
						}
						
						if(!empty($_SESSION['error'])){ 
							echo "<div class='alert bg-danger text-light'>" . $_SESSION['error'] . "</div>"	;
							$_SESSION['error'] = NULL;
						}
					?>
					<table class='table table-hover'>
						<thead>
							<tr>
								<td>No.</td>
								<td>Berkas</td>
								<td>Nama</td>
								<td>NIK</td>
								<td>Jenis Kelamin</td>
								<td>Status</td>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;foreach($peserta as $row){?>
								<tr>
									<td><?= $i ?></td>
									<td>
								
										<a href='#' class='btn btn-primary btn-sm' data-toggle="modal" data-target="#berkas<?=$row->id?>">Upload Berkas</a>
											
									</td>
									<td><?= $row->nama ?></td>
									<td><?= $row->nik ?></td>
									<td><?= $row->jenis_kelamin ?></td>
									<td><label for="" class='btn btn-danger btn-sm'>X</label><label for="" class='btn btn-success btn-sm'><i class='fa fa-check'></i></label></td>
								</tr>
								<div class="modal fade" id="berkas<?=$row->id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Upload Berkas</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<form method="POST" action="<?=base_url('psb/update_berkas')?>">
												<div class="modal-body">
													<input type="hidden" name="id" value="<?=$row->id?>">
													<div class="form-group">
														<label for="KK">KK</label>
														<input type="file" name="kk" class="form-control">
													</div>
													<div class="form-group">
														<label for="ktp">KTP</label>
														<input type="file" name="ktp" class="form-control">
													</div>
													<div class="form-group">
														<label for="rapor">Rapor</label>
														<input type="file" name="rapor" class="form-control">
													</div>
													<div class="form-group">
														<label for="photo">Pas Foto 3X4</label>
														<input type="file" name="photo" class="form-control">
													</div>

												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													<button type="submit" class="btn btn-primary">Save changes</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							<?php $i++;} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		
		if(localStorage.getItem('msg')){
			$(".card-body").prepend("<div class='alert bg-primary text-light'>"+ localStorage.getItem('msg') +"</div>")
			localStorage.removeItem("msg");

		}
	})
</script>
