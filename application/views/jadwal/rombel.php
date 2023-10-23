                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Setting Rombel/Kelompok</h5>&nbsp;
                                                    <div class="card-block">
                                                    <form method="post" action="<?php echo base_url('master/jadwal/save_rombel'); ?>">
                                                        <table width="70%">
                                                            <tr>
                                                                <td>Nama Rombel</td>
                                                                <td>:</td>
                                                                <td><input type="text" placeholder="Nama Rombel" name="rombel" class="form-control" required=""></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Status Rombel</td>
                                                                <td>:</td>
                                                                <td><select name="status" class="form-control">
                                                                    <option selected="" disabled="">-- Pilih Status --</option>
                                                                    <option value="Aktif">Aktif</option>
                                                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                                                </select></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">
                                                                    <input type="submit" class="btn btn-primary" value="Simpan"> 
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        </form>
                                                        <br>
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="order-table" class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Kode / Nama Rombel</th>
                                                                    <th>Status</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $no = 1;
                                                            foreach($rombel as $a){?>
                                                                <tr>
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td><?php echo $a->rombel ?></td>
                                                                    <td><?php echo $a->is_aktif ?></td>
                                                                    <td>
                                                                          <a href="<?php echo base_url().'master/jadwal/rombel_edit/'.$a->id; ?>" class="btn btn-success">Edit</a> <a href="<?php echo base_url().'master/jadwal/rombel_delete/'.$a->id; ?>" class="btn btn-danger">Delete</a>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Kode / Nama Rombel</th>
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
