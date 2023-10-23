                    <style>
                            * {
                              box-sizing: border-box;
                            }

                            body {
                              background-color: #f1f1f1;
                            }

                            #regForm {
                              background-color: #ffffff;
                              margin-left: 10px;
                              font-family: Raleway;
                              padding: 40px;
                              width: 100%;
                              min-width: 300px;
                            }

                            h1 {
                              text-align: center;  
                            }

                            input {
                              padding: 10px;
                              width: 100%;
                              font-size: 17px;
                              font-family: Raleway;
                              border: 1px solid #aaaaaa;
                            }

                            /* Mark input boxes that gets an error on validation: */
                            input.invalid {
                              background-color: #ffdddd;
                            }

                            /* Hide all steps by default: */
                            .tab {
                              display: none;
                            }

                            button {
                              background-color: #4CAF50;
                              color: #ffffff;
                              border: none;
                              padding: 10px 20px;
                              font-size: 17px;
                              font-family: Raleway;
                              cursor: pointer;
                            }

                            button:hover {
                              opacity: 0.8;
                            }

                            #prevBtn {
                              background-color: #bbbbbb;
                            }

                            /* Make circles that indicate the steps of the form: */
                            .step {
                              height: 15px;
                              width: 15px;
                              margin: 0 2px;
                              background-color: #bbbbbb;
                              border: none;  
                              border-radius: 50%;
                              display: inline-block;
                              opacity: 0.5;
                            }

                            .step.active {
                              opacity: 1;
                            }

                            /* Mark the steps that are finished and valid: */
                            .step.finish {
                              background-color: #4CAF50;
                            }
                            </style>

                        <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>FORM TAMBAH CALON MAHASISWA BARU</h5>
                                                    </div>
                                                    <div class="card-block">
                                                    <h4 class="sub-title">DATA CALON MAHASISWA</h4>
                                                     <form id="regForm" action="<?php echo base_url()?>pmb/cmhs_tambah_aksi" method="post" enctype="multipart/form-data">
                                                          <!-- One "tab" for each step in the form: -->
                                                          <div class="tab">PILIH KELAS :
                                                            <p><select id="kelas" name="kelas" class="form-control" required="">
                                                                    <option value="opt1" selected="" disabled="">- Pilih Kelas -</option>
                                                                    <?php foreach($kelas as $kel){?>
                                                                    <option value="<?php echo $kel->jalur."-".$kel->id; ?>"><?php echo $kel->nama_kelas ?></option>
                                                                    <?php } ?>
                                                                </select><a href="<?php echo base_url('master/kelas'); ?>">Tambah Kelas</a></p>
                                                                PILIH JALUR :
                                                            <p><select id="jalur" name="jalur" class="form-control"  required="">
                                                                </select></p>
                                                                <div id="kerdiv" hidden="">
                                                                    JENIS KERJASAMA (JIKA JALUR KERJSAMA) :
                                                                    <p><select id="kerjasama" name="kerjasama" class="form-control">
                                                                        </select></p>
                                                                </div>
                                                            <div id="skl_mou" hidden="">
                                                                <p id="mou_akfar"></p>
                                                            </div>
                                                          </div>
                                                          <div class="tab">
                                                                <div id="gel_text" hidden="">PILIH GELOMBANG :
                                                                    <p><select name="gelombang" id="gelombang" class="form-control" required="">
                                                                        
                                                                    <?php foreach($gelombang as $g){?>
                                                                        <option value="<?php echo $g->nama_gel ?>"><?php echo $g->nama_gel_long ?></option>
                                                                    <?php } ?>
                                                                    </select></p>
                                                                </div>
                                                                <div id="pmdp_text" hidden="">
                                                                    NILAI RATA - RATA SEMESTER 1 :
                                                                    <p><input type="number" placeholder="NILAI RATA - RATA SEMESTER 1" name="smt1" required=""></select></p>
                                                                    NILAI RATA - RATA SEMESTER 2 :
                                                                    <p><input type="number" placeholder="NILAI RATA - RATA SEMESTER 2" name="smt2" required=""></select></p>
                                                                    NILAI RATA - RATA SEMESTER 3 :
                                                                    <p><input type="number" placeholder="NILAI RATA - RATA SEMESTER 3" name="smt3" required=""></select></p>
                                                                    NILAI RATA - RATA SEMESTER 4 :
                                                                    <p><input type="number" placeholder="NILAI RATA - RATA SEMESTER 4" name="smt4" required=""></select></p>
                                                                    NILAI RATA - RATA SEMESTER 5 :
                                                                    <p><input type="number" placeholder="NILAI RATA - RATA SEMESTER 5" name="smt5" required=""></select></p>
                                                                    SERTIFIKAT JUARA :
                                                                    <p><input type="file" name="file1"></select></p>
                                                                    <p><input type="text" name="ket1" placeholder="Keterangan Sertifikat"></select></p>
                                                                    SERTIFIKAT JUARA :
                                                                    <p><input type="file" name="file2"></select></p>
                                                                    <p><input type="text" name="ket2" placeholder="Keterangan Sertifikat"></select></p>
                                                                    SERTIFIKAT JUARA :
                                                                    <p><input type="file" name="file3"></select></p>
                                                                    <p><input type="text" name="ket3" placeholder="Keterangan Sertifikat"></select></p>
                                                                </div>
                                                                JENIS PENDAFTARAN : 
                                                                <p><select name="pendaftaran" class="form-control" required="">
                                                                        <option value="1">Peserta Didik Baru</option>
                                                                    </select></p>Program Studi 1 :
                                                                    <p><select name="pilihan1" class="form-control" required="">
                                                                    <option value="opt1" selected="" disabled="">- Pilih Program Studi 1 -</option>
                                                                    <?php foreach($prodi as $p){?>
                                                                    <option value="<?php echo $p->id ?>"><?php echo $p->jenjang." - ".$p->nama_jurusan ?></option>
                                                                    <?php } ?>
                                                                </select></p>Program Studi 2 :
                                                                <p><select name="pilihan2" class="form-control" required="">
                                                                    <option value="opt1" selected="" disabled="">- Pilih Program Studi 1 -</option>
                                                                    <?php foreach($prodi as $p){?>
                                                                    <option value="<?php echo $p->id ?>"><?php echo $p->jenjang." - ".$p->nama_jurusan ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                </p>
                                                          </div>
                                                          <div class="tab">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    Nomor KTP :
                                                                    <p><input type="number" class="form-control" placeholder="Nomor KTP" oninput="this.className = ''" name="ktp" required=""></p>
                                                                    NISN :
                                                                    <p><input type="number" class="form-control" placeholder="NISN" oninput="this.className = ''" name="nisn" required="">
                                                                    Tidak Tahu NISN anda? <a href="https://nisn.data.kemdikbud.go.id/page/data" target="_blank">cek DISINI</a></p>
                                                                    Nama Lengkap :
                                                                    <p><input type="text" class="form-control" placeholder="Nama Lengkap" oninput="this.className = ''" name="nama" required=""></p>
                                                                    Jenis Kelamin :
                                                                    <p>
                                                                        <select name="jk" class="form-control" required="">
                                                                            <option selected="" disabled="">Jenis Kelamin</option>
                                                                            <option value="1">Laki - Laki</option>
                                                                            <option value="2">Perempuan</option>
                                                                        </select>
                                                                    </p>
                                                                    Agama :
                                                                    <p>
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
                                                                    </p>
                                                                    Nama Ibu :
                                                                    <p><input type="text" class="form-control" placeholder="Nama Ibu" oninput="this.className = ''" name="ibu" required=""></p>
                                                                    Nama Ayah :
                                                                    <p><input type="text" class="form-control" placeholder="Nama Ayah" oninput="this.className = ''" name="ayah" required=""></p>
                                                                    Nomor HP Orang Tua :
                                                                    <p><input type="text" class="form-control" placeholder="Nomor HP Orang Tua" oninput="this.className = ''" name="hp_ortu" required=""></p>
                                                                    Alamat Semarang :
                                                                    <p><textarea class="form-control" style="resize: none;" name="alamat_semarang" placeholder="Alamat Semarang" required="" ></textarea></p>
                                                                    Tinggi Badan :
                                                                    <p><input type="number" class="form-control" placeholder="Tinggi Badan" oninput="this.className = ''" name="tb" required=""></p>
                                                                    Berat Badan :
                                                                    <p><input type="number" class="form-control" placeholder="Berat Badan" oninput="this.className = ''" name="bb" required=""></p>
                                                                    Tempat Lahir :
                                                                    <p><input type="text" class="form-control" placeholder="Tempat Lahir" oninput="this.className = ''" name="tl" required=""></p>
                                                                    Tanggal Lahir :
                                                                    <p><input type="date" class="form-control" oninput="this.className = ''" name="tgl" required=""></p>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    Nomor Handphone :
                                                                    <p><input type="text" class="form-control" placeholder="No Handphone" oninput="this.className = ''" name="hp" required=""></p>
                                                                    Nomor Telepon :
                                                                    <p><input type="text" class="form-control" placeholder="Nomor Telepon" oninput="this.className = ''" name="telepon" required=""></p>
                                                                    Status Warga Negara :
                                                                    <p>
                                                                        <select name="warga_negara" id="wn" class="form-control" required="">
                                                                            <option selected="" disabled="">Pilih Warga Negara</option>
                                                                            <?php foreach($warga_negara as $w){?>
                                                                            <option value="<?php echo $w->id_negara?>"><?php echo $w->nm_negara ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </p>
                                                                    Nama Provinsi :
                                                                    <p>
                                                                        <select name="provinsi" id="provinsi" class="form-control" required="">
                                                                            <option selected="" disabled="">Pilih Provinsi</option>
                                                                            <?php foreach($wilayah as $w){?>
                                                                            <option value="<?php echo $w->id_wil ?>"><?php echo $w->nm_wil ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </p>
                                                                    Nama Kota/Kabupaten :
                                                                    <p>
                                                                        <select name="kotakab" id="kotakab" class="form-control" required=""> 
                                                                            <option selected="" disabled="">Pilih Kota/Kabupaten</option>
                                                                        </select>
                                                                    </p>
                                                                    Nama Kecamatan :
                                                                    <p>
                                                                        <select name="kecamatan" id="kecamatan" class="form-control" required="">
                                                                            <option selected="" disabled="">Daftar Kecamatan</option>
                                                                        </select>
                                                                    </p>
                                                                    Kode POS :
                                                                    <p><input type="text" class="form-control" placeholder="KODE POS" oninput="this.className = ''" name="pos" required=""></p>
                                                                    Nama Kelurahan :
                                                                    <p><input type="text" class="form-control" placeholder="Nama Kelurahan" oninput="this.className = ''" name="kelurahan" required=""></p>
                                                                    Alamat :
                                                                    <p><textarea class="form-control" style="resize: none;" name="alamat" placeholder="Hanya nama kampung, jalan dan nomor rumah saja" required="" ></textarea></p>
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            RT :
                                                                            <p><input type="text" class="form-control" placeholder="RT" oninput="this.className = ''" name="rt" required=""></p>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            RW :
                                                                            <p><input type="text" class="form-control" placeholder="RW" oninput="this.className = ''" name="rw" required=""></p>
                                                                        </div>
                                                                    </div>
                                                                    Sekolah Asal :
                                                                    <p><select name="asal_sekolah" id="asal_sekolah" class="form-control js-example-basic-single" required="">
                                                                    </select></p>
                                                                </div>
                                                            </div>
                                                          </div>
                                                          <div class="tab">
                                                              <div class="row">
                                                                  <div class="col-sm-6">
                                                                      Dapat Info PMB darimana?
                                                                      <p>
                                                                          <select name="info_pmb" class="form-control" required="">
                                                                            <option value="opt1" selected="" disabled="">- Pilih -</option>
                                                                            <option value="1">Teman</option>
                                                                            <option value="2">Kerabat / Orang Tua</option>
                                                                            <option value="3">Sosial Media</option>
                                                                            <option value="4">Lainnya</option>
                                                                          </select>
                                                                      </p>
                                                                  </div>
                                                                  <div class="col-sm-6">
                                                                      Upload Foto :
                                                                      <p><input type='file' name="foto" onchange="readURL(this);" />
                                                                        Maksimal 1 MB dengan background merah.</p>
                                                                      <img id="blah" src="http://placehold.it/180" alt="your image" style="width:225px;height:280px;" />
                                                                      <br><br><br>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <div style="overflow:auto;">
                                                            <div style="float:right;">
                                                              <button type="button" id="prevBtn" onclick="nextPrev(-1)">Sebelumnya</button>
                                                              <button type="button" id="nextBtn" onclick="nextPrev(1)">Selanjutnya</button>
                                                            </div>
                                                          </div>
                                                          <!-- Circles which indicates the steps of the form: -->
                                                          <div style="text-align:center;margin-top:40px;">
                                                            <span class="step"></span>
                                                            <span class="step"></span>
                                                            <span class="step"></span>
                                                            <span class="step"></span>
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
                                    function readURL(input) {
                                        if (input.files && input.files[0]) {
                                            var reader = new FileReader();

                                            reader.onload = function (e) {
                                                $('#blah')
                                                    .attr('src', e.target.result);
                                            };

                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }
                                    var currentTab = 0; // Current tab is set to be the first tab (0)
                                    showTab(currentTab); // Display the current tab

                                    function showTab(n) {
                                      // This function will display the specified tab of the form...
                                      var x = document.getElementsByClassName("tab");
                                      x[n].style.display = "block";
                                      //... and fix the Previous/Next buttons:
                                      if (n == 0) {
                                        document.getElementById("prevBtn").style.display = "none";
                                      } else {
                                        document.getElementById("prevBtn").style.display = "inline";
                                      }
                                      if (n == (x.length - 1)) {
                                        document.getElementById("nextBtn").innerHTML = "Simpan";
                                      } else {
                                        document.getElementById("nextBtn").innerHTML = "Selanjutnya";
                                      }
                                      //... and run a function that will display the correct step indicator:
                                      fixStepIndicator(n)
                                    }

                                    function nextPrev(n) {
                                      // This function will figure out which tab to display
                                      var x = document.getElementsByClassName("tab");
                                      // Exit the function if any field in the current tab is invalid:
                                      if (n == 1 && !validateForm()) return false;
                                      // Hide the current tab:
                                      x[currentTab].style.display = "none";
                                      // Increase or decrease the current tab by 1:
                                      currentTab = currentTab + n;
                                      // if you have reached the end of the form...
                                      if (currentTab >= x.length) {
                                        // ... the form gets submitted:
                                        document.getElementById("regForm").submit();
                                        return false;
                                      }
                                      // Otherwise, display the correct tab:
                                      showTab(currentTab);
                                    }

                                    function validateForm() {
                                      // This function deals with validation of the form fields
                                      var x, y, i, valid = true;
                                      x = document.getElementsByClassName("tab");
                                      y = x[currentTab].getElementsByTagName("input");
                                      // A loop that checks every input field in the current tab:
                                      for (i = 0; i < y.length; i++) {
                                        // If a field is empty...
                                        if (y[i].value == "") {
                                          // add an "invalid" class to the field:
                                          y[i].className += " invalid";
                                          // and set the current valid status to false
                                          valid = true;
                                        }
                                      }
                                      // If the valid status is true, mark the step as finished and valid:
                                      if (valid) {
                                        document.getElementsByClassName("step")[currentTab].className += " finish";
                                      }
                                      return valid; // return the valid status
                                    }

                                    function fixStepIndicator(n) {
                                      // This function removes the "active" class of all steps...
                                      var i, x = document.getElementsByClassName("step");
                                      for (i = 0; i < x.length; i++) {
                                        x[i].className = x[i].className.replace(" active", "");
                                      }
                                      //... and adds the "active" class on the current step:
                                      x[n].className += " active";
                                    }
                                        $(document).ready(function(){
                                            $('#kelas').change(function(){
                                                var str = $(this).val();
                                                var str_explode = str.split('-');
                                                var kelas = str_explode[0];
                                                console.log(kelas);
                                                var isi = '';
                                                var data = '';
                                                if(kelas == 1){
                                                    isi = '<option value="opt1" selected="" disabled="">- Pilih Jalur -</option><option value="1">PMDP</option><option value="2">Kerjasama</option><option value="3">Umum</option>';
                                                }else if(kelas == 2){
                                                    isi = '<option value="opt1" selected="" disabled="">- Pilih Jalur -</option><option value="3">Umum</option><option value="2">Kerjasama</option>';
                                                }
                                                // $('#gelombang').html(data);
                                                $('#jalur').html(isi);
                                            });
                                            $('#jalur').change(function(){
                                                var pilihan = $(this).val();
                                                var get_kelas = $('#kelas').val();
                                                console.log(get_kelas);
                                                var str_explode = get_kelas.split('-');
                                                var kelas = str_explode[0];
                                                var hasil = '';
                                                if ((pilihan == 2) && (kelas == 1)) {
                                                    hasil = '<option value="opt1" selected="" disabled="">- Pilih Kerjasama -</option><option value="1">MOU AKFAR</option><option value="2">Alumni SMK Nusaputera</option>';
                                                    document.getElementById('kerdiv').hidden = false;
                                                    document.getElementById('skl_mou').hidden = false;
                                                }else if((pilihan == 2) && (kelas == 2)){
                                                    hasil = '<option value="opt1" selected="" disabled="">- Pilih Kerjasama -</option><option value="1">MOU AKFAR</option><option value="2">Alumni SMK Nusaputera</option><option value="3">PAFI</option><option value="4">Kimia Farma</option>';
                                                    document.getElementById('kerdiv').hidden = false;
                                                    document.getElementById('skl_mou').hidden = false;
                                                }else{
                                                    document.getElementById('kerdiv').hidden = true;
                                                    document.getElementById('skl_mou').hidden = true;
                                                }

                                                if (pilihan == 3) {
                                                    document.getElementById('gel_text').hidden = false;
                                                    document.getElementById('pmdp_text').hidden = true;
                                                }
                                                if (pilihan == 2) {
                                                    document.getElementById('gel_text').hidden = false;
                                                    document.getElementById('pmdp_text').hidden = true;
                                                }
                                                if(pilihan == 1){
                                                    document.getElementById('gel_text').hidden = true;
                                                    document.getElementById('pmdp_text').hidden = false;
                                                }
                                                if ((pilihan != 1) && (pilihan != 3) && (pilihan != 2)) {
                                                    document.getElementById('gel_text').hidden = true;
                                                    document.getElementById('pmdp_text').hidden = true;
                                                }
                                                $('#kerjasama').html(hasil);
                                            });
                                            $('#kerjasama').change(function(){
                                                var mou_val = $(this).val();
                                                var html = '';
                                                if (mou_val == 1) {
                                                    document.getElementById('skl_mou').hidden = false;
                                                    $.ajax({
                                                    url : "<?php echo base_url();?>pmb/daftar_mou/",
                                                    method: "POST",
                                                    data:{id:mou_val},
                                                    async: false,
                                                    dataType: "json",
                                                    success: function(data){
                                                            html += 'PILIH SEKOLAH : <p><select id="mou_akfar" name="nama_sekolah_mou" class="form-control">';
                                                        var i;
                                                        for (i = 0; i < data.length; i++) {
                                                            html += '<option value="'+ data[i].id_sekolah +'">'+data[i].nama_sekolah+'</option>';
                                                        }
                                                            html += '</select></p>';
                                                            
                                                        }
                                                    });
                                                }else{
                                                    document.getElementById('skl_mou').hidden = true;
                                                }
                                                $('#mou_akfar').html(html);
                                            });
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