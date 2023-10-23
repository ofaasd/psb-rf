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
					<h5>FORM DETAIL CALON MAHASISWA BARU</h5>
				</div>
				<div class="card-block">
					<h4 class="sub-title">DATA CALON MAHASISWA</h4>
					<form action="<?php echo base_url()?>formulir/simpan_penpres" method="post" enctype="multipart/form-data">
						<div id="pmdp_text">
							NILAI RATA - RATA SEMESTER 1 :
							<p><input type="number" value="<?php echo (!empty($rapor->nilai_smt1))?$rapor->nilai_smt1:""?>" placeholder="NILAI RATA - RATA SEMESTER 1" name="smt1" required="" class="form-control"></p>
							BERKAS RAPOR SEMESTER 1 :
							<p>
								<input type="file" name="file_smt1"  class="form-control"><small>* File Max 10MB</small>
								<?php 
									if(!empty($rapor->file_smt1)){
										echo "<a href='" . base_url() . "assets/rapor/" . $rapor->file_smt1 . "' target='_blank' class='btn btn-primary btn-mini'>Lihat FIle</a>";
									}
								?>
							</p>
							NILAI RATA - RATA SEMESTER 2 :
							<p><input type="number" value="<?php echo (!empty($rapor->nilai_smt2))?$rapor->nilai_smt2:""?>" placeholder="NILAI RATA - RATA SEMESTER 2" name="smt2" required="" class="form-control"></p>
							BERKAS RAPOR SEMESTER 2 :
							<p>
								<input type="file" name="file_smt2"  class="form-control"><small>* File Max 10MB</small>
								<?php 
									if(!empty($rapor->file_smt2)){
										echo "<a href='" . base_url() . "assets/rapor/" . $rapor->file_smt2 . "' target='_blank' class='btn btn-primary btn-mini'>Lihat FIle</a>";
									}
								?>
								
							</p>
							NILAI RATA - RATA SEMESTER 3 :
							<p><input type="number" value="<?php echo (!empty($rapor->nilai_smt3))?$rapor->nilai_smt3:""?>" placeholder="NILAI RATA - RATA SEMESTER 3" name="smt3" required="" class="form-control"></p>
							BERKAS RAPOR SEMESTER 3 :
							<p>
								<input type="file" name="file_smt3"  class="form-control"><small>* File Max 10MB</small>
								<?php 
									if(!empty($rapor->file_smt3)){
										echo "<a href='" . base_url() . "assets/rapor/" . $rapor->file_smt3 . "' target='_blank' class='btn btn-primary btn-mini'>Lihat FIle</a>";
									}
								?>
							</p>
							NILAI RATA - RATA SEMESTER 4 :
							<p><input type="number" value="<?php echo (!empty($rapor->nilai_smt4))?$rapor->nilai_smt4:""?>" placeholder="NILAI RATA - RATA SEMESTER 4" name="smt4" required="" class="form-control"></p>
							BERKAS RAPOR SEMESTER 4 :
							<p>
								<input type="file" name="file_smt4"  class="form-control"><small>* File Max 10MB</small>
								<?php 
									if(!empty($rapor->file_smt4)){
										echo "<a href='" . base_url() . "assets/rapor/" . $rapor->file_smt4 . "' target='_blank' class='btn btn-primary btn-mini'>Lihat FIle</a>";
									}
								?>
							</p>
							NILAI RATA - RATA SEMESTER 5 :
							<p><input type="number" value="<?php echo (!empty($rapor->nilai_smt5))?$rapor->nilai_smt5:""?>" placeholder="NILAI RATA - RATA SEMESTER 5" name="smt5" required="" class="form-control"></p>
							BERKAS RAPOR SEMESTER 5 :
							<p>
								<input type="file" name="file_smt5"  class="form-control"><small>* File Max 10MB</small>
								<?php 
									if(!empty($rapor->file_smt5)){
										echo "<a href='" . base_url() . "assets/rapor/" . $rapor->file_smt5 . "' target='_blank' class='btn btn-primary btn-mini'>Lihat FIle</a>";
									}
								?>
							</p>
							SERTIFIKAT JUARA :
							<p><input type="file" name="file1"  class="form-control"></p>
							<p><input type="text" name="ket1" placeholder="Keterangan Sertifikat" class="form-control" value="<?php echo (!empty($piagam->ket1))?$piagam->ket1:""?>"></p>
							<p>
								<?php 
									if(!empty($piagam->file1)){
										echo "<a href='" . base_url() . "assets/sertifikat/" . $piagam->file1 . "' target='_blank' class='btn btn-primary btn-mini'>Lihat FIle</a>";
									}
								?>
							</p>
							SERTIFIKAT JUARA :
							<p><input type="file" name="file2" class="form-control"></p>
							<p><input type="text" name="ket2" placeholder="Keterangan Sertifikat" class="form-control" value="<?php echo (!empty($piagam->ket2))?$piagam->ket2:""?>"></p>
							<p>
								<?php 
									if(!empty($piagam->file2)){
										echo "<a href='" . base_url() . "assets/sertifikat/" . $piagam->file2 . "' target='_blank' class='btn btn-primary btn-mini'>Lihat FIle</a>";
									}
								?>
							</p>
							SERTIFIKAT JUARA :
							<p><input type="file" name="file3" class="form-control"></p>
							<p><input type="text" name="ket3" placeholder="Keterangan Sertifikat" class="form-control" value="<?php echo (!empty($piagam->ket3))?$piagam->ket3:""?>"></p>
							<p>
								<?php 
									if(!empty($piagam->file3)){
										echo "<a href='" . base_url() . "assets/sertifikat/" . $piagam->file3 . "' target='_blank' class='btn btn-primary btn-mini'>Lihat FIle</a>";
									}
								?>
							</p>
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