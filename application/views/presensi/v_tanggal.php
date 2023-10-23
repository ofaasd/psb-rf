                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <?php 
                                                        echo $this->session->userdata('presensi'); 
                                                        $this->session->set_userdata('presensi','');
                                                              ?>
                                                        <h5>PILIH TANGGAL PERTEMUAN</h5>&nbsp;<a href="<?php echo base_url('master/presensi/download_template/'.$id_jadwal); ?>" class="btn btn-success">Download Template</a>
                                                    <div class="card-block">
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="order-table" class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Pertemuan</th>
                                                                    <th>Tanggal</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            if (empty($temu)) {
                                                                # code...
                                                                echo "<p><b>Tanggal Pertemuan belum diatur. Silahkan ke menu Akademik->Pengaturan Pertemuan";
                                                            }
                                                            $no = 1; $i = 1;
                                                            foreach($temu as $a){?>
                                                                <tr>
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td><?php echo "Pertemuan Ke-".$i++ ?></td>
                                                                    <td><?php $date = date_create($a->tgl_pertemuan); echo date_format($date,"d/m/Y"); ?></td>
                                                                    <td>
                                                                          <a href="<?php echo base_url().'master/presensi/input/'.$a->id; ?>" class="btn btn-success">Input Presensi</a>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Pertemuan</th>
                                                                    <th>Tanggal</th>
                                                                    <th></th>
                                                                </tr>
                                                            </tfoot>
                                                          </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
