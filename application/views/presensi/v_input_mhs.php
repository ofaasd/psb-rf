<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <?php 
                    echo $this->session->userdata('presensi'); 
                    $this->session->set_userdata('presensi','');
                          ?>
                          <br>
                    <h5>PILIH TANGGAL PERTEMUAN</h5>&nbsp;
                <div class="card-block">
                <form action="<?php echo base_url('master/presensi/simpan_p'); ?>" method="post">
                    <div class="dt-responsive table-responsive">
                        <table class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pertemuan</th>
                                <th>Tanggal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1; $id_jadwal = 1; $nim = 1; $total=0; $status_ = 1; $tgl= 1; $stat_val = 0; $stat = ''; $total_rec = 0; $id = 1; $i=1;
                        foreach($temu as $a){
                            $get_stat = $this->db->get_where('master_presensi', array('id_jadwal' => $a->id_jadwal,'nim' => $get_nim, 'tgl_pertemuan' => $a->tgl_pertemuan))->row();
                            if(empty($get_stat->status)){
                                $stat_val = '';
                                $stat = "-- Pilih Status --";
                            }elseif ($get_stat->status == 1) {
                                # code...
                                $stat_val = 1;
                                $stat = "Hadir";
                            }elseif($get_stat->status == 2){
                                $stat_val = 2;
                                $stat = "Izin";
                            }else{
                                $stat_val = 3;
                                $stat = "Tanpa Keterangan";
                            }
                            $total_rec += $id;
                            ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo "Pertemuan Ke-".$i++ ?></td>
                                <td><?php $date = date_create($a->tgl_pertemuan); echo date_format($date,"d/m/Y"); ?></td>
                                <td>
                                      <input type="text" name="id_jadwal<?php echo $id_jadwal++ ?>" value="<?php echo $a->id_jadwal ?>" hidden="" />
                                      <input type="text" name="nim<?php echo $nim++ ?>" value="<?php echo $get_nim ?>" hidden="" />
                                      <input type="date" name="tgl<?php echo $tgl++ ?>" value="<?php echo $a->tgl_pertemuan ?>" hidden="" />
                                      <select name="status<?php echo $status_++; ?>">
                                          <?php 
                                            if (empty($get_stat->status)) {
                                                # code...
                                                echo "<option selected='' disabled=''>-- Pilih Status --</option>";
                                            }else{
                                                echo "<option selected='' value='".$stat_val."'>".$stat."</option>";
                                            }
                                          ?>
                                        <option value="1">Hadir</option>
                                        <option value="2">Izin</option>
                                        <option value="3">Tanpa Keterangan</option>
                                      </select>

                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                      </table>
                      <input value="<?php echo $total_rec; ?>" type="text" hidden="" name="total">
                      <input type="submit" class="btn btn-success" value="simpan">
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
