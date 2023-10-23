<style>
    .input-group-prepend{
        background:#ecf0f1;
        padding:5px;
    }
</style>
<div class="page-body">
    <div class="row">
        <div class="col-sm-9">
            <form action="<?php echo  base_url()?>simpeg/manage/save" method="post" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header">
                    <h5>BIODATA PEGAWAI BARU</h5>
                    <h4><?php echo  $this->session->userdata('status'); 
                        $this->session->set_userdata('status','');?></h4>
                </div>
                <div class="card-block">
                
                <h4 class="sub-title">Biodata</h4>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="col-sm-4 col-form-label">Jenis Pegawai : </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="jenis_pegawai" id="jenis_pegawai">
                            <option value="0">--- Pilih Jenis Pegawai --- </option>
                            <?php
                                foreach($jenis_pegawai as $row){
                                    echo "<option value='" . $row->id . "''>" . $row->nama . "</option>";
                                }
                            ?>
                            </select>
                        </div>
                        <label class="col-sm-4 col-form-label"></label>
                        <div class="col-sm-10">
                            <select class="form-control" name="posisi_pegawai" id="status_pegawai">
                                
                            </select>
                        </div>
                        <label class="col-sm-10 col-form-label">Nomor Induk pegawai(npp): </label>
                        <div class="col-sm-10">
                            <!-- <input type="text" class="form-control" name="npp" id="npp" readonly> -->
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <input type="text" name="npp_depan" class="input-group-text" id="initial_npp" readonly="readonly">
                                </div>
                                <input type="text" class="form-control" name="npp" id="npp" aria-describedby="inputGroupPrepend" required>
                            </div>
                        </div>
                       <!--  <div class="col-md-4 mb-3">
                          <label for="validationCustomUsername">Username</label>
                          <div class="input-group">
                            
                          </div>
                        </div> -->
                        <!-- <label class="col-sm-4 col-form-label">Homebase : </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="homebase">
                            <?php
                                foreach($progdi as $row){
                                    echo "<option value='" . $row->id . "''>" . $row->jenjang . " - " . $row->nama_jurusan . "</option>";
                                }
                            ?>
                            </select>
                        </div> -->
                        <div id="homebase">

                        </div>
                        <label class="col-sm-4 col-form-label">Nama Lengkap : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_lengkap" value="" >
                        </div>
                        <label class="col-sm-10 col-form-label">Alamat Tempat Tinggal : </label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="alamat" value="" ></textarea>
                        </div>
                        <label class="col-sm-4 col-form-label">Jenis Kelamin : </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="jenis_kelamin">
                                <?php
                                    foreach($jenis_kelamin as $key=>$row){
                                        echo "<option value='" . $key . "''>" . $row . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <label class="col-sm-4 col-form-label">NIDN : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nidn" value="" >
                        </div>
                        <label class="col-sm-4 col-form-label">Status Perkawinan : </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="status_nikah">
                                <?php
                                    foreach($status_kawin as $row){
                                        echo "<option value='" . $row . "''>" . $row . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <label class="col-sm-10 col-form-label">Status Kepegawaian : </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="status">
                                <?php
                                    foreach($status as $row){
                                        echo "<option value='" . $row . "''>" . $row . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <label class="col-sm-4 col-form-label">Tempat, Tgl Lahir : </label>
                        <div class="col-sm-10">
                            <div class="row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="tempat_lahir" value="" placeholder="Tempat Lahir">
                            </div>

                            <div class="col-sm-6">
                                <input type="text" id="datepicker" class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir">
                            </div>
                        </div>
                        </div>

                        <label class="col-sm-4 col-form-label">Gelar Depan : </label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="gelar_depan" value="" placeholder="Ex: Dr., Ir.,">
                        </div>
                        <label class="col-sm-4 col-form-label">Gelar Belakang : </label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="gelar_belakang" value="" placeholder="Ex: S.ked, S.Farm, M.Farm">
                        </div>


                        <label class="col-sm-4 col-form-label">No. KTP : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="no_ktp" value="" >
                        </div>
                        <label class="col-sm-4 col-form-label">No. KK : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="no_kk" value="" >
                        </div>
                        <label class="col-sm-10 col-form-label">No. BPJS Kesehatan : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="no_bpjs_kesehatan" value="" >
                        </div>
                        <label class="col-sm-12 col-form-label">No. BPJS ketenagakerjaan : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="no_bpjs_ketenagakerjaan" value="" >
                        </div>
                        <!-- 
                        <label class="col-sm-4 col-form-label">npp PNS : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="npp_pns" value="" >
                        </div> -->
                        <!-- <label class="col-sm-4 col-form-label">Kelurahan : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="kelurahan" value="" >
                        </div>
                        <label class="col-sm-4 col-form-label">Kecamatan : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="kecamatan" value="" >
                        </div>
                        <label class="col-sm-4 col-form-label">Kota : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="kota" value="" >
                        </div>
                        <label class="col-sm-4 col-form-label">Provinsi : </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="provinsi">
                                <?php
                                    foreach($provinsi as $row){
                                        echo "<option value='" . $row->id . "''>" . $row->nama_prov . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    -->
                        <label class="col-sm-4 col-form-label">Agama : </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="agama">
                            <?php
                                foreach($agama as $row){
                                    echo "<option value='" . $row . "''>" . $row . "</option>";
                                }
                            ?>
                            </select>
                        </div> 
                        <label class="col-sm-4 col-form-label">Email : </label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email1" value="" >
                        </div>
                        <label class="col-sm-4 col-form-label">No. Telp / Hp : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="no_telp" value="" >
                        </div>
                        
                        <!-- <label class="col-sm-4 col-form-label">Email2 : </label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email2" value="" >
                        </div> -->
                        <!-- <label class="col-sm-4 col-form-label">Blog : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="blog" value="" >
                        </div>
                        <label class="col-sm-4 col-form-label">Citation : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="citation" value="" >
                        </div> -->
                    </div>
                    <div class="col-sm-6">
                        <label class="col-sm-12 col-form-label"><p style="margin:0"><b>Pendidikan S1</b></p></label>
                        <label class="col-sm-4 col-form-label">Universitas : </label>
                        <input type="hidden" name="jenjang[]" value="S1">
                        <div class="col-sm-10">
                            <!-- <input type="text" class="form-control" name="universitas[]" value="" placeholder="Universitas Ex : Universitas Indonesia"> -->
                            <select name="universitasid[]" id="univ1" class="js-example-basic-single col-sm-12" placeholder="--Nama Universitas--">
                                <?php
                                    //echo "<option value='0'></option>";
                                    foreach($universitas as $value){
                                        echo "<option value=" . $value->id . "  >" . $value->nama_universitas . "</option>";
                                    }
                                    echo "<option value='999999' >Lainnya</option>";
                                ?> 
                            </select>
                            <div class="univ1-text">
                                <input type='hidden' class='form-control mt-3' placeholder='Nama Universitas' name='universitas[]'>
                            </div>
                        </div>
                        <label class="col-sm-4 col-form-label">Jurusan : </label>
                        <div class="col-sm-10">
                            <select name="jurusanid[]" id="jurusan1" class="js-example-basic-single col-sm-12" placeholder="--Nama Jurusan--">
                                <?php
                                    //echo "<option value='0'></option>";
                                    foreach($master_prodi as $value){
                                        echo "<option value=" . $value->id . "  >" . $value->nama_jurusan . "</option>";
                                    }
                                    echo "<option value='999999' >Lainnya</option>";
                                ?> 
                            </select>
                            <div class="jurusan1-text">
                                <input type='hidden' class='form-control mt-3' placeholder='Nama Jurusan' name='jurusan[]'>
                            </div>
                        </div>

                        <br />
                        <div class="form-check col-sm-12">
                          <input class="form-check-input" type="checkbox" value="" id="pendidikans2" style="margin-left:0; margin-top:.40rem">
                          <label class="form-check-label" for="pendidikans2">
                            <p style="margin:0"><b>Pendidikan S2</b></p>
                          </label>
                        </div>
                        <label class="col-sm-4 col-form-label">Universitas : </label>
                        <input type="hidden" name="jenjang[]" value="S2">
                        <div class="col-sm-10">
                            <select name="universitasid[]" class="js-example-basic-single col-sm-12" id="univ2" disabled  placeholder="--Nama Universitas--">
                                <?php
                                    //echo "<option value='0'>--Nama Universitas--</option>";
                                    foreach($universitas as $value){
                                        echo "<option value=" . $value->id . "  >" . $value->nama_universitas . "</option>";
                                    }
                                    echo "<option value='999999' >Lainnya</option>";
                                ?> 
                            </select>
                            <div class="univ2-text">
                                <input type='hidden' class='form-control mt-3' placeholder='Nama Universitas' name='universitas[]'>
                            </div>
                        </div>
                        <label class="col-sm-4 col-form-label">Jurusan : </label>
                        <div class="col-sm-10">
                            <select name="jurusanid[]" id="jurusan2" class="js-example-basic-single col-sm-12" disabled  placeholder="--Nama Jurusan--">
                                <?php
                                    //echo "<option value='0'></option>";
                                    foreach($master_prodi as $value){
                                        echo "<option value=" . $value->id . "  >" . $value->nama_jurusan . "</option>";
                                    }
                                    echo "<option value='999999' >Lainnya</option>";
                                ?> 
                            </select>
                            <div class="jurusan2-text">
                                <input type='hidden' class='form-control mt-3' placeholder='Nama Jurusan' name='jurusan[]'>
                            </div>
                        </div>
                        <br />
                        <div class="form-check col-sm-12">
                          <input class="form-check-input" type="checkbox" value="" id="pendidikans3" style="margin-left:0; margin-top:.40rem">
                          <label class="form-check-label" for="pendidikans3">
                            <p style="margin:0"><b>Pendidikan S3</b></p>
                          </label>
                        </div>
                        <label class="col-sm-4 col-form-label">Universitas : </label>
                        <input type="hidden" name="jenjang[]" value="S3">
                        <div class="col-sm-10">
                             <select name="universitasid[]" class="js-example-basic-single col-sm-12" id="univ3" disabled  placeholder="--Nama Universitas--">
                                <?php
                                    //echo "<option value='0'>--Nama Universitas--</option>";
                                    foreach($universitas as $value){
                                        echo "<option value=" . $value->id . "  >" . $value->nama_universitas . "</option>";
                                    }
                                    echo "<option value='999999' >Lainnya</option>";
                                ?> 
                            </select>
                            <div class="univ3-text">
                                <input type='hidden' class='form-control mt-3' placeholder='Nama Universitas' name='universitas[]'>
                            </div>
                        </div>
                        <label class="col-sm-4 col-form-label">Jurusan : </label>
                        <div class="col-sm-10">
                            <select name="jurusanid[]" id="jurusan3" class="js-example-basic-single col-sm-12"  disabled  placeholder="--Nama Jurusan--">
                                <?php
                                    //echo "<option value='0'></option>";
                                    foreach($master_prodi as $value){
                                        echo "<option value=" . $value->id . "  >" . $value->nama_jurusan . "</option>";
                                    }
                                    echo "<option value='999999' >Lainnya</option>";
                                ?> 
                            </select>
                            <div class="jurusan3-text">
                                <input type='hidden' class='form-control mt-3' placeholder='Nama Jurusan' name='jurusan[]'>
                            </div>
                        </div>
                        
                        
                        <!--   -->
                        <!-- <label class="col-sm-4 col-form-label">Golongan Darah : </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="golongan_darah">
                                <?php
                                    foreach($golongan_darah as $row){
                                        echo "<option value='" . $row . "''>" . $row . "</option>";
                                    }
                                ?>
                            </select>
                        </div> -->
                        
                        <label class="col-sm-4 col-form-label">Nama Pasangan : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_pasangan" value="" >
                        </div>

                        <label class="col-sm-4 col-form-label">Tgl Lahir Pasangan : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="tgl_lahir_pasangan" value="" id="datepicker2">
                        </div>

                        

                        <!-- <label class="col-sm-4 col-form-label">Agama : </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="agama">
                                <?php
                                    foreach($agama as $row){
                                        echo "<option value='" . $row . "''>" . $row . "</option>";
                                    }
                                ?>
                            </select>
                        </div> -->
                        <label class="col-sm-8 col-form-label">Pekerjaan Pasangan : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="pekerjaan_pasangan" value="" >
                        </div>
                        <label class="col-sm-4 col-form-label">Jumlah Anak : </label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="jumlah_anak" value="" >
                        </div>
                        <label class="col-sm-4 col-form-label">Password : </label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" value="" >
                        </div>
                       
                            <label class="col-sm-6 col-form-label">Upload Foto : </label>
                             <div class="col-sm-10">
                                <input type="file" class="form-control" required="" name="foto"></input><p>Maksimal 500kb </p>
                            </div>
                       
                        
                    </div>
                </div>
             </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5>DATA KEPEGAWAIAN</h5>
                    <h4><?php echo  $this->session->userdata('status'); 
                        $this->session->set_userdata('status','');?></h4>
                </div>
                <div class="card-block">                        
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <!-- <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="sub-title">Pendidikan Awal Kepegawaian</h4>
                                        <label class="col-sm-4 col-form-label">Jurusan : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="jurusan" value="" >
                                        </div>
                                        <label class="col-sm-4 col-form-label">Asal Sekolah : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="asal_sekolah" value="" >
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="row">
                                    <div class="col-sm-12">
                                        
                                        <h4 class="sub-title">Golongan Awal</h4>
                                        <label class="col-sm-4 col-form-label">Golongan : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="golongan_awal" value="" >
                                        </div>
                                        <label class="col-sm-4 col-form-label">No. pengantar : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="np_awal" value="" >
                                        </div>
                                        <label class="col-sm-4 col-form-label">No. SK : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nsk_awal" value="" >
                                        </div>
                                        <label class="col-sm-4 col-form-label">Tgl. SK : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="tglsk_awal" value="" >
                                        </div>
                                        <label class="col-sm-4 col-form-label">TMT : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="tmt_awal" value="" >
                                        </div>
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col-sm-12">
                                        
                                        <h4 class="sub-title">Golongan</h4>
                                        <label class="col-sm-4 col-form-label">Golongan : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="golongan_skrg" value="" >
                                        </div>
                                        <label class="col-sm-4 col-form-label">No. pengantar : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="np_skrg" value="" >
                                        </div>
                                        <label class="col-sm-4 col-form-label">No. SK : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nosk_skrg" value="" >
                                        </div>
                                        <label class="col-sm-4 col-form-label">Tgl. SK : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="tglsk_skrg" id="tglsk_skrg" value="" >
                                        </div>
                                        <label class="col-sm-4 col-form-label">TMT : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="tmt_skrg" value="" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <br /><br />
                                        <h4 class="sub-title">Jabatan Fungsional</h4>
                                        <!-- <label class="col-sm-4 col-form-label">jenis Pegawai Awal : </label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="jenis_pegawai">
                                                <?php
                                                    foreach($jenis_pegawai as $row){
                                                        echo "<option value='" . $row->id . "''>" . $row->nama . "</option>";
                                                    }
                                                ?>  
                                            </select>
                                        </div> -->
                                        <!-- <label class="col-sm-4 col-form-label">Jabatan Fungsional Awal : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="jabatan_fungsional_awal" value="" >
                                        </div> -->
                                        <label class="col-sm-4 col-form-label">Jabatan Fungsional : </label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="jabatan_fungsional">
                                                <?php
                                                    foreach($jabatan_fungsional as $row){
                                                        echo "<option value='" . $row . "''>" . $row . "</option>";
                                                    }
                                                ?>  
                                            </select>
                                        </div> 
                                        <label class="col-sm-4 col-form-label">No. SK : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nosk_fungsional" value="" >
                                        </div> 
                                        <label class="col-sm-4 col-form-label">Tgl. SK : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="tglsk_fungsional" id="tglsk_fungsional" value="" >
                                        </div>
                                        <label class="col-sm-4 col-form-label">TMT SK : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="tmtsk_fungsional" value="" >
                                        </div>
                                        <!-- <label class="col-sm-4 col-form-label">KUM : </label> -->
                                        <div class="col-sm-10">
                                            <input type="hidden" class="form-control" name="kum_fungsional" value="" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                
                                <div class="row">
                                    <div class="col-sm-12">
                                        
                                        <h4 class="sub-title">Jabatan Struktural</h4>
                                        <label class="col-sm-4 col-form-label">Unit Kerja : </label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="unit_kerja">
                                                <?php
                                                    foreach($fakultas as $row){
                                                        echo "<option value='" . $row->id . "'>FAKULTAS " . $row->nama_fakultas . "</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <label class="col-sm-4 col-form-label">Bagian : </label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="bagian" id="bagian">
                                                <option value="0">-- Bagian --</option>
                                                <?php
                                                    foreach($bagian as $row){
                                                        echo "<option value='" . $row->bagian . "'>" . $row->bagian . "</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <label class="col-sm-4 col-form-label">Jabatan Struktural : </label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="jabatan_struktural" id="jabatan">
                                                <option value="0">-- Jabatan Struktural --</option>
                                                
                                            </select>
                                        </div>
                                        <label class="col-sm-4 col-form-label">No. SK : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nosk_struktural" value="" >
                                        </div> 
                                        <label class="col-sm-4 col-form-label">Tgl. SK : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="tglsk_struktural" id="tglsk_struktural" value="" >
                                        </div>
                                        <label class="col-sm-4 col-form-label">TMT SK : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="tmtsk_struktural" value="" >
                                        </div>
                                        <!-- <label class="col-sm-4 col-form-label">KUM : </label> -->
                                        <div class="col-sm-10">
                                            <input type="hidden" class="form-control" name="kum_struktural" value="" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                </div>
                <div class="card-footer">
                    <input type="submit" name="submit" value="Simpan" class="btn btn-primary">
                </div>
            </div>

            </form>
          </div>
          <div class="col-md-3">
            <?php echo  $riwayat_tree ?>
          </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#univ1").on("change",function(){
        universitas("univ1");
    });
    $("#univ2").on("change",function(){
        universitas("univ2");
    });
    $("#univ3").on("change",function(){
        universitas("univ3");
    });
    $("#jurusan1").on("change",function(){
        universitas("jurusan1");
    });
    $("#jurusan2").on("change",function(){
        universitas("jurusan2");
    });
    $("#jurusan3").on("change",function(){
        universitas("jurusan3");
    });
    
    function universitas(univ){
        if($("#" + univ).val() == 999999){
            //alert("lainnya");
            $("." + univ + "-text input").attr({type:"text"});
        }else{  
            $("." + univ + "-text input").attr({type:"hidden"});
        }
        //alert("asdasd");
    }
    $(document).ready(function(){
        $('#jenis_pegawai').change(function(){
            var id=$(this).val();
            $.ajax({
                url : "<?php echo  base_url();?>pegawai/get_status/",
                method : "POST",
                data : {id: id},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                    html += '<option value="0">--- Pilih Jenis Pegawai --- </option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value="'+ data[i].kode +'">'+data[i].nama+'</option>';
                    }
                    $('#status_pegawai').html(html);
                     
                }
            });
        });
        $("#status_pegawai").change(function(){
            var today = new Date();
            var month = today.getMonth();
            var year = today.getFullYear();

            year = year.toString().substr(-2);
            month = month.toString();

            if (month.length === 1)
            {
                month = "0" + month;
            }

            var tgl = month + year;
            var status = $(this).val();
            var id = (parseInt(<?php echo  $last_id ?>)+1);
            id = id.toString();

            if(id.length === 1){
                id = "00" + id;
            }else if(id.length === 2){
                id = "0" + id;
            }else{
                id = id;
            }

            var initial_npp = status+tgl;
            var npp = id;
            $("#initial_npp").val(initial_npp);
            $("#npp").val(npp);

            $.ajax({
                url : "<?php echo  base_url();?>pegawai/get_prodi/",
                method : "POST",
                data : {bagian: id},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = "";
                    html += '<label class="col-sm-4 col-form-label">Homebase : </label><div class="col-sm-10">';
                    html += '<select name="homebase" class="form-control">';
                    html += '<option value="0">-- Homebase -- </option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value="'+ data[i].id +'">'+data[i].nama_jurusan+'</option>';
                    }
                    html += '</select></div>';
                    $('#homebase').html(html);
                }
            });
        });
        $('#bagian').change(function(){
            var id=$(this).val();
            $.ajax({
                url : "<?php echo  base_url();?>pegawai/get_jabatan/",
                method : "POST",
                data : {bagian: id},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                    html += '<option value="0">-- Jabatan Struktural -- </option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value="'+ data[i].id +'">'+data[i].jabatan+'</option>';
                    }
                    $('#jabatan').html(html);
                     
                }
            });
        });
        $('.univ').selectpicker();
        $("#datepicker").datepicker();
        $("#datepicker2").datepicker();
        $("#tglsk_skrg").datepicker();
        $("#tglsk_fungsional").datepicker();
        $("#tglsk_struktural").datepicker();
        $("#pendidikans2").change(function(){
            if($(this).is(":checked")){
                $("#univ2").prop("disabled",false);
                $("#jurusan2").prop("disabled",false);
            }else{
                $("#univ2").prop("disabled",true);
                $("#jurusan2").prop("disabled",true);
            }
        });

        $("#pendidikans3").change(function(){
            if($(this).is(":checked")){
                $("#univ3").prop("disabled",false);
                $("#jurusan3").prop("disabled",false);
            }else{
                $("#univ3").prop("disabled",true);
                $("#jurusan3").prop("disabled",true);
            }
        });
    });
    
</script>
