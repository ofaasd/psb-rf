                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <?php 
                                                        echo $this->session->userdata('presensi'); 
                                                        $this->session->set_userdata('presensi','');
                                                              ?>
                                                        <h5>PILIH TANGGAL PERTEMUAN</h5>&nbsp;
                                                    <div class="card-block">
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="order-table" class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>NIM</th>
                                                                    <th>Nama Mahasiswa</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $no = 1;
                                                            foreach($temu as $a){?>
                                                                <tr>
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td><?php echo $a->nim ?></td>
                                                                    <td><?php echo $a->nama ?></td>
                                                                    <td>
                                                                          <a href="<?php echo base_url().'master/presensi/input_mhs/'.$a->nim; ?>" class="btn btn-success">Input Presensi</a>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>NIM</th>
                                                                    <th>Nama Mahasiswa</th>
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
