                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Setting Rombel/Kelompok</h5>&nbsp;
                                                    <div class="card-block">
                                                    <form method="post" action="<?php echo base_url('master/jadwal/edit_rombel'); ?>">
                                                        <table width="70%">
                                                            <tr>
                                                                <td>Nama Rombel</td>
                                                                <td>:</td>
                                                                <td><input type="text" value="<?php echo $r->id ?>" name="id" hidden="">
                                                                <input type="text" value="<?php echo $r->rombel ?>" name="rombel" class="form-control" required=""></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Status Rombel</td>
                                                                <td>:</td>
                                                                <td><select name="status" class="form-control">
                                                                    <option selected="" value="<?php echo $r->is_aktif ?>"><?php echo $r->is_aktif ?></option>
                                                                    <option value="Aktif">Aktif</option>
                                                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                                                </select></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">
                                                                    <input type="submit" class="btn btn-primary" value="Update"> 
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
