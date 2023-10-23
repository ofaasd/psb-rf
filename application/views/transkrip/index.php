<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Transkrip / Daftar Nilai</h5>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-sm-3">
                            <select class="js-example-basic-single form-control" id="nama_mhs">
                                <option selected="" disabled="">-- Cari Nama Mahasiswa --</option>
                                <?php foreach ($daftar_mhs as $d): ?>
                                    <option value="<?php echo $d->nim; ?>"><?php echo $d->nim.' - '.$d->nama; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button onclick="cari();" class="btn btn-primary" style="height:30px; padding:5px;"><span><i class="fa fa-search"></i></span> Cari</button>
                        </div>
                    </div>
                    <div id="result">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
    function cari(){
        var nim = $('#nama_mhs').val();
        $.ajax({
                url : "<?php echo base_url()?>transkrip/mahasiswa/",
                method : "POST",
                data:{
                    nim: nim
                },
                success: function(data){
                    $("#result").html(data);
                }
            });
    }
</script>