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
              <h5>Daftar Nilai</h5>
          </div>
          <div class="card-block">
              <div class="dt-responsive table-responsive">
              <table width="100%">
                <tr>
                  <td style="text-align: right;"><a href="#">Download Daftar Nilai</a></td>
                </tr>
              </table>
                  <table class="table nowrap">
                  <thead>
                      <tr>
                          <th width="10px">No</th>
                          <th width="20px">Kode Mata Kuliah</th>
                          <th>Nama Mata Kuliah</th>
                          <th width="10px">SKS</th>
                          <th style="text-align: right;">Nilai (Grade)</th>
                      </tr>
                  </thead>
                  <tbody>
                        <?php $no = 1; 
                        $jumlah_sks = 0;
                        $score = 0;
                        $ipk = 0;
                        $A = 0;
                        $AB = 0;
                        $B = 0;
                        $BC = 0;
                        $C = 0;
                        $CD = 0;
                        $D = 0;
                        $E = 0;
                        foreach($transkrip as $t){?>
                          <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $t->kode_mata_kuliah ?></td>
                            <td><?php echo $t->mata_kuliah ?></td>
                            <td><?php echo $t->jumlah_sks ?></td>
                            <td style="text-align: right;"><?php 
                            $pecah_nhuruf = $t->nhuruf;
                            // $pecah_nhuruf[1];
                              if ($pecah_nhuruf == 'E') {
                                $E += 1;
                                echo '<font color="red">E</font>';
                              }elseif ($pecah_nhuruf == 'D') {
                                $D += 1;
                                echo '<font color="brown">D</font>';
                              }elseif ($pecah_nhuruf == 'CD') {
                                $CD += 1;
                                echo '<font color="brown">CD</font>';
                              }elseif ($pecah_nhuruf == 'C') {
                                $C += 1;
                                echo '<font color="orange">C</font>';
                              }elseif ($pecah_nhuruf == 'BC') {
                                $BC += 1;
                                echo '<font color="orange">BC</font>';
                              }elseif ($pecah_nhuruf == 'B') {
                                $B += 1;
                                echo '<font color="green">B</font>';
                              }elseif ($pecah_nhuruf == 'AB') {
                                $AB += 1;
                                echo '<font color="green">AB</font>';
                              }elseif ($pecah_nhuruf == 'A') {
                                $A += 1;
                                echo '<font color="black">A</font>';
                              }
                            ?></td>
                          </tr>
                        <?php
                            $point = $this->bantuan->nbobot($pecah_nhuruf);
                            $jumlah_sks += $t->jumlah_sks;
                            $score += $point * $t->jumlah_sks; 
                        } ?>
                  </tbody>
                </table>
                <center><?php 
                if ($score == 0 || $jumlah_sks == 0) {
                  # code...
                  $ipk = 0;
                }else{
                  $ipk = $score / $jumlah_sks;
                }
                 
                echo "<font color='red'>E</font> = ".$E.", <font color='brown'>D</font> = ".$D.", <font color='orange'>C</font> = ".$C.", <font color='green'>B</font> = ".$B.", <font color='black'>A</font> = ".$A."<br>";
                              echo "Jumlah SKS = ".$jumlah_sks.", Total Score = ".$score."<br>Indeks Prestasi Komulatif (IPK) = ".number_format($ipk,2);?></center>
              </div>
          </div>
      </div>
  </div>
</div>
</div>

