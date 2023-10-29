<div class="page-body">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<?php echo $this->session->userdata('status_update'); 
								$this->session->set_userdata('status_update', ''); ?>
					<h3>Selamat Datang, <?php echo $this->session->userdata("nama"); ?></h3>
				</div>
				<div class="card-block">
					<table class="table table-styling">
						<thead>
							<tr class="table-primary">
								<th>Langkah-Langkah Pendaftaran</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1. Mengisi <a href="<?php echo base_url()?>psb/index" class="btn btn-primary btn-sm">Data Pendaftaran PSB</a>
								</td>
							</tr>
							<tr>
								<td>
									2. Validasi Data Silahkan <a href="<?php echo base_url()?>psb/index" class="btn btn-primary btn-sm" >Pastikan data sudah benar kemudian klik tombol validasi</a>
								</td>
							</tr>
							<tr>
								<td>3. Cetak Formulir Pendaftaran 
									<a href="<?php echo base_url();?>psb/cetak"  class="btn btn-primary btn-sm">
										<span class="pcoded-micon"><i class="feather icon-edit-2"></i></span>
										<span class="pcoded-mtext">Klik Disini</span>
									</a>
								</td>
							</tr>
							<tr>
								<td>4. Lakukan Pembayaran pendaftaran. klik <a href="<?php echo base_url()?>formulir/upload_bukti" class="btn btn-primary btn-sm"> Upload Bukti Pembayaran</a> untuk mengetahui detailnya</td>
							</tr>
							<tr>
								<td>5. <a href="<?php echo base_url()?>formulir/jadwal_ujian" class="btn btn-primary btn-sm"> Lihat Jadwal Ujian</a></td>
							</tr>
							<tr>
								<td>6. <a href="<?php echo base_url()?>formulir/pengumuman_ujian" class="btn btn-primary btn-sm"> Pengumuman Ujian</a></td>
							</tr>
							
						</tbody>
					</table>
				</div>
				
			</div>
		</div>
	</div>
</div>
<script>
	function validasi(){
		var r = confirm("Jika Anda melakukan validasi, maka data pendaftaran Anda akan dikirim ke sistem. Selanjutnya Anda tidak dapat mengubah data Anda dan akan diberikan nomor pendaftaran. Data yang tidak divalidasi akan diabaikan dari sistem pendaftaran.");
		if (r == true) {
			return window.location.href = "<?php echo base_url()?>formulir/validasi_biodata";
		} else {
			return false;
		}
	}
</script>
