                        <?php
                            echo $this->session->userdata('notif');
                            $this->session->unset_userdata('notif');
                        ?>
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
                                                                    <th>#</th>
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
                                                                    <td><a href="<?php echo base_url(); ?>akademik/perwalian/reset_act/<?php echo $m->nim ?>" title="delete" class="btn btn-primary" onclick="return confirm('Apakah Anda yakin akan menyetel ulang kata sandi <?php echo $m->nama ?>') ">Reset</a></td>
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