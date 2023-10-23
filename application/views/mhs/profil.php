                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>PROFIL MAHASISWA</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="dt-responsive table-responsive">
                                                            <form action="<?php echo base_url('mhs/dashboard/update/')?>" method="post">
                                                            <table width="80%">
                                                                <tr>
                                                                    <td rowspan="7" style="position: top;">
																		<center><img src="<?php echo base_url().'assets/foto_mahasiswa/'.$detail[0]['foto_mhs'];?>" width="120px" height="160px"></center><br>
																		<center><a href="#" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#ubah_photo"><i class="feather icon-image"></i> Ubah Photo</a></center><br /><br />
																		
																	</td>
                                                                    <td>
                                                                        <input type="text" name="nim" hidden="" value="<?php echo $detail[0]['nim'];?>">NIM 
                                                                    </td>
                                                                    <td>:</td>
                                                                    <td>
                                                                        <?php echo $detail[0]['nim'];?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Angkatan</td>
                                                                    <td>:</td>
                                                                    <td><input type="text" name="angkatan" value="<?php echo substr($detail[0]['nim'], 2, 4); ?>" class="form-control" readonly=''></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nama Lengkap <font class="text-danger">*</font></td>
                                                                    <td>:</td>
                                                                    <td><input type="text" name="nama" value="<?php echo $detail[0]['nama'];?>" class="form-control" required></td>
                                                                </tr>
																<tr>
                                                                    <td>No.KTP <font class="text-danger">*</font></td>
                                                                    <td>:</td>
                                                                    <td><input type="text" name="no_ktp" value="<?php echo $detail[0]['no_ktp'];?>" class="form-control" required></td>
                                                                </tr>
																<tr>
																	<!--<td></td>-->
																	<td>Tempat Lahir</td>
																	<td>:</td>
																	<td><input type="text" name="tempat_lahir" value="<?php echo $detail[0]['tempat_lahir']?>" class="form-control" required></td>
																</td>
																<tr>
																	<!--<td></td>-->
																	<td>Tanggal Lahir</td>
																	<td>:</td>
																	<td><input type="date" name="tgl_lahir" value="<?php echo $detail[0]['tgl_lahir']?>" class="form-control" required></td>
																</td>
																<tr>
																	<!--<td></td>-->
																	<td>Jenis Kelamin</td>
																	<td>:</td>
																	<td>	
																		<select name="jk" class="form-control">
																			<option value=1 <?php if($detail[0]['jk'] == 1){ echo "selected=''";}?>>Laki-laki</option>
																			<option value=2 <?php if($detail[0]['jk'] == 2){ echo "selected=''";}?>>Perempuan</option>
																		</select>
																	</td>
																</tr>
                                                                <tr>
																	<td></td>
                                                                    <td>Agama</td>
                                                                    <td>:</td>
                                                                    <td><select name="agama" id="agama" class="form-control" required=""> 
                                                                        <option value="1" <?php if($detail[0]['agama'] == 1){ echo "selected=''";}?>>Islam</option>
                                                                        <option value="2" <?php if($detail[0]['agama'] == 2){ echo "selected=''";}?>>Kristen</option>
                                                                        <option value="3" <?php if($detail[0]['agama'] == 3){ echo "selected=''";}?>>Katolik</option>
                                                                        <option value="4" <?php if($detail[0]['agama'] == 4){ echo "selected=''";}?>>Hindu</option>
                                                                        <option value="5" <?php if($detail[0]['agama'] == 5){ echo "selected=''";}?>>Budha</option>
                                                                        <option value="6" <?php if($detail[0]['agama'] == 6){ echo "selected=''";}?>>Konghucu</option>
                                                                        <option value="99" <?php if($detail[0]['agama'] == 99){ echo "selected=''";}?>>Lainnya</option>
                                                                        </select></td>
                                                                </tr>
																<tr>
																	<td></td>
                                                                    <td>Nama Ayah</td>
                                                                    <td>:</td>
                                                                    <td><input type="text" name="nama_ayah" value="<?php echo $detail[0]['nama_ayah'];?>" class="form-control" required></td>
                                                                </tr>
																<tr>
																	<td></td>
                                                                    <td>Nama Ibu</td>
                                                                    <td>:</td>
                                                                    <td><input type="text" name="nama_ibu" value="<?php echo $detail[0]['nama_ibu'];?>" class="form-control" required></td>
                                                                </tr>
																
                                                                <tr>
                                                                    <td></td>
                                                                    <td>Nomor Telpon</td>
                                                                    <td>:</td>
                                                                    <td><input type="text" name="telp" value="<?php echo $detail[0]['telp'];?>" class="form-control"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>Nomor HP <font class="text-danger">*</font></td>
                                                                    <td>:</td>
                                                                    <td><input type="text" name="hp" value="<?php echo $detail[0]['hp'];?>" class="form-control" required ></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>Nomor HP Orang Tua</td>
                                                                    <td>:</td>
                                                                    <td><input type="text" name="hp_ortu" value="<?php echo $detail[0]['hp_ortu'];?>" class="form-control"></td>
                                                                </tr>
                                                                <!--<tr>
                                                                    <td></td>
                                                                    <td>Alamat Semarang <font class="text-danger">*</font></td>
                                                                    <td>:</td>
                                                                    <td><textarea name="alamat_semarang" value="<?php echo $detail[0]['alamat_semarang'];?>" class="form-control" required></textarea></td>
                                                                </tr>-->
                                                                <tr>
                                                                    <td></td>
                                                                    <td>Email <font class="text-danger">*</font></td>
                                                                    <td>:</td>
                                                                    <td><input type="email" name="email" value="<?php echo $detail[0]['email'];?>" class="form-control" required></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>Alamat</td>
                                                                    <td>:</td>
                                                                    <td><input type="text" name="alamat" value="<?php echo $detail[0]['alamat'];?>" class="form-control"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>RT</td>
                                                                    <td>:</td>
                                                                    <td><input type="text" name="rt" value="<?php echo $detail[0]['rt'];?>" class="form-control"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>RW</td>
                                                                    <td>:</td>
                                                                    <td><input type="text" name="rw" value="<?php echo $detail[0]['rw'];?>" class="form-control"></td>
                                                                </tr>
																<tr>
                                                                    <td></td>
                                                                    <td>Provinsi</td>
                                                                    <td>:</td>
                                                                    <td><select name="provinsi" id="provinsi" class="form-control" required="">
                                                                            <option selected="" value="<?php echo $detail[0]['provinsi']; ?>"><?php echo $detail[0]['nm_wil']; ?></option>
                                                                            <?php foreach($wilayah as $w){?>
                                                                            <option value="<?php echo $w->id_wil ?>"><?php echo $w->nm_wil ?></option>
                                                                            <?php } ?>
                                                                        </select></td>
                                                                </tr>
																
                                                                <tr>
                                                                    <td></td>
                                                                    <td>Kota / Kabupaten</td>
                                                                    <td>:</td>
                                                                    <td><select name="kokab" id="kotakab" class="form-control" required=""> 
                                                                            <option selected="" value="<?php echo $detail[0]['kokab']; ?>"><?php echo (!empty($detail[1]['nm_wil'])?$detail[1]['nm_wil']:""); ?></option>
                                                                        </select></td>
                                                                </tr>
																<tr>
                                                                    <td></td>
                                                                    <td>Kecamatan</td>
                                                                    <td>:</td>
                                                                    <td><select name="kecamatan" id="kecamatan" class="form-control" required=""> 
                                                                            <option selected="" value="<?php echo $detail[0]['kecamatan']; ?>"><?php echo (!empty($detail[2]['nm_wil'])?$detail[2]['nm_wil']:""); ?></option>
                                                                        </select></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>Kelurahan</td>
                                                                    <td>:</td>
                                                                    <td><input type="text" name="kelurahan" value="<?php echo $detail[0]['kelurahan'];?>" class="form-control"></td>
                                                                </tr>
																<tr>
                                                                    <td></td>
                                                                    <td>Dosen Wali</td>
                                                                    <td>:</td>
                                                                    <td><select name="id_dsn_wali" id="id_dsn_wali" class="form-control js-example-basic-single" required="">
                                                                            <option selected="" value="<?php echo $detail[0]['id_dsn_wali'] ?>"><?php echo $detail[0]['dosen_wali']; ?></option>
                                                                            <?php foreach($dosen as $w){?>
                                                                            <option value="<?php echo $w->id ?>"><?php echo $w->nama ?></option>
                                                                            <?php } ?>
                                                                        </select></td>
                                                                </tr>
                                                                
                                                                
                                                                <!--<tr>
                                                                    <td></td>
                                                                    <td>Status</td>
                                                                    <td>:</td>
                                                                    <td><select name="status" id="status" class="form-control" required=""> 
                                                                            <option selected="" value="<?php echo $detail[0]['status']; ?>"><?php if($detail[0]['status'] == 1){
                                                                        echo 'Aktif';
                                                                        }else if($detail[0]['status'] == 2){
                                                                            echo 'Cuti';
                                                                        }else if($detail[0]['status'] == 3){
                                                                            echo 'Keluar';
                                                                        }else if($detail[0]['status'] == 4){
                                                                            echo 'Lulus';
                                                                        }else if($detail[0]['status'] == 5){
                                                                            echo 'Meninggal';
                                                                        }else if($detail[0]['status'] == 6){
                                                                            echo 'DO';
                                                                        }?></option>
                                                                        <option value="1">Aktif</option>
                                                                        <option value="2">Cuti</option>
                                                                        <option value="3">Keluar</option>
                                                                        <option value="4">Lulus</option>
                                                                        <option value="5">Meninggal</option>
                                                                        <option value="6">DO</option>
                                                                        </select></td>
                                                                </tr>-->
                                                                <tr align="right">
                                                                    <td colspan="4"><hr><input class="btn btn-success" type="submit" value="Update"></td>
                                                                </tr>
                                                            </table>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									<div class="modal fade" id="ubah_photo" tabindex="-1" role="dialog">
										<div class="modal-dialog modal-lg" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title">Ubah Gambar</h4>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form method="POST" action="<?php echo  base_url()?>mhs/dashboard/ubah_photo" enctype="multipart/form-data">
														<input type="hidden" name="nim" value="<?php echo $detail[0]['nim'];?>">
														<label class="col-sm-12 col-form-label">File Gambar : </label>
														<div class="col-sm-10">
															<input type="file" class="form-control" name="foto" value="" >
														</div> 
														<div class="col-sm-12 col-form-label">
															<input type="submit" value="Simpan" class="btn btn-primary">
														</div>
													</form>
												</div>
											 </div>
										</div>
									</div>
