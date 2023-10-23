<style type="text/css">
        /*body {font-family: Arial, Helvetica, sans-serif;}*/

        /* The Modal (background) */
        .modal {
          display: none; /* Hidden by default */
          position: fixed; /* Stay in place */
          z-index: 1; /* Sit on top */
          padding-top: 100px; /* Location of the box */
          left: 120px;
          top: 0;
          width: 100%; /* Full width */
          height: 100%; /* Full height */
          overflow: auto; /* Enable scroll if needed */
          background-color: rgb(0,0,0); /* Fallback color */
          background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
          background-color: #fefefe;
          margin: auto;
          padding: 25px;
          border: 1px solid #888;
          width: 30%;
        }

        /* The Close Button */
        .close {
          color: #aaaaaa;
          float: right;
          font-size: 28px;
          font-weight: bold;
        }

        .close:hover,
        .close:focus {
          color: #000;
          text-decoration: none;
          cursor: pointer;
        }
    </style>
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                <?php
                        if ($cek_input == 0) {
                          echo "<center><h4><b><font color='red'>Input KRS belum dibuka.</font></b></center>";
                        }elseif($cek_keuangan == 0){
							echo "<center><h4><b><font color='red'>Anda belum bisa input krs. harap hubungi bagian keuangan.</font></b></center>";
						}else{ ?>
                    <?php 
                    echo $this->session->userdata('krs'); 
                    $this->session->set_userdata('krs','');
                          ?>
                    <table border="0">
                        <tr>
                            <td><h5>NIM</h5></td>
                            <td><h5>:</h5></td>
                            <td><h5><?php echo $mhs[0]['nim']; ?></h5></td>
                        </tr>
                        <tr>
                            <td><h5>NAMA MAHASISWA</h5></td>
                            <td><h5>:</h5></td>
                            <td><h5><?php echo $mhs[0]['nama']; ?></h5></td>
                        </tr>
                        <tr>
                            <td><h5>KUOTA SKS</h5></td>
                            <td><h5>:</h5></td>
                            <td><h5><?php echo $kuota->sks." / ".$batas; ?></h5></td>
                        </tr>
                    </table>
                    <!-- <p><b><font style="color:red;"><?php echo $this->session->userdata('jadwal_bentrok'); ?></font></b></p>
                    <?php //echo $this->session->set_userdata('jadwal_bentrok', ''); ?> -->
                    </div>
                    <div class="col-sm-4">
                    <?php $stat = ''; if($kuota->sks > $batas){
                            $stat = 'disabled=""';
                        }
                        ?>
                    <select name="matakuliah" id="matakuliah" class="form-control js-example-basic-single" <?php echo $stat;?>>
                        <option selected="" disabled="">-- Pilih Matakuliah --</option>
                        <?php foreach($matakuliah as $m){?>
                        <option value="<?php echo $m->kode_mata_kuliah ?>"><?php echo $m->kode_mata_kuliah.' - '.$m->nama_mata_kuliah ." - Smt.".$m->semester;?></option>
                        <?php } ?>
                    </select>
                    </div>
                    <hr>
                <div class="card-block">
                    <div class="dt-responsive table-responsive">
                        <table id="jadwal" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jam</th>
                                <th>Hari</th>
                                <th>Ruang</th>
                                <th>Dosen</th>
                                <th>Kelas</th>
                                <th>Kuota</th>
                                <th>Pilih (Satu Saja)</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Jam</th>
                                <th>Hari</th>
                                <th>Ruang</th>
                                <th>Dosen</th>
                                <th>Kelas</th>
                                <th>Kuota</th>
                                <th>Pilih (Satu Saja)</th>
                            </tr>
                        </tfoot>
                      </table>
                      <br>
                      <hr>
                    </div>
                    
                    <div class="dt-responsive table-responsive">
                    <h5>Detail KRS</h5>
                    <p><font style="color:red;"><?php echo $this->session->userdata('krs_bentrok'); ?></font></p>
                    <?php echo $this->session->set_userdata('krs_bentrok', ''); ?>
                        <table class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Matakuliah</th>
								<th>Kode Matakuliah</th>
                                <th>Hari,Jam</th>
                                <th>Ruang</th>
                                <th>Dosen</th>
                                <th>Kelas</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1;
                                foreach ($detail_krs as $d) {?>
                                <tr>
                                     <td><?php echo $no++; ?></td>
                                    <td><?php echo $d->mata_kuliah; ?></td>
                                    <td><?php echo $d->kode_mata_kuliah; ?></td>
                                    <td><?php echo $d->hari.', '.$d->sesi; ?></td>
                                    <td><?php echo urldecode($d->ruang); ?></td>
                                    <td><?php echo $d->nama_dosen; ?></td>
                                    <td><?php echo $d->kelas; ?></td>
                                    <td><a href='<?php echo base_url().'mhs/krs/delete/'.$d->id.'-'.$d->nim; ?>' onclick="return confirm('Yakin Delete KRS?')" class='btn btn-danger'>Hapus</a>
                                </tr>
                                <?php }?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Matakuliah</th>
                                <th>kode Matakuliah</th>
                                <th>Hari,Jam</th>
                                <th>Ruang</th>
                                <th>Dosen</th>
                                <th>Kelas</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                      </table>
                      <!-- <p align='right'><input type="submit" class="btn btn-success btn-round" value="SELESAI / PUBLISH" /></p> -->
                    </div>
                </div>
              <?php
                  }
              ?>
            </div>
        </div>
    </div>
</div>
                                    
<script type="text/javascript">
$(document).ready(function(){
	$(".js-example-basic-single").select2();
    $('#matakuliah').change(function(){
        var matakuliah = $(this).val();
        console.log(matakuliah);
        var html = '';
        var uri_encode = '';
        var btn = ''; 
        $.ajax({
            url : "<?php echo base_url();?>mhs/input_krs/list_jadwal/",
            method: "POST",
            data:{id:matakuliah},
            async: false, 
            dataType: "json",
            success: function(data){
            var i;
                for (i = 0; i < data.length; i++) {
                    var no = i + 1;
                    var uri_encode = '<?php echo $mhs[0]['nim'];?>-'+data[i].kode_mata_kuliah+'-'+data[i].hari+'-'+data[i].sesi+'-'+data[i].ruang+'-'+data[i].id_dosen+'-'+data[i].id+'-'+data[i].kelas;
                    if (data[i].kuota_diambil == data[i].kapasitas) {
                        btn = '<a class="btn btn-danger">Penuh</a>';
                    }else{
                        btn = '<a href="<?php echo base_url('mhs/input_krs/tambah_jadwal/');?>'+uri_encode+'" class="btn btn-primary">Pilih</a>';
                    }
                    html += '<tr>';
                    html += '<td>'+ no +'</td>';
                    html += '<td>'+data[i].sesi+'</td>';
                    html += '<td>'+data[i].hari+'</td>';
                    html += '<td>'+data[i].ruang+'</td>';
                    html += '<td>'+data[i].nama_dosen+'</td>';
                    html += '<td>';
					if(data[i].kelas==1)
						html+="Reguler";
					else
						html+="Karyawan";
					
					html +='</td>';
                    html += '<td>'+data[i].kuota_diambil+'/'+data[i].kapasitas+'</td>';
                    html += '<td>'+btn+'</td>';
                    html += '<tr>';
                }                                                
            }
            });
        $('#jadwal tbody').html(html);
    });
});
</script>

                                    
