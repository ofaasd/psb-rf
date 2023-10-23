<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <?php echo $this->session->userdata('status_delete'); 
                          $this->session->set_userdata('status_delete','');
                          ?>
                    <h5>Lihat Halaman Mahasiswa</h5>
                </div>
                <div class="card-block">
                    <form method="POST" action="<?php echo base_url() ?>preview/proses" autocomplete="off" onsubmit="return check_password()">
                      <div class="row">
                        <div class="col-md-12 form-group">
                            <div class="form-inline">
                                <!-- <input type="text" class="form-control" id="myInput" placeholder="Masukan npp. Cth : 070220002"> -->
                                <select name="nim" id="myInput" class="js-example-basic-single col-sm-12" placeholder="" >
                                  <?php
                                      //echo "<option value='0'></option>";
                                      foreach($daftar_mhs as $row){
                                          echo "<option value=" . $row->nim . "  ";
                                          
                                          echo ">" . $row->nim . " - " . $row->nama . "</option>";
                                      }
                                  ?> 
                              </select>
                            </div>
                        </div>
						<div class="col-md-12 form-group">
                                <!-- <input type="text" class="form-control" id="myInput" placeholder="Masukan npp. Cth : 070220002"> -->
							<input type="password" name="password" class="form-control" placeholder="Masukan Password Admin" >
                        </div>
                        <div class="col-md-4">
                          <button type="submit" class="btn btn-primary" id="cari" style="height:30px; padding:5px;"> <i class="fa fa-search"></i> Cari </button>
                        </div>
                      </div>
                    </form>
				</div>
            </div>
        </div>
    </div>
</div> 	
<?php
	echo $this->session->flashdata('error');
?>