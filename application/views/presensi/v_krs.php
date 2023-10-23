                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <?php 
                                                        echo $this->session->userdata('presensi'); 
                                                        $this->session->set_userdata('presensi','');
                                                              ?>
                                                    <div class="card-block">
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="order-table" class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Matakuliah</th>
                                                                    <th>sks</th>
                                                                    <th>Hari, Jam</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $no = 1;
                                                            foreach($temu as $a){?>
                                                                <tr>
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td><?php echo $a->mata_kuliah ?></td>
                                                                    <td><?php echo $a->sks ?></td>
                                                                    <td><?php echo $a->hari.", ".$a->sesi."  ".$a->ruang; ?></td>
                                                                    <td>
                                                                          <a href="<?php echo base_url().'master/presensi/p/'.$this->openssl->convert("encrypt", $a->id_jadwal."-".$a->nim); ?>" class="btn btn-success">Set Presensi</a>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Matakuliah</th>
                                                                    <th>sks</th>
                                                                    <th>Hari, Jam</th>
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
