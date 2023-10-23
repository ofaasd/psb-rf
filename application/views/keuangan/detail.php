                        <?php 
                        	echo $this->session->userdata('notif_tagihan');
                        	$this->session->set_userdata('notif_tagihan', '');
                        ?>
                        <style>
						* {
						  box-sizing: border-box;
						}

						/* Create two equal columns that floats next to each other */
						.column {
						  float: left;
						  width: 50%;
						  padding: 10px;
						}

						.row:after {
						  content: "";
						  display: table;
						  clear: both;
						}
						</style>
                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                    	Detail Keuangan
                                                    </div>
                                                    <div class="card-block">
                                                    	<table width="20%">
                                                    		<tr>
                                                    			<td>Nomor Induk Mahasiswa</td>
                                                    			<td>:</td>
                                                    			<td><?php echo $m->nim ?></td>
                                                    		</tr>
                                                    		<tr>
                                                    			<td>Nama Lengkap</td>
                                                    			<td>:</td>
                                                    			<td><?php echo strtoupper($m->nama); ?></td>
                                                    		</tr>
                                                    		<tr>
                                                    			<td>Program Studi</td>
                                                    			<td>:</td>
                                                    			<td><?php echo $this->bantuan->pilihan_prodi($m->id_program_studi); ?></td>
                                                    		</tr>
                                                    	</table>
                                                    	<br>
                                                    	<div class="row">
                                                    		<div class="column">
                                                    			<h6>Tagihan PMB</h6>
                                                    			<table width="80%" >
                                                    				<tr>
                                                    					<th>No.</th>
                                                    					<th>Jenis Tagihan</th>
                                                    					<th>Tanggal</th>
                                                    					<th>Status</th>
                                                    					<th></th>
                                                    				</tr>
                                                    				<tr>
                                                    					<td>1.</td>
                                                    					<td><b>Tahap I</b><br>Rp. <?php echo number_format($nom_thp_1,2,',','.'); ?></td>
                                                    					<td><?php echo $tgl_thp_1 ?></td>
                                                    					<td><?php echo $stat_thp_1 ?></td>
                                                    					<td><?php echo ($stat_thp_1 == 'Belum')?"<a href='".base_url('master/keuangan_mhs/tambah_tagihan/'.$nom_thp_1.'-TAHAP_I-'.$id_mhs)."' class='btn btn-success'> + </a>":"";?></td>
                                                    				</tr>
                                                    				<tr>
                                                    					<td>2.</td>
                                                    					<td><b>Tahap II</b><br>Rp. <?php echo number_format($nom_thp_2,2,',','.'); ?></td>
                                                    					<td><?php echo $tgl_thp_2 ?></td>
                                                    					<td><?php echo $stat_thp_2 ?></td>
                                                    					<td><?php echo ($stat_thp_2 == 'Belum')?"<a href='".base_url('master/keuangan_mhs/tambah_tagihan/'.$nom_thp_2.'-TAHAP_II-'.$id_mhs)."' class='btn btn-success'> + </a>":"";?></td>
                                                    				</tr>
                                                    				<tr>
                                                    					<td>3.</td>
                                                    					<td><b>Tahap III</b><br>Rp. <?php echo number_format($nom_thp_3,2,',','.'); ?></td>
                                                    					<td><?php echo $tgl_thp_3 ?></td>
                                                    					<td><?php echo $stat_thp_3 ?></td>
                                                    					<td><?php echo ($stat_thp_3 == 'Belum')?"<a href='".base_url('master/keuangan_mhs/tambah_tagihan/'.$nom_thp_3.'-TAHAP_III-'.$id_mhs)."' class='btn btn-success'> + </a>":"";?></td>
                                                    				</tr>
                                                    			</table>
                                                    		</div>
                                                    		<div class="column">
                                                    			<h6>Tambah Jenis Tagihan</h6>
                                                    			<table width="100%">
                                                    				<tr>
                                                    					<th>No.</th>
                                                    					<th>Jenis Tagihan</th>
                                                    					<th>Nominal</th>
                                                    					<th></th>
                                                    				</tr>
                                                    				<tr>
                                                    					<td><b>1.</b></td>
                                                    					<td><b>SPI</b></td>
                                                    					<td>Rp. <?php echo number_format($tagihan[0]['total_spi'],2,',','.');?></td>
                                                    					<td><a href='<?php echo base_url('master/keuangan_mhs/tambah_tagihan/'.$tagihan[0]['total_spi'].'-SPI-'.$id_mhs); ?>' class='btn btn-success'> + </a></td> 
                                                    				</tr>
                                                    				<tr>
                                                    					<td><b>2.</b></td>
                                                    					<td><b>SKS (<?php echo $sks ?> * <?php echo number_format($tagihan[0]['sks'],2,',','.'); ?>)</b></td>
                                                    					<td>Rp. <?php $total_sks = $sks * $tagihan[0]['sks']; echo number_format($sks * $tagihan[0]['sks'],2,',','.');?></td>
                                                    					<td><a href='<?php echo base_url('master/keuangan_mhs/tambah_tagihan/'.$total_sks.'-SKS-'.$id_mhs); ?>' class='btn btn-success'> + </a></td> 
                                                    				</tr>
                                                    				<tr>
                                                    					<td><b>3.</b></td>
                                                    					<td><b>Operasional</b></td>
                                                    					<td>Rp. <?php echo number_format($tagihan[0]['operasional'],2,',','.');?></td>
                                                    					<td><a href='<?php echo base_url('master/keuangan_mhs/tambah_tagihan/'.$tagihan[0]['operasional'].'-Operasional-'.$id_mhs); ?>' class='btn btn-success'> + </a></td>
                                                    				</tr>
                                                    				<tr>
                                                    					<td><b>4.</b></td>
                                                    					<td><b>Kemahasiswaan</b></td>
                                                    					<td>Rp. <?php echo number_format($tagihan[0]['kemahasiswaan'],2,',','.');?></td>
                                                    					<td><a href='<?php echo base_url('master/keuangan_mhs/tambah_tagihan/'.$tagihan[0]['kemahasiswaan'].'-Kemahasiswaan-'.$id_mhs)?>' class='btn btn-success'> + </a></td>
                                                    				</tr>
                                                    				<tr>
                                                    					<td><b>5.</b></td>
                                                    					<td><b>Seragam & Alat</b></td>
                                                    					<td>Rp. <?php echo number_format($tagihan[0]['seragam'],2,',','.');?></td>
                                                    					<td><a href='<?php echo base_url('master/keuangan_mhs/tambah_tagihan/'.$tagihan[0]['seragam'].'-Seragam_dan_Alat-'.$id_mhs); ?>' class='btn btn-success'> + </a></td>
                                                    				</tr>
                                                    			</table>	
                                                    		</div>
                                                    	</div>
                                                    	<hr>
                                                    	<b>Tagihan <font color="green">Aktif</font></b>
                                                    	<div class="row">
                                                    		<div class="column">
                                                    			<form action="<?php echo base_url('master/keuangan_mhs/simpan_tagihan'); ?>" method="post">
                                                    				<input type="number" name="id_mhs" value="<?php echo $id_mhs ?>" hidden="">
                                                    				<table border="1">
			                                                    		<tr>
			                                                    			<th width="50px" style="text-align: center;">No.</th>
			                                                    			<th width="300px" style="padding-left: 10px;">Jenis Tagihan</th>
			                                                    			<th width="200px" style="padding-left: 10px;">Nominal</th>
			                                                    			<th width="50px"></th>
			                                                    		</tr>
			                                                    		<?php $no = 1; $total = 0; foreach ($aktif as $a): ?>
			                                                    		<tr>
			                                                    			<td style="text-align: center;"><?php echo $no++ ?></td>
			                                                    			<td style="padding-left: 10px;"><?php echo $a->jenis ?></td>
			                                                    			<td style="padding-left: 10px;">Rp. <?php echo number_format($a->nominal,2,',','.'); ?></td>
			                                                    			<td><a href='<?php echo base_url('master/keuangan_mhs/hapus_tagihan/'.$a->id); ?>' class='btn btn-danger'> Hapus </a></td>
			                                                    		</tr>	
			                                                    		<?php 
			                                                    			$total += $a->nominal;
			                                                    		endforeach ?>
			                                                    		<tr>
			                                                    			<th colspan="2" style="padding-left: 10px;">Total Pembayaran</th>
			                                                    			<th colspan="2" style="padding-left: 10px;">Rp. <?php echo number_format($total,2,',','.'); ?><input type="number" name="total" value="<?php echo $total ?>" hidden=""></th>
			                                                    		</tr>
			                                                    		<tr>
			                                                    			<th colspan="2" style="padding-left: 10px;">Dibayarkan</th>
			                                                    			<th colspan="2" style="padding-left: 10px;"><input type="number" name="terbayar" class="form-control" value="<?php echo $terbayar?>"></th>
			                                                    		</tr>
			                                                    		<tr>
			                                                    			<th colspan="2" style="padding-left: 10px;">Sisa Tagihan</th>
			                                                    			<th colspan="2" style="padding-left: 10px;">Rp. <?php echo number_format($total - $terbayar,2,',','.'); ?></th>
			                                                    		</tr>
			                                                    		<tr>
			                                                    			<th colspan="2" style="padding-left: 10px;">Batas Tanggal Pembayaran <?php echo $batas_tgl ?></th>
			                                                    			<th colspan="2" style="padding-left: 10px;"><input type="date" name="tgl" class="form-control" value="<?php echo $batas_tgl ?>" required=""></th>
			                                                    		</tr>
			                                                    		<tr>
			                                                    			<th colspan="2" style="padding-left: 10px;">Status Pembayaran</th>
			                                                    			<th colspan="2" style="padding-left: 10px;"><select name="status" id="status" class="form-control">
			                                                    				<option selected="" value="<?php echo $status ?>"><?php echo ($status == 0) ? 'Belum':'Lunas'; ?></option>
			                                                    				<option value="0">Belum</option>
			                                                    				<option value="1">Lunas</option>
			                                                    			</select></th>
			                                                    		</tr>
			                                                    		<tr>
			                                                    			<td colspan="4" align="center"><input type="submit" value="simpan" class="btn btn-primary"></td>
			                                                    		</tr>
			                                                    	</table>
                                                    			</form>
                                                    		</div>
                                                    		<div class="column">
                                                    			<table class="table table-striped table-bordered nowrap">
			                                                            <thead>
			                                                                <tr>
			                                                                    <!-- <th>No</th>
			                                                                    <th>NIM</th>
			                                                                    <th>Nama Mahasiswa</th> -->
			                                                                    <th>KRS</th>
			                                                                    <th>UTS</th>
			                                                                    <th>UAS</th>
			                                                                    <!-- <th>#</th> -->
			                                                                </tr>
			                                                            </thead>
			                                                            <tbody>
			                                                            <?php $no = 1;
																		
			                                                            foreach($keuangan as $d){?>
			                                                                <tr>
			                                                                    <!-- <td><?php echo $no++ ?></td>
			                                                                    <td><?php echo $d->nim ?></td>
			                                                                    <td><?php echo $d->nama ?></td> -->
			                                                                    <!-- <td><a href="<?php echo base_url('master/keuangan_mhs/detail/'.$d->id_mahasiswa);?>" class="btn btn-primary">Rincian</a></td> -->
			                                                                    <td>
																					<select name="krs" id="krs<?php echo $d->id?>">
																						<option value="1" <?php echo ($d->krs == 1)?"selected":""?>>Buka</option>
																						<option value="0" <?php echo ($d->krs == 0)?"selected":""?>>Tutup</option>
																					</select>
																				</td>
			                                                                    <td>
																					<select name="uts" id="uts<?php echo $d->id?>">
																						<option value="1" <?php echo ($d->uts == 1)?"selected":""?>>Buka</option>
																						<option value="0" <?php echo ($d->uts == 0)?"selected":""?>>Tutup</option>
																					</select>
																				</td>
			                                                                    <td>
																					<select name="uas" id="uas<?php echo $d->id?>">
																						<option value="1" <?php echo ($d->uas == 1)?"selected":""?>>Buka</option>
																						<option value="0" <?php echo ($d->uas == 0)?"selected":""?>>Tutup</option>
																					</select>
																				</td>
			                                                                    
			                                                                </tr>
																			<script>
																				$(document).ready(function(){
																					$("#krs<?php echo $d->id; ?>").change(function(){
																						$.ajax({
																							url:'<?php echo base_url() ?>master/keuangan_mhs/ubah_krs',
																							data:{
																								id:<?php echo $d->id_mahasiswa ?>,
																								krs: $(this).val()
																							},
																							method:"POST",
																							success:function(data){
																								if(data == 1){
																									alert("berhasil");
																								}else{
																									alert(data);
																								}
																							}
																						});
																					});
																					$("#uts<?php echo $d->id; ?>").change(function(){
																						$.ajax({
																							url:'<?php echo base_url() ?>master/keuangan_mhs/ubah_uts',
																							data:{
																								id:<?php echo $d->id_mahasiswa ?>,
																								uts: $(this).val()
																							},
																							method:"POST",
																							success:function(data){
																								if(data == 1){
																									alert("berhasil");
																								}else{
																									alert('gagal');
																								}
																							}
																						});
																					});
																					$("#uas<?php echo $d->id; ?>").change(function(){
																						$.ajax({
																							url:'<?php echo base_url() ?>master/keuangan_mhs/ubah_uas',
																							data:{
																								id:<?php echo $d->id_mahasiswa ?>,
																								uas: $(this).val()
																							},
																							method:"POST",
																							success:function(data){
																								if(data == 1){
																									alert("berhasil");
																								}else{
																									alert('gagal');
																								}
																							}
																						});
																					});
																				});
																			</script>
			                                                            <?php } ?>
			                                                            </tbody>
			                                                          </table>
                                                    		</div>
                                                    	</div>
                                                    	<hr>
                                                    	<b>Riwayat Tagihan <font color="red">2021-Gasal</font></b>
                                                    	<table border="1">
                                                    		<tr>
                                                    			<th width="50px" style="text-align: center;">No.</th>
                                                    			<th width="500px" style="padding-left: 10px;">Jenis Tagihan</th>
                                                    			<th width="500px" style="padding-left: 10px;">Nominal</th>
                                                    			<th width="50px"></th>
                                                    		</tr>
                                                    	</table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

