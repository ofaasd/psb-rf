 <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
						<div class="col-md-12">
							<h2>Input Nilai (<?php echo $jadwal->kode_mata_kuliah?> <?php echo $jadwal->nama_mata_kuliah ?>)</h2>
						</div>
					</div>
				</div>
				<div class="card-block">
					<?php 
						echo $this->session->userdata('persentase');
						$this->session->set_userdata('persentase','');
						if ($persentase < 1) 
						{
							echo "<font color='red'><i>Silahkan Atur Persentase Tugas, UTS, dan UAS sebelum Input Nilai</i></font>";
						}
					?>
					<form action="<?php echo base_url('master/nilai/save_persentase');?>" method="POST">
						<input type="number" name="id_jadwal" value="<?php echo $id_jadwal; ?>" hidden="">
						<table>
							<tr>
								<td>Persentase Nilai Tugas</td>
								<td>:</td>
								<td><input type="number" class="from-control" name="ntugas" value="<?php echo $tugas ?>"></td>
							</tr>
							<tr>
								<td>Persentase Nilai UTS</td>
								<td>:</td>
								<td><input type="number" class="from-control" name="nuts" value="<?php echo $uts ?>"></td>
							</tr>
							<tr>
								<td>Persentase Nilai UAS</td>
								<td>:</td>
								<td><input type="number" class="from-control" name="nuas" value="<?php echo $uas ?>"></td>
							</tr>
							<tr>
								<td colspan="3"><input type="submit" value="simpan" class="btn btn-primary"></td>
							</tr>
						</table>
					</form>
					<br>
					<form method="POST" action="<?php echo base_url() ?>master/nilai/save_nilai">
						<input type="number" class="from-control" name="ptugas" value="<?php echo $tugas ?>" hidden="">
						<input type="number" class="from-control" name="puts" value="<?php echo $uts ?>" hidden="">
						<input type="number" class="from-control" name="puas" value="<?php echo $uas ?>" hidden="">
					<table class="table table-stripped">
						
						<tr>
							<td>NIM</td>
							<td>Nama</td>
							<td>UTS</td>
							<td>UAS</td>
							<td>Tugas</td>
							<td>Nilai Akhir</td>
							<td>Nilai Huruf</td>
						</tr>
						<?php
							foreach($nilai as $row){
									$status = '';
									$btn = '';
								if ($persentase < 1) {
									$status = "readonly=''";
									$btn = "hidden=''";
								}
								echo "<tr>";
								echo "<td>" . $row->nim . "</td>";
								echo "<td>" . $row->nama_mhs . "</td>";
								echo "<td><input type='text' name='nuts[]' class='form-control' value='" . $row->nuts . "' ". $status ."></td>";
								echo "<td><input type='text' name='nuas[]' class='form-control' value='" . $row->nuas . "' ". $status ."></td>";
								echo "<td><input type='text' name='ntugas[]' class='form-control' value='" . $row->ntugas . "' ". $status ."></td>";
								echo "<td><input type='text' name='nakhir[]' class='form-control' value='" . $row->nakhir . "' readonly=''></td>";
								echo "<td><input type='text' name='nhuruf[]' class='form-control' value='" . $row->nhuruf . "' readonly=''></td>";
								echo "<input type='hidden' name='id[]' value='" .  $row->id ."'>";
								
								echo "</tr>";
							}
						?>
					</table>
					<input type="hidden" name='id_jadwal' value='<?php echo $id_jadwal ?>'>
					<input type="submit" class="btn btn-primary" value="simpan" <?php echo $btn; ?> >
					</form>
				</div>
			</div>
		</div>
	</div>