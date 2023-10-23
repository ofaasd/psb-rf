<?php
    function rupiah($angka){
    
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;
 
    }
?>
                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>FORM REGISTRASI MAHASISWA BARU</h5>
                                                        <h4><?php echo $this->session->userdata('status'); 
                                                            $this->session->set_userdata('status','');?></h4>
                                                    </div>
                                                    <div class="card-block">
                                                    <form action="<?php echo base_url()?>pmb/surat_pernyataan" method="post">
                                                    <h4 class="sub-title">DETAIL PEMBAYARAN</h4>
                                                    <?php
                                                        $jml_operasional = $o->operasional + $o->kemahasiswaan + $o->seragam;
                                                    ?>
                                                    <input type="number" class="form-control" id="jml_operasional" value="<?php echo $jml_operasional; ?>" hidden></input>
                                                    <?php foreach($registrasi as $d){?>
                                                     <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control" value="<?php echo $d->id ?>" name="id" hidden="">
                                                            <div class="col-sm-12">
                                                                <label><b>Sumbangan Pendidikan Institusi (SPI) :</b></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input class="form-control" name="spi" id="spi" value="<?php echo $spi; ?>"></input>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <br>
                                                                <label><b>Operasional :</b></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input type="number" class="form-control" name="operasional" id="operasional" value="<?php echo $operasional; ?>"></input>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <br>
                                                                <label><b>Potongan SPI :</b></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input class="form-control" type="text" name="potongan" id="potongan" value="<?php echo $potongan_spi; ?>"></input>
                                                                <br>
                                                                <a href="#" class="btn btn-primary" onclick="hitung()">Hitung</a><p id="total"></p>
                                                            </div>
                                                        </div>
                                                       
                                                        <div class="col-sm-6">
                                                            <div class="col-sm-12">
                                                                <label><b>Total Biaya Satuan Kredit Semester (SKS) :</b></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input type="number" class="form-control" id="sks" name="sks" value="<?php echo $sks; ?>"></input>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <br>
                                                                <label><b>Kemahasiswaan :</b></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input type="number" class="form-control" name="kemahasiswaan" id="kemahasiswaan" value="<?php echo $kemahasiswaan; ?>"></input>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <br>
                                                                <label><b>Seragam :</b></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input type="number" class="form-control" name="seragam" id="seragam" value="<?php echo $seragam; ?>"></input>
                                                            </div>
                                                            <div <?php if($d->jalur_pendaftaran != 3){ echo 'hidden=""';}?>>
                                                                <div class="col-sm-6">
                                                                    <label><b>Nilai Tes Masuk (0-100) :</b></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="number" name="tes" class="form-control" max="100" min="0" placeholder="0" <?php if ($d->is_bayar == 1) {
                                                                        # code...
                                                                        echo 'readonly';
                                                                    } if($d->jalur_pendaftaran != 3){ echo '';}else{ echo 'required=""';}?>></input>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="col-sm-6">
                                                                <label><b>Jumlah Tahap 1 :</b></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input class="form-control" type="text" name="jml_tahap_1" id="jml_1" value="<?php echo $jml_tahap_1; ?>"></input>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="col-sm-6">
                                                                <label><b>Tanggal Tahap 1 :</b></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input class="form-control" type="date" name="tgl_tahap_1" value="<?php echo $tgl_tahap_1; ?>"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="col-sm-6">
                                                                <br>
                                                                <label><b>Jumlah Tahap 2 :</b></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input class="form-control" type="text" name="jml_tahap_2" id="jml_2" value="<?php echo $jml_tahap_2; ?>"></input>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="col-sm-6">
                                                                <br>
                                                                <label><b>Tanggal Tahap 2 :</b></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input class="form-control" type="date" name="tgl_tahap_2" value="<?php echo $tgl_tahap_2; ?>"></input>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="col-sm-6">
                                                                <br>
                                                                <label><b>Jumlah Tahap 3 :</b></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input class="form-control" type="text" name="jml_tahap_3" id="jml_3" value="<?php echo $jml_tahap_3; ?>"></input>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="col-sm-6">
                                                                <br>
                                                                <label><b>Tanggal Tahap 3 :</b></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input class="form-control" type="date" name="tgl_tahap_3" value="<?php echo $tgl_tahap_3; ?>"></input>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <div class="col-sm-12">
                                                                <label><b>Status Pembayaran Pendaftaran :</b></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <select name="bayar" class="form-control" required="">
                                                                    <option value="0" <?php $bayar = $d->is_bayar; if($d->is_bayar == 0){ echo "selected disabled='true'"; }?>>Belum Bayar</option>
                                                                    <option value="1" <?php if($d->is_bayar == 1){ echo "selected"; }?>>Sudah Bayar</option>
                                                                </select>
                                                            </div>
                                                            <input type="number" class="form-control" readonly="" name="nopen" value="<?php echo $d->nopen ?>"  maxlength="16" hidden="">
                                                            <input type="text" class="form-control" name="nama" value="<?php echo $d->nama ?>" hidden="">
                                                            <textarea class="form-control" name="alamat" style="resize: none;" hidden=""><?php echo $d->alamat ?></textarea>
                                                            <select name="kecamatan" id="kecamatan" class="form-control" hidden="">
                                                            <option selected="" value="<?php echo $d->kecamatan ?>"><?php echo $data['nm_kec']; ?></option>
                                                                </select>
                                                            <input hidden="" type="text" class="form-control" name="kelurahan" value="<?php echo $d->kelurahan ?>" >
                                                            <input type="text" hidden="" class="form-control" name="rt" value="<?php echo $d->rt ?>" >
                                                            <input type="text" hidden="" class="form-control" name="rw" value="<?php echo $d->rw ?>" >
                                                            <input type="text" hidden="" class="form-control" name="hp" value="<?php echo $d->hp ?>" >
                                                            <input type="text" hidden="" class="form-control" name="telpon" value="<?php echo $d->telpon ?>" >
                                                                <select name="provinsi" id="provinsi" class="form-control" hidden="">
                                                                    <option selected="" value="<?php echo $d->provinsi ?>"><?php echo $data['nm_prop']; ?></option>
                                                                </select>
                                                                <select name="kotakab" id="kotakab" class="form-control" hidden=""> 
                                                                    <option selected="" value="<?php echo $d->kotakab ?>"><?php echo $data['nm_kab']; ?></option>
                                                                </select>
                                                            <br><br>
                                                           
                                                        </div>
                                                        
                                                        <div class="col-sm-6">
                                                            <div class="col-sm-4">
                                                                <label><b></b></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input type="submit" class="btn btn-primary btn-round" value="Surat Pernyataan"></input>
                                                                <!-- <a href="<?php echo base_url('pmb/cetak_regis_btn/').$d->id;?>" class="btn btn-primary btn-round">Surat Pernyataan</a> -->
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </form>
                                                <form action="<?php echo base_url()?>pmb/cmhs_upreg_aksi" method="post" enctype="multipart/form-data">
                                                    <h4 class="sub-title">DATA MAHASISWA BARU</h4>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <div class="col-sm-4">
                                                                <label>No. Pendaftaran : </label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" value="<?php echo $d->id ?>" name="id" hidden="">
                                                                <input type="number" class="form-control" readonly="" name="nopen" value="<?php echo $d->nopen ?>"  maxlength="16">
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label>Nomor KTP : </label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input type="number" class="form-control" name="noktp" value="<?php echo $d->noktp ?>" maxlength="16">
                                                            </div>
                                                            <label class="col-sm-4 col-form-label">NISN : </label>
                                                            <div class="col-sm-8">
                                                                <input type="number" class="form-control" name="nisn" value="<?php echo $d->nisn ?>"  maxlength="15"><p>Tidak Tahu NISN anda? cek <a href="https://nisn.data.kemdikbud.go.id/page/data" target="_blank">DISINI</a></p>
                                                            </div>
                                                            <label class="col-sm-4 col-form-label">Nama Lengkap : </label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="nama" value="<?php echo $d->nama ?>" >
                                                            </div>
                                                            <label class="col-sm-4 col-form-label">Jenis Kelamin : </label>
                                                            <div class="col-sm-8">
                                                                <select name="jk" class="form-control" >
                                                                    <option selected="" value="<?php echo $d->jk ?>"><?php if($d->jk == 1){ echo "Laki - Laki"; }else{ echo "Perempuan"; } ?></option>
                                                                    <option value="1">Laki - Laki</option>
                                                                    <option value="2">Perempuan</option>
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-4 col-form-label">Agama : </label>
                                                            <div class="col-sm-8">
                                                                <select name="agama" class="form-control" >
                                                                    <option value="<?php echo $d->agama ?>" selected="" ><?php if($d->agama == 1 ){ 
                                                                            echo "Islam"; 
                                                                        }else if($d->agama == 2){ 
                                                                            echo "Kristen"; 
                                                                        }else if($d->agama == 3){ 
                                                                            echo "Katolik"; 
                                                                        }else if($d->agama == 4){ 
                                                                            echo "Hindu"; 
                                                                        }else if($d->agama == 5){ 
                                                                            echo "Budha"; 
                                                                        }else if($d->agama == 6){ 
                                                                            echo "Konghucu"; 
                                                                        }else{ 
                                                                            echo "Lainnya"; 
                                                                        }
                                                                    ?></option>

                                                                    <option value="1">Islam</option>
                                                                    <option value="2">Kristen</option>
                                                                    <option value="3">Katolik</option>
                                                                    <option value="4">Hindu</option>
                                                                    <option value="5">Budha</option>
                                                                    <option value="6">Konghucu</option>
                                                                    <option value="99">Lainnya</option>
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-4 col-form-label">Nama Ibu : </label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="nama_ibu" value="<?php echo $d->nama_ibu ?>" >
                                                            </div>
                                                            <label class="col-sm-4 col-form-label">Nama Ayah : </label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="nama_ayah" value="<?php echo $d->nama_ayah ?>" >
                                                            </div>
                                                            <label class="col-sm-4 col-form-label">Tinggi Badan : </label>
                                                            <div class="col-sm-8">
                                                                <input type="number" class="form-control" name="tinggi_badan" value="<?php echo $d->tinggi_badan ?>" >
                                                            </div>
                                                            <label class="col-sm-4 col-form-label">Berat Badan : </label>
                                                            <div class="col-sm-8">
                                                                <input type="number" class="form-control" name="berat_badan" value="<?php echo $d->berat_badan ?>" >
                                                            </div>
                                                            <label class="col-sm-4 col-form-label">Tempat Lahir : </label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="tempat_lahir" value="<?php echo $d->tempat_lahir ?>" >
                                                            </div>
                                                            <label class="col-sm-4 col-form-label">Tanggal Lahir : </label>
                                                            <div class="col-sm-8">
                                                                <input type="date" class="form-control" name="tanggal_lahir" value="<?php echo $d->tanggal_lahir ?>" >
                                                            </div>
                                                            <label class="col-sm-3 col-form-label">No. HP : </label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="hp" value="<?php echo $d->hp ?>" >
                                                            </div>
                                                            <label class="col-sm-4 col-form-label">No. Telpon :</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="telpon" value="<?php echo $d->telpon ?>" >
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label>Warga Negara : </label>
                                                            </div>
                                                             <div class="col-sm-8">
                                                                <select name="warga_negara" id="wn" class="form-control" >
                                                                    <option selected="" value="<?php echo $d->warga_negara ?>"><?php echo $data['nama_negara']?></option>
                                                                    <?php foreach($warga_negara as $w){?>
                                                                    <option value="<?php echo $w->id_negara?>"><?php echo $w->nm_negara ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-4 col-form-label">Nama Provinsi : </label>
                                                             <div class="col-sm-8">
                                                                <select name="provinsi" id="provinsi" class="form-control" >
                                                                    <option selected="" value="<?php echo $d->provinsi ?>"><?php echo $data['nm_prop']; ?></option>
                                                                    <?php foreach($wilayah as $w){?>
                                                                    <option value="<?php echo $w->id_wil ?>"><?php echo $w->nm_wil ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- Batas Column -->
                                                        <div class="col-sm-6">
                                                            <label class="col-sm-4 col-form-label">Kota / Kabupaten : </label>
                                                             <div class="col-sm-8">
                                                                <select name="kotakab" id="kotakab" class="form-control" > 
                                                                    <option selected="" value="<?php echo $d->kotakab ?>"><?php echo $data['nm_kab']; ?></option>
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-3 col-form-label">Kecamatan : </label>
                                                            <div class="col-sm-8">
                                                                <select name="kecamatan" id="kecamatan" class="form-control" >
                                                                    <option selected="" value="<?php echo $d->kecamatan ?>"><?php echo $data['nm_kec']; ?></option>
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-3 col-form-label">Kode POS : </label>
                                                            <div class="col-sm-8">
                                                                <input type="number" class="form-control" name="kode_pos" value="<?php echo $d->kodepos ?>" >
                                                            </div>
                                                            <label class="col-sm-3 col-form-label">Kelurahan : </label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="kelurahan" value="<?php echo $d->kelurahan ?>" >
                                                            </div>
                                                            <label class="col-sm-4 col-form-label">Alamat : </label>
                                                            <div class="col-sm-8">
                                                                <textarea class="form-control" name="alamat" style="resize: none;" ><?php echo $d->alamat ?></textarea>
                                                            </div>
                                                            <label class="col-sm-4 col-form-label">RT :</label>
                                                            <label class="col-sm-4 col-form-label">RW : </label>
                                                            <div class="col-sm-8">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <input type="text" class="form-control" name="rt" value="<?php echo $d->rt ?>" >
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" class="form-control" name="rw" value="<?php echo $d->rw ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <label class="col-sm-3 col-form-label">Sekolah Asal :</label>
                                                             <div class="col-sm-8">
                                                             <select name="asal_sekolah" id="asal_sekolah" class="form-control js-example-basic-single">
                                                                    <option selected="" value="<?php echo $d->asal_sekolah ?>"><?php echo $data['nm_sekolah']; ?></option>
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-4 col-form-label">Pilih Jenis Kelas :</label>
                                                             <div class="col-sm-8">
                                                                <select name="kelas" class="form-control" readonly="">
                                                                    <option value="<?php echo $d->kelas ?>" selected="" readonly=""><?php if($d->kelas == 1){ echo "Reguler"; }else if($d->kelas == 2){ echo "Karyawan"; }?></option>
                                                                </select>
                                                             </div>
                                                             <label class="col-sm-4 col-form-label">Kategori :</label>
                                                             <div class="col-sm-8">
                                                                <select name="jalur" class="form-control" readonly="">
                                                                    <option value="<?php echo $d->jalur_pendaftaran ?>" selected="" readonly=""><?php if($d->jalur_pendaftaran == 1){ echo "PMDP"; }else if($d->jalur_pendaftaran == 2){ echo "KERJASAMA"; }else if($d->jalur_pendaftaran == 3){ echo "UMUM"; }?></option>
                                                                </select>
                                                             </div>
                                                             <div <?php if($d->jalur_pendaftaran != 2){ echo 'hidden=""'; }else{ echo '';}?>>
                                                                <label class="col-sm-4 col-form-label">Jenis Kerjasama :</label>
                                                                <div class="col-sm-8">
                                                                    <select name="kerjasama" class="form-control" readonly="">
                                                                        <option value="<?php echo $d->is_kerjasama ?>" selected="" readonly=""><?php if($d->is_kerjasama == 1){ echo "MOU AKADEMI FARMASI NUSAPUTERA"; }else if($d->is_kerjasama == 2){ echo "ALUMNI SMK NUSAPUTERA"; }else if($d->is_kerjasama == 3){ echo "PAFI"; }else if($d->is_kerjasama == 4){ echo "KIMIA FARMA"; }?></option>
                                                                    </select>
                                                                </div>
                                                                <div <?php if($d->is_kerjasama != 1){ echo 'hidden=""'; }else{ echo '';}?>>
                                                                    <label class="col-sm-4 col-form-label">Jenis Kerjasama :</label>
                                                                    <div class="col-sm-8">
                                                                        <select name="mou" class="form-control" readonly="">
                                                                            <option value="<?php echo $d->is_mou ?>" selected="" readonly=""><?php echo $data['mou']; ?></option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                             </div>
                                                            <label class="col-sm-6 col-form-label">Pilih Jenis Pendaftaran :</label>
                                                             <div class="col-sm-8">
                                                                <select name="pendaftaran" class="form-control" readonly="">
                                                                    <option value="<?php echo $d->jenis_pendaftaran ?>" selected="" readonly=""><?php if($d->jenis_pendaftaran == 1){ echo "Peserta Didik Baru"; }else if($d->jenis_pendaftaran == 2){ echo "Pindahan"; }else if($d->jenis_pendaftaran == 11){ echo "Alih Jenjang"; }else if($d->jenis_pendaftaran == 12){ echo "Lintas Jalur"; }?></option>
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-8 col-form-label">Gelombang Pendaftaran : </label>
                                                             <div class="col-sm-8">
                                                                <select name="gelombang" id="gelombang" class="form-control" readonly="">
                                                                    <option value="<?php echo $d->gelombang ?>" selected="" readonly=""><?php echo $data['gelombang']; ?></option>
                                                                </select>
                                                            </div>
                                                            <div <?php if ($d->jalur_pendaftaran != 1) { echo 'hidden=""';}else{ echo '';}?>>
                                                                <label class="col-sm-4 col-form-label">Total Nilai PMDP : </label>
                                                                <div class="col-sm-8">
                                                                    <input type="number" class="form-control" name="pmdp" value="<?php echo $d->peringkat_pmdp ?>" >
                                                                </div>
                                                            </div>
                                                            <label class="col-sm-6 col-form-label">Pilih Program Studi 1 : </label>
                                                             <div class="col-sm-8">
                                                                <select name="pilihan1" class="form-control" >
                                                                    <option value="<?php echo $d->pilihan1 ?>" selected=""><?php echo $data['jurusan1']; ?></option>
                                                                    <?php foreach($prodi as $p){?>
                                                                    <option value="<?php echo $p->id ?>"><?php echo $p->nama_jurusan ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-6 col-form-label">Pilih Program Studi 2 : </label>
                                                             <div class="col-sm-8">
                                                                <select name="pilihan2" class="form-control" >
                                                                    <option value="<?php echo $d->pilihan2 ?>" selected="" ><?php echo $data['jurusan2']?></option>
                                                                    <?php foreach($prodi as $p){?>
                                                                    <option value="<?php echo $p->id ?>"><?php echo $p->nama_jurusan ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-6 col-form-label">Dapat info PMB darimana?</label>
                                                             <div class="col-sm-8">
                                                                <select name="info_pmb" class="form-control" >
                                                                    <option value="<?php echo $d->info_pmb ?>" selected=""><?php if($d->info_pmb == 1){ echo "Teman"; }else if($d->info_pmb == 2){ echo "Kerabat / Orang Tua"; }else if($d->info_pmb == 3){ echo "Sosial Media"; }else if($d->info_pmb == 4){ echo "Lainnya"; }?></option>
                                                                    <option value="1">Teman</option>
                                                                    <option value="2">Kerabat / Orang Tua</option>
                                                                    <option value="3">Sosial Media</option>
                                                                    <option value="4">Lainnya</option>
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-6 col-form-label">Upload Foto : </label>
                                                             <div class="col-sm-8">
                                                                <img src="<?php echo base_url().'assets/foto_pmb_peserta/'.$d->foto_peserta;?>" style="width: 100px;height: 150px;"><br><br>
                                                                <input type="file" class="form-control" name="foto"></input><p>Maksimal 500kb dengan background merah.</p>
                                                            </div>
                                                             <div class="col-sm-6">
                                                                <input type="submit" class="btn btn-success btn-round" value="Update Data">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                   </form>
                                                <?php } ?>
                                                  </div>
                                                 </div>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        function hitung(){
                                            var spi = $('#spi').val();
                                            var sks = $('#sks').val();
                                            var kemahasiswaan = $('#kemahasiswaan').val();
                                            var seragam = $('#seragam').val();
                                            var operasional = $('#operasional').val();
                                            var potongan = $('#potongan').val();

                                            var total = parseInt(kemahasiswaan) + parseInt(operasional) + parseInt(seragam) + parseInt(spi) + parseInt(sks) - parseInt(potongan);
                                            var thp_1 = total / 2;
                                            var thp_2 = thp_1 / 2;
                                            console.log(kemahasiswaan);
                                            console.log(seragam);
                                            console.log(spi);
                                            document.getElementById('jml_1').value = thp_1;
                                            document.getElementById('jml_2').value = thp_2;
                                            document.getElementById('jml_3').value = thp_2;
                                            document.getElementById("total").innerHTML = "Total : RP. "+total;
                                        }
                                        var rupiah = document.getElementById('rupiah');
                                        rupiah.addEventListener('keyup', function(e){
                                            // tambahkan 'Rp.' pada saat form di ketik
                                            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                                            rupiah.value = formatRupiah(this.value, '');
                                        });
                                 
                                        /* Fungsi formatRupiah */
                                        function formatRupiah(angka, prefix){
                                            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                                            split           = number_string.split(','),
                                            sisa            = split[0].length % 3,
                                            rupiah          = split[0].substr(0, sisa),
                                            ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
                                 
                                            // tambahkan titik jika yang di input sudah menjadi angka ribuan
                                            if(ribuan){
                                                separator = sisa ? '.' : '';
                                                rupiah += separator + ribuan.join('.');
                                            }
                                 
                                            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                                            return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
                                        }
                                        var rupiah1 = document.getElementById('rupiah1');
                                        rupiah1.addEventListener('keyup', function(e){
                                            // tambahkan 'Rp.' pada saat form di ketik
                                            // gunakan fungsi formatrupiah1() untuk mengubah angka yang di ketik menjadi format angka
                                            rupiah1.value = formatrupiah1(this.value, '');
                                        });
                                 
                                        /* Fungsi formatrupiah1 */
                                        function formatrupiah1(angka, prefix){
                                            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                                            split           = number_string.split(','),
                                            sisa            = split[0].length % 3,
                                            rupiah1          = split[0].substr(0, sisa),
                                            ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
                                 
                                            // tambahkan titik jika yang di input sudah menjadi angka ribuan
                                            if(ribuan){
                                                separator = sisa ? '.' : '';
                                                rupiah1 += separator + ribuan.join('.');
                                            }
                                 
                                            rupiah1 = split[1] != undefined ? rupiah1 + ',' + split[1] : rupiah1;
                                            return prefix == undefined ? rupiah1 : (rupiah1 ? '' + rupiah1 : '');
                                        }
                                        $(document).ready(function(){
                                            $('#wn').change(function(){
                                                var id=$(this).val();
                                                $.ajax({
                                                    url : "<?php echo base_url();?>pmb/daftar_prov/",
                                                    method : "POST",
                                                    data : {id: id},
                                                    async : false,
                                                    dataType : 'json',
                                                    success: function(data){
                                                        var html = '';
                                                        var i;
                                                        for(i=0; i<data.length; i++){
                                                            html += '<option value="'+ data[i].prov_id +'">'+data[i].nama_prov+'</option>';
                                                        }
                                                        // $('#provinsi').html(html);
                                                         
                                                    }
                                                });
                                            });
                                            $('#gelombang').change(function(){
                                                var val_gel = $(this).val();
                                                var nopen_pmdp = 20000;
                                                var nopen_gel = 50000;
                                                if(val_gel == 'PMDP'){
                                                    $.ajax({
                                                        url : "<?php echo base_url();?>pmb/nopen_pmdp/",
                                                        method : "POST",
                                                        data : {id: nopen_pmdp},
                                                        async : false,
                                                        dataType : 'json',
                                                        success: function(data){
                                                            var nopen_baru = '';
                                                            var i;
                                                            for(i=0; i<data.length; i++){
                                                                // nopen_baru += data[i].nopen;
                                                                nopen_baru += '<input type="text" class="form-control" readonly="" value="'+ data[i].nopen +'" name="nopen">';
                                                            }
                                                            // console.log(nopen_baru);
                                                            $('#nopen').html(nopen_baru);
                                                        }
                                                    });
                                                    document.getElementById('pmdp1').disabled= false;
                                                    document.getElementById('pmdp2').disabled= false;
                                                    document.getElementById('pmdp3').disabled= false;
                                                    document.getElementById('pmdp4').disabled= false;
                                                }else{
                                                    $.ajax({
                                                        url : "<?php echo base_url();?>pmb/nopen_gel/",
                                                        method : "POST",
                                                        data : {id: nopen_gel},
                                                        async : false,
                                                        dataType : 'json',
                                                        success: function(data){
                                                            var nopen_baru = '';
                                                            var i;
                                                            for(i=0; i<data.length; i++){
                                                                // nopen_baru += data[i].nopen;
                                                                nopen_baru += '<input type="text" class="form-control" readonly="" value="'+ data[i].nopen +'" name="nopen">';
                                                            }
                                                            // console.log(nopen_baru);
                                                            $('#nopen').html(nopen_baru);
                                                        }
                                                    });
                                                    document.getElementById('pmdp1').disabled= true;
                                                    document.getElementById('pmdp2').disabled= true;
                                                    document.getElementById('pmdp3').disabled= true;
                                                    document.getElementById('pmdp4').disabled= true;
                                                }
                                            });
                                        });
                                        $(document).ready(function(){
                                            $('#provinsi').change(function(){
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
                                            $('#kotakab').change(function(){
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
                                        });
                                        $(document).ready(function(){
                                            $('#provinsi').change(function(){
                                                var id_prov=$(this).val();
                                                $('#kotakab').change(function(){
                                                    var id_kota=$(this).val();
                                                    $.ajax({
                                                    url : "<?php echo base_url();?>pmb/daftar_sekolah/",
                                                    method : "POST",
                                                    data : {id_prov: id_prov,
                                                            id_kota: id_kota},
                                                    async : false,
                                                    dataType : 'json',
                                                    success: function(data){
                                                        var html = '';
                                                        var i;
                                                        for(i=0; i<data.length; i++){
                                                            html += '<option value="'+ data[i].id +'">'+data[i].nama+'</option>';
                                                        }
                                                        $('#asal_sekolah').html(html);
                                                         
                                                        }
                                                    });
                                                });
                                            });
                                        });
                                    </script>
