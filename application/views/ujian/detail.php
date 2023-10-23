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
                                                        <h5>Daftar Mahasiswa</h5>
                                                        <a href="<?php echo base_url('master/ujian/input/'.$kode_mk); ?>" class="btn btn-primary">Kembali</a>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="order-table" class="table table-striped table-bordered nowrap">
                                                                <thead>
                                                                    <tr>
                                                                      <th>#</th>
                                                                      <th>NIM</th>
                                                                      <th>NAMA MAHASISWA</th>
                                                                      <th>NOMOR KURSI</th>
                                                                      <th>RUANG</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                  <?php $no=1; foreach ($detail as $d): ?>
                                                                    <tr>
                                                                        <td><?php echo $no++ ?></td>
                                                                        <td><?php echo $d->nim1 ?></td>
                                                                        <td><?php echo $d->nama ?></td>
                                                                        <td><select id="no_kursi" onchange="save(<?php echo $d->jadwal_id ?>, <?php echo $d->id_tahun ?>, '<?php echo $d->nim1 ?>');">
                                                                          <?php if(!is_null($d->no_kursi)){?>
                                                                              <option selected="" value="<?php echo $d->no_kursi ?>"><?php echo $d->no_kursi ?></option>
                                                                          <?php
                                                                            }else{ 
                                                                              echo "<option selected='' disabled=''>-- Pilih No. Kursi --</option>";
                                                                            }
                                                                            for ($i=1; $i <= 100 ; $i++) { 
                                                                              echo "<option value='".$i."'>".$i."</option>";
                                                                            }
                                                                          ?>
                                                                        </select></td>
                                                                        <td>
                                                                            <select id="ruang" onchange="save(<?php echo $d->jadwal_id ?>, <?php echo $d->id_tahun ?>, '<?php echo $d->nim1 ?>');">
                                                                            <?php if(!is_null($d->ruang)){?>
                                                                                <option selected="" value="<?php echo $d->ruang ?>"><?php echo $d->ruang ?></option>
                                                                            <?php
                                                                              }else{ 
                                                                                echo "<option selected='' disabled=''>-- Pilih Ruang --</option>";
                                                                              }
                                                                              foreach($ruang as $r) { 
                                                                                echo "<option value='".$r->nama_ruang."'>".$r->nama_ruang."</option>";
                                                                              }
                                                                            ?>
                                                                          </select>
                                                                        </td>
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
<script type="text/javascript">
  function save(id_jadwal, ta, nim){
  var no_kursi = $("#no_kursi").val();
  var ruang = $("#ruang").val();
  $.ajax({
            url : "<?php echo base_url();?>master/ujian/save_ruang/",
            method : "POST",
            data : {id_jadwal: id_jadwal,
                    nim: nim,
                    no_kursi: no_kursi,
                    ruang: ruang,
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