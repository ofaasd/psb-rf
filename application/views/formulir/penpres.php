<?php
	$jalur = array(1=>"PMDP","Kerjasama","Umum");
?>
<div class="page-body">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<?php echo $this->session->userdata('status_update'); 
								$this->session->set_userdata('status_update', ''); ?>
					<h5>Pendidikan Terakhir</h5>
				</div>
				<div class="card-block">
					<h4 class="sub-title">DATA CALON MAHASISWA</h4>
					<form action="<?php echo base_url()?>formulir/simpan_penpres" method="post" enctype="multipart/form-data">
						<div id="pmdp_text">
							<h3>Rata-rata Nilai Rapor : <?php echo $detail->peringkat_pmdp ?></h3>
							SERTIFIKAT JUARA :
							<p><input type="file" name="file1"  class="form-control" disabled></p>
							<p><input type="text" name="ket1" placeholder="Keterangan Sertifikat" class="form-control" disabled></p>
							SERTIFIKAT JUARA :
							<p><input type="file" name="file2" class="form-control" disabled></p>
							<p><input type="text" name="ket2" placeholder="Keterangan Sertifikat" class="form-control" disabled></p>
							SERTIFIKAT JUARA :
							<p><input type="file" name="file3" class="form-control" disabled></p>
							<p><input type="text" name="ket3" placeholder="Keterangan Sertifikat" class="form-control" disabled></p>
						</div>
						<div class="form-group row">
							
							 <div class="col-sm-12">
								<input type="submit" value="simpan" class="btn btn-primary" style="width:100%">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>