                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <?php 
                                                        echo $this->session->userdata('uang'); 
                                                        $this->session->set_userdata('uang','');
                                                              ?>
                                                        <h5>Master Keuangan</h5>&nbsp;
                                                        <form action="<?php echo base_url();?>/master/keuangan/publish" method="post">
                                                          <button type="submit" onclick="return confirm('Apakah anda yakin untuk Mempublikasi Tagihan Keuangan?')" class="btn btn-primary">Publish</button>
                                                        </form>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="order-table" class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>NIM</th>
                                                                    <th>Nama Mahasiswa</th>
                                                                    <th>Status</th>
                                                                    <th>Izin Ujian</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $no = 1;
                                                            foreach($uang as $a){?>
                                                                <tr>
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td><?php echo $a->nim ?></td>
                                                                    <td><?php echo $a->nama ?></td>
                                                                    <td><?php if ($a->is_bayar == 1) {
                                                                        # code...
                                                                        echo "LUNAS";
                                                                    }else{
                                                                        echo "BELUM LUNAS";
                                                                        } 
                                                                        if ($a->izin_ujian == 0) {
                                                                            $izin_ujian = 'Tidak diizinkan';
                                                                        }else{
                                                                            $izin_ujian = 'Diizinkan';
                                                                        }
                                                                        ?></td>
                                                                    <td>
                                                                        <select id="izin_ujian" onchange="izinUjian(<?php echo $a->nim ?>);">
                                                                            <option selected="" value="<?php echo $a->izin_ujian ?>"><?php echo $izin_ujian ?></option>
                                                                            <option value="1">Diizinkan</option>
                                                                            <option value="0">Tidak diizinkan</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                          <a href="<?php echo base_url().'master/keuangan/input/'.$a->nim; ?>" class="btn btn-success">Set Keuangan</a>
                                                                          <a href="<?php echo base_url().'master/keuangan/bayar/'.$a->nim; ?>" class="btn btn-primary">Bayar</a>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>NIM</th>
                                                                    <th>Nama Mahasiswa</th>
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
<script type="text/javascript">
    function izinUjian(nim){
        var izin_ujian = $('#izin_ujian').val();
        $.ajax({
            url : "<?php echo base_url();?>master/keuangan/save_izin_ujian/",
            method : "POST",
            data : {
                    nim: nim,
                    izin_ujian: izin_ujian
                  },
            async : false,
            dataType : 'json',
            success: function(data){
                // console.log(data)
                if (data.result == 1) {
                    swal("Berhasil!", "Mengganti Data...", "success");
                }else{   
                    swal("Gagal!", "Mengganti Data...", "error");
                }
            }
        });
    }
</script>