<script type="text/javascript">
    $(document).ready(function(){
                                            $('#provinsi').change(function(){
                                                var id=$(this).val();
                                                $.ajax({
                                                    url : "<?php echo base_url();?>mhs/dashboard/daftar_kotakab/",
                                                    method : "POST",
                                                    data : {id: id},
                                                    async : false,
                                                    dataType : 'json',
                                                    success: function(data){
                                                        var html = '';
                                                        var i;
                                                        for(i=0; i<data.length; i++){
                                                            html += '<option value="'+ data[i].id_wil +'">'+data[i].nm_wil+'</option>';
                                                        }
                                                        $('#kotakab').html(html);
                                                         
                                                    }
                                                });
                                            });
                                            $('#kotakab').change(function(){
                                                var id=$(this).val();
                                                $.ajax({
                                                    url : "<?php echo base_url();?>mhs/dashboard/daftar_kec/",
                                                    method : "POST",
                                                    data : {id: id},
                                                    async : false,
                                                    dataType : 'json',
                                                    success: function(data){
                                                        var html = '';
                                                        var i;
                                                        for(i=0; i<data.length; i++){
                                                            html += '<option value="'+ data[i].id_wil +'">'+data[i].nm_wil+'</option>';
                                                        }
                                                        $('#kecamatan').html(html);
                                                         
                                                    }
                                                });
                                            });
                                        });
</script>