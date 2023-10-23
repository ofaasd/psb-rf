
    <div class="row">
        <div class="col-sm-12">
            <form action="<?php echo base_url()?>pegawai/update" method="post" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-1">
                            <!--<a href="<?php echo base_url()?>pegawai" class="btn btn-primary col-md-12" style="display:block;"><i class="ti-arrow-left"></i> </a>-->
                        </div>
                        <div class="col-md-5">
                            <h5 style="margin-top:10px;">BIODATA PEGAWAI</h5>
                        </div>
                    <h4><?php echo $this->session->userdata('status'); 
                        $this->session->set_userdata('status','');?></h4>
                    </div>
                </div>
                <div class="card-block">
                
                <h4 class="sub-title">Biodata</h4>
                <div class="form-group row">
                    <input type="hidden" name="id_biodata" value="<?php echo  $query->id_biodata ?>">
                    <div class="col-sm-2">
                        <img src="<?php echo base_url();?>assets/foto_pegawai/<?php echo  $query->foto; ?>" width="100%"><br /><br />
						<?php if(isset($simpeg) && $simpeg == true){?>
							<a href="#" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#ubah_photo"><i class="feather icon-image"></i> Ubah Photo</a><br /><br />
							<a href="#" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#ubah_password"><i class="fa fa-key"></i> Ubah Password</a><br /><br />
						<?php } ?>
                        
                        <a href="<?php echo  base_url() ?>simpeg/profil/cv/<?php echo $query->id_pegawai?>" class="btn btn-primary col-md-12"><i class="feather icon-download"></i> CV</a>
                    </div>      
                    <div class="col-sm-5">
                        <!-- <label class="col-sm-12 col-form-label">Jenis Pegawai : </label>
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
                        <label class="col-sm-12 col-form-label"></label>
                        <div class="col-sm-10">
                            <select class="form-control" name="posisi_pegawai" id="status_pegawai">
                                
                            </select>
                        </div> -->
                        
                        <input type="hidden" name="pegawai_id" value="<?php echo $query->pegawai_id?>">
                        <label class="col-sm-12 col-form-label">Nomor Induk pegawai(NPP): </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nip" id="nip" value="<?php echo $query->npp?>">
                        </div>
                        
                        <label class="col-sm-12 col-form-label">Homebase : </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="homebase">
                            <?php
                                foreach($homebase as $row){
                                    echo "<option value='" . $row->id . "' ";
                                    if($row->id == $query->homebase)
                                        echo "selected";
                                    echo ">" . $row->nama_jurusan . "</option>";
                                }
                            ?>
                            </select>
                        </div>
                        <label class="col-sm-12 col-form-label">Nama Lengkap : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_lengkap" value="<?php echo  $query->nama_lengkap ?>" >
                        </div>
                        <label class="col-sm-10 col-form-label">Alamat Tempat Tinggal : </label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="alamat" value="" ><?php echo  $query->alamat ?></textarea>
                        </div>
						
							<label class="col-sm-10 col-form-label">Nama Provinsi :</label>
							<div class="col-sm-10">
								<p>
									<select name="provinsi" id="provinsi" class="form-control" required="">
										<option selected="" disabled="">Pilih Provinsi</option>
										<?php foreach($wilayah as $w){?>
										<option value="<?php echo $w->id_wil ?>"><?php echo $w->nm_wil ?></option>
										<?php } ?>
									</select>
								</p>
							</div>
						
							<label class="col-sm-10 col-form-label">Nama Kota/Kabupaten :</label>
							<div class="col-sm-10">
								<p>
									<select name="kotakab" id="kotakab" class="form-control" required=""> 
										<option selected="" disabled="">Pilih Kota/Kabupaten</option>
									</select>
								</p>
							</div>
						
							<label class="col-sm-10 col-form-label">Nama Kecamatan :</label>
							<div class="col-sm-10">
								<p>
									<select name="kecamatan" id="kecamatan" class="form-control" required="">
										<option selected="" disabled="">Daftar Kecamatan</option>
									</select>
								</p>
							</div>
						
							<label class="col-sm-10 col-form-label">Nama Kelurahan :</label>
							<div class="col-sm-10">
								<p><input type="text" class="form-control" placeholder="Nama Kelurahan" oninput="this.className = ''" id="kelurahan" name="kelurahan" required=""></p>
							</div>
						
                        <label class="col-sm-12 col-form-label">Jenis Kelamin : </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="jenis_kelamin">
                                <?php
                                    foreach($jenis_kelamin as $key=>$row){
                                        echo "<option value='" . $key . "' ";
                                        if ($query->jenis_kelamin == $key) {
                                            echo "selected";
                                        }
                                        echo ">" . $row . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <label class="col-sm-12 col-form-label">NIDN : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nidn" value="<?php echo  $query->nidn ?>" >
                        </div>
                        <label class="col-sm-12 col-form-label">Status Perkawinan : </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="status_nikah">
                                <?php
                                    foreach($status_kawin as $row){
                                        echo "<option value='" . $row . "' ";
                                        if($query->status_nikah == $row){
                                            echo "selected";
                                        }
                                        echo ">" . $row . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <label class="col-sm-10 col-form-label">Status Kepegawaian : </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="status">
                                <?php
                                    foreach($status as $row){
                                        echo "<option value='" . $row . "'";
                                        if($query->status_pegawai == $row){
                                            echo "selected";
                                        }
                                        echo ">" . $row . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <label class="col-sm-12 col-form-label">Tempat, Tgl Lahir : </label>
                        <div class="col-sm-10">
                            <div class="row">
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="tempat_lahir" value="<?php echo  $query->tempat_lahir?>" placeholder="Tempat Lahir">
                            </div>

                            <div class="col-sm-7">
                                <input type="text" id="datepicker"  class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir" value="<?php echo date("m/d/Y", strtotime($query->tanggal_lahir));  ?>">
                            </div>
                        </div>
                        </div>

                        <label class="col-sm-12 col-form-label">Gelar Depan : </label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="gelar_depan" value="<?php echo  $query->gelar_depan ?>" placeholder="Ex: Dr., Ir.,">
                        </div>
                        <label class="col-sm-12 col-form-label">Gelar Belakang : </label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="gelar_belakang" value="<?php echo  $query->gelar_belakang ?>" placeholder="Ex: S.ked, S.Farm, M.Farm">
                        </div>
                        <!-- 
                        <label class="col-sm-12 col-form-label">NIP PNS : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nip_pns" value="" >
                        </div> -->
                        <!-- <label class="col-sm-12 col-form-label">Kelurahan : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="kelurahan" value="" >
                        </div>
                        <label class="col-sm-12 col-form-label">Kecamatan : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="kecamatan" value="" >
                        </div>
                        <label class="col-sm-12 col-form-label">Kota : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="kota" value="" >
                        </div>
                        <label class="col-sm-12 col-form-label">Provinsi : </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="provinsi">
                                <?php
                                    foreach($provinsi as $row){
                                        echo "<option value='" . $row->id . "''>" . $row->nama_prov . "</option>";
                                    }
                                ?>
                            </select>
                        </div>-->
                        <label class="col-sm-12 col-form-label">Agama : </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="agama">
                            <?php
                                foreach($agama as $row){
                                    echo "<option value='" . $row . "'";
									echo ($row == $query->agama)?"selected":"";
									echo " >" . $row . "</option>";
                                }
                            ?>
                            </select>
                        </div> 
                        <label class="col-sm-12 col-form-label">Email : </label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email1" value="<?php echo  $query->email1 ?>" >
                        </div>
						<label class="col-sm-12 col-form-label">No. Telp : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="notelp" value="<?php echo  $query->notelp ?>" >
                        </div>
						<label class="col-sm-12 col-form-label">No. HP : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nohp" value="<?php echo  $query->nohp ?>" >
                        </div>
						
                        <!-- <label class="col-sm-12 col-form-label">Email2 : </label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email2" value="" >
                        </div>
                        <label class="col-sm-12 col-form-label">Blog : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="blog" value="" >
                        </div>
                        <label class="col-sm-12 col-form-label">Citation : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="citation" value="" >
                        </div> -->
                    </div>
                    <div class="col-sm-5">

                        <label class="col-sm-12 col-form-label"><p style="margin:0"><b>Pendidikan S1</b></p></label>
                        <label class="col-sm-12 col-form-label">Universitas : </label>
                        <input type="hidden" name="jenjang[]" value="S1">
                        <div class="col-sm-10">
                            <!-- <input type="text" class="form-control" name="universitas[]" value="" placeholder="Universitas Ex : Universitas Indonesia"> -->
                            <select name="universitasid[]" id="univ1" class="js-example-basic-single col-sm-12" placeholder="--Nama Universitas--">
                                <?php
                                    //echo "<option value='0'></option>";
                                    foreach($master_universitas as $value){
                                        echo "<option value=" . $value->id . "  ";
                                        if(!empty($s1->universitas) ){
                                            if($s1->universitas == $value->id){
                                                echo "selected";
                                            }
                                        }
                                        echo ">" . $value->nama_universitas . "</option>";
                                    }
                                    echo "<option value='999999' >Lainnya</option>";
                                ?> 
                            </select>
                            <input type="hidden" name="status_riwayat[]" value="<?php echo  (!empty($s1->id))?$s1->id:"0" ?>">
                            <input type="hidden" name="id_pegawai" value="<?php echo  $query->id_pegawai?>">
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
                                        echo "<option value=" . $value->id . " ";
                                        if(!empty($s1->jurusan) ){
                                            if($s1->jurusan == $value->id){
                                                echo "selected";
                                            }
                                        }
                                        echo " >" . $value->nama_jurusan . "</option>";
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
                        <label class="col-sm-12 col-form-label">Universitas : </label>
                        <input type="hidden" name="jenjang[]" value="S2">
                        <div class="col-sm-10">
                            <select name="universitasid[]" class="js-example-basic-single col-sm-12" id="univ2" disabled  placeholder="--Nama Universitas--">
                                <?php
                                    //echo "<option value='0'>--Nama Universitas--</option>";
                                    foreach($master_universitas as $value){
                                        echo "<option value=" . $value->id . "  ";
                                        if(!empty($s2->universitas) ){
                                            if($s2->universitas == $value->id){
                                                echo "selected";
                                            }
                                        }
                                        echo ">" . $value->nama_universitas . "</option>";
                                    }
                                    echo "<option value='999999' >Lainnya</option>";
                                ?> 
                            </select>
                            <input type="hidden" name="status_riwayat[]" value="<?php echo  (!empty($s2->id))?$s2->id:"0" ?>">
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
                                        echo "<option value=" . $value->id . " ";
                                        if(!empty($s2->jurusan) ){
                                            if($s2->jurusan == $value->id){
                                                echo "selected";
                                            }
                                        }
                                        echo " >" . $value->nama_jurusan . "</option>";
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
                        <label class="col-sm-12 col-form-label">Universitas : </label>
                        <input type="hidden" name="jenjang[]" value="S3">
                        <div class="col-sm-10">
                             <select name="universitasid[]" class="js-example-basic-single col-sm-12" id="univ3" disabled  placeholder="--Nama Universitas--">
                                <?php
                                    //echo "<option value='0'>--Nama Universitas--</option>";
                                    foreach($master_universitas as $value){
                                        echo "<option value=" . $value->id . "  ";
                                        if(!empty($s3->universitas) ){
                                            if($s3->universitas == $value->id){
                                                echo "selected";
                                            }
                                        }
                                        echo ">" . $value->nama_universitas . "</option>";
                                    }
                                    echo "<option value='999999' >Lainnya</option>";
                                ?> 
                            </select>
                            <input type="hidden" name="status_riwayat[]" value="<?php echo  (!empty($s3->universitas))?$s3->id_pegawai:"0" ?>">
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
                                        echo "<option value=" . $value->id . " ";
                                        if(!empty($s3->jurusan) ){
                                            if($s3->jurusan == $value->id){
                                                echo "selected";
                                            }
                                        }
                                        echo " >" . $value->nama_jurusan . "</option>";
                                    }
                                    echo "<option value='999999' >Lainnya</option>";
                                ?> 
                            </select>
                            <div class="jurusan3-text">
                                <input type='hidden' class='form-control mt-3' placeholder='Nama Jurusan' name='jurusan[]'>
                            </div>
                        </div>
                        
                        <!--   -->
                        <!-- <label class="col-sm-12 col-form-label">Golongan Darah : </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="golongan_darah">
                                <?php
                                    foreach($golongan_darah as $row){
                                        echo "<option value='" . $row . "''>" . $row . "</option>";
                                    }
                                ?>
                            </select>
                        </div> -->
                        
                        <label class="col-sm-12 col-form-label">Nama Pasangan : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_pasangan" value="<?php echo  $query->nama_pasangan ?>" >
                        </div>

                        <label class="col-sm-12 col-form-label">Tgl Lahir Pasangan : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="tgl_lahir_pasangan" value="<?php echo date("m/d/Y", strtotime($query->tgl_lahir_pasangan));  ?>" id="datepicker2">
                        </div>

                        

                        <!-- <label class="col-sm-12 col-form-label">Agama : </label>
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
                            <input type="text" class="form-control" name="pekerjaan_pasangan" value="<?php echo  $query->pekerjaan_pasangan ?>" >
                        </div>
                        <label class="col-sm-12 col-form-label">Jumlah Anak : </label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="jumlah_anak" value="<?php echo  $query->jumlah_anak?>" >
                        </div>
                        <!-- <label class="col-sm-12 col-form-label">Password : </label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" value="" >
                        </div> -->
                       
                        <!-- <label class="col-sm-6 col-form-label">Upload Foto : </label>
                         <div class="col-sm-10">
                            <input type="file" class="form-control" required="" name="foto"></input><p>Maksimal 500kb </p>
                        </div> -->
						<label class="col-sm-12 col-form-label">No. KTP : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="no_ktp" value="<?php echo  $query->no_ktp ?>" >
                        </div>
                        <label class="col-sm-12 col-form-label">No. KK : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="no_kk" value="<?php echo  $query->no_kk ?>" >
                        </div>
                        <label class="col-sm-10 col-form-label">No. BPJS Kesehatan : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="no_bpjs_kesehatan" value="<?php echo  $query->no_bpjs_kesehatan ?>" >
                        </div>
                        <label class="col-sm-12 col-form-label">No. BPJS ketenagakerjaan : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="no_bpjs_ketenagakerjaan" value="<?php echo  $query->no_bpjs_ketenagakerjaan?>" >
                        </div>
                        
                    </div>
                </div>
             </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5>DATA KEPEGAWAIAN</h5>
                    <h4><?php echo $this->session->userdata('status'); 
                        $this->session->set_userdata('status','');?></h4>
                </div>
                <div class="card-block">                        
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <!-- <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="sub-title">Pendidikan Awal Kepegawaian</h4>
                                        <label class="col-sm-12 col-form-label">Jurusan : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="jurusan" value="" >
                                        </div>
                                        <label class="col-sm-12 col-form-label">Asal Sekolah : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="asal_sekolah" value="" >
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="row">
                                    <div class="col-sm-12">
                                        
                                        <h4 class="sub-title">Golongan Awal</h4>
                                        <label class="col-sm-12 col-form-label">Golongan : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="golongan_awal" value="" >
                                        </div>
                                        <label class="col-sm-12 col-form-label">No. pengantar : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="np_awal" value="" >
                                        </div>
                                        <label class="col-sm-12 col-form-label">No. SK : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nsk_awal" value="" >
                                        </div>
                                        <label class="col-sm-12 col-form-label">Tgl. SK : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="tglsk_awal" value="" >
                                        </div>
                                        <label class="col-sm-12 col-form-label">TMT : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="tmt_awal" value="" >
                                        </div>
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col-sm-12">
                                        
                                        <h4 class="sub-title">Golongan</h4>
                                        <input type="hidden" name="id_golongan" value="<?php echo  $pegawai_golongan->id?>">
                                        <label class="col-sm-12 col-form-label">Golongan : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="golongan_skrg" value="<?php echo  $pegawai_golongan->nama?>" >
                                        </div>
                                        <label class="col-sm-12 col-form-label">No. pengantar : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="np_skrg" value="<?php echo  $pegawai_golongan->no_pengantar?>" >
                                        </div>
                                        <label class="col-sm-12 col-form-label">No. SK : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nosk_skrg" value="<?php echo  $pegawai_golongan->no_sk ?>" >
                                        </div>
                                        <label class="col-sm-12 col-form-label">Tgl. SK : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="tglsk_skrg" id="tglsk_skrg" value="<?php echo date("m/d/Y", strtotime($pegawai_golongan->tanggal_sk));  ?>" >
                                        </div>
                                        <label class="col-sm-12 col-form-label">TMT : </label>
                                        <div class="col-sm-10">
                                            <input id="tmtsk_skrg" type="text" class="form-control" name="tmt_skrg" value="<?php echo date("m/d/Y", strtotime($pegawai_golongan->tmt));  ?>" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <br /><br />
                                        <h4 class="sub-title">Jabatan Fungsional</h4>
                                        <input type="hidden" name="id_jabatan_fungsional" value="<?php echo  $pegawai_jabatan_fungsional->id?>">
                                        <!-- <label class="col-sm-12 col-form-label">jenis Pegawai Awal : </label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="jenis_pegawai">
                                                <?php
                                                    foreach($jenis_pegawai as $row){
                                                        echo "<option value='" . $row->id . "''>" . $row->nama . "</option>";
                                                    }
                                                ?>  
                                            </select>
                                        </div> -->
                                        <!-- <label class="col-sm-12 col-form-label">Jabatan Fungsional Awal : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="jabatan_fungsional_awal" value="" >
                                        </div> -->
                                        <label class="col-sm-12 col-form-label">Jabatan Fungsional : </label>
                                        <div class="col-sm-10">
                                            
                                            <select class="form-control" name="jabatan_fungsional">
                                                <?php
                                                    foreach($jabatan_fungsional as $row){
                                                        echo "<option value='" . $row . "'";
                                                        if($pegawai_jabatan_fungsional->jabatan_fungsional_sekarang == $row) echo "selected";
                                                        echo ">" . $row . "</option>";
                                                    }
                                                ?>  
                                            </select>
                                        </div> 
                                        <label class="col-sm-12 col-form-label">No. SK : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nosk_fungsional" value="<?php echo  $pegawai_jabatan_fungsional->no_sk_fungsional?>" >
                                        </div> 
                                        <label class="col-sm-12 col-form-label">Tgl. SK : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="tglsk_fungsional" id="tglsk_fungsional" value="<?php echo  $pegawai_jabatan_fungsional->tgl_sk_fungsional?>" >
                                        </div>
                                        <label class="col-sm-12 col-form-label">TMT SK : </label>
                                        <div class="col-sm-10">
                                            <input type="text" id="tmtsk_fungsional" class="form-control" name="tmtsk_fungsional" value="<?php echo  $pegawai_jabatan_fungsional->tmt_sk_fungsional?>" >
                                        </div>
                                        <!-- <label class="col-sm-12 col-form-label">KUM : </label> -->
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
                                        <input type="hidden" name="id_jabatan_struktural" value="<?php echo  $pegawai_jabatan_struktural->id?>">
                                        <label class="col-sm-12 col-form-label">Unit Kerja : </label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="unit_kerja" id="unit_kerja">
                                                <option value="0">-- Unit Kerja --</option>
                                                <?php
                                                    foreach($unit_kerja as $row){
                                                        echo "<option value='" . $row->id . "' ";
                                                        if(!empty($curr_jabatan) && $row->id == $curr_jabatan->id_unit_kerja){
                                                            echo "selected";
                                                        }
                                                        echo ">" . $row->unit_kerja . "</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <label class="col-sm-12 col-form-label">Bagian : </label>
                                        <div class="col-sm-10" id="pl_bagian">
                                            <select class="form-control" name="bagian" id="bagian">
                                                <option value="0">-- Bagian --</option>
                                                <?php
                                                    foreach($bagian as $row){
                                                        echo "<option value='" . $row->id . "' ";
                                                        if(!empty($curr_jabatan) && $row->id == $curr_jabatan->id_bagian){
                                                            echo "selected";
                                                        }
                                                        echo ">" . $row->nama_bagian . "</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <label class="col-sm-12 col-form-label">Jenis Jabatan : </label>
                                        <div class="col-sm-10" id="pl_jenis_jabatan">
                                            <select class="form-control" name="jenis_jabatan" id="jenis_jabatan">
                                                <option value="0">-- Jenis Jabatan --</option>
                                                <?php
                                                    foreach($jenis_jabatan as $row){
                                                        echo "<option value='" . $row->id . "' ";
                                                        if(!empty($curr_jabatan) && $row->id == $curr_jabatan->id_jenis_jabatan){
                                                            echo "selected";
                                                        }
                                                        echo ">" . $row->nama_jenis . "</option>";
                                                        if($curr_jabatan->id_bagian != 5){
                                                            break;
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <label class="col-sm-12 col-form-label">Jabatan : </label>
                                        <div class="col-sm-10" id="pl_jabatan">
                                            <select class="form-control" name="jabatan_struktural" id="jabatan">
                                                <option value="0">-- Jabatan Struktural --</option>
                                                <?php
                                                foreach($jabatan_struktural as $jabatan){
                                                ?>
                                                <?php echo "<option value='" . $jabatan->id . "'";
                                                if(!empty($curr_jabatan) && $jabatan->id == $curr_jabatan->id){
                                                    echo "selected";
                                                }
                                                echo ">" . $jabatan->nama_jabatan . "</option>";?>
                                                 
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <label class="col-sm-12 col-form-label">No. SK : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nosk_struktural" value="<?php echo  $pegawai_jabatan_struktural->no_sk_struktural?>" >
                                        </div> 
                                        <label class="col-sm-12 col-form-label">Tgl. SK : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="tglsk_struktural" id="tglsk_struktural" value="<?php echo date("m/d/Y", strtotime($pegawai_jabatan_struktural->tanggal_sk_struktural));  ?>" >
                                        </div>
                                        <label class="col-sm-12 col-form-label">TMT SK : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="tmtsk_struktural" id="tmtsk_struktural" value="<?php echo date("m/d/Y", strtotime($pegawai_jabatan_struktural->tmt_sk_struktural));  ?>" >
                                        </div>
                                        <!-- <label class="col-sm-12 col-form-label">KUM : </label> -->
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
        </div>
    </div>
	<div class="modal fade" id="ubah_photo" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Ubah Gambar</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="POST" action="<?php echo base_url()?>simpeguser/biodata/ubah_photo" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo $query->id_pegawai?>">
						<input type="hidden" name="npp" value="<?php echo $query->npp?>">
						<label class="col-sm-12 col-form-label">File Gambar : </label>
						<div class="col-sm-10">
							<input type="file" class="form-control" name="foto" value="" >
						</div>
						<div class="col-sm-12 col-form-label">
							<input type="submit" value="Simpan">
						</div>
					</form>
				</div>
			 </div>
		</div>
	</div>
	<div class="modal fade" id="ubah_password" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Ubah Password</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="POST" action="<?php echo base_url()?>simpeguser/biodata/ubah_password" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo $query->id_pegawai?>">
						<input type="hidden" name="npp" value="<?php echo $query->npp?>">
						<label class="col-sm-12 col-form-label">Password Baru : </label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="password" value="" >
						</div>
						<div class="col-sm-12 col-form-label">
							<input type="submit" value="Simpan">
						</div>
					</form>
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
        $(".js-example-basic-single").select2();
        $('#jenis_pegawai').change(function(){
            var id=$(this).val();
            $.ajax({
                url : "<?php echo base_url();?>pegawai/get_status/",
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
		$(document.body).on("change","#provinsi",function(){
            var id=$(this).val();
            $.ajax({
                url : "<?php echo base_url();?>pmb/daftar_kotakab/",
                method : "POST",
                data : {id: id},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option value="'+ data[i].id_wil +'">'+data[i].nm_wil+'</option>';
                    }
                    $('#kotakab').html(html);
                     
                }
            });
        });
         $(document.body).on("change","#kotakab",function(){
            var id=$(this).val();
            $.ajax({
                url : "<?php echo base_url();?>pmb/daftar_kec/",
                method : "POST",
                data : {id: id},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option value="'+ data[i].id_wil +'">'+data[i].nm_wil+'</option>';
                    }
                    $('#kecamatan').html(html);
                     
                }
            });
        });
        $("#unit_kerja").change(function(){
            var id=$(this).val();
            $.ajax({
                url : "<?php echo base_url();?>pegawai/get_bagian/",
                method : "POST",
                data : "id_unit="+id,
                success: function(data){
                    $('#pl_bagian').html(data);
                }
            });
        });
        $(document).on("change","#bagian",function(){
            var id=$(this).val();
            var id_unit = $("#unit_kerja").val();
            $.ajax({
                url : "<?php echo base_url();?>pegawai/get_jenis_jabatan/",
                method : "POST",
                data : "id_bagian="+id+"&id_unit="+id_unit,
                success: function(data){
                    $('#pl_jenis_jabatan').html(data);
                }
            });
        });
        $(document).on("change","#jenis_jabatan",function(){
            var id=$(this).val();
            var id_bagian = $("#bagian").val();
            $.ajax({
                url : "<?php echo base_url();?>pegawai/get_jabatan_struktural/",
                method : "POST",
                data : "id_jenis_jabatan="+id+"&id_bagian="+id_bagian,
                success: function(data){
                    $('#pl_jabatan').html(data);
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

            var nip = status+tgl+id;
            $("#nip").val(nip);

        });
        $('#bagian').change(function(){
            var id=$(this).val();
            $.ajax({
                url : "<?php echo base_url();?>pegawai/get_jabatan/",
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
        $("#datepicker").datepicker();
        $("#datepicker2").datepicker();
        $("#tglsk_skrg").datepicker();
        $("#tglsk_fungsional").datepicker();
        $("#tglsk_struktural").datepicker();
        $("#tmtsk_skrg").datepicker();
        $("#tmtsk_fungsional").datepicker();
        $("#tmtsk_struktural").datepicker();
        <?php
        if(!empty($s2)){
            ?>
            $('#pendidikans2').prop('checked', true);
            $("#univ2").prop("disabled",false);
            $("#jurusan2").prop("disabled",false);
            
            $("#s2_id").val("<?php echo  $s2->id?>");
            <?php
        }

        if(!empty($s3)){
            ?>
            $('#pendidikans3').prop('checked', true);
            $("#univ3").prop("disabled",false);
            $("#jurusan3").prop("disabled",false);
            $("#s3_id").val("<?php echo  $s3->id?>");
            <?php
        }
        ?>
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
		<?php 
			if(!empty($query->provinsi)){
		?>
			$("#provinsi").val("<?php echo $query->provinsi?>").change();
			$("#kotakab").val("<?php echo $query->kotakab?>").change();
			$("#kecamatan").val("<?php echo $query->kecamatan?>").change();
			$("#kelurahan").val("<?php echo $query->kelurahan ?>");
		<?php
			}
		?>
    });
</script>
