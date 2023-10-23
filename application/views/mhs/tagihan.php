                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Rincian Tagihan</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <table width="50%">
                                                          <tr>
                                                            <td>Nomor Induk Mahasiswa</td>
                                                            <td>: </td>
                                                            <td><?php echo $biodata->nim ?><input value="<?php echo $biodata->nim ?>" name="nim" hidden=""></td>
                                                          </tr>
                                                          <tr>
                                                            <td>Nama Lengkap</td>
                                                            <td>: </td>
                                                            <td><?php echo $biodata->nama ?></td>
                                                          </tr>
                                                        </table>
                                                        <br>
                                                        <h5>Rincian Tagihan :</h5><hr>
                                                        <div class="dt-responsive table-responsive">
                                                          <?php if($cek < 1){
                                                                echo "Belum Ada Tagihan";
                                                            }else{ ?>
                                                            <table width="60%">
                                                              <tr>
                                                                <td>Sumbangan Pengembangan Institusi (SPI)</td>
                                                                <td width="20px"> : </td>
                                                                <td>Rp.</td>
                                                                <td align="right"><?php echo number_format($tagihan->spi,2,',','.'); ?> </td>
                                                                <td></td>
                                                              </tr>
                                                              <tr>
                                                                <td>Operasional</td>
                                                                <td width="20px"> : </td>
                                                                <td>Rp.</td>
                                                                <td align="right"><?php echo number_format($tagihan->operasional,2,',','.'); ?> </td>
                                                                <td></td>
                                                              </tr>
                                                              <tr>
                                                                <td>Kemahasiswaan</td>
                                                                <td width="20px"> : </td>
                                                                <td>Rp.</td>
                                                                <td align="right"><?php echo number_format($tagihan->kemahasiswaan,2,',','.'); ?> </td>
                                                                <td></td>
                                                              </tr>
                                                              <tr>
                                                                <td>Seragam dan Alat Praktikum</td>
                                                                <td width="20px"> : </td>
                                                                <td>Rp.</td>
                                                                <td align="right"><?php echo number_format($tagihan->seragam,2,',','.'); ?> </td>
                                                                <td></td>
                                                              </tr>
                                                              <tr>
                                                                <td>Satuan Kredit Semester (SKS)</td>
                                                                <td width="20px"> : </td>
                                                                <td>Rp.</td>
                                                                <td align="right"><?php
                                                                  echo number_format($tagihan->sks,2,',','.'); ?> </td>
                                                                <td></td>
                                                              </tr>
                                                              <tr>
                                                                <td colspan="5" align="right"><hr></td>
                                                                <td>+</td>
                                                              </tr>
                                                              <tr>
                                                                <td>Total Tagihan</td>
                                                                <td width="20px"> : </td>
                                                                <td>Rp.</td>
                                                                <td align="right"><?php
                                                                  echo number_format($tagihan->total,2,',','.'); ?> </td>
                                                                <td></td>
                                                              </tr>
                                                              <tr>
                                                                <td><br>Status Pembayaran</td>
                                                                <td width="20px"><br> : </td>
                                                                <td><br> </td>
                                                                <td align="right"><br><?php
                                                                  if ($tagihan->is_bayar == 1) {
                                                                    # code...
                                                                    echo "<font color='green'>LUNAS</font>";
                                                                  }else{
                                                                    echo "<font color='red'>BELUM LUNAS</font>";
                                                                  }
                                                                  ?></td>
                                                                <td></td>
                                                              </tr>
                                                            </table>
                                                            <?php } ?>
                                                        </div>
                                                    </div>

                                            </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

