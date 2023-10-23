<style>
   .ui-autocomplete {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    float: left;
    display: none;
    min-width: 160px;   
    padding: 4px 0;
    margin: 0 0 10px 25px;
    list-style: none;
    background-color: #ffffff;
    border-color: #ccc;
    border-color: rgba(0, 0, 0, 0.2);
    border-style: solid;
    border-width: 1px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -webkit-background-clip: padding-box;
    -moz-background-clip: padding;
    background-clip: padding-box;
    *border-right-width: 2px;
    *border-bottom-width: 2px;
}

.ui-menu-item > a.ui-corner-all {
    display: block;
    padding: 3px 15px;
    clear: both;
    font-weight: normal;
    line-height: 18px;
    color: #555555;
    white-space: nowrap;
    text-decoration: none;
}

.ui-state-hover, .ui-state-active {
    color: #ffffff;
    text-decoration: none;
    background-color: #0088cc;
    border-radius: 0px;
    -webkit-border-radius: 0px;
    -moz-border-radius: 0px;
    background-image: none;
}
</style>

            <div class="card">
                <div class="card-header">
                    <?php echo  $this->session->userdata('status_delete'); 
                          $this->session->set_userdata('status_delete','');
                          ?>
                </div>
                <div class="card-block">
					<?php
						if($this->authact->getRole() ==1){
					?>
							<form method="POST" action="" autocomplete="off">
								<div class="col-md-4 autocomplete">
									<div class="form-inline">
										<input type="text" class="form-control" id="myInput" placeholder="Masukan npp. Cth : 070220002">
										<a href="#" class="btn btn-primary" id="cari"> Cari </a>

									</div>
								</div>
							</form>
					<?php
						}
					?>
                    <div class="result">

                    </div>
                </div>
            </div>
<script type="text/javascript" src="<?php echo  base_url()?>/assets/js/autocomplete.js"></script>
<script>
    $( function() {
      var availableTags = [
        <?php 
        foreach($npp as $row){
            echo '"' . $row->npp . '",';
        }
        ?>
      ];
      $( "#myInput" ).autocomplete({
        source: availableTags
      });
    } );
    $("#cari").click(function(){
        //var npp = $(this).val();
        $.ajax({
            url : "<?php echo  base_url()?>simpeg/<?php echo $url?>/"+$("#myInput").val(),
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
                url : "<?php echo  base_url()?>simpeg/<?php echo $url?>/<?php echo  $this->uri->segment('4')?>",
                method : "GET",
                success: function(data){
                    $(".result").html(data);
                    $("#myInput").val("<?php echo  $this->uri->segment('4')?>");
                }
            });
        <?php
            }elseif(!empty($_SESSION['npp'])){
              $npp = $_SESSION['npp'];
          ?>
              $.ajax({
                  url : "<?php echo  base_url()?>simpeg/<?php echo $url?>/<?php echo  $npp ?>",
                  method : "GET",
                  success: function(data){
                      $(".result").html(data);
                      $("#myInput").val("<?php echo  $npp ?>");
                  }
              });
          <?php
            }
        ?>
    });
</script>