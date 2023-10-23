<?php
            echo $this->session->userdata('notif');
            $this->session->set_userdata('notif', '');
?>
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
    /* Style the tab */
      .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
      }

      /* Style the buttons inside the tab */
      .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
      }

      /* Change background color of buttons on hover */
      .tab button:hover {
        background-color: #ddd;
      }

      /* Create an active/current tablink class */
      .tab button.active {
        background-color: #ccc;
      }

      /* Style the tab content */
      .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
      }
    </style>
                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                    <!-- <a href="<?php echo base_url('master/ujian/publish'); ?>" class="btn btn-success" onclick="return confirm('Apakah anda yakin?')">Publish</a> -->
                                                        <hr>
                                                        <h5>Setting Ujian</h5>
                                                    </div>
                                                    <div class="card-block">
                                                      <div class="tab">
                                                        <button class="tablinks" onclick="openCity(event, 'Jadwal')">Jadwal Ujian</button>
                                                        <button class="tablinks" onclick="openCity(event, 'Tempat')">Tempat Ujian</button>
                                                      </div>
                                                      <div id="Jadwal" class="tabcontent">
                                                        <div class="row">
                                                            <div class="col-sm-6" style="margin-left: 0px;">
                                                            <form action="<?php echo base_url('master/ujian/upload_jadwal_ujian'); ?>" method="post" enctype="multipart/form-data">
                                                              <label>Upload File Excel : </label>
                                                              <input type="file" class="form-control" name="file_excel" style="margin-bottom: 10px;">
                                                              <input type="submit" class="btn btn-success" value="upload">
                                                              <a href="<?php echo base_url('master/ujian/format_excel/'); ?>" class="btn btn-primary">Download Format</a>
                                                            </form>
                                                          </div>
                                                          <!--<div class="col-sm-6">
                                                            <table id="order-table" class="table table-striped table-bordered nowrap">
                                                              <thead>
                                                                <tr>
                                                                  <th>Id Jam (Sesi)</th>
                                                                  <th>Nama Sesi</th>
                                                                </tr>
                                                              </thead>
                                                              <tbody>
                                                            <?php
                                                              foreach ($sesi_ujian as $u) {
                                                                  echo "<tr>
                                                                              <td>".$u->id."</td>
                                                                              <td>".$u->nama_sesi."</td>
                                                                          </tr>";                  
                                                              }
                                                            ?>
                                                            </tbody>
                                                            </table>
                                                          </div>-->
                                                        </div>
                                                        <br>
                                                        <hr>
                                                        <div class="dt-responsive table-responsive">
                                                            <table class="table table-striped table-bordered nowrap">
                                                                <thead>
                                                                    <tr>
                                                                      <th>#</th>
                                                                      <th>Kode</th>
                                                                      <th>Mata Kuliah</th>
                                                                      <th>Dosen</th>
                                                                      <th>Kelas</th>
                                                                      <th>Tanggal UTS</th>
                                                                      <th>Waktu UTS</th>
                                                                      <th>Tanggal UAS</th>
                                                                      <th>Waktu UAS</th>
                                                                      <!--<th>Tanggal UTS Praktek</th>
                                                                      <th>Waktu UTS Praktek</th>
                                                                      <th>Tanggal UAS Praktek</th>
                                                                      <th>Waktu UAS Praktek</th>-->
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                  <?php $no = 1; foreach ($jadwal as $j): ?>
                                                                    <tr>
                                                                      <td><?php echo $no++ ?></td>
                                                                      <td><?php echo $j->kode_mata_kuliah ?></td>
                                                                      <td><?php echo $j->nama_mata_kuliah ?></td>
                                                                      <td><?php echo $j->gelar_depan.$j->nama_lengkap.' '.$j->gelar_belakang; ?></td>
                                                                      <td><?php echo ($j->kelas == 1)?"reguler":"karyawan" ?><input type="hidden" name="kelas" id='kelas<?php echo $j->jadwal_id ?>' value="<?php echo $j->kelas; ?>"></td>
                                                                      <td><input type="date" name="tgl_uts_t" id="tgl_uts_t<?php echo $j->jadwal_id ?>" value="<?php echo $j->tanggal_uts_t ?>" onchange="save('<?php echo $j->jadwal_id ?>', <?php echo $j->id_tahun ?>);"></td>
                                                                      <td><select name="id_jam_uts_t" id="id_jam_uts_t<?php echo $j->jadwal_id ?>" onchange="save('<?php echo $j->jadwal_id ?>', <?php echo $j->id_tahun ?>);">
                                                                          <?php 
                                                                            if(!is_null($j->id_jam_uts_t)){
                                                                                echo "<option selected='' value='".$j->id_jam_uts_t."'>".$this->bantuan->jam($j->id_jam_uts_t)."</option>";
                                                                            }else{
                                                                                echo "<option selected='' disabled=''><center>--Pilih Sesi--</center></option>";
                                                                              }
                                                                            foreach ($sesi_ujian as $u) {
                                                                              echo "<option value='".$u->id."'>".$u->nama_sesi."</option>";
                                                                            }
                                                                          ?>
                                                                      </select></td>
                                                                      <td><input type="date" name="tgl_uas_t" id="tgl_uas_t<?php echo $j->jadwal_id ?>" value="<?php echo $j->tanggal_uas_t ?>" onchange="save('<?php echo $j->jadwal_id ?>', <?php echo $j->id_tahun ?>);"></td>
                                                                      <td><select name="id_jam_uas_t" id="id_jam_uas_t<?php echo $j->jadwal_id ?>" onchange="save('<?php echo $j->jadwal_id ?>', <?php echo $j->id_tahun ?>);">
                                                                          <?php 
                                                                            if(!is_null($j->id_jam_uas_t)){
                                                                                echo "<option selected='' value='".$j->id_jam_uas_t."'>".$this->bantuan->jam($j->id_jam_uas_t)."</option>";
                                                                            }else{
                                                                                echo "<option selected='' disabled=''><center>--Pilih Sesi--</center></option>";
                                                                              }
                                                                            foreach ($sesi_ujian as $u) {
                                                                              echo "<option value='".$u->id."'>".$u->nama_sesi."</option>";
                                                                            }
                                                                          ?>
                                                                      </select></td>
                                                                      <!--<td><input type="date" name="tgl_uts_p" id="tgl_uts_p<?php echo $j->kode_mata_kuliah ?>" value="<?php echo $j->tanggal_uts_p ?>" onchange="save('<?php echo $j->kode_mata_kuliah ?>', <?php echo $j->id_tahun ?>);"></td>
                                                                      <td><select name="id_jam_uts_p" id="id_jam_uts_p<?php echo $j->kode_mata_kuliah ?>" onchange="save('<?php echo $j->kode_mata_kuliah ?>', <?php echo $j->id_tahun ?>);">
                                                                          <?php 
                                                                            if(!is_null($j->id_jam_uts_p)){
                                                                                echo "<option selected='' value='".$j->id_jam_uts_p."'>".$this->bantuan->jam($j->id_jam_uts_p)."</option>";
                                                                            }else{
                                                                                echo "<option selected='' disabled=''><center>--Pilih Sesi--</center></option>";
                                                                              }
                                                                            foreach ($sesi_ujian as $u) {
                                                                              echo "<option value='".$u->id."'>".$u->nama_sesi."</option>";
                                                                            }
                                                                          ?>
                                                                      </select></td>
                                                                      <td><input type="date" name="tgl_uas_p" id="tgl_uas_p<?php echo $j->kode_mata_kuliah ?>" value="<?php echo $j->tanggal_uas_p ?>" onchange="save('<?php echo $j->kode_mata_kuliah ?>', <?php echo $j->id_tahun ?>);"></td>
                                                                      <td><select name="id_jam_uas_p" id="id_jam_uas_p<?php echo $j->kode_mata_kuliah ?>" onchange="save('<?php echo $j->kode_mata_kuliah ?>', <?php echo $j->id_tahun ?>);">
                                                                          <?php 
                                                                            if(!is_null($j->id_jam_uas_p)){
                                                                                echo "<option selected='' value='".$j->id_jam_uas_p."'>".$this->bantuan->jam($j->id_jam_uas_p)."</option>";
                                                                            }else{
                                                                                echo "<option selected='' disabled=''><center>--Pilih Sesi--</center></option>";
                                                                              }
                                                                            foreach ($sesi_ujian as $u) {
                                                                              echo "<option value='".$u->id."'>".$u->nama_sesi."</option>";
                                                                            }
                                                                          ?>
                                                                      </select></td>-->
                                                                    </tr>
                                                                  <?php endforeach ?>
                                                                </tbody>
                                                            </table>
															
                                                        </div>
                                                      </div>

                                                      <div id="Tempat" class="tabcontent">
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="order-table" class="table table-striped table-bordered nowrap">
                                                                <thead>
                                                                    <tr>
                                                                      <th>Kode Mata Kuliah</th>
                                                                      <th>Mata Kuliah</th>
                                                                      <th>Dosen</th>
                                                                      <th></th> 
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                  <?php foreach ($jadwal as $d): ?>
                                                                    <tr>
                                                                      <td><?php echo $d->kode_mata_kuliah ?></td>
                                                                      <td><?php echo $d->nama_mata_kuliah ?></td>
                                                                      <td><?php echo $d->gelar_depan.$d->nama_lengkap.' '.$d->gelar_belakang; ?></td>
                                                                      <td><a href="<?php echo base_url('master/ujian/detail/'.$d->jadwal_id); ?>" class="btn btn-warning"><i class="feather icon-edit"></i></a></td>
                                                                    </tr>
                                                                  <?php endforeach ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
