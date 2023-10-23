                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <?php 
                                                        echo $this->session->userdata('status_delete'); 
                                                        $this->session->set_userdata('status_delete','');
                                                        ?>
                                                        <h5>DAFTAR MAHASISWA BARU</h5>
                                                    </div>
                                                   
                                                    
                                                    <div class="card-block">
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="order-table" class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>No. Pendaftaran</th>
                                                                    <th>NISN</th>
                                                                    <th>Nama Lengkap</th>
                                                                    <th>Jenis Pendaftaran</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $no = 1;
                                                            foreach($daftar_pmb as $a){?>
                                                                <tr>
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td><?php echo $a->nopen ?></td>
                                                                    <td><?php echo $a->nisn ?></td>
                                                                    <td><?php echo $a->nama ?></td>
                                                                    <td><?php if($a->jenis_pendaftaran == 1){
                                                                        echo 'Peserta Didik Baru';
                                                                        }else if($a->jenis_pendaftaran == 2){
                                                                            echo 'Pindahan';
                                                                        }else if($a->jenis_pendaftaran == 11){
                                                                            echo 'Alih Jenjang';
                                                                        }else if($a->jenis_pendaftaran == 12){
                                                                            echo 'Lintas Jalur';
                                                                        }?></td>
                                                                    <td><a href="<?php echo base_url()?>master/keuangan/detail_biaya_pendaftaran/<?php echo $a->nopen?>" class="btn btn-success">Detail</a></td>
                                                                </tr>
                                                            <?php 
                                                            }
                                                            
                                                            ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>No. Pendaftaran</th>
                                                                    <th>NISN</th>
                                                                    <th>Nama Lengkap</th>
                                                                    <th>Jenis Pendaftaran</th>
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