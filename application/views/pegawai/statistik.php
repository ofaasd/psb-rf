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
                    <h5>STATISTIk PEGAWAI</h5>
                </div>
                <div class="card-block">
                    <form method="POST" action="" autocomplete="off">
                        <div class="col-md-12 autocomplete">
                            <div class="form-inline">
                                <label for="unit">
                                  Unit : &nbsp;
                                </label>
                                <select name="unit" class="form-control">
                                  <!-- <option value="0">--Unit--</option> -->
                                  <?php
                                  foreach($query as $row){
                                    echo "<option value='" . $row->id . "' ";
                                    if(!empty($unit_result)){
                                      if($unit_result == $row->id){
                                        echo "selected";
                                      }
                                    }
                                    echo ">" . $row->nama_jurusan ."</option>";
                                  }

                                  ?>
                                </select>
                                <label for="unit">
                                  &nbsp; &nbsp; Kategori : &nbsp;
                                </label>
                                <select name="kategori" class="form-control">
                                  <!-- <option value="0">--Unit--</option> -->
                                  <?php
                                  foreach($kategori as $key=>$row){
                                    echo "<option value='" . $key . "'";
                                    if(!empty($kategori_result)){
                                      if($kategori_result == $key){
                                        echo "selected";
                                      }
                                    }
                                    echo ">" . $row ."</option>";
                                  }
                                  ?>
                                </select>
                                &nbsp;&nbsp;
                                <input type="submit" value="Lihat" class="btn btn-primary"> 
                            </div>
                        </div>

                    </form>
                    <div class="result">
                      <?php
                      if(!empty($result)){
                        echo $result;
                      }
                      ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 