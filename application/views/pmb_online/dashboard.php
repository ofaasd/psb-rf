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
								<td>1. Mengisi <a href="<?php echo base_url()?>formulir/info" class="btn btn-primary btn-sm">Info Pribadi</a>,<a href="<?php echo base_url()?>formulir/penpres" class="btn btn-primary btn-sm">Nilai Rapor dan Prestasi</a> dan <a href="<?php echo base_url()?>formulir/upload_foto" class="btn btn-primary btn-sm">Upload Foto</a>
								</td>
							</tr>
							<tr>
								<td>
									2. Validasi Data Silahkan <a href="#" class="btn btn-primary btn-sm" id="validasi_biodata" onclick="return validasi()">Klik Disini Untuk Validasi</a>
								</td>
							</tr>
							<tr>
								<td>3. Cetak Formulir Pendaftaran 
									<?php
										$id = $this->session->userdata("id_user");
										$nopen = (!empty($this->db->get_where("user_guest",array("id"=>$id))->row()->no_pendaftaran))?$this->db->get_where("user_guest",array("id"=>$id))->row()->no_pendaftaran:"";
										if(empty($nopen)){
									?>
											<a href="#" <?php (empty($nopen))?"disabled":""?> class="btn btn-danger btn-sm">
												Verifikasi Terlebih Dahulu
											</a>
									<?php
										}else{
									?>
										<a href="<?php echo base_url();?>formulir/cetak_formulir/<?php echo $nopen ?>" <?php (empty($nopen))?"disabled":""?>  class="btn btn-primary btn-sm">
											<span class="pcoded-micon"><i class="feather icon-edit-2"></i></span>
											<span class="pcoded-mtext">Klik Disini</span>
										</a>
									<?php
										}
									?>
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