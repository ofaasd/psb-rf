<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <?php 
                    echo $this->session->userdata('presensi'); 
                    $this->session->set_userdata('presensi','');
                    if (!is_null($memos)) {
                        $memo = $memos->memo;
                        $sub = $memos->sub;
                        $hdr = $memos->mhs_hadir;
                    }else{
                        $memo = null;
                        $sub = null;
                        $hdr = 0;
                    }
                          ?>
                          <a href="<?php echo base_url('master/presensi/tanggal/'.$jadwal_id); ?>" class="btn btn-primary">Kembali</a><hr>
                    <h5>Input Presensi</h5>&nbsp;
                <div class="card-block">
                    <form action="<?php echo base_url('master/presensi/simpan'); ?>" method="post">
                    <div class="dt-responsive table-responsive">
                        <label>Materi Kontrak Perkuliahan :</label>
                        <textarea class="form-control" name="memo"><?php echo $memo ?></textarea>
                        <br>
                        <label>Sub Pembahasan :</label>
                        <textarea class="form-control" name="sub"><?php echo $sub ?></textarea>
                        <br>
                        <label>Jumlah Mahasiswa Hadir : <?php echo $hdr; ?></label>
                        <br>
                        <table class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1; $id_jadwal = 1; $nim = 1; $status_ = 1; $tgl = 1; $stat = ''; $stat_val = ''; $id = 1; $total_rec = 0;
                        foreach($mhs as $a){
                            $status = $this->db->get_where('master_presensi', array('nim' => $a->nim, 'tgl_pertemuan' => $tgl_pertemuan))->row();
                            if (empty($status->status)) {
                                # code...
                                $stat_val = "";
                                $stat = "-- Pilih Status --";
                            }elseif ($status->status == 1) {
                                # code...
                                $stat_val = 1;
                                $stat = "Hadir";
                            }elseif($status->status == 2){
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
                                <td>
                                <input value="<?php echo $a->id_jadwal; ?>" type="text" hidden="" name="id_jadwal<?php echo $id_jadwal++; ?>">
                                <input value="<?php echo $a->nim; ?>" type="text" hidden="" name="nim<?php echo $nim++; ?>"><?php echo $a->nim ?></td>
                                <td><?php echo $a->nama ?></td>
                                <td><input value="<?php echo $tgl_pertemuan; ?>" type="date" hidden="" name="tgl<?php echo $tgl++; ?>">
                                <?php $date = date_create($tgl_pertemuan); echo date_format($date,"d/m/Y"); ?></td>
                                <td>
                                      <select name="status<?php echo $status_++;?>">
                                          <?php
                                            if (empty($status->status)) {
                                                # code...
                                                echo "<option selected='' value='1'>Hadir</option>";
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
                      <input value="<?php echo $id_pertemuan; ?>" type="text" hidden="" name="id_pertemuan">
                      <input type="submit" class="btn btn-success" value="simpan">
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
