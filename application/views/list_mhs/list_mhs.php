                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>DAFTAR MAHASISWA</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="order-table" class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>NIM</th>
                                                                    <th>Nama Lengkap</th>
                                                                    <th>Email</th>
                                                                    <th>status</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $no = 1;
                                                            foreach($daftar_mhs as $a){?>
                                                                <tr>
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td><?php echo $a->nim ?></td>
                                                                    <td><?php echo $a->nama ?></td>
                                                                    <td><?php echo $a->email ?></td>
                                                                    <td><?php if($a->status == 1){
                                                                        echo 'Aktif';
                                                                        }else if($a->status == 2){
                                                                            echo 'Cuti';
                                                                        }else if($a->status == 3){
                                                                            echo 'Keluar';
                                                                        }else if($a->status == 4){
                                                                            echo 'Lulus';
                                                                        }else if($a->status == 5){
                                                                            echo 'Meninggal';
                                                                        }else if($a->status == 6){
                                                                            echo 'DO';
                                                                        }?></td>
                                                                    <td><a href="<?php echo base_url()?>master/khs/khs_detail/<?php echo $a->nim?>" class="btn btn-success">Lihat KHS</a></td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>NIM</th>
                                                                    <th>Nama Lengkap</th>
                                                                    <th>Email</th>
                                                                    <th>Status</th>
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