<style>
    .input-group-prepend{
        background:#ecf0f1;
        padding:5px;
    }
    .wizard .content {
	    min-height: 100px;
	}
	.wizard .content > .body {
	    width: 100%;
	    height: auto;
	    padding: 15px;
	    position: relative;
	}
</style>
<div class="card-block">
	<div class="row">
		<div class="col-md-12">
			<div id="wizard">
				<section>
					<form class="wizard-form" id="create-pegawai" action="#">
						<h3> Registration </h3>
						<fieldset>
							<label class="col-sm-12 col-form-label">Jenis Pegawai : </label>
	                        <div class="col-sm-12">
	                            <select class="form-control" name="jenis_pegawai" id="jenis_pegawai" required>
	                            <option value="0">--- Pilih Jenis Pegawai --- </option>
	                            <?php
	                                foreach($jenis_pegawai as $row){
	                                    echo "<option value='" . $row->id . "''>" . $row->nama . "</option>";
	                                }
	                            ?>
	                            </select>
	                        </div>
	                        <label class="col-sm-4 col-form-label"></label>
	                        <div class="col-sm-12">
	                            <select class="form-control" name="posisi_pegawai" id="status_pegawai" required>
	                                
	                            </select>
	                        </div>
	                        <label class="col-sm-12 col-form-label">Nomor Induk pegawai(NIP): </label>
	                        <div class="col-sm-12">
	                            <input type="hidden" class="form-control" name="nip" id="initial_npp" value=""> 
	                            <div class="input-group">
	                                <input type="text" name="npp" class="form-control" placeholder="cth : 060710112" id="nip" aria-describedby="inputGroupPrepend" required>
	                            </div>
	                        </div>
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
	                        <div class="col-sm-12">
	                            <input type="text" id="nama_lengkap" class="form-control" name="nama_lengkap" value="" required>
	                        </div>
	                        
	                        <label class="col-sm-4 col-form-label">Jenis Kelamin : </label>
	                        <div class="col-sm-12">
	                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" >
	                                <?php
	                                    foreach($jenis_kelamin as $key=>$row){
	                                        echo "<option value='" . $key . "''>" . $row . "</option>";
	                                    }
	                                ?>
	                            </select>
	                        </div>
	                        <label class="col-sm-4 col-form-label">Password : </label>
	                        <div class="col-sm-12">
	                            <input type="password" class="form-control" name="password" id="password" required>
	                        </div>
	                        <br />

	                        <!-- <div class="col-sm-2 col-right" style="float:right">
	                        	<a href="#" class="form-control btn btn-primary" id="simpan">Simpan</a>
	                        </div> -->
						</fieldset>
						<h3> General information </h3>
						<fieldset>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Gelar Depan : </label>
		                        <div class="col-sm-5">
		                            <input type="text" class="form-control" name="gelar_depan" value="" placeholder="Ex: Dr., Ir.,">
		                        </div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Gelar Belakang : </label>
		                        <div class="col-sm-5">
		                            <input type="text" class="form-control" name="gelar_belakang" value="" placeholder="Ex: S.ked, S.Farm, M.Farm">
		                        </div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">NIDN : </label>
		                        <div class="col-sm-10">
		                            <input type="text" class="form-control" name="nidn" value="" >
		                        </div>
							</div>
							<div class="form-group row">
								<label class="col-sm-10 col-form-label">Alamat Tempat Tinggal : </label>
		                        <div class="col-sm-10">
		                            <textarea class="form-control" name="alamat" value="" id="alamat" required></textarea>
		                        </div>
		                    </div>
		                    <div class="form-group row">
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
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-sm-10 col-form-label">Nama Kota/Kabupaten :</label>
	                            <div class="col-sm-10">
		                            <p>
		                                <select name="kotakab" id="kotakab" class="form-control" required=""> 
		                                    <option selected="" disabled="">Pilih Kota/Kabupaten</option>
		                                </select>
		                            </p>
		                        </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-sm-10 col-form-label">Nama Kecamatan :</label>
	                            <div class="col-sm-10">
		                            <p>
		                                <select name="kecamatan" id="kecamatan" class="form-control" required="">
		                                    <option selected="" disabled="">Daftar Kecamatan</option>
		                                </select>
		                            </p>
		                        </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-sm-10 col-form-label">Nama Kelurahan :</label>
	                            <div class="col-sm-10">
	                            	<p><input type="text" class="form-control" placeholder="Nama Kelurahan" oninput="this.className = ''" name="kelurahan" required=""></p>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-sm-10 col-form-label">Golongan Darah :</label>
	                            <div class="col-sm-10">
	                            	<select name="golongan_darah" id="goldar" class="form-control">
		                                    <option selected="" disabled="">Pilih Golongan Darah</option>
		                                    <?php 
		                                    	$golongan = array("A","B","AB","O");
		                                    	foreach($golongan as $value){?>
		                                    	<option value="<?php echo $value ?>"><?php echo $value ?></option>
		                                    <?php } ?>
	                                </select>
	                            </div>
	                        </div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">No. KTP : </label>
		                        <div class="col-sm-10">
		                            <input type="text" class="form-control" name="no_ktp" value="" >
		                        </div>
							</div>

							<div class="form-group row">
								<label class="col-sm-4 col-form-label">No. KK : </label>
		                        <div class="col-sm-10">
		                            <input type="text" class="form-control" name="no_kk" value="" >
		                        </div>
							</div>
							<div class="form-group row">
								<label class="col-sm-10 col-form-label">No. BPJS Kesehatan : </label>
		                        <div class="col-sm-10">
		                            <input type="text" class="form-control" name="no_bpjs_kesehatan" value="" >
		                        </div>
							</div>
							<div class="form-group row">
								<label class="col-sm-12 col-form-label">No. BPJS ketenagakerjaan : </label>
		                        <div class="col-sm-10">
		                            <input type="text" class="form-control" name="no_bpjs_ketenagakerjaan" value="" >
		                        </div>
							</div>
							<div class="form-group row">
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
		                    </div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Status Perkawinan : </label>
		                        <div class="col-sm-10">
		                            <select class="form-control" name="status_nikah" id="status_nikah">
		                                <?php
		                                    foreach($status_kawin as $row){
		                                        echo "<option value='" . $row . "''>" . $row . "</option>";
		                                    }
		                                ?>
		                            </select>
		                        </div>
							</div>
							<div id="detail_status">
								<div class="menikah">
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Nama Pasangan : </label>
				                        <div class="col-sm-10">
				                            <input type="text" class="form-control" name="nama_pasangan" value="" >
				                        </div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Tgl Lahir Pasangan : </label>
				                        <div class="col-sm-10">
				                            <input type="text" class="form-control" name="tgl_lahir_pasangan" value="" id="datepicker2">
				                        </div>

									</div>
									<div class="form-group row">
										<label class="col-sm-8 col-form-label">Pekerjaan Pasangan : </label>
				                        <div class="col-sm-10">
				                            <input type="text" class="form-control" name="pekerjaan_pasangan" value="" >
				                        </div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Jumlah Anak : </label>
				                        <div class="col-sm-4">
				                            <input type="number" class="form-control" name="jumlah_anak" value="" >
				                        </div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Nama Pasangan : </label>
				                        <div class="col-sm-10">
				                            <input type="text" class="form-control" name="nama_pasangan" value="" >
				                        </div>
									</div>
								</div>
							</div>
						</fieldset>
						<h3> Education </h3>
						<fieldset>
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
						</fieldset>
						<h3> Work experience </h3>
						<fieldset>
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
				                                            <input type="date" class="form-control" name="tglsk_skrg" id="tglsk_skrg" value="" >
				                                        </div>
				                                        <label class="col-sm-4 col-form-label">TMT : </label>
				                                        <div class="col-sm-10">
				                                            <input type="date" class="form-control" name="tmt_skrg" value="" >
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
				                                            <input type="date" class="form-control" name="tglsk_fungsional" id="tglsk_fungsional" value="" >
				                                        </div>
				                                        <label class="col-sm-4 col-form-label">TMT SK : </label>
				                                        <div class="col-sm-10">
				                                            <input type="date" class="form-control" name="tmtsk_fungsional" value="" >
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
				                                            <input type="date" class="form-control" name="tglsk_struktural" id="tglsk_struktural" value="" >
				                                        </div>
				                                        <label class="col-sm-4 col-form-label">TMT SK : </label>
				                                        <div class="col-sm-10">
				                                            <input type="date" class="form-control" name="tmtsk_struktural" value="" >
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
						</fieldset>
					</form>
				</section>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).on("change","#univ1",function(){
        universitas("univ1");
    });
    $(document).on("change","#univ2",function(){
        universitas("univ2");
    });
    $(document).on("change","#univ3",function(){
        universitas("univ3");
    });
    $(document).on("change","#jurusan1",function(){
        universitas("jurusan1");
    });
    $(document).on("change","#jurusan2",function(){
        universitas("jurusan2");
    });
    $(document).on("change","#jurusan3",function(){
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
        $(document.body).on("change","#jenis_pegawai",function(){
            var id=$("#jenis_pegawai").val();
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
        
        $(document.body).on("click","#simpan",function(){
        	var nama_lengkap = $("#nama_lengkap").val();
	        var posisi_pegawai= $("#status_pegawai").val();
	        var npp = $("#initial_npp").val()+$("#nip").val();
	        var id_progdi = $("#homebase_select").val();
	        var jenis_kelamin = $("#jenis_kelamin").val();
	        var password = $("#password").val();
	        if(!nama_lengkap || !posisi_pegawai || !npp || !id_progdi || !alamat || !jenis_kelamin || !password ){
	        	alert("harap isi semua form");
	        }else{
	        	$.ajax({
	                url : "<?php echo $url_simple_insert ?>",
	                method : "POST",
	                data : "nama_lengkap="+nama_lengkap+"&posisi_pegawai="+posisi_pegawai+"&npp="+npp+"&id_progdi="+id_progdi+"&alamat="+alamat+"&jenis_kelamin="+jenis_kelamin+"&password="+password,
	                success: function(data){
	                    //alert("data berhasil disimpan");
	                    window.location.href="<?php echo $redirect1 ?>"+npp;
	                }
	            });
            }
        });
        $(document.body).on("change","#status_pegawai",function(){
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
            var id = (parseInt(<?php echo $last_id ?>)+1);
            id = id.toString();

            if(id.length === 1){
                id = "00" + id;
            }else if(id.length === 2){
                id = "0" + id;
            }else{
                id = id;
            }

            var initial_npp = status+tgl;
            var nip = id;
            // $("#initial_npp").val(initial_npp);
            // $("#nip").val(nip);

            $.ajax({
                url : "<?php echo base_url();?>pegawai/get_homebase/",
                method : "POST",
                data : {bagian: id},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = "";
                    html += '<label class="col-sm-4 col-form-label">Homebase : </label><div class="col-sm-12">';
                    html += '<select name="homebase" id="homebase_select" class="form-control" required>';
                    html += '<option value="0">-- Homebase -- </option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value="'+ data[i].id +'">'+data[i].nama_jurusan+'</option>';
                    }
                    html += '</select></div>';
                    $('#homebase').html(html);
                }
            });
        });
        $(document.body).on('change', '#bagian', function(){
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
        $(document.body).on("change","#pendidikans2",function(){
            if($(this).is(":checked")){
                $("#univ2").prop("disabled",false);
                $("#jurusan2").prop("disabled",false);
            }else{
                $("#univ2").prop("disabled",true);
                $("#jurusan2").prop("disabled",true);
            }
        });

        $(document.body).on("change","#pendidikans3",function(){
            if($(this).is(":checked")){
                $("#univ3").prop("disabled",false);
                $("#jurusan3").prop("disabled",false);
            }else{
                $("#univ3").prop("disabled",true);
                $("#jurusan3").prop("disabled",true);
            }
        });	
    });
	$("#detail_status").css({"display":"none"});
	$(document.body).on("change","#status_nikah",function(){
		if($(this).val() == "Lajang"){
			$("#detail_status").css({"display":"none"});
		}else{
			$("#detail_status").css({"display":"block"});
		}
	});
	$(document).ready(function() {

	    function adjustIframeHeight() {
	        var $body   = $('body'),
	            $iframe = $body.data('iframe.fv');
	        if ($iframe) {
	            // Adjust the height of iframe
	            $iframe.height($body.height());
	        }
	    }
	    var form = $("#create-pegawai").show();

		form.steps({
		  headerTag: "h3",
		  bodyTag: "fieldset",
		  transitionEffect: "slideLeft",
		  onStepChanging: function(event, currentIndex, newIndex) {

		      // Allways allow previous action even if the current form is not valid!
		      if (currentIndex > newIndex) {
		          return true;
		      }
		      // Forbid next action on "Warning" step if the user is to young
		      if (newIndex === 3 && Number($("#age-2").val()) < 18) {
		          return false;
		      }
		      // Needed in some cases if the user went back (clean up)
		      if (currentIndex < newIndex) {
		          // To remove error styles
		          form.find(".body:eq(" + newIndex + ") label.error").remove();
		          form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
		      }
		      form.validate().settings.ignore = ":disabled,:hidden";
		      return form.valid();
		  },
		  onStepChanged: function(event, currentIndex, priorIndex) {

		      // Used to skip the "Warning" step if the user is old enough.
		      if (currentIndex === 2 && Number($("#age-2").val()) >= 18) {
		          form.steps("next");
		      }
		      // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
		      if (currentIndex === 2 && priorIndex === 3) {
		          form.steps("previous");
		      }
		  },
		  onFinishing: function(event, currentIndex) {

		      form.validate().settings.ignore = ":disabled";
		      return form.valid();
		  },
		  onFinished: function(event, currentIndex) {
		  		var npp = $("#initial_npp").val()+$("#nip").val();
		  		$.ajax({
	                url : "<?php echo $url_insert_all ?>",
	                method : "POST",
	                data : form.serialize(),
	                success: function(data){
	                    //alert("data berhasil disimpan");
	                    if(data == "berhasil"){
	                    	window.location.href="<?php echo $redirect1 ?>"+npp;
	                    }else{
	                    	window.location.href="<?php echo $redirect1 ?>"+npp;
	                    }
	                }
	            });
		  }
		}).validate({
		  errorPlacement: function errorPlacement(error, element) {

		      element.before(error);
		  },
		  rules: {
		      confirm: {
		          equalTo: "#password-2"
		      }
		  }
		});
	});
</script>
