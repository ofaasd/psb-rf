                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>PERWALIAN</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="order-table" class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>NIM</th>
                                                                    <th>Nama Lengkap</th>
                                                                    <th>Jurusan</th>
                                                                    <th>Fakultas</th>
                                                                    <th>Jumlah SKS</th>
                                                                    <th>Verifikasi KRS</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $no = 1;
                                                            foreach($mhs as $m){?>
                                                                <tr>
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td><?php echo $m->nim ?></td>
                                                                    <td><a href="<?php echo base_url();?>akademik/perwalian/cetak_krs/<?php echo $m->nim?>"><?php echo $m->nama ?></a></td>
                                                                    <td><?php echo $m->nama_jurusan.'-'.$m->jenjang; ?></td>
                                                                    <td><?php echo $m->nama_fakultas ?></td>
                                                                    <td><?php echo (empty($m->jumlah_sks))?0:$m->jumlah_sks; ?>/24 <a href="#" data-toggle="modal" data-target="#myModal<?php echo $m->nim ?>" class="btn btn-primary" style="font-size:11px; width: 10px; padding-left: 5px; padding-top: 2px; height: 5px;"><b>KRS</b></a>    
                                                                        <!-- Modal -->
                                                                        <div id="myModal<?php echo $m->nim ?>" class="modal fade" role="dialog">
                                                                          <div class="modal-dialog">
                                                                            <style type="text/css">
                                                                                .modal-dialog{max-width:920px;margin:30px auto}
                                                                            </style>
                                                                            <!-- Modal content-->
                                                                            <div class="modal-content" style="width: 100%;">
                                                                              <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                <h4 class="modal-title"><?php echo $m->nim.' - '.$m->nama; ?></h4>
                                                                              </div>
                                                                              <div class="modal-body">
                                                                                <?php
                                                                                    $ta = $this->db->query("SELECT * FROM `master_tahun_ajaran` where is_aktif = 1")->row();
                                                                                    $krs = $this->db->query("SELECT master_krs_temp.*,  
                                                                                                            master_jadwal_temp.kode_mata_kuliah, 
                                                                                                            master_tahun_ajaran.*,
                                                                                                            master_mata_kuliah.jumlah_sks 
                                                                                                            FROM `master_krs_temp` 
                                                                                                            INNER JOIN master_jadwal_temp ON master_krs_temp.id_jadwal = master_jadwal_temp.id 
                                                                                                            INNER JOIN master_tahun_ajaran ON master_krs_temp.id_tahun = master_tahun_ajaran.id
                                                                                                            INNER JOIN master_mata_kuliah ON master_jadwal_temp.kode_mata_kuliah = master_mata_kuliah.kode_mata_kuliah 
                                                                                                            WHERE master_krs_temp.nim = '".$m->nim."'
                                                                                                            AND master_krs_temp.id_tahun = $ta->id")->result();
                                                                                ?>
                                                                                <table class="table-striped" width="100%">
                                                                                    <tr>
                                                                                        <td rowspan="2"><center><b>No</b></center></td>
                                                                                        <td rowspan="2"><center><b>Kode MK</b></center></td>
                                                                                        <td rowspan="2"><center><b>Nama Mata Kuliah</b></center></td>
                                                                                        <td rowspan="2"><center><b>SKS</b></center></td>
                                                                                        <td colspan="2"><center><b>Jadwal</b></center></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td><center><b>Hari, Jam</b></center></td>
                                                                                        <td><center><b>Ruang</b></center></td>
                                                                                    </tr>
                                                                                    <?php $no=1; $total = 0; foreach($krs as $a){?>
                                                                                    <tr >
                                                                                        <td><center><?php echo $no++;?></center></td>
                                                                                        <td><center><?php echo $a->kode_mata_kuliah ?></center></td>
                                                                                        <td><?php echo $a->mata_kuliah ?></td>
                                                                                        <td><center><?php echo $a->jumlah_sks ?></center></td>
                                                                                        <td><center><?php echo $a->hari.", ".$a->sesi; ?></center></td>
                                                                                        <td><center><?php echo urldecode($a->ruang) ?></center></td>
                                                                                    </tr>
                                                                                    <?php $total += $a->jumlah_sks; 
                                                                                    }?>

                                                                                    <tr>
                                                                                        <td colspan="3" align="right"><b>Jumlah SKS</b></td>
                                                                                        <td><center><b><?php echo $total; ?></b></center></td>
                                                                                        <td colspan="2" bgcolor="white"></td>
                                                                                    </tr>
                                                                                </table>
                                                                              </div>
                                                                              <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                              </div>
                                                                            </div>

                                                                          </div>
                                                                        </div>
                                                                    </td>
                                                                    <td><select name="status_krs" id="status_krs-<?php echo $m->nim; ?>" class="form-control" onchange="verifikasi('<?php echo $m->nim; ?>')">
                                                                        <option value="0" <?php echo ($m->status_krs == 0)?"selected":""?>>Belum</option>
                                                                        <option value="1" <?php echo ($m->status_krs == 1)?"selected":""?>>Sudah</option>
                                                                    </select></td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                          </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
<script type="text/javascript">
    function verifikasi(nim){
        var status_krs = document.getElementById("status_krs-"+nim).value;
        // console.log(nim);
        // console.log(id_dsn_wali);
        $.ajax({
            url : "<?php echo base_url();?>akademik/perwalian/verifikasi/",
            method : "POST",
            data : {nim: nim,
                    status_krs: status_krs},
            async : false,
            dataType : 'json',
            success: function(data){
                // console.log(data)
                if (data.result == 1) {
                    alert('Berhasil Ubah Data Verifikasi');
                }else{   
                    alert('Gagal Ubah Data Verifikasi');
                }
            }
        });
    }
</script>