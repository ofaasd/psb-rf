                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <?php echo $this->session->userdata('pertemuan'); 
                                                              $this->session->set_userdata('pertemuan','');
                                                              ?>
                                                        <h5>Setting Pertemuan</h5>&nbsp;
                                                    <div class="card-block">
                                                    <form action="<?php echo base_url('master/pertemuan/simpan'); ?>" method="post">
                                                        <table width="50%">
                                                            <?php $no = 1;
                                                            foreach($temu as $a){?>
                                                                <input hidden="" name="id_jadwal" value="<?php echo $a->id ?>">
                                                                <input hidden="" name="id_tahun" value="<?php echo $a->id_tahun ?>">
                                                                <tr>
                                                                    <td><b>Kode Mata Kuliah</b></td>
                                                                    <td><b>: </b></td>
                                                                    <td><?php echo $a->kode_mata_kuliah ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Nama Mata Kuliah</b></td>
                                                                    <td><b>: </b></td>
                                                                    <td><?php echo $a->nama_mata_kuliah ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Dosen Pengampu</b></td>
                                                                    <td><b>: </b></td>
                                                                    <td><?php echo $a->nama_dosen ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Hari, Jam & Ruang</b></td>
                                                                    <td><b>: </b></td>
                                                                    <td><?php echo $a->hari.", ".$a->sesi."  ".$a->ruang; ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                        <hr>
                                                        <div class="dt-responsive table-responsive">
                                                            <table width="50%">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Pertemuan</th>
                                                                    <th>Tanggal Pertemuan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>Pertemuan 1</td>
                                                                    <td><input type="date" name="pertemuan1" class="form-control" value="<?php 
                                                                    if (!empty($tgl[0])) {
                                                                        # code...
                                                                        echo $tgl[0]['tgl_pertemuan'];
                                                                    }
                                                                    ?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2</td>
                                                                    <td>Pertemuan 2</td>
                                                                    <td><input type="date" name="pertemuan2" class="form-control" value="<?php 
                                                                    if (!empty($tgl[1])) {
                                                                        # code...
                                                                        echo $tgl[1]['tgl_pertemuan'];
                                                                    }
                                                                    ?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>3</td>
                                                                    <td>Pertemuan 3</td>
                                                                    <td><input type="date" name="pertemuan3" class="form-control" value="<?php 
                                                                    if (!empty($tgl[2])) {
                                                                        # code...
                                                                        echo $tgl[2]['tgl_pertemuan'];
                                                                    }
                                                                    ?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>4</td>
                                                                    <td>Pertemuan 4</td>
                                                                    <td><input type="date" name="pertemuan4" class="form-control" value="<?php 
                                                                    if (!empty($tgl[3])) {
                                                                        # code...
                                                                        echo $tgl[3]['tgl_pertemuan'];
                                                                    }
                                                                    ?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>5</td>
                                                                    <td>Pertemuan 5</td>
                                                                    <td><input type="date" name="pertemuan5" class="form-control" value="<?php 
                                                                    if (!empty($tgl[4])) {
                                                                        # code...
                                                                        echo $tgl[4]['tgl_pertemuan'];
                                                                    }
                                                                    ?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>6</td>
                                                                    <td>Pertemuan 6</td>
                                                                    <td><input type="date" name="pertemuan6" class="form-control" value="<?php 
                                                                    if (!empty($tgl[5])) {
                                                                        # code...
                                                                        echo $tgl[5]['tgl_pertemuan'];
                                                                    }
                                                                    ?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>7</td>
                                                                    <td>Pertemuan 7</td>
                                                                    <td><input type="date" name="pertemuan7" class="form-control" value="<?php 
                                                                    if (!empty($tgl[6])) {
                                                                        # code...
                                                                        echo $tgl[6]['tgl_pertemuan'];
                                                                    }
                                                                    ?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>8</td>
                                                                    <td>Pertemuan 8</td>
                                                                    <td><input type="date" name="pertemuan8" class="form-control" value="<?php 
                                                                    if (!empty($tgl[7])) {
                                                                        # code...
                                                                        echo $tgl[7]['tgl_pertemuan'];
                                                                    }
                                                                    ?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>9</td>
                                                                    <td>Pertemuan 9</td>
                                                                    <td><input type="date" name="pertemuan9" class="form-control" value="<?php 
                                                                    if (!empty($tgl[8])) {
                                                                        # code...
                                                                        echo $tgl[8]['tgl_pertemuan'];
                                                                    }
                                                                    ?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>10</td>
                                                                    <td>Pertemuan 10</td>
                                                                    <td><input type="date" name="pertemuan10" class="form-control" value="<?php 
                                                                    if (!empty($tgl[9])) {
                                                                        # code...
                                                                        echo $tgl[9]['tgl_pertemuan'];
                                                                    }
                                                                    ?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>11</td>
                                                                    <td>Pertemuan 11</td>
                                                                    <td><input type="date" name="pertemuan11" class="form-control" value="<?php 
                                                                    if (!empty($tgl[10])) {
                                                                        # code...
                                                                        echo $tgl[10]['tgl_pertemuan'];
                                                                    }
                                                                    ?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>12</td>
                                                                    <td>Pertemuan 12</td>
                                                                    <td><input type="date" name="pertemuan12" class="form-control" value="<?php 
                                                                    if (!empty($tgl[11])) {
                                                                        # code...
                                                                        echo $tgl[11]['tgl_pertemuan'];
                                                                    }
                                                                    ?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>13</td>
                                                                    <td>Pertemuan 13</td>
                                                                    <td><input type="date" name="pertemuan13" class="form-control" value="<?php 
                                                                    if (!empty($tgl[12])) {
                                                                        # code...
                                                                        echo $tgl[12]['tgl_pertemuan'];
                                                                    }
                                                                    ?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>14</td>
                                                                    <td>Pertemuan 14</td>
                                                                    <td><input type="date" name="pertemuan14" class="form-control" value="<?php 
                                                                    if (!empty($tgl[13])) {
                                                                        # code...
                                                                        echo $tgl[13]['tgl_pertemuan'];
                                                                    }
                                                                    ?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>15</td>
                                                                    <td>Pertemuan 15</td>
                                                                    <td><input type="date" name="pertemuan15" class="form-control" value="<?php 
                                                                    if (!empty($tgl[14])) {
                                                                        # code...
                                                                        echo $tgl[14]['tgl_pertemuan'];
                                                                    }
                                                                    ?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>16</td>
                                                                    <td>Pertemuan 16</td>
                                                                    <td><input type="date" name="pertemuan16" class="form-control" value="<?php 
                                                                    if (!empty($tgl[15])) {
                                                                        # code...
                                                                        echo $tgl[15]['tgl_pertemuan'];
                                                                    }
                                                                    ?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="3"><hr><center><input type="submit" class="btn btn-success" value="Simpan/Update"></center></td>
                                                                </tr>
                                                            </tbody>
                                                          </table>
                                                    </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
