                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <?php 
                                                        echo $this->session->userdata('uang'); 
                                                        $this->session->set_userdata('uang','');
                                                              ?>
                                                        <h5>Master Keuangan</h5>&nbsp;
														<?php
															if($keuangan->num_rows() < 1){
																echo "<div class='alert alert-danger backgroud-danger'>Data Mahasiswa tidak ditemukan pada tahun ajaran ini harap generate data terlebih dahulu</div>";
																echo "<a href='" . base_url() . "/master/keuangan_mhs/generate' class='btn btn-primary'>Generate Data</a>";
															}
														
														?>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="order-table" class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>NIM</th>
                                                                    <th>Nama Mahasiswa</th>
                                                                    <!-- <th>KRS</th>
                                                                    <th>UTS</th>
                                                                    <th>UAS</th> -->
                                                                    <th>#</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $no = 1;
															
                                                            foreach($keuangan->result() as $a){?>
                                                                <tr>
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td><?php echo $a->nim ?></td>
                                                                    <td><?php echo $a->nama ?></td>
                                                                    <td><a href="<?php echo base_url('master/keuangan_mhs/detail/'.$a->id_mahasiswa);?>" class="btn btn-primary">Rincian</a></td>
                                                                    <!-- <td>
																		<select name="krs" id="krs<?php echo $a->id?>">
																			<option value="1" <?php echo ($a->krs == 1)?"selected":""?>>Buka</option>
																			<option value="0" <?php echo ($a->krs == 0)?"selected":""?>>Tutup</option>
																		</select>
																	</td>
                                                                    <td>
																		<select name="uts" id="uts<?php echo $a->id?>">
																			<option value="1" <?php echo ($a->uts == 1)?"selected":""?>>Buka</option>
																			<option value="0" <?php echo ($a->uts == 0)?"selected":""?>>Tutup</option>
																		</select>
																	</td>
                                                                    <td>
																		<select name="uas" id="uas<?php echo $a->id?>">
																			<option value="1" <?php echo ($a->uas == 1)?"selected":""?>>Buka</option>
																			<option value="0" <?php echo ($a->uas == 0)?"selected":""?>>Tutup</option>
																		</select>
																	</td> -->
                                                                    
                                                                </tr>
																<script>
																	$(document).ready(function(){
																		$("#krs<?php echo $a->id; ?>").change(function(){
																			$.ajax({
																				url:'<?php echo base_url() ?>master/keuangan_mhs/ubah_krs',
																				data:{
																					id:<?php echo $a->id ?>,
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
																		$("#uts<?php echo $a->id; ?>").change(function(){
																			$.ajax({
																				url:'<?php echo base_url() ?>master/keuangan_mhs/ubah_uts',
																				data:{
																					id:<?php echo $a->id ?>,
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
																		$("#uas<?php echo $a->id; ?>").change(function(){
																			$.ajax({
																				url:'<?php echo base_url() ?>master/keuangan_mhs/ubah_uas',
																				data:{
																					id:<?php echo $a->id ?>,
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
                                                            <!-- <tfoot>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>NIM</th>
                                                                    <th>Nama Mahasiswa</th>
                                                                    <th>KRS</th>
                                                                    <th>UTS</th>
                                                                    <th>UAS</th>
                                                                </tr>
                                                            </tfoot> -->
                                                          </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
<script type="text/javascript">
    function izinUjian(nim){
        var izin_ujian = $('#izin_ujian').val();
        $.ajax({
            url : "<?php echo base_url();?>master/keuangan/save_izin_ujian/",
            method : "POST",
            data : {
                    nim: nim,
                    izin_ujian: izin_ujian
                  },
            async : false,
            dataType : 'json',
            success: function(data){
                // console.log(data)
                if (data.result == 1) {
                    swal("Berhasil!", "Mengganti Data...", "success");
                }else{   
                    swal("Gagal!", "Mengganti Data...", "error");
                }
            }
        });
    }
</script>
