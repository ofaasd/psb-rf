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
        <div class="col-sm-9 target_ajax">
            <div class="card">
                <div class="card-header">
                    <?php echo  $this->session->userdata('status_delete'); 
                          $this->session->set_userdata('status_delete','');
                          ?>
                    
                      <div class="col-md-12">
                        <h5>FORM PERUBAHAN npp</h5>
                      </div>
                     
                </div>
                <div class="card-block">
                    <form method="POST" action="<?php echo  base_url()?>simpeg/manage/ubah_npp" autocomplete="off">
                        <input type="hidden" name="status" value="npp" >
                        <div class="col-md-12">
                          <div class="col-md-6 autocomplete">
                              <label for="npp" class="control-label">npp</label>
                              
                              <input type="text" class="form-control" id="myInput" placeholder="Masukan npp. Cth : 070220002" name="npp_lama">
                              
                          </div>
                        </div><br />
                        <div class="col-md-12">
                          <div class="col-md-6">
                              <label for="npp" class="control-label">npp BARU</label>
                              
                              <input type="text" class="form-control" id="npp_baru" placeholder="Masukan npp. Cth : 070220002" name="npp_baru">
                              
                          </div>
                        </div><br />
                        <div class="col-md-12">
                          <input type="submit" class="btn btn-primary" value="kirim">
                          <input type="reset" class="btn btn-danger" value="batal">
                        </div>
                    </form>
                    <div class="result">
                      <div class="card">
                        <div class="card-header">
                          <h5>Log NPP
                        </div>  
                        <div class="card-block">
                          <div class="dt-responsive table-responsive">
                            <table id="order-table" class="table table-striped table-bordered nowrap">
                              <thead>
                                  <tr>
                                      <th width="30%">Timestamp</th>
                                      <th>Aktifitas</th>
                                  </tr>
                              </thead>
                              <tbody>


                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
          <?php echo  $riwayat_tree ?>
        </div>
    </div>
</div> 
<script type="text/javascript" src="<?php echo  base_url()?>/assets/js/autocomplete.js"></script>
<script>
    var countries = [<?php 
        foreach($npp as $row){
            echo '"' . $row->npp . '",';
        }
        ?>];

autocomplete(document.getElementById("myInput"), countries);
    $("#cari").click(function(){
        //var npp = $(this).val();
        $.ajax({
            url : "<?php echo  base_url()?>simpeg/manage/edit/"+$("#myInput").val(),
            method : "GET",
            success: function(data){
                $(".result").html(data);
            }
        });
    });
    $(document).ready(function(){
        <?php
            if(!empty($this->uri->segment('4'))){
        ?>
            $.ajax({
                url : "<?php echo  base_url()?>simpeg/manage/edit/<?php echo  $this->uri->segment('4')?>",
                method : "GET",
                success: function(data){
                    $(".result").html(data);
                    $("#myInput").val("<?php echo  $this->uri->segment('4')?>");
                }
            });
        <?php
            }
        ?>
    });
</script>