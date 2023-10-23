                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <?php 
                                                        echo $this->session->userdata('status_delete'); 
                                                        $this->session->set_userdata('status_delete','');
                                                        ?>

                                                        <a href="<?php echo base_url()?>pmb/tambah_calon_mhs" class="btn btn-success btn-round">TAMBAH CALON MAHASISWA</a><hr>
                                                        <h5>DAFTAR CALON MAHASISWA BARU</h5>
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
                                                                    <th><button onclick="location.href='<?=base_url('pmb/cetak_formulir_all/')?>';" class="btn btn-secondary"><i class="fa fa-download" aria-hidden="true"></i>
                                                                     Unduh Semua</button></th>
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
                                                                    <td><a href="<?php echo base_url()?>pmb/cetak_formulir/<?php echo $a->nopen?>" class="btn btn-success">Cetak Formulir</a>&ensp;<a href="<?php echo base_url()?>pmb/cmhs_detail/<?php echo $a->id?>" class="btn btn-info">Detail</a>&ensp;<a href="<?php echo base_url()?>pmb/registrasi/<?php echo $a->id?>" class="btn btn-success">Registrasi</a>&ensp;<a href="<?php echo base_url()?>pmb/delete_calon_mhs/<?php echo $a->id?>" onclick="return confirm('Yakin Delete Data Calon Mahasiswa?')" class="btn btn-danger">Delete</a></td>
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