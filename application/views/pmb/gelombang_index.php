                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <?php 
                                                        echo $this->session->userdata('status_delete'); 
                                                        $this->session->set_userdata('status_delete','');
                                                        ?>

                                                        <a href="<?php echo base_url()?>pmb/tambah_calon_mhs" class="btn btn-success btn-round">TAMBAH GELOMBANG</a><hr>
                                                        <h5>DAFTAR GELOMBANG</h5>
                                                    </div>
                                                   
                                                    
                                                    <div class="card-block">
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="order-table" class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Kode Gelombang</th>
                                                                    <th>Nomor Gelombang</th>
                                                                    <th>Nama Gelombang</th>
                                                                    <th>Tanggal Mulai</th>
                                                                    <th>Tanggal Akhir</th>
                                                                    <th>#</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $no = 1;
                                                            foreach($data as $a){?>
                                                                <tr>
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td><?php echo $a->nama_gel ?></td>
                                                                    <td><?php echo $a->no_gel ?></td>
                                                                    <td><?php echo $a->nama_gel_long ?></td>
                                                                    <td><?php echo date_format(date_create($a->tgl_mulai), 'd-m-Y'); ?></td>
                                                                    <td><?php echo date_format(date_create($a->tgl_akhir), 'd-m-Y'); ?></td>
                                                                    <td><a href="<?php echo base_url('pmb/gelombang_edit/'.$a->id); ?>" class="btn btn-primary"><span><i class="fa fa-file"></i></span> Detail</a></td>
                                                                </tr>
                                                            <?php 
                                                            }
                                                            
                                                            ?>
                                                            </tbody>
                                                          </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>