<style>
    * { box-sizing: border-box; }
body {
  font: 16px Arial;
}
.autocomplete {
  /*the container must be positioned relative:*/
  position: relative;
  display: inline-block;
}
input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}
input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
}
input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
}
.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff;
  border-bottom: 1px solid #d4d4d4;
}
.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9;
}
.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important;
  color: #ffffff;
}
</style>
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <?php echo $this->session->userdata('status_delete'); 
                          $this->session->set_userdata('status_delete','');
                          ?>
                    <h5>Struktur Kepegawaian</h5>
                </div>
                <div class="card-block">
                    <form method="POST" action="<?php echo base_url('pegawai/save_struktur'); ?>" autocomplete="off">

                      <div class="row">
                        <div class="col-md-4">
                          <label>Ketua Sekolah Tinggi : </label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-inline">
                                <!-- <input type="text" class="form-control" id="myInput" placeholder="Masukan npp. Cth : 070220002"> -->
                                <select name="ketua_st" class="js-example-basic-single col-sm-12" >
                                    <option selected="" value="<?php echo $s->ketua_st ?>"><?php echo $s->ketua_st ?> </option>
                                  <?php
                                      foreach($npp as $row){
                                          echo "<option value='".$row->nama."'";
                                          
                                          echo ">" . $row->npp . " - " . strtoupper($row->nama) . "</option>";
                                      }
                                  ?> 
                                </select>
                            </div>
                        </div>
                      </div>

                      <div class="row" style="margin-top: 10px;">
                            <div class="col-md-4">
                              <label>Pembantu Ketua I Bidang Akademik : </label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-inline">
                                    <!-- <input type="text" class="form-control" id="myInput" placeholder="Masukan npp. Cth : 070220002"> -->
                                    <select name="pembantu_1" class="js-example-basic-single col-sm-12" >
                                      <option selected="" value="<?php echo $s->pembantu_1 ?>"><?php echo $s->pembantu_1 ?> </option>
                                      <?php
                                          foreach($npp as $row){
                                              echo "<option value='".$row->nama."'";
                                              
                                              echo ">" . $row->npp . " - " . strtoupper($row->nama) . "</option>";
                                          }
                                      ?> 
                                    </select>
                                </div>
                            </div>
                      </div>

                      <div class="row" style="margin-top: 10px;">
                            <div class="col-md-4">
                              <label>Pembantu Ketua II Bidang SDM & Keuangan : </label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-inline">
                                    <!-- <input type="text" class="form-control" id="myInput" placeholder="Masukan npp. Cth : 070220002"> -->
                                    <select name="pembantu_2" class="js-example-basic-single col-sm-12" >
                                      <option selected="" value="<?php echo $s->pembantu_2 ?>"><?php echo $s->pembantu_2 ?> </option>
                                      <?php
                                          foreach($npp as $row){
                                              echo "<option value='".$row->nama."'";
                                              
                                              echo ">" . $row->npp . " - " . strtoupper($row->nama) . "</option>";
                                          }
                                      ?> 
                                    </select>
                                </div>
                            </div>
                      </div>

                      <div class="row" style="margin-top: 10px;">
                            <div class="col-md-4">
                              <label>Pembantu Ketua III Bidang Kemahasiswaan, Humas, Kerjasama & Alumni : </label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-inline">
                                    <!-- <input type="text" class="form-control" id="myInput" placeholder="Masukan npp. Cth : 070220002"> -->
                                    <select name="pembantu_3" class="js-example-basic-single col-sm-12" >
                                      <option selected="" value="<?php echo $s->pembantu_3 ?>"><?php echo $s->pembantu_3 ?> </option>
                                      <?php
                                          foreach($npp as $row){
                                              echo "<option value='".$row->nama."'";
                                              
                                              echo ">" . $row->npp . " - " . strtoupper($row->nama) . "</option>";
                                          }
                                      ?> 
                                    </select>
                                </div>
                            </div>
                      </div>

                      <div class="row" style="margin-top: 10px;">
                            <div class="col-md-4">
                              <label>Ketua Program Studi D3 Farmasi : </label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-inline">
                                    <!-- <input type="text" class="form-control" id="myInput" placeholder="Masukan npp. Cth : 070220002"> -->
                                    <select name="prodi_d3" class="js-example-basic-single col-sm-12" >
                                      <option selected="" value="<?php echo $s->prodi_d3 ?>"><?php echo $s->prodi_d3 ?> </option>
                                      <?php
                                          foreach($npp as $row){
                                              echo "<option value='".$row->nama."'";
                                              
                                              echo ">" . $row->npp . " - " . strtoupper($row->nama) . "</option>";
                                          }
                                      ?> 
                                    </select>
                                </div>
                            </div>
                      </div>

                      <div class="row" style="margin-top: 10px;">
                            <div class="col-md-4">
                              <label>Ketua Program Studi S1 Farmasi : </label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-inline">
                                    <!-- <input type="text" class="form-control" id="myInput" placeholder="Masukan npp. Cth : 070220002"> -->
                                    <select name="prodi_s1" class="js-example-basic-single col-sm-12" >
                                      <option selected="" value="<?php echo $s->prodi_s1 ?>"><?php echo $s->prodi_s1 ?> </option>
                                      <?php
                                          foreach($npp as $row){
                                              echo "<option value='".$row->nama."'";
                                              
                                              echo ">" . $row->npp . " - " . strtoupper($row->nama) . "</option>";
                                          }
                                      ?> 
                                    </select>
                                </div>
                            </div>
                      </div>

                      <div class="row" style="margin-top: 10px;">
                            <div class="col-md-4">
                              <label>Sekertaris Program Studi D3 Farmasi : </label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-inline">
                                    <!-- <input type="text" class="form-control" id="myInput" placeholder="Masukan npp. Cth : 070220002"> -->
                                    <select name="sekertaris_prodi_d3" class="js-example-basic-single col-sm-12" >
                                      <option selected="" value="<?php echo $s->sekertaris_prodi_d3 ?>"><?php echo $s->sekertaris_prodi_d3 ?> </option>
                                      <?php
                                          foreach($npp as $row){
                                              echo "<option value='".$row->nama."'";
                                              
                                              echo ">" . $row->npp . " - " . strtoupper($row->nama) . "</option>";
                                          }
                                      ?> 
                                    </select>
                                </div>
                            </div>
                      </div>

                      <div class="row" style="margin-top: 10px;">
                            <div class="col-md-4">
                              <label>Sekertaris Program Studi S1 Farmasi : </label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-inline">
                                    <!-- <input type="text" class="form-control" id="myInput" placeholder="Masukan npp. Cth : 070220002"> -->
                                    <select name="sekertaris_prodi_s1" class="js-example-basic-single col-sm-12" >
                                      <option selected="" value="<?php echo $s->sekertaris_prodi_s1 ?>"><?php echo $s->sekertaris_prodi_s1 ?> </option>
                                      <?php
                                          foreach($npp as $row){
                                              echo "<option value='".$row->nama."'";
                                              
                                              echo ">" . $row->npp . " - " . strtoupper($row->nama) . "</option>";
                                          }
                                      ?> 
                                    </select>
                                </div>
                            </div>
                      </div>

                      <div class="row" style="margin-top: 10px;">
                            <div class="col-md-4">
                              <label>Ketua Lembaga Penjaminan Mutu : </label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-inline">
                                    <!-- <input type="text" class="form-control" id="myInput" placeholder="Masukan npp. Cth : 070220002"> -->
                                    <select name="ketua_mutu" class="js-example-basic-single col-sm-12" >
                                      <option selected="" value="<?php echo $s->ketua_mutu ?>"><?php echo $s->ketua_mutu ?> </option>
                                      <?php
                                          foreach($npp as $row){
                                              echo "<option value='".$row->nama."'";
                                              
                                              echo ">" . $row->npp . " - " . strtoupper($row->nama) . "</option>";
                                          }
                                      ?> 
                                    </select>
                                </div>
                            </div>
                      </div>

                      <div class="row" style="margin-top: 10px;">
                            <div class="col-md-4">
                              <label>Ketua Lembaga Penelitian & Pengabdian kepada Masyarakat : </label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-inline">
                                    <!-- <input type="text" class="form-control" id="myInput" placeholder="Masukan npp. Cth : 070220002"> -->
                                    <select name="ketua_penelitian" class="js-example-basic-single col-sm-12" >
                                      <option selected="" value="<?php echo $s->ketua_penelitian ?>"><?php echo $s->ketua_penelitian ?> </option>
                                      <?php
                                          foreach($npp as $row){
                                              echo "<option value='".$row->nama."'";
                                              
                                              echo ">" . $row->npp . " - " . strtoupper($row->nama) . "</option>";
                                          }
                                      ?> 
                                    </select>
                                </div>
                            </div>
                      </div>

                      <div class="row" style="margin-top: 10px;">
                            <div class="col-md-4">
                              <label>Sekertaris Lembaga Penelitian & Pengabdian Kepada Masyarakat : </label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-inline">
                                    <!-- <input type="text" class="form-control" id="myInput" placeholder="Masukan npp. Cth : 070220002"> -->
                                    <select name="sekertaris_penelitian" class="js-example-basic-single col-sm-12" >
                                      <option selected="" value="<?php echo $s->sekertaris_penelitian ?>"><?php echo $s->sekertaris_penelitian ?> </option>
                                      <?php
                                          foreach($npp as $row){
                                              echo "<option value='".$row->nama."'";
                                              
                                              echo ">" . $row->npp . " - " . strtoupper($row->nama) . "</option>";
                                          }
                                      ?> 
                                    </select>
                                </div>
                            </div>
                      </div>

                      <div class="row" style="margin-top: 10px;">
                            <div class="col-md-4">
                              <label>Koordinator Laboratorium : </label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-inline">
                                    <!-- <input type="text" class="form-control" id="myInput" placeholder="Masukan npp. Cth : 070220002"> -->
                                    <select name="koor_lab" class="js-example-basic-single col-sm-12" >
                                      <option selected="" value="<?php echo $s->koor_lab ?>"><?php echo $s->koor_lab ?> </option>
                                      <?php
                                          foreach($npp as $row){
                                              echo "<option value='".$row->nama."'";
                                              
                                              echo ">" . $row->npp . " - " . strtoupper($row->nama) . "</option>";
                                          }
                                      ?> 
                                    </select>
                                </div>
                            </div>
                      </div>
                      
                      <div class="row" style="margin-top: 10px;">
                            <div class="col-md-4">
                              <label>Koordinator Sarana & Prasarana : </label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-inline">
                                    <!-- <input type="text" class="form-control" id="myInput" placeholder="Masukan npp. Cth : 070220002"> -->
                                    <select name="koor_sarana" class="js-example-basic-single col-sm-12" >
                                      <option selected="" value="<?php echo $s->koor_sarana ?>"><?php echo $s->koor_sarana ?> </option>
                                      <?php
                                          foreach($npp as $row){
                                              echo "<option value='".$row->nama."'";
                                              
                                              echo ">" . $row->npp . " - " . strtoupper($row->nama) . "</option>";
                                          }
                                      ?> 
                                    </select>
                                </div>
                            </div>
                      </div>
                      <button type="submit" class="btn btn-primary" style="height:30px; padding:5px;"> <i class="fa fa-save"></i> Simpan </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
<script type="text/javascript" src="<?php echo base_url()?>/assets/js/autocomplete.js"></script>