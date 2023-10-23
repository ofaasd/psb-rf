                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>FORM TAMBAH CALON MAHASISWA BARU</h5>
                                                    </div>
                                                    <div class="card-block">
                                                    <h4 class="sub-title">DATA CALON MAHASISWA</h4>
                                                     <form action="<?php echo base_url()?>pmb/cmhs_tambah_aksi" method="post" enctype="multipart/form-data">
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <div class="col-sm-4">
                                                                <label>No. Pendaftaran : </label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <p id="nopen"><font color="red">Akan muncul setelah memilih Gelombang Pendaftaran.</font></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="col-sm-4 col-form-label">Kota / Kabupaten : </label>
                                                             <div class="col-sm-8">
                                                                <select name="kotakab" id="kotakab" class="form-control" required=""> 
                                                                    <option selected="" disabled="">Pilih Kota/Kabupaten</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <div class="col-sm-4">
                                                                <label>Nomor KTP : </label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input type="number" class="form-control" name="noktp" placeholder="Nomor KTP" required="" maxlength="16">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="col-sm-3 col-form-label">Kecamatan : </label>
                                                            <div class="col-sm-8">
                                                                <select name="kecamatan" id="kecamatan" class="form-control" required="">
                                                                    <option selected="" disabled="">Daftar Kecamatan</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <label class="col-sm-4 col-form-label">NISN : </label>
                                                            <div class="col-sm-8">
                                                                <input type="number" class="form-control" name="nisn" placeholder="NISN" required="" maxlength="15"><p>Tidak Tahu NISN anda? cek <a href="https://nisn.data.kemdikbud.go.id/page/data" target="_blank">DISINI</a></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="col-sm-3 col-form-label">Kode POS : </label>
                                                            <div class="col-sm-8">
                                                                <input type="number" class="form-control" name="kode_pos" placeholder="Kode POS" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <label class="col-sm-4 col-form-label">Nama Lengkap : </label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="col-sm-3 col-form-label">Kelurahan : </label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="kelurahan" placeholder="Kelurahan" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                         <div class="col-sm-6">
                                                            <label class="col-sm-4 col-form-label">Jenis Kelamin : </label>
                                                            <div class="col-sm-8">
                                                                <select name="jk" class="form-control" required="">
                                                                    <option selected="" disabled="">Jenis Kelamin</option>
                                                                    <option value="1">Laki - Laki</option>
                                                                    <option value="2">Perempuan</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="col-sm-4 col-form-label">Alamat : </label>
                                                            <div class="col-sm-8">
                                                                <textarea class="form-control" style="resize: none;" name="alamat" placeholder="Hanya nama kampung, jalan dan nomor rumah saja" required="" ></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                         <div class="col-sm-6">
                                                            <label class="col-sm-4 col-form-label">Agama : </label>
                                                            <div class="col-sm-8">
                                                                <select name="agama" class="form-control" required="">
                                                                    <option value="opt1" selected="" disabled="">Pilih Agama</option>
                                                                    <option value="1">Islam</option>
                                                                    <option value="2">Kristen</option>
                                                                    <option value="3">Katolik</option>
                                                                    <option value="4">Hindu</option>
                                                                    <option value="5">Budha</option>
                                                                    <option value="6">Konghucu</option>
                                                                    <option value="99">Lainnya</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="col-sm-4 col-form-label">RT :</label>
                                                            <label class="col-sm-4 col-form-label">RW : </label>
                                                            <div class="col-sm-8">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <input type="text" class="form-control" name="rt" placeholder="RT" required="">
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" class="form-control" name="rw" placeholder="RW" required="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <label class="col-sm-4 col-form-label">Nama Ibu : </label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="nama_ibu" placeholder="Nama Ibu" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="col-sm-3 col-form-label">Sekolah Asal :</label>
                                                             <div class="col-sm-8">
                                                             <!-- <select name="asal_sekolah" id="asal_sekolah" class="form-control" required="">
                                                                    <option selected="" disabled="">Pilih Sekolah Asal</option>
                                                             </select> -->
                                                             <select name="asal_sekolah" id="asal_sekolah" class="form-control js-example-basic-single">
                                                            </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <label class="col-sm-4 col-form-label">Nama Ayah : </label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="nama_ayah" placeholder="Nama ayah" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="col-sm-4 col-form-label">Pilih Jenis Kelas :</label>
                                                             <div class="col-sm-8">
                                                                <select name="kelas" class="form-control" required="">
                                                                    <option value="opt1" selected="" disabled="">- Pilih Kelas -</option>
                                                                    <option value="1">Karyawan</option>
                                                                    <option value="2">Reguler</option>
                                                                    <option value="3">RPL</option>
                                                                    <option value="4">Kimia Farma</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <label class="col-sm-4 col-form-label">Tinggi Badan : </label>
                                                            <div class="col-sm-8">
                                                                <input type="number" class="form-control" name="tinggi_badan" placeholder="Tinggi Badan" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="col-sm-6 col-form-label">Pilih Jenis Pendaftaran :</label>
                                                             <div class="col-sm-8">
                                                                <select name="pendaftaran" class="form-control" required="">
                                                                    <option value="opt1" selected="" disabled="">- Pilih Pendaftaran -</option>
                                                                    <option value="1">Peserta Didik Baru</option>
                                                                    <option value="2">Pindahan</option>
                                                                    <option value="11">Alih Jenjang</option>
                                                                    <option value="12">Lintas Jalur</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <label class="col-sm-4 col-form-label">Berat Badan : </label>
                                                            <div class="col-sm-8">
                                                                <input type="number" class="form-control" name="berat_badan" placeholder="Berat Badan" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="col-sm-8 col-form-label">Gelombang Pendaftaran : </label>
                                                             <div class="col-sm-8">
                                                                <select name="gelombang" id="gelombang" class="form-control" required="">
                                                                    <option value="opt1" selected="" disabled="">Gelombang Pendaftaran</option>
                                                                <?php foreach($gelombang as $g){?>
                                                                    <option value="<?php echo $g->nama_gel ?>"><?php echo $g->nama_gel_long ?></option>
                                                                <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <label class="col-sm-4 col-form-label">Tempat Lahir : </label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="col-sm-4 col-form-label" id="label1"></label>
                                                            <label class="col-sm-4 col-form-label" id="label2"></label>
                                                            <div class="col-sm-8">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <input type="text" id="pmdp1" class="form-control" name="pmdp1" placeholder="Rata-rata Nilai" hidden="">
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" id="pmdp2" class="form-control" name="pmdp2" placeholder="Rata-rata Nilai" hidden="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <label class="col-sm-4 col-form-label">Tanggal Lahir : </label>
                                                            <div class="col-sm-8">
                                                                <input type="date" class="form-control" name="tanggal_lahir" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="col-sm-4 col-form-label" id="label3"></label>
                                                            <label class="col-sm-4 col-form-label" id="label4"></label>
                                                            <div class="col-sm-8">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <input type="text" id="pmdp3" class="form-control" name="pmdp3" placeholder="Rata-rata Nilai" hidden="">
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" id="pmdp4" class="form-control" name="pmdp4" placeholder="Rata-rata Nilai" hidden="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <label class="col-sm-3 col-form-label">No. HP : </label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="hp" placeholder="Nomor HP" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="col-sm-6 col-form-label">Pilih Program Studi 1 : </label>
                                                         <div class="col-sm-8">
                                                            <select name="pilihan1" class="form-control" required="">
                                                                <option value="opt1" selected="" disabled="">- Pilih Program Studi 1 -</option>
                                                                <?php foreach($prodi as $p){?>
                                                                <option value="<?php echo $p->id ?>"><?php echo $p->nama_jurusan ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <label class="col-sm-4 col-form-label">No. Telpon :</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="telpon" placeholder="Nomor Telepon" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="col-sm-6 col-form-label">Pilih Program Studi 2 : </label>
                                                             <div class="col-sm-8">
                                                                <select name="pilihan2" class="form-control" required="">
                                                                    <option value="opt1" selected="" disabled="">- Pilih Program Studi 2 -</option>
                                                                    <?php foreach($prodi as $p){?>
                                                                    <option value="<?php echo $p->id ?>"><?php echo $p->nama_jurusan ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <div class="col-sm-4">
                                                                <label>Warga Negara : </label>
                                                            </div>
                                                             <div class="col-sm-8">
                                                                <select name="warga_negara" id="wn" class="form-control" required="">
                                                                    <option selected="" disabled="">Pilih Warga Negara</option>
                                                                    <?php foreach($warga_negara as $w){?>
                                                                    <option value="<?php echo $w->id_negara?>"><?php echo $w->nm_negara ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="col-sm-6 col-form-label">Dapat info PMB darimana?</label>
                                                             <div class="col-sm-8">
                                                                <select name="info_pmb" class="form-control" required="">
                                                                    <option value="opt1" selected="" disabled="">- Pilih -</option>
                                                                    <option value="1">Teman</option>
                                                                    <option value="2">Kerabat / Orang Tua</option>
                                                                    <option value="3">Sosial Media</option>
                                                                    <option value="4">Lainnya</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <label class="col-sm-4 col-form-label">Nama Provinsi : </label>
                                                             <div class="col-sm-8">
                                                                <select name="provinsi" id="provinsi" class="form-control" required="">
                                                                    <option selected="" disabled="">Pilih Provinsi</option>
                                                                    <?php foreach($wilayah as $w){?>
                                                                    <option value="<?php echo $w->id_wil ?>"><?php echo $w->nm_wil ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label class="col-sm-6 col-form-label">Upload Foto : </label>
                                                             <div class="col-sm-8">
                                                                <input type="file" class="form-control" required="" name="foto"></input><p>Maksimal 500kb dengan background merah.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-sm-10 col-form-label"></label>
                                                         <div class="col-sm-2">
                                                            <input type="submit" class="btn btn-success btn-round" value="Simpan Data">
                                                        </div>
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
                                                    document.getElementById('label1').innerHTML = "Kelas X Semester 1";
                                                    document.getElementById('label2').innerHTML = "Kelas X Semester 2";
                                                    document.getElementById('label3').innerHTML = "Kelas XI Semester 1";
                                                    document.getElementById('label4').innerHTML = "Kelas XI Semester 2";
                                                    document.getElementById('pmdp1').hidden = false;
                                                    document.getElementById('pmdp2').hidden = false;
                                                    document.getElementById('pmdp3').hidden = false;
                                                    document.getElementById('pmdp4').hidden = false;
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
                                                    document.getElementById('label1').innerHTML = "";
                                                    document.getElementById('label2').innerHTML = "";
                                                    document.getElementById('label3').innerHTML = "";
                                                    document.getElementById('label4').innerHTML = "";
                                                    document.getElementById('pmdp1').hidden = true;
                                                    document.getElementById('pmdp2').hidden = true;
                                                    document.getElementById('pmdp3').hidden = true;
                                                    document.getElementById('pmdp4').hidden = true;
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