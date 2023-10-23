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
                    echo $this->session->userdata('krs'); 
                    $this->session->set_userdata('krs','');
                          ?>
                    <h5>Kartu Rencana Studi (KRS)</h5>&nbsp;
                    <form action="<?php echo base_url();?>/master/krs/transkrip" method="post">
                      <button type="submit" onclick="return confirm('Apakah anda yakin untuk update Transkrip Nilai? Jadwal, KRS, presensi, keuangan akan di reset.')" class="btn btn-primary">Update Transkrip</button>
                    </form>
					<div class="row">
						<div class="col-md-6">
							<table class="table table-stripped">
								<tr>
									<td><b>Total Mahasiswa Aktif</b></td>
									<td>:</td>
									<td><b> <?php echo $total_mhs; ?></b></td>
								</tr>
								<tr>
									<td><b>Total Mahasiswa Input KRS</b></td>
									<td>:</td>
									<td><b> <?php echo $total_input_krs; ?></b></td>
								</tr>
								
							</table>
						</div>
					</div>
                    <a href="<?php echo base_url()?>master/krs/log" class="btn btn-success btn-round"><font style="color: white;">Download Log KRS</font></a>
                </div>
                <div class="card-block">
                    <div class="dt-responsive table-responsive">
                        <table id="order-table" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun Ajaran</th>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Jumlah Krs</th>
                                <th>Status Keuangan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1;
                        foreach($krs as $a){?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $a->awal." - ".$a->akhir.' ('.$jenis[$a->jenis].')'; ?></td>
                                <td><?php echo $a->nim ?></td>
                                <td><?php echo $a->nama ?></td>
                                <td class="<?php echo (empty($a->jumlah_sks))?"bg-danger":"bg-success" ?>"><?php echo (empty($a->jumlah_sks))?0:$a->jumlah_sks ?>/24</td>
                                <td><?php
                                    $status = $a->krs;
                                    $btn = "";
                                    if ($status == 1) {
                                      # code...
                                      echo "LUNAS";
                                      $btn = "<a href='".base_url('master/krs/input/').$a->nim."' class='btn btn-success'> Input KRS </a> <a href='".base_url('master/krs/cetak/').$a->nim."' class='btn btn-primary'> Cetak </a>";
                                    }else{
                                      echo "BELUM LUNAS";
                                      $btn = "Tagihan Belum Lunas";
                                    }
                                ?></td>
                                <td>
                                      <?php echo $btn; ?>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Status Keuangan</th>
                            </tr>
                        </tfoot>
                      </table>
                    </div>
                </div>
                <div id="myModal" class="modal">

          <!-- Modal content -->
          <div class="modal-content">
            <span class="close">&times;</span>
            <form action="<?php echo base_url();?>master/krs/nonaktif" method="post">
                <div class="col-sm-12">
                <div class="col-sm-12">
                    Masukan PIN :
                    <p><input type="password" class="form-control" placeholder="Masukan PIN" name="pin" required=""></p>
                </div>
                <div class="col-sm-12">
                  <input type="submit" class="btn btn-success" onclick="return confirm('Apakah anda yakin untuk non-aktifkan KRS sekarang dan memulai baru?')" value="Proses" />
                </div>
            </div>
            </form>
          </div>

        </div>
            </div>
        </div>
    </div>
</div>
                                    
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
