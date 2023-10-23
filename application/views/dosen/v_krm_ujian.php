 <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
						<div class="col-md-12">
							<h2></h2>
						</div>
					</div>
				</div>
				<div class="card-block">
					<table class="table">
						<tr>
							<!-- <th>No.</th> -->
							<th colspan="2">DAFTAR MATAKULIAH</th>
						</tr>
						<?php
							foreach($jadwal as $row){
						?>
							<tr>
								<td width="40%">
									<table>
										<tr>
											<td>Kode Mata Kuliah</td>
											<td>:</td>
											<td><?php echo $row->kode_mata_kuliah ?></td>
										</tr>
										<tr>
											<td>Nama Mata Kuliah</td>
											<td>:</td>
											<td><?php echo $row->nama_mata_kuliah ?></td>
										</tr>
										<tr>
											<td>Hari, Sesi</td>
											<td>:</td>
											<td><?php echo $row->hari.', '.$row->sesi ?></td>
										</tr>
										<tr>
											<td>Ruang</td>
											<td>:</td>
											<td><?php echo $row->ruang ?></td>
										</tr>
									</table>
								</td>
								<td width="40%">
									<table>
										<tr>
											<td>Jumlah Mahasiswa</td>
											<td>:</td>
											<td><?php echo $this->db->get_where('master_krs_temp', ['id_jadwal' => $row->id])->num_rows(); ?></td>
										</tr>
										<tr>
											<td colspan="3">
												<?php
												$a = $this->db->get_where('master_nilai', ['id_jadwal' => $row->id, 'nhuruf' => 'A'])->num_rows();
												$ab = $this->db->get_where('master_nilai', ['id_jadwal' => $row->id, 'nhuruf' => 'AB'])->num_rows();
												$b = $this->db->get_where('master_nilai', ['id_jadwal' => $row->id, 'nhuruf' => 'B'])->num_rows();
												$bc = $this->db->get_where('master_nilai', ['id_jadwal' => $row->id, 'nhuruf' => 'BC'])->num_rows();
												$c = $this->db->get_where('master_nilai', ['id_jadwal' => $row->id, 'nhuruf' => 'C'])->num_rows();
												$cd = $this->db->get_where('master_nilai', ['id_jadwal' => $row->id, 'nhuruf' => 'CD'])->num_rows();
												$d = $this->db->get_where('master_nilai', ['id_jadwal' => $row->id, 'nhuruf' => 'D'])->num_rows();
												$e = $this->db->get_where('master_nilai', ['id_jadwal' => $row->id, 'nhuruf' => 'E'])->num_rows();
												echo "A=".$a."; AB=".$ab."; B=".$b."; BC=".$bc."; C=".$c."; CD=".$cd."; D=".$d."; E=".$e.";";
												?>
											</td>
										</tr>
										<tr>
											<td colspan="3">
												Pertemuan : 
												<?php $temu = $this->db->select('*')->from('master_presensi')->where(['id_jadwal' => $row->id, 'status' => 1])->group_by('tgl_pertemuan')->get()->num_rows();
													  $temu_persen = $temu * 6.25;
												?>
												<div class="progress">
												  <div class="progress-bar" role="progressbar" aria-valuenow="70"
												  aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $temu_persen; ?>%">
												    <?php echo $temu; ?>/16
												  </div>
												</div>
											</td>
										</tr>
										<tr>
											<td colspan="3"><a href='<?php echo base_url() . "/dosen/ujian/set_nilai/" . $row->id; ?>' class='btn btn-primary'>Set Nilai</a></td></td>
										</tr>
									</table>
								</td>
							</tr>
						<?php
							}
						?>
					</table>
				</div>
			</div>
		</div>
	</div>