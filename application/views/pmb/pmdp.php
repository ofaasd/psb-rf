                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <?php echo $this->session->userdata('status_delete'); 
                                                              $this->session->set_userdata('status_delete','');
                                                              ?>
                                                       <!--  <a href="<?php echo base_url()?>pmb/tambah_calon_mhs" class="btn btn-success btn-round">TAMBAH CALON MAHASISWA</a><hr> -->
                                                        <h5>DAFTAR PESERTA PMDP</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <a href="<?php echo base_url('pmb/download_pmdp'); ?>" class="btn btn-primary"><span class="fa fa-download"></span>Download Excel</a>
                                                        <br>
                                                        <br>
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="order-table" class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>No. Pendaftaran</th>
                                                                    <th>NISN</th>
                                                                    <th>Nama Lengkap</th>
                                                                    <th>Jenis Pendaftaran</th>
                                                                    <th>Nilai Total</th>
                                                                    <th>Jurusan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $no = 1;
                                                            foreach($list as $a){?>
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
                                                                    <td><?php echo $a->peringkat_pmdp ?></a>
                                                                    <td><?php echo $this->bantuan->pilihan_prodi($a->pilihan1); ?></a>
                                                                        <!-- <a href="<?php echo base_url()?>pmb/pmb/surat_pengumuman/<?php echo $a->id?>" class="btn btn-primary">Surat Pernyataan</a> -->
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>No. Pendaftaran</th>
                                                                    <th>NISN</th>
                                                                    <th>Nama Lengkap</th>
                                                                    <th>Jenis Pendaftaran</th>
                                                                    <th>Nilai Total</th>
                                                                    <th>Jurusan</th>
                                                                </tr>
                                                            </tfoot>
                                                          </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>