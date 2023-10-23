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
					<div class="row">
						<div class="col-sm-6">
							<form>
								<b>UPLOAD NILAI : (<font color="red">FITUR INI BELUM BISA DIGUNAKAN</font>)</b>
								<div class="col-sm-6" style="padding-left: 0px;">
									<input type="file" name="file_excel" class="form-control">
								</div>
								<input type="submit" value="upload" class="btn btn-success" style="margin-top: 10px;"> <a href="#" class="btn btn-primary" style="margin-top: 10px;">unduh format</a>
							</form>
							<hr>
							<form action="<?php echo base_url('dosen/ujian/save_persentase');?>" method="POST">
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
								<br>
								<?php
								$a = $this->db->get_where('master_nilai', ['id_jadwal' => $id_jadwal, 'nhuruf' => 'A'])->num_rows();
								$ab = $this->db->get_where('master_nilai', ['id_jadwal' => $id_jadwal, 'nhuruf' => 'AB'])->num_rows();
								$b = $this->db->get_where('master_nilai', ['id_jadwal' => $id_jadwal, 'nhuruf' => 'B'])->num_rows();
								$bc = $this->db->get_where('master_nilai', ['id_jadwal' => $id_jadwal, 'nhuruf' => 'BC'])->num_rows();
								$c = $this->db->get_where('master_nilai', ['id_jadwal' => $id_jadwal, 'nhuruf' => 'C'])->num_rows();
								$cd = $this->db->get_where('master_nilai', ['id_jadwal' => $id_jadwal, 'nhuruf' => 'CD'])->num_rows();
								$d = $this->db->get_where('master_nilai', ['id_jadwal' => $id_jadwal, 'nhuruf' => 'D'])->num_rows();
								$e = $this->db->get_where('master_nilai', ['id_jadwal' => $id_jadwal, 'nhuruf' => 'E'])->num_rows();
								echo "<b>A=".$a."; AB=".$ab."; <font style='color: blue;'>B=".$b."; BC=".$bc.";</font> <font style='color: orange;'>C=".$c."; CD=".$cd.";</font> <font style='color: brown;'>D=".$d.";</font> <font style='color: red;'>E=".$e.";</font></b>";
							?>
							</form>
						</div>
						<div class="col-sm-6">
							<table>
								<tr>
									<th style="margin-left: 10px;">Publish</th>
									<th style="margin-left: 10px;">Validasi</th>
								</tr>
								<tr>
									<td><button class="<?php echo $class_p_tugas; ?>" onclick="publish(<?php echo $id_jadwal ?>, 'tugas')" style="font-size: 11px;" <?php echo $stat_p_tugas; ?>>TGS</button></td>
									<td><button class="<?php echo $class_v_tugas; ?>" onclick="validasi(<?php echo $id_jadwal ?>, 'tugas')" style="font-size: 11px; margin-left: 0px;" <?php echo $stat_v_tugas; ?>>TGS</button></td>
								</tr>
								<tr>
									<td><button class="<?php echo $class_p_uts; ?>" onclick="publish(<?php echo $id_jadwal ?>, 'uts')" style="font-size: 11px;" <?php echo $stat_p_uts; ?>>UTS</button></td>
									<td><button class="<?php echo $class_v_uts; ?>" onclick="validasi(<?php echo $id_jadwal ?>, 'uts')" style="font-size: 11px; margin-left: 0px;" <?php echo $stat_v_uts; ?>>UTS</button></td>
								</tr>
								<tr>
									<td><button class="<?php echo $class_p_uas; ?>" onclick="publish(<?php echo $id_jadwal ?>, 'uas')" style="font-size: 11px;" <?php echo $stat_p_uas; ?>>UAS</button></td>
									<td><button class="<?php echo $class_v_uas; ?>" onclick="validasi(<?php echo $id_jadwal ?>, 'uas')" style="font-size: 11px; margin-left: 0px;" <?php echo $stat_v_uas; ?>>UAS</button></td>
								</tr>
								<tr>
									<td colspan="2">
										Ket : <br>
										Hijau = Belum di publish/validasi<br>
										Merah = Sudah di publish/validasi
									</td>
								</tr>
							</table>
						</div>
					</div>
					
					<br>
					<form method="POST" action="<?php echo base_url() ?>dosen/ujian/save_nilai">
						<input type="number" class="from-control" name="ptugas" value="<?php echo $tugas ?>" hidden="">
						<input type="number" class="from-control" name="puts" value="<?php echo $uts ?>" hidden="">
						<input type="number" class="from-control" name="puas" value="<?php echo $uas ?>" hidden="">
					<table class="table table-stripped">
						
						<tr>
							<td>NIM</td>
							<td>Nama</td>
							<td>Tugas</td>
							<td>UTS</td>
							<td>UAS</td>
							<td>Nilai Akhir</td>
							<td>Nilai Huruf</td>
						</tr>
						<?php
							foreach($nilai as $row){
									$status = '';
								if ($persentase < 1) {
									$status = "readonly=''";
								}
								echo "<tr>";
								echo "<td>" . $row->nim . "</td>";
								echo "<td>" . strtoupper($row->nama_mhs) . "</td>";
								echo "<td><input type='text' name='ntugas[]' class='form-control' value='" . $row->ntugas . "' ". $status ." ". $v_tugas ."></td>";
								echo "<td><input type='text' name='nuts[]' class='form-control' value='" . $row->nuts . "' ". $status ." ". $v_uts ."></td>";
								echo "<td><input type='text' name='nuas[]' class='form-control' value='" . $row->nuas . "' ". $status ." ". $v_uas ."></td>";
								echo "<td><input type='text' name='nakhir[]' class='form-control' value='" . $row->nakhir . "' readonly=''></td>";
								echo "<td><input type='text' name='nhuruf[]' class='form-control' value='" . $row->nhuruf . "' readonly=''></td>";
								echo "<input type='hidden' name='id[]' value='" .  $row->id ."'>";
								
								echo "</tr>";
							}
						?>
					</table>
					<input type="hidden" name='id_jadwal' value='<?php echo $id_jadwal ?>'>
					<input type="submit" class="btn btn-primary" value="simpan">
					</form>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function publish(id_jadwal, jenis){
			 $.ajax({
                    url : "<?php echo base_url();?>dosen/ujian/publish",
                    method: "POST",
                    data:{
                          id_jadwal: id_jadwal,
                          jenis: jenis
                      },
                    async: false, 
                    dataType: "json",
                    success: function(data){
                        if (data.res == 1) {
                        	location.reload();
                        }else{
                        	alert("Gagal Publish "+jenis);
                        }
                    }
                });
		}
		function validasi(id_jadwal, jenis){
			$.ajax({
                    url : "<?php echo base_url();?>dosen/ujian/validasi",
                    method: "POST",
                    data:{
                          id_jadwal: id_jadwal,
                          jenis: jenis
                      },
                    async: false, 
                    dataType: "json",
                    success: function(data){
                        if (data.res == 1) {
                        	location.reload();
                        }else{
                        	alert("Gagal Publish "+jenis);
                        }                              
                    }
                });
		}
	</script>