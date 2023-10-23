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
                    <h5>KRM Dosen</h5>
                </div>
                <div class="card-block">
                    <form method="POST" action="" autocomplete="off">
                      <div class="row">
                        <div class="col-md-4">
                            <div class="form-inline">
                                <!-- <input type="text" class="form-control" id="myInput" placeholder="Masukan npp. Cth : 070220002"> -->
                                <select name="universitasid[]" id="myInput" class="js-example-basic-single col-sm-12" placeholder="--Nama Universitas--" >
                                  <?php
                                      //echo "<option value='0'></option>";
                                      foreach($npp as $row){
                                          echo "<option value=" . $row->id . "  ";
                                          
                                          echo ">" . $row->npp . " - " . $row->nama . "</option>";
                                      }
                                  ?> 
                              </select>

                                

                            </div>
                        </div>
                        <div class="col-md-4">
                          <a href="#" class="btn btn-primary" id="cari" style="height:30px; padding:5px;"> <i class="fa fa-search"></i> Cari </a>
                        </div>
                      </div>
                    </form>
                    <div class="result">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
<script type="text/javascript" src="<?php echo base_url()?>/assets/js/autocomplete.js"></script>
<script>
//     var countries = [<?php 
//         foreach($npp as $row){
//             echo '"' . $row->npp . '",';
//         }
//         ?>];

// autocomplete(document.getElementById("myInput"), countries);
    $("#cari").click(function(){
        //var npp = $(this).val();
        $.ajax({
            url : "<?php echo base_url()?>pegawai/krm_ajax/"+$("#myInput").val(),
            method : "GET",
            success: function(data){
                $(".result").html(data);
            }
        });
    });
    $(document).ready(function(){
        <?php
            if(!empty($this->uri->segment('3'))){
        ?>
            $.ajax({
                url : "<?php echo base_url()?>pegawai/krm_ajax/<?php echo  $this->uri->segment('3')?>",
                method : "GET",
                success: function(data){
                    $(".result").html(data);
                    $("#myInput").val("<?php echo  $this->uri->segment('3')?>");
                }
            });
        <?php
            }
        ?>
    });
</script>