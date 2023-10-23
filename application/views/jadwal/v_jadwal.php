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
                                                        <?php 
                                                        echo $this->session->userdata('jadwal'); 
                                                        $this->session->set_userdata('jadwal','');
                                                              ?>
                                                        <!-- <a href="<?php echo base_url()?>master/matakuliah/add" class="btn btn-success btn-round"><font style="color: white;">TAMBAH MATA KULIAH</font></a><hr> -->
                                                        <h5>MASTER Jadwal</h5>
                                                    </div>
                                                    <div class="card-block">
                                                      <div class="tab">
                                                        <button class="tablinks" onclick="openCity(event, 'Jadwal')">Input Jadwal</button>
                                                        <button class="tablinks" onclick="openCity(event, 'Daftar')">Daftar Jadwal</button>
                                                      </div>
                                                      <div id="Jadwal" class="tabcontent">
                                                        <div class="col-sm-6" style="margin-left: 0px;">
                                                            <form action="<?php echo base_url('master/jadwal/upload_jadwal'); ?>" method="post" enctype="multipart/form-data">
                                                              <label>Upload File Excel : </label>
                                                              <input type="file" class="form-control" name="file_excel" style="margin-bottom: 10px;">
                                                              <input type="submit" class="btn btn-success" value="upload">
                                                              <a href="<?php echo base_url('assets/jadwal/upload_jadwal.xlsx'); ?>" class="btn btn-primary">Download Format</a>
                                                            </form>
                                                          </div>
                                                          <hr>
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="order-table" class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th width="5">No</th>
                                                                    <th width="25px"><center>Jadwal</center></th>
                                                                    <!-- <th width="20px"><center>Status</center></th> -->
                                                                    <th width="20px">Kode</th>
                                                                    <th>Nama Mata Kuliah</th>
                                                                    <th width="10px">T/P</th>
                                                                    <th width="10px">SKS</th>
                                                                    <th width="10px">Smt</th>
                                                                    <th >Kel. MK</th>
                                                                    <th width="20px">Rumpun Mata Kuliah</th>
                                                                    <!-- <th width="20px">Status</th> -->
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $no = 1;
                                                            foreach($matakuliah as $a){?>
                                                                <tr>
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td>
                                                                        <form method="post" action="<?php echo base_url('master/jadwal/redir/');?>">
                                                                          <input type="text" name="kode" value="<?php echo $a->kode_mata_kuliah ?>" hidden=""/>
                                                                          <input type="text" name="matkul" value="<?php echo $a->nama_mata_kuliah ?>" hidden=""/>
                                                                          <input type="submit" value="Input Jadwal" class="btn btn-success" />
                                                                        </form>
                                                                    </td>
                                                                    <!-- <td><?php if($a->is_aktif == 1){
                                                                        echo '<a href="#" class="btn btn-success">AKTIF</a>';
                                                                        }else if($a->is_aktif == 0){
                                                                            echo '<a href="#" class="btn btn-danger">TIDAK AKTIF</a>';
                                                                        }?>
                                                                    </td> -->
                                                                    <td><?php echo $a->kode_mata_kuliah ?></td>
                                                                    <td><?php echo $a->nama_mata_kuliah." / ".$a->nama_mata_kuliah_eng; ?></td>
                                                                    <td><?php echo $a->tp ?></td>
                                                                    <td><?php echo $a->jumlah_sks ?></td>
                                                                    <td><?php echo $a->semester ?></td>
                                                                    <td><?php echo $a->kelompok_mata_kuliah ?></td>
                                                                    <td><?php echo $a->rumpun ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th width="5">No</th>
                                                                    <th width="25px"><center>Jadwal</center></th>
                                                                    <th width="20px">Kode</th>
                                                                    <th>Nama Mata Kuliah</th>
                                                                    <th width="10px">T/P</th>
                                                                    <th width="10px">SKS</th>
                                                                    <th width="10px">Smt</th>
                                                                    <th>Kel. MK</th>
                                                                    <th width="20px">Rumpun Mata Kuliah</th>
                                                                </tr>
                                                            </tfoot>
                                                          </table>
                                                        </div>
                                                      </div>

                                                      <div id="Daftar" class="tabcontent">
                                                      <div class="dt-responsive table-responsive">
                                                            <table id="daftar" class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th width="5">No</th>
                                                                    <th width="25px"><center>Dosen</center></th>
                                                                    <th width="20px"><center>Kode Matakuliah</center></th>
                                                                    <th width="20px">Nama Matakuliah</th>
                                                                    <th>Hari</th>
                                                                    <th width="10px">Sesi</th>
                                                                    <th width="10px">Ruang</th>
                                                                    <th width="10px">Kelas</th>
                                                                    <th >Kuota diambil</th>
                                                                    <th width="20px">Status</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $no = 1;
                                                            foreach($list_jadwal as $b){?>
                                                                <tr>
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td><?php echo $b->gelar_depan.' '.$b->nama_lengkap.' '.$b->gelar_belakang; ?></td>
                                                                    <td><?php echo $b->kode_mata_kuliah?></td>
                                                                    <td><?php echo $b->nama_mata_kuliah ?></td>
                                                                    <td><?php echo $b->hari ?></td>
                                                                    <td><?php echo $b->sesi ?></td>
                                                                    <td><?php echo $b->ruang ?></td>
                                                                    <td><?php echo $b->kelas ?></td>
                                                                    <td><?php echo $b->kuota_diambil ?></td>
                                                                    <td><?php if($b->status == 1){
                                                                        echo '<a href="#" class="btn btn-success">Buka</a>';
                                                                        }else if($b->status == 0){
                                                                            echo '<a href="#" class="btn btn-danger">Tutup</a>';
                                                                        }?>
                                                                    </td>
                                                                    <td>
                                                                      <form method="post" action="<?php echo base_url('master/jadwal/redir/');?>">
                                                                          <input type="text" name="kode" value="<?php echo $b->kode_mata_kuliah ?>" hidden=""/>
                                                                          <input type="text" name="matkul" value="<?php echo $b->nama_mata_kuliah ?>" hidden=""/>
                                                                          <input type="submit" value="Edit" class="btn btn-success" />
                                                                      </form>
                                                                      <a href="<?php echo base_url('master/jadwal/delete_jadwal/'.$b->jadwal_id); ?>" onclick="return confirm('Yakin Delete Data Jadwal?')" class="btn btn-danger">Delete</a>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th width="5">No</th>
                                                                    <th width="25px"><center>Dosen</center></th>
                                                                    <th width="20px"><center>Kode Matakuliah</center></th>
                                                                    <th width="20px">Nama Matakuliah</th>
                                                                    <th>Hari</th>
                                                                    <th width="10px">Sesi</th>
                                                                    <th width="10px">Ruang</th>
                                                                    <th width="10px">Kelas</th>
                                                                    <th >Kuota diambil</th>
                                                                    <th width="20px">Status</th>
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
                                    </div>
<script type="text/javascript">
  $(document).ready(function() {
        $('#daftar').DataTable();
    } );
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
</script>