function save(id_jadwal, ta){
  var tanggal_uts_t = $("#tgl_uts_t"+id_jadwal).val();
  var id_jam_uts_t = $("#id_jam_uts_t"+id_jadwal).val();
  var tanggal_uas_t = $("#tgl_uas_t"+id_jadwal).val();
  var id_jam_uas_t = $("#id_jam_uas_t"+id_jadwal).val();
  var tanggal_uts_p = $("#tgl_uts_p"+id_jadwal).val();
  var id_jam_uts_p = $("#id_jam_uts_p"+id_jadwal).val();
  var tanggal_uas_p = $("#tgl_uas_p"+id_jadwal).val();
  var id_jam_uas_p = $("#id_jam_uas_p"+id_jadwal).val();
  var kelas = $('#kelas'+id_jadwal).val();
  $.ajax({
            url : "<?php echo base_url();?>master/ujian/save/",
            method : "POST",
            data : {
                    id_jadwal: id_jadwal,
					          kelas : kelas,
                    tanggal_uts_t: tanggal_uts_t,
                    id_jam_uts_t: id_jam_uts_t,
                    tanggal_uas_t: tanggal_uas_t,
                    id_jam_uas_t: id_jam_uas_t,
                    tanggal_uts_p: tanggal_uts_p,
                    id_jam_uts_p: id_jam_uts_p,
                    tanggal_uas_p: tanggal_uas_p,
                    id_jam_uas_p: id_jam_uas_p,
                    ta: ta
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