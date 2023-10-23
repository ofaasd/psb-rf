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
                                                                    <th>Dosen Wali</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $no = 1;
                                                            foreach($mhs as $m){?>
                                                                <tr>
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td><?php echo $m->nim ?></td>
                                                                    <td><?php echo $m->nama ?></td>
                                                                    <td><?php echo $m->nama_jurusan.'-'.$m->jenjang; ?></td>
                                                                    <td><?php echo $m->nama_fakultas ?></td>
                                                                    <td><select name="dsn_wali" id="dsn<?php echo $m->nim; ?>" class="js-example-basic-single form-control" onchange="saveDsn('<?php echo $m->nim; ?>')">
                                                                        <?php
                                                                            if (is_null($m->id_dsn_wali)) {
                                                                                echo "<option selected='' disabled>--Pilih Dsn Wali--</option>";
                                                                            }else{
                                                                                echo "<option value='".$m->id_dsn_wali."' selected=''>".$m->nama_lengkap."</option>";
                                                                            }
                                                                            $list_dosen = $this->db->get('pegawai')->result();
                                                                            foreach ($list_dosen as $l) {
                                                                                echo "<option value='".$l->id."'>".$l->nama."</option>";
                                                                            }
                                                                        ?>
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
    function saveDsn(nim){
        var id_dsn_wali = document.getElementById("dsn"+nim).value;
        // console.log(nim);
        // console.log(id_dsn_wali);
        $.ajax({
            url : "<?php echo base_url();?>akademik/perwalian/save_dsn/",
            method : "POST",
            data : {nim: nim,
                    id_dsn_wali: id_dsn_wali},
            async : false,
            dataType : 'json',
            success: function(data){
                // console.log(data)
                if (data.result == 1) {
                    alert('Berhasil input dosen wali');
                }else{   
                    alert('Gagal input dosen wali');
                }
            }
        });
    }
</script>