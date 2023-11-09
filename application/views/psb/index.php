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
							echo "<div class='alert alert-danger bg-danger text-light'>Anda belum melakukan registrasi. Silahkan Klik <a href='" . base_url('psb/create') . "' class='btn btn-primary btn-sm'>Disini</a> untuk mendaftar</div>";
						}else{
							echo "<a href='" . base_url('psb/create') . "' class='btn btn-primary' style='margin-bottom:10px'>+ Calon Santri Baru</a>";
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
								<td>No. Pendaftaran</td>
								<td>Nama</td>
								<td>NIK</td>
								<td>Jenis Kelamin</td>
								<td>Action</td>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;foreach($peserta as $row){?>
								<tr>
									<td><?= $i ?></td>
									<td>
										<?php
											if(!empty($row->no_pendaftaran)){
												echo $row->no_pendaftaran;
											}else{
												echo "<a href='" . base_url('psb/validasi/') . $row->id ."' class='btn btn-primary btn-sm' onclick='return confirm(\"Sebelum melakukan validasi, pastikan semua form sudah terisi\");'>Validasi</a>";
											}
										?>
									</td>
									<td><?= $row->nama ?></td>
									<td><?= $row->nik ?></td>
									<td><?= $row->jenis_kelamin ?></td>
									<td><a href="<?= base_url('psb/edit/' . $row->id )?>" class='btn btn-success btn-sm'><i class="fa fa-pencil"></i></a><a href="<?= base_url('psb/delete/' . $row->id )?>" class='btn btn-danger btn-sm'><i class="fa fa-trash"></i></a></td>
								</tr>
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
