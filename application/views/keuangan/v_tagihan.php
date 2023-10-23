                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Rincian Tagihan</h5>
                                                    </div>
                                                    <div class="card-block">
                                                      <form method="post" action="<?php echo base_url('master/keuangan/simpan'); ?>">
                                                        <table width="50%">
                                                          <tr>
                                                            <td>Nomor Induk Mahasiswa</td>
                                                            <td>: </td>
                                                            <td><?php echo $tagihan->nim ?><input value="<?php echo $tagihan->nim ?>" name="nim" hidden=""></td>
                                                          </tr>
                                                          <tr>
                                                            <td>Nama Lengkap</td>
                                                            <td>: </td>
                                                            <td><?php echo $tagihan->nama ?></td>
                                                          </tr>
                                                        </table>
                                                        <br>
                                                        <h5>Rincian Tagihan :</h5><hr>
                                                        <div class="dt-responsive table-responsive">
                                                            <table width="60%">
                                                              <tr>
                                                                <td>Sumbangan Pengembangan Institusi (SPI)</td>
                                                                <td width="20px"> : </td>
                                                                <td>Rp.</td>
                                                                <td align="right"><?php echo number_format($tagihan->spi,2,',','.'); ?> </td>
                                                                <td width="40px" align="right"><input type="checkbox" name="spi" value="<?php echo $tagihan->spi ?>"></td>
                                                              </tr>
                                                              <tr>
                                                                <td>Operasional</td>
                                                                <td width="20px"> : </td>
                                                                <td>Rp.</td>
                                                                <td align="right"><?php echo number_format($tagihan->operasional,2,',','.'); ?> </td>
                                                                <td width="40px" align="right"><input type="checkbox" name="operasional" value="<?php echo $tagihan->operasional ?>"></td>
                                                              </tr>
                                                              <tr>
                                                                <td>Kemahasiswaan</td>
                                                                <td width="20px"> : </td>
                                                                <td>Rp.</td>
                                                                <td align="right"><?php echo number_format($tagihan->kemahasiswaan,2,',','.'); ?> </td>
                                                                <td width="40px" align="right"><input type="checkbox" name="kemahasiswaan" value="<?php echo $tagihan->kemahasiswaan ?>"></td>
                                                              </tr>
                                                              <tr>
                                                                <td>Seragam dan Alat Praktikum</td>
                                                                <td width="20px"> : </td>
                                                                <td>Rp.</td>
                                                                <td align="right"><?php echo number_format($tagihan->seragam,2,',','.'); ?> </td>
                                                                <td width="40px" align="right"><input type="checkbox" name="seragam" value="<?php echo $tagihan->seragam ?>"></td>
                                                              </tr>
                                                              <tr>
                                                                <td>Satuan Kredit Semester (SKS)</td>
                                                                <td width="20px"> : </td>
                                                                <td>Rp.</td>
                                                                <td align="right"><?php
                                                                  // $jml = 0;
                                                                  // $jml = $tagihan->jml_sks * $tagihan->sks;
                                                                  // echo number_format($jml,2,',','.'); 
                                                                    echo number_format($tagihan->total_sks,2,',','.');
                                                                  ?> </td>
                                                                <td width="40px" align="right"><input type="checkbox" name="sks" value="<?php echo $tagihan->total_sks ?>"></td>
                                                              </tr>
                                                              <tr>
                                                                <td colspan="5"><br><center><input type="submit" value="Simpan" class="btn btn-success"></center></td>
                                                              </tr>
                                                            </table>
                                                          </form>
                                                        </div>
                                                    </div>

                                            </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

