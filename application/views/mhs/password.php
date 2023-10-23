                        <?php
                            echo $this->session->userdata('ganti_pass');
                            $this->session->set_userdata('ganti_pass', '');
                        ?>
                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>GANTI PASSWORD</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="dt-responsive table-responsive">
                                                            <form action="<?php echo base_url('mhs/dashboard/save_pass/')?>" method="post">
                                                            <table width="80%">
                                                                <tr>
                                                                    <td>Password Lama</td>
                                                                    <td>:</td>
                                                                    <td><input type="password" name="old_pass" class="form-control" placeholder="Password Lama"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Password Baru</td>
                                                                    <td>:</td>
                                                                    <td><input type="password" name="new_pass" class="form-control" placeholder="Password Baru"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Re-Password Baru</td>
                                                                    <td>:</td>
                                                                    <td><input type="password" name="new_pass1" class="form-control" placeholder="Password Baru"></td>
                                                                </tr>
                                                                <tr align="right">
                                                                    <td colspan="4"><hr><input class="btn btn-success" type="submit" value="Update"></td>
                                                                </tr>
                                                            </table>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>