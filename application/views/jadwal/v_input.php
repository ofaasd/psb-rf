<style type="text/css">
        /*body {font-family: Arial, Helvetica, sans-serif;}*/

        /* The Modal (background) */
        .modal {
          display: none; /* Hidden by default */
          position: fixed; /* Stay in place */
          z-index: 1; /* Sit on top */
          padding-top: 100px; /* Location of the box */
          left: 120px;
          top: 0;
          width: 100%; /* Full width */
          height: 100%; /* Full height */
          overflow: auto; /* Enable scroll if needed */
          background-color: rgb(0,0,0); /* Fallback color */
          background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
          background-color: #fefefe;
          margin: auto;
          padding: 25px;
          border: 1px solid #888;
          width: 30%;
        }

        /* The Close Button */
        .close {
          color: #aaaaaa;
          float: right;
          font-size: 28px;
          font-weight: bold;
        }

        .close:hover,
        .close:focus {
          color: #000;
          text-decoration: none;
          cursor: pointer;
        }
    </style>
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <?php 
                    echo $this->session->userdata('jadwal_input');  
                    $this->session->set_userdata('jadwal_input','');
                          ?>
                    <a href="<?php echo base_url()?>master/jadwal/" class="btn btn-success btn-round"><font style="color: white;">KEMBALI HOME JADWAL</font></a><hr>
                    <h5>NAMA MATA KULIAH : (<?php echo $this->session->userdata('kode_matkul'); ?>)<?php echo $this->session->userdata('nama_matkul'); ?></h5>
                    <br><b><font style="color:red;"><?php 
								 if(!empty($this->session->userdata('jadwal_bentrok'))){
                                    echo $this->session->userdata('jadwal_bentrok');
                                    $this->session->set_userdata('jadwal_bentrok', '');
									// foreach($this->session->userdata('jadwal_bentrok') as $value){
									// 	echo $value . "<br />";
									// }
								} 
								// echo $this->session->userdata('jadwal_bentrok');

								?></font></b>
                    </div>
                <div class="card-block">
                <form method="post" action="<?php 
												if($a->id == ""){
													echo base_url()."master/jadwal/input_act";
												}else{
													echo base_url()."master/jadwal/update_act_new";
												}
											?>">
                    <input name="kode" value="<?php echo $this->session->userdata('kode_matkul'); ?>" hidden="">
                    <?php
                        $ta = $this->db->query("SELECT * FROM `master_tahun_ajaran` where is_aktif = 1")->row()->id;
                        $cek_jml_jadwal = $this->db->get_where('master_jadwal_temp', array('kode_mata_kuliah' => $this->session->userdata('kode_matkul'), 'id_tahun' => $ta))->num_rows();
                        if ($cek_jml_jadwal > 0) {
                    ?>
                        <a href="<?php echo base_url('master/jadwal/edit/'.$this->session->userdata('kode_matkul')); ?>" class="btn btn-success">Edit Jadwal</a>
                <?php } ?>
                    <table width="100%">
						<tr>
							<td colspan="10">
								<p><strong>Kelas Reguler</strong></p>
							</td>
						</tr>
                        <tr>
                            <td style="margin-bottom: 10px; width:120px;">
                                <label>Rombel:</label>
                                <select name="rombel[]" class="form-control">
                                    
                                    <?php 
										$i = 1;
										foreach($rombel as $r){
									?>
                                        <option value="<?php echo $r->rombel; ?>" <?php echo ($i==1)?"selected":""?>><?php echo $r->rombel; ?></option>
                                    <?php $i++; } ?>
                                </select>
                            </td>
                            <td>
                                <input name="id_jadwal[]" value="<?php echo $a->id ?>" hidden="">
                                <label>Dosen:</label>
                                <select name="dosen[]" class="form-control"  >
                                    <option value="<?php echo $a->id_dosen; ?>" selected=""><?php echo $a->dosen; ?></option>
                                    <?php foreach($dosen_1 as $dosen){?>
                                        <option value="<?php echo $dosen->id; ?>"><?php echo $dosen->nama_pegawai; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <label>Hari:</label>
                                <select name="hari[]" class="form-control"  >
                                    <option value="<?php echo $a->hari; ?>" selected=""><?php echo $a->hari; ?></option>
                                    <?php foreach($hari_1 as $hari){?>
                                        <option value="<?php echo $hari->nama_hari; ?>"><?php echo $hari->nama_hari; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <label>Sesi:</label>
                                <select name="sesi[]" class="form-control"  >
                                    <option value="<?php echo $a->sesi; ?>" selected=""><?php echo $a->sesi; ?></option>
                                    <?php foreach($sesi_1 as $sesi){?>
                                        <option value="<?php echo $sesi->nama_sesi; ?>"><?php echo $sesi->nama_sesi; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <label>Ruang:</label>
                                <select name="ruang[]" class="form-control"  >
                                    <option value="<?php echo $a->ruang; ?>" selected=""><?php echo $a->ruang; ?></option>
                                    <?php foreach($ruang_1 as $ruang){?>
                                        <option value="<?php echo $ruang->nama_ruang; ?>"><?php echo $ruang->nama_ruang; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <label>Kelas:</label>
                                <select name="kelas[]" class="form-control"  >
                                    <option value="1">Reguler</option>
                                </select>
                            </td>
                            <td>
                                <label>Status:</label>
                                <select name="status[]" class="form-control"  >
                                    <option value="<?php echo $a->status; ?>" selected=""><?php if($a->status == 1){ echo "BUKA";}else if($a->status == 0){ echo "TUTUP";}else{ echo $a->status; } ?></option>
                                    <option value='1'>BUKA</option>
                                    <option value='0'>TUTUP</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="margin-bottom: 10px;">
                                <label>Rombel:</label>
                                <select name="rombel[]" class="form-control">
                                    <?php 
										$i = 1;
										foreach($rombel as $r){
									?>
                                        <option value="<?php echo $r->rombel; ?>" <?php echo ($i==2)?"selected":""?>><?php echo $r->rombel; ?></option>
                                    <?php $i++; } ?>
                                </select>
                            </td>
                            <td style="margin-bottom: 10px;">
                                <input name="id_jadwal[]" value="<?php echo $b->id ?>" hidden="">
                                <label>Dosen:</label>
                                <select name="dosen[]" class="form-control"  >
                                    <option value="<?php echo $b->id_dosen; ?>" selected=""><?php echo $b->dosen; ?></option>
                                    <?php foreach($dosen_1 as $dosen){?>
                                        <option value="<?php echo $dosen->id; ?>"><?php echo $dosen->nama_pegawai; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td style="margin-bottom: 10px;">
                                <label>Hari:</label>
                                <select name="hari[]" class="form-control"  >
                                    <option value="<?php echo $b->hari; ?>" selected=""><?php echo $b->hari; ?></option>
                                    <?php foreach($hari_1 as $hari){?>
                                        <option value="<?php echo $hari->nama_hari; ?>"><?php echo $hari->nama_hari; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td style="margin-bottom: 10px;">
                                <label>Sesi:</label>
                                <select name="sesi[]" class="form-control"  >
                                    <option value="<?php echo $b->sesi; ?>" selected=""><?php echo $b->sesi; ?></option>
                                    <?php foreach($sesi_1 as $sesi){?>
                                        <option value="<?php echo $sesi->nama_sesi; ?>"><?php echo $sesi->nama_sesi; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td style="margin-bottom: 10px;">
                                <label>Ruang:</label>
                                <select name="ruang[]" class="form-control"  >
                                    <option value="<?php echo $b->ruang; ?>" selected=""><?php echo $b->ruang; ?></option>
                                    <?php foreach($ruang_1 as $ruang){?>
                                        <option value="<?php echo $ruang->nama_ruang; ?>"><?php echo $ruang->nama_ruang; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td style="margin-bottom: 10px;">
                                <label>Kelas:</label>
                                <select name="kelas[]" class="form-control"  >
                                    <option value="1">Reguler</option>
                                </select>
                            </td>
                            <td style="margin-bottom: 10px;">
                                <label>Status:</label>
                                <select name="status[]" class="form-control"  >
                                    <option value="<?php echo $b->status; ?>" selected=""><?php if($b->status == 1){ echo "BUKA";}else if($b->status == 0){ echo "TUTUP";}else{ echo $b->status; } ?></option>
                                    <option value='1'>BUKA</option>
                                    <option value='0'>TUTUP</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="margin-bottom: 10px;">
                                <label>Rombel:</label>
                                <select name="rombel[]" class="form-control" >
                                    <?php 
										$i = 1;
										foreach($rombel as $r){
									?>
                                        <option value="<?php echo $r->rombel; ?>" <?php echo ($i==3)?"selected":""?>><?php echo $r->rombel; ?></option>
                                    <?php $i++; } ?>
                                </select>
                            </td>
                            <td>
                                <input name="id_jadwal[]" value="<?php echo $c->id ?>" hidden="">
                                <label>Dosen:</label>
                                <select name="dosen[]" class="form-control"  >
                                    <option value="<?php echo $c->id_dosen; ?>" selected=""><?php echo $c->dosen; ?></option>
                                    <?php foreach($dosen_1 as $dosen){?>
                                        <option value="<?php echo $dosen->id; ?>"><?php echo $dosen->nama_pegawai; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <label>Hari:</label>
                                <select name="hari[]" class="form-control"  >
                                    <option value="<?php echo $c->hari; ?>" selected=""><?php echo $c->hari; ?></option>
                                    <?php foreach($hari_1 as $hari){?>
                                        <option value="<?php echo $hari->nama_hari; ?>"><?php echo $hari->nama_hari; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <label>Sesi:</label>
                                <select name="sesi[]" class="form-control"  >
                                    <option value="<?php echo $c->sesi; ?>" selected=""><?php echo $c->sesi; ?></option>
                                    <?php foreach($sesi_1 as $sesi){?>
                                        <option value="<?php echo $sesi->nama_sesi; ?>"><?php echo $sesi->nama_sesi; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <label>Ruang:</label>
                                <select name="ruang[]" class="form-control"  >
                                    <option value="<?php echo $c->ruang; ?>" selected=""><?php echo $c->ruang; ?></option>
                                    <?php foreach($ruang_1 as $ruang){?>
                                        <option value="<?php echo $ruang->nama_ruang; ?>"><?php echo $ruang->nama_ruang; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <label>Kelas:</label>
                                <select name="kelas[]" class="form-control"  >
                                    <option value="1">Reguler</option>
                                </select>
                            </td>
                            <td>
                                <label>Status:</label>
                                <select name="status[]" class="form-control"  >
                                    <option value="<?php echo $c->status; ?>" selected=""><?php if($c->status == 1){ echo "BUKA";}else if($c->status == 0){ echo "TUTUP";}else{ echo $c->status; } ?></option>
                                    <option value='1'>BUKA</option>
                                    <option value='0'>TUTUP</option>
                                </select>
                            </td>
                        </tr>
						<tr>
							<td colspan="10">
								<p><strong>Kelas Karyawan</strong></p>
							</td>
						</tr>
						<tr>
                            <td style="margin-bottom: 10px;">
                                <label>Rombel:</label>
                                <select name="rombel[]" class="form-control" >
                                    <?php 
										$i = 1;
										foreach($rombel as $r){
									?>
                                        <option value="<?php echo $r->rombel; ?>" <?php echo ($i==1)?"selected":""?>><?php echo $r->rombel; ?></option>
                                    <?php $i++; } ?>
                                </select>
                            </td>
                            <td>
                                <input name="id_jadwal[]" value="<?php echo $d->id ?>" hidden="">
                                <label>Dosen:</label>
                                <select name="dosen[]" class="form-control"  >
                                    <option value="<?php echo $d->id_dosen; ?>" selected=""><?php echo $d->dosen; ?></option>
                                    <?php foreach($dosen_1 as $dosen){?>
                                        <option value="<?php echo $dosen->id; ?>"><?php echo $dosen->nama_pegawai; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <label>Hari:</label>
                                <select name="hari[]" class="form-control"  >
                                    <option value="<?php echo $d->hari; ?>" selected=""><?php echo $d->hari; ?></option>
                                    <?php foreach($hari_1 as $hari){?>
                                        <option value="<?php echo $hari->nama_hari; ?>"><?php echo $hari->nama_hari; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <label>Sesi:</label>
                                <select name="sesi[]" class="form-control"  >
                                    <option value="<?php echo $d->sesi; ?>" selected=""><?php echo $d->sesi; ?></option>
                                    <?php foreach($sesi_1 as $sesi){?>
                                        <option value="<?php echo $sesi->nama_sesi; ?>"><?php echo $sesi->nama_sesi; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <label>Ruang:</label>
                                <select name="ruang[]" class="form-control"  >
                                    <option value="<?php echo $d->ruang; ?>" selected=""><?php echo $d->ruang; ?></option>
                                    <?php foreach($ruang_1 as $ruang){?>
                                        <option value="<?php echo $ruang->nama_ruang; ?>"><?php echo $ruang->nama_ruang; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <label>Kelas:</label>
                                <select name="kelas[]" class="form-control"  >
                                    <option value="2">Karyawan</option>
                                </select>
                            </td>
                            <td>
                                <label>Status:</label>
                                <select name="status[]" class="form-control"  >
                                    <option value="<?php echo $d->status; ?>" selected=""><?php if($d->status == 1){ echo "BUKA";}else if($d->status == 0){ echo "TUTUP";}else{ echo $d->status; } ?></option>
                                    <option value='1'>BUKA</option>
                                    <option value='0'>TUTUP</option>
                                </select>
                            </td>
                        </tr>
						<tr>
                            <td style="margin-bottom: 10px;">
                                <label>Rombel:</label>
                                <select name="rombel[]" class="form-control" >
                                    <?php 
										$i = 1;
										foreach($rombel as $r){
									?>
                                        <option value="<?php echo $r->rombel; ?>" <?php echo ($i==2)?"selected":""?>><?php echo $r->rombel; ?></option>
                                    <?php $i++; } ?>
                                </select>
                            </td>
                            <td>
                                <input name="id_jadwal[]" value="<?php echo $e->id ?>" hidden="">
                                <label>Dosen:</label>
                                <select name="dosen[]" class="form-control"  >
                                    <option value="<?php echo $e->id_dosen; ?>" selected=""><?php echo $e->dosen; ?></option>
                                    <?php foreach($dosen_1 as $dosen){?>
                                        <option value="<?php echo $dosen->id; ?>"><?php echo $dosen->nama_pegawai; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <label>Hari:</label>
                                <select name="hari[]" class="form-control"  >
                                    <option value="<?php echo $e->hari; ?>" selected=""><?php echo $e->hari; ?></option>
                                    <?php foreach($hari_1 as $hari){?>
                                        <option value="<?php echo $hari->nama_hari; ?>"><?php echo $hari->nama_hari; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <label>Sesi:</label>
                                <select name="sesi[]" class="form-control"  >
                                    <option value="<?php echo $e->sesi; ?>" selected=""><?php echo $e->sesi; ?></option>
                                    <?php foreach($sesi_1 as $sesi){?>
                                        <option value="<?php echo $sesi->nama_sesi; ?>"><?php echo $sesi->nama_sesi; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <label>Ruang:</label>
                                <select name="ruang[]" class="form-control"  >
                                    <option value="<?php echo $e->ruang; ?>" selected=""><?php echo $e->ruang; ?></option>
                                    <?php foreach($ruang_1 as $ruang){?>
                                        <option value="<?php echo $ruang->nama_ruang; ?>"><?php echo $ruang->nama_ruang; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <label>Kelas:</label>
                                <select name="kelas[]" class="form-control"  >
                                    <option value="2">Karyawan</option>
                                </select>
                            </td>
                            <td>
                                <label>Status:</label>
                                <select name="status[]" class="form-control"  >
                                    <option value="<?php echo $e->status; ?>" selected=""><?php if($e->status == 1){ echo "BUKA";}else if($e->status == 0){ echo "TUTUP";}else{ echo $e->status; } ?></option>
                                    <option value='1'>BUKA</option>
                                    <option value='0'>TUTUP</option>
                                </select>
                            </td>
                        </tr>
						<tr>
                            <td style="margin-bottom: 10px;">
                                <label>Rombel:</label>
                                <select name="rombel[]" class="form-control" >
                                    <?php 
										$i = 1;
										foreach($rombel as $r){
									?>
                                        <option value="<?php echo $r->rombel; ?>" <?php echo ($i==3)?"selected":""?>><?php echo $r->rombel; ?></option>
                                    <?php $i++; } ?>
                                </select>
                            </td>
                            <td>
                                <input name="id_jadwal[]" value="<?php echo $f->id ?>" hidden="">
                                <label>Dosen:</label>
                                <select name="dosen[]" class="form-control"  >
                                    <option value="<?php echo $f->id_dosen; ?>" selected=""><?php echo $f->dosen; ?></option>
                                    <?php foreach($dosen_1 as $dosen){?>
                                        <option value="<?php echo $dosen->id; ?>"><?php echo $dosen->nama_pegawai; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <label>Hari:</label>
                                <select name="hari[]" class="form-control"  >
                                    <option value="<?php echo $f->hari; ?>" selected=""><?php echo $f->hari; ?></option>
                                    <?php foreach($hari_1 as $hari){?>
                                        <option value="<?php echo $hari->nama_hari; ?>"><?php echo $hari->nama_hari; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <label>Sesi:</label>
                                <select name="sesi[]" class="form-control"  >
                                    <option value="<?php echo $f->sesi; ?>" selected=""><?php echo $f->sesi; ?></option>
                                    <?php foreach($sesi_1 as $sesi){?>
                                        <option value="<?php echo $sesi->nama_sesi; ?>"><?php echo $sesi->nama_sesi; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <label>Ruang:</label>
                                <select name="ruang[]" class="form-control"  >
                                    <option value="<?php echo $f->ruang; ?>" selected=""><?php echo $f->ruang; ?></option>
                                    <?php foreach($ruang_1 as $ruang){?>
                                        <option value="<?php echo $ruang->nama_ruang; ?>"><?php echo $ruang->nama_ruang; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <label>Kelas:</label>
                                <select name="kelas[]" class="form-control"  >
                                    <option value="2">Karyawan</option>
                                </select>
                            </td>
                            <td>
                                <label>Status:</label>
                                <select name="status[]" class="form-control"  >
                                    <option value="<?php echo $f->status; ?>" selected=""><?php if($f->status == 1){ echo "BUKA";}else if($f->status == 0){ echo "TUTUP";}else{ echo $f->status; } ?></option>
                                    <option value='1'>BUKA</option>
                                    <option value='0'>TUTUP</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <br>
                    <input type="submit" class="btn btn-primary" value="Simpan">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
                                    
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
