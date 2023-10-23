<div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                    <a class="btn btn-primary" href="<?php echo base_url('mahasiswa');?>">Kembali</a><hr>
                                                        <h5>DAFTAR MAHASISWA</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="dt-responsive table-responsive">
                                                            <form action="<?php echo base_url('mahasiswa/update/')?>" method="post">
                                                            <table width="80%">
                                                                <tr>
                                                                    <td rowspan="4" style="position: top;"><center><img src="<?php echo base_url().'assets/foto_pmb_peserta/'.$detail[0]['foto_mhs'];?>" width="120px" height="160px"></center></td>
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
                                                                    <td><input type="text" name="angkatan" value="<?php echo substr($detail[0]['nim'], 2,4);?>" class="form-control" readonly=''></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Program Studi</td>
                                                                    <td>:</td>
                                                                    <td><select name="prodi" id="prodi" class="form-control" required=""> 
                                                                        <?php foreach ($prodi as $p): ?>
                                                                            <option value="<?php echo $p->id ?>" <?php echo $detail[0]['id_program_studi'] == $p->id?"selected":"";?>><?php echo $p->nama_jurusan ?></option>    
                                                                        <?php endforeach ?>
                                                                    </select></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nama Lengkap</td>
                                                                    <td>:</td>
                                                                    <td><input type="text" name="nama" value="<?php echo $detail[0]['nama'];?>" class="form-control"></td>
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
                                                                        <option value="99" <?php if($detail[0]['agama'] == 99){ echo "selected=''";}?>>Konghucu</option>
                                                                        </select></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>Nomor Telpon</td>
                                                                    <td>:</td>
                                                                    <td><input type="text" name="telp" value="<?php echo $detail[0]['telp'];?>" class="form-control"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>Nomor HP</td>
                                                                    <td>:</td>
                                                                    <td><input type="text" name="hp" value="<?php echo $detail[0]['hp'];?>" class="form-control"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>Nomor HP Orang Tua</td>
                                                                    <td>:</td>
                                                                    <td><input type="text" name="hp_ortu" value="<?php echo $detail[0]['hp_ortu'];?>" class="form-control"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>Alamat Semarang</td>
                                                                    <td>:</td>
                                                                    <td><input type="text" name="alamat_semarang" value="<?php echo $detail[0]['alamat_semarang'];?>" class="form-control"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>Email</td>
                                                                    <td>:</td>
                                                                    <td><input type="text" name="email" value="<?php echo $detail[0]['email'];?>" class="form-control"></td>
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
                                                                    <td>Kelurahan</td>
                                                                    <td>:</td>
                                                                    <td><input type="text" name="kelurahan" value="<?php echo $detail[0]['kelurahan'];?>" class="form-control"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>Kecamatan</td>
                                                                    <td>:</td>
                                                                    <td><select name="kecamatan" id="kecamatan" class="form-control" required=""> 
                                                                            <option selected="" value="<?php echo $detail[0]['kecamatan']; ?>"><?php echo $detail[2]['nm_wil']; ?></option>
                                                                        </select></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>Kota / Kabupaten</td>
                                                                    <td>:</td>
                                                                    <td><select name="kokab" id="kotakab" class="form-control" required=""> 
                                                                            <option selected="" value="<?php echo $detail[0]['kokab']; ?>"><?php echo $detail[1]['nm_wil']; ?></option>
                                                                        </select></td>
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
                                                                </tr>
                                                                <tr align="right">
                                                                    <td colspan="4"><hr><input class="btn btn-success" type="submit" value="Simpan"></td>
                                                                </tr>
                                                            </table>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
<script type="text/javascript">
    $(document).ready(function(){
                                            $('#provinsi').change(function(){
                                                var id=$(this).val();
                                                $.ajax({
                                                    url : "<?php echo base_url();?>pmb/daftar_kotakab/",
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
                                                    url : "<?php echo base_url();?>pmb/daftar_kec/",
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