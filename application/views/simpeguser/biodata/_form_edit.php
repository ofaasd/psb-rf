
    <div class="row">
        <div class="col-sm-12">
            <form action="<?php echo base_url()?>simpeguser/biodata/update" method="post" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header">
                    <h5>BIODATA PEGAWAI</h5>
                    <h4><?php echo $this->session->userdata('status'); 
                        $this->session->set_userdata('status','');?></h4>
                </div>
                <div class="card-block">
                
                <h4 class="sub-title">Biodata</h4>
                <div class="form-group row">
                    <input type="hidden" name="id_biodata" value="<?php echo  $query->id_biodata ?>">
                    <div class="col-sm-4">
                        <img src="<?php echo base_url();?>assets/foto_pegawai/<?php echo  $query->foto; ?>" width="100%"><br /><br />
                        <!-- <a href="#" style="" class="btn btn-primary">Ubah Foto</a><br /><br />
                        <a href="#" class="btn btn-success">Ubah Password</a>  -->
                        <a href="#" class="btn btn-primary waves-effect"><i class="feather icon-download"></i> Curriculum Vitae</a><br /><br />
                        <a href="#" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#ubah_photo"><i class="feather icon-image"></i> Ubah Photo</a><br /><br />
                        <a href="#" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#ubah_password"><i class="fa fa-key"></i> Ubah Password</a><br /><br />
                        
                        


                        
                    </div>      
                    <div class="col-sm-4">
                        <label class="col-sm-10 col-form-label">Nomor Induk pegawai(npp): </label>
                        <div class="col-sm-10">
                            <input type="npp" value="<?php echo  $query->npp ?>" class="form-control" id="npp" readonly>
                        </div>
                        <label class="col-sm-12 col-form-label">Jenis Pegawai : </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="jenis_pegawai" id="jenis_pegawai">
                            <option value="0">--- Pilih Jenis Pegawai --- </option>
                            <?php
                                foreach($jenis_pegawai as $row){
                                    echo "<option value='" . $row->id . "' ";
                                    if($query->id_jenis_pegawai == $row->id)echo "selected";
                                    echo ">" . $row->nama . "</option>";
                                }
                            ?>
                            </select>
                        </div>
                        <label class="col-sm-12 col-form-label"></label>
                        <div class="col-sm-10">
                            <select class="form-control" name="posisi_pegawai" id="status_pegawai">
                                <?php

                                foreach($posisi as $row){
                                    echo "<option value='" . $row->kode ."' ";
                                    if($query->kd_posisi_pegawai == $row->kode)echo "selected";
                                    echo ">" . $row->nama . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        
                        
                        <label class="col-sm-12 col-form-label">Homebase : </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="homebase">
                            <?php
                                foreach($progdi as $row){
                                    echo "<option value='" . $row->id . "''>" . $row->jenjang . " - " . $row->nama_jurusan . "</option>";
                                }
                            ?>
                            </select>
                        </div>
                        <input type="hidden" name="npp" value="<?php echo  $query->npp ?>">
                        <label class="col-sm-12 col-form-label">Nama Lengkap : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_lengkap" value="<?php echo  $query->nama_lengkap ?>" >
                        </div>
                        <label class="col-sm-10 col-form-label">Alamat Tempat Tinggal : </label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="alamat" value="" ><?php echo  $query->alamat ?></textarea>
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
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="tempat_lahir" value="<?php echo  $query->tempat_lahir?>" placeholder="Tempat Lahir">
                            </div>

                            <div class="col-sm-6">
                                <input type="text" id="datepicker" class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir" value="<?php echo  $query->tanggal_lahir ?>">
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
                        <!-- 
                        <label class="col-sm-12 col-form-label">npp PNS : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="npp_pns" value="" >
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
                        </div>
                    -->
                        <label class="col-sm-12 col-form-label">Agama : </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="agama">
                            <?php
                                foreach($agama as $row){
                                    echo "<option value='" . $row . "' ";
                                    if($row == $query->agama)echo "selected";
                                    echo ">" . $row . "</option>";
                                }
                            ?>
                            </select>
                        </div> 
                        <label class="col-sm-12 col-form-label">Email : </label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email1" value="<?php echo $query->email1?>" >
                        </div>
                        <label class="col-sm-4 col-form-label">No. Telp / Hp : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="no_telp" value="<?php echo $query->notelp?>" >
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
                    <div class="col-sm-4">

                        <label class="col-sm-12 col-form-label"><p style="margin:0"><b>Pendidikan S1</b></p></label>
                        <input type="hidden" name="s1_id" value="<?php echo  (!empty($s1->id))?$s1->id:"" ?>">
                        <label class="col-sm-12 col-form-label">Universitas : </label>
                        <input type="hidden" name="jenjang[]" value="S1">
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="universitas[]" value="<?php echo  $s1->universitas ?>" placeholder="Universitas Ex : Universitas Indonesia">
                        </div>
                        <label class="col-sm-12 col-form-label">Jurusan : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="jurusan[]" value="<?php echo  $s1->jurusan ?>" id="jurusans1" placeholder="Jurusan Ex : Teknik informatika">
                        </div>

                        <br />
                        <div class="form-check col-sm-12">
                          <input class="form-check-input" type="checkbox" value="" id="pendidikans2" style="margin-left:0; margin-top:.40rem">
                          <label class="form-check-label" for="pendidikans2">
                            <p style="margin:0"><b>Pendidikan S2</b></p>
                            <input type="hidden" name="s2_id" id="s2_id">
                          </label>
                        </div>
                        <label class="col-sm-12 col-form-label">Universitas : </label>
                        <input type="hidden" name="jenjang[]" value="S2">
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="universitas[]" value="" placeholder="Universitas Ex : Universitas Indonesia" id="universitass2" disabled>
                        </div>
                        <label class="col-sm-12 col-form-label">Jurusan : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="jurusan[]" value="" placeholder="Jurusan Ex : Teknik informatika" id="jurusans2" disabled>
                        </div>
                        <br />
                        <div class="form-check col-sm-12">
                          <input class="form-check-input" type="checkbox" value="" id="pendidikans3" style="margin-left:0; margin-top:.40rem">
                          <label class="form-check-label" for="pendidikans3">
                            <p style="margin:0"><b>Pendidikan S3</b></p>
                            <input type="hidden" name="s3_id" id="s3_id">
                          </label>
                        </div>
                        <label class="col-sm-12 col-form-label">Universitas : </label>
                        <input type="hidden" name="jenjang[]" value="S3">
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="universitas" value="" placeholder="Universitas Ex : Universitas Indonesia" id="universitass3" disabled>
                        </div>
                        <label class="col-sm-12 col-form-label">Jurusan : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="universitas" value="" placeholder="Jurusan Ex : Teknik informatika" id="jurusans3" disabled>
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
                            <input type="text" class="form-control" name="tgl_lahir_pasangan" value="<?php echo  $query->tgl_lahir_pasangan ?>" id="datepicker2">
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
                                            <input type="text" class="form-control" name="tglsk_skrg" id="tglsk_skrg" value="<?php echo  $pegawai_golongan->tanggal_sk?>" >
                                        </div>
                                        <label class="col-sm-12 col-form-label">TMT : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="tmt_skrg" value="<?php echo  $pegawai_golongan->tmt ?>" >
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
                                            <input type="text" class="form-control" name="tmtsk_fungsional" value="<?php echo  $pegawai_jabatan_fungsional->tmt_sk_fungsional?>" >
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
                                            <select class="form-control" name="unit_kerja">
                                                <?php
                                                    foreach($fakultas as $row){
                                                        echo "<option value='" . $row->id . "' ";
                                                        if($row->id == $pegawai_jabatan_struktural->unit_kerja){
                                                            echo "selected";
                                                        }
                                                        echo ">FAKULTAS " . $row->nama_fakultas . "</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <label class="col-sm-12 col-form-label">Bagian : </label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="bagian" id="bagian">
                                                <option value="0">-- Bagian --</option>
                                                <?php
                                                    foreach($bagian as $row){
                                                        echo "<option value='" . $row->bagian . "' ";
                                                        if($row->bagian == $jabatan_struktural->bagian){
                                                            echo "selected";
                                                        }
                                                        echo ">" . $row->bagian . "</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <label class="col-sm-12 col-form-label">Jabatan Struktural : </label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="jabatan_struktural" id="jabatan">
                                                <option value="0">-- Jabatan Struktural --</option>
                                                <?php
                                                foreach($jabatan_struktural_list as $jabatan){
                                                ?>
                                                <?php echo "<option value='" . $jabatan->id . "'";
                                                if($jabatan->jabatan == $jabatan_struktural->jabatan){
                                                    echo "selected";
                                                }
                                                echo ">" . $jabatan->jabatan . "</option>";?>
                                                 
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
                                            <input type="text" class="form-control" name="tglsk_struktural" id="tglsk_struktural" value="<?php echo  $pegawai_jabatan_struktural->tanggal_sk_struktural?>" >
                                        </div>
                                        <label class="col-sm-12 col-form-label">TMT SK : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="tmtsk_struktural" value="<?php echo  $pegawai_jabatan_struktural->tmt_sk_struktural?>" >
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
            <div class="modal fade" id="ubah_npp" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Ubah npp</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="<?php echo base_url()?>simpeguser/biodata/ubah_npp" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $query->id_pegawai?>">
                                
                                <label class="col-sm-12 col-form-label">npp Baru : </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="npp" value="<?php echo  $query->npp ?>">
                                </div>
                                <div class="col-sm-12 col-form-label">
                                    <input type="submit" value="Simpan">
                                </div>
                            </form>
                        </div>
                     </div>
                </div>
            </div>
          </div>
        </div>
    </div>
<script type="text/javascript">
    
    $(document).ready(function(){
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

            var npp = status+tgl+id;
            //$("#npp").val(npp);

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
        $("#pendidikans2").change(function(){
            if($(this).is(":checked")){
                $("#universitass2").prop("disabled",false);
                $("#jurusans2").prop("disabled",false);
            }else{
                $("#universitass2").prop("disabled",true);
                $("#jurusans2").prop("disabled",true);
            }
        });

        <?php
        if(!empty($s2)){
            ?>
            $('#pendidikans2').prop('checked', true);
            $("#universitass2").prop("disabled",false);
            $("#jurusans2").prop("disabled",false);
            $("#universitass2").val("<?php echo  $s2->universitas ?>");
            $("#jurusans2").val("<?php echo  $s2->jurusan ?>");
            $("#s2_id").val("<?php echo  $s2->id?>");
            <?php
        }

        if(!empty($s3)){
            ?>
            $('#pendidikans3').prop('checked', true);
            $("#universitass3").prop("disabled",false);
            $("#jurusans3").prop("disabled",false);
            $("#s3_id").val("<?php echo  $s3->id?>");
            <?php
        }
        ?>
        $("#pendidikans3").change(function(){
            if($(this).is(":checked")){
                $("#universitass3").prop("disabled",false);
                $("#jurusans3").prop("disabled",false);
            }else{
                $("#universitass3").prop("disabled",true);
                $("#jurusans3").prop("disabled",true);
            }
        });
    });
</script>
