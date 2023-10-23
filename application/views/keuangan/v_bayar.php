                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Rincian Tagihan</h5>
                                                    </div>
                                                    <div class="card-block">
                                                      <form method="post" action="<?php echo base_url('master/keuangan/bayar_aksi'); ?>">
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
                                                                <td align="right"><br><select name="bayar" class="form-control">
                                                                  <option value="<?php $tagihan->is_bayar ?>" selected=""><?php
                                                                  if ($tagihan->is_bayar == 1) {
                                                                    # code...
                                                                    echo "LUNAS";
                                                                  }else{
                                                                    echo "BELUM LUNAS";
                                                                  }
                                                                  ?></option>
                                                                  <option value="1">LUNAS</option>
                                                                  <option value="0">BELUM LUNAS</option>
                                                                </select></td>
                                                                <td></td>
                                                              </tr>
                                                              <tr>
                                                                <td colspan="5"><br><?php if($tagihan->is_publish == 0){
                                                                  echo "Tagihan belum dipublikasi, publikasi terdahulu sebelum merubah status bayar";
                                                                  }else{?>
                                                                  <center><input type="submit" value="Simpan" class="btn btn-success"></center>
                                                                  <?php } ?></td>
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

