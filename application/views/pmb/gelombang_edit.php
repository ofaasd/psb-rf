                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <?php 
                                                        echo $this->session->userdata('status_delete'); 
                                                        $this->session->set_userdata('status_delete','');
                                                        ?>

                                                        <a href="<?php echo base_url()?>pmb/gelombang" class="btn btn-success btn-round">KEMBALI</a><hr>
                                                        <h5>DETAIL GELOMBANG</h5>
                                                    </div>
                                                   
                                                    
                                                    <div class="card-block">
                                                        <form action="<?php echo base_url('pmb/gelombang_update'); ?>" method="post">
                                                            <?php foreach ($data as $a): ?>
                                                             <table>
                                                                <tr>
                                                                    <td>
                                                                        Nomor Gelombang
                                                                    </td>
                                                                    <td>:</td>
                                                                    <td><input type="number" name="no_gel" value="<?php echo $a->no_gel ?>" class="form-control"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Kode Gelombang
                                                                    </td>
                                                                    <td>:</td>
                                                                    <td><input type="text" name="nama_gel" value="<?php echo $a->nama_gel ?>" class="form-control"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Nama Gelombang
                                                                    </td>
                                                                    <td>:</td>
                                                                    <td><input type="text" name="nama_gel_long" value="<?php echo $a->nama_gel_long ?>" class="form-control"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Tanggal Mulai
                                                                    </td>
                                                                    <td>:</td>
                                                                    <td><input type="date" name="tgl_mulai" value="<?php echo $a->tgl_mulai ?>" class="form-control"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Tanggal Akhir
                                                                    </td>
                                                                    <td>:</td>
                                                                    <td><input type="date" name="tgl_akhir" value="<?php echo $a->tgl_akhir ?>" class="form-control"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Tanggal Ujian
                                                                    </td>
                                                                    <td>:</td>
                                                                    <td><input type="date" name="ujian" value="<?php echo $a->ujian ?>" class="form-control"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Jam Ujian
                                                                    </td>
                                                                    <td>:</td>
                                                                    <td><input type="time" name="jam_ujian" value="<?php echo $a->jam_ujian ?>" class="form-control"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Pengumuman Ujian
                                                                    </td>
                                                                    <td>:</td>
                                                                    <td><input type="date" name="pengumuman" value="<?php echo $a->pengumuman ?>" class="form-control"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Mulai Register
                                                                    </td>
                                                                    <td>:</td>
                                                                    <td><input type="date" name="reg_mulai" value="<?php echo $a->reg_mulai ?>" class="form-control"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Batas Register
                                                                    </td>
                                                                    <td>:</td>
                                                                    <td><input type="date" name="reg_akhir" value="<?php echo $a->reg_akhir ?>" class="form-control"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Tahun Ajaran
                                                                    </td>
                                                                    <td>:</td>
                                                                    <td><select name="tahun" class="form-control">
                                                                        <option value="<?php echo $ta->id ?>" selected><?php echo $ta->awal.'/'.$ta->akhir ?></option>
                                                                    </select></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Jenis Gelombang
                                                                    </td>
                                                                    <td>:</td>
                                                                    <td><select name="jenis" class="form-control">
                                                                        <option selected="" disabled="">Jenis Gelombang</option>
                                                                        <option value="1">Reguler</option>
                                                                        <option value="2">Khusus</option>
                                                                        <option value="3">PMDK</option>
                                                                    </select></td>
                                                                </tr>
                                                            </table>  
                                                            <input type="number" name="id" value="<?php echo $a->id ?>" hidden="" readolny>
                                                            <input type="submit" value="simpan" class="btn btn-primary"> 
                                                            <?php endforeach ?>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>