<a href="#form-add" id="add"  class="btn btn-primary waves-effect" onclick="add_form()">Tambah</a> <br />
      <table class="table">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nomor/Judul</th>
            <th>Fakultas/Jenis Penelitian</th>
            <th>Tahun</th>
            <th>Sumber Dana</th>
            <th>Jumlah Dana</th>
            <th>No. Surat Perjanjian</th>
            <th>Penyelenggara</th>
            <th>Lampiran</th>
            <th>Anggota</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          foreach($riwayat as $row){
            echo "<tr>";
            echo "<td>" . $i . "</td>";
            echo "<td>" . $row->nomor . " " . $row->judul . "</td>";
            echo "<td>" . $row->nama_fakultas . " " . $row->jenis_penelitian ."</td>";
            echo "<td>" . $row->tahun . "</td>";
            echo "<td>" . $row->sumber_dana . "</td>";
            echo "<td>" . $row->dana . "</td>";
            echo "<td>" . $row->no_surat . "</td>";
            echo "<td>" . $row->penyelenggara . "</td>";
            echo "<td align='left'>";
            if(!empty($row->dokumen)){
              if(substr($row->dokumen, -3) == "pdf"){
                echo "<a href='" . base_url() . "assets/images/penelitian/".$row->dokumen . "' target='_blank' title='dokumen'><i class=\"fa fa-file-pdf-o\"></i></a>";
              }else{
                echo "<a href='" . base_url() . "assets/images/penelitian/".$row->dokumen . "' target='_blank' title='dokumen'><i class=\"fa fa-file-image-o\" ></i></i></a>";
              }
            }
            echo "&nbsp;&nbsp;&nbsp;";
            if(!empty($row->proposal)){
              if(substr($row->proposal, -3) == "pdf"){
                echo "<a href='" . base_url() . "assets/images/penelitian/".$row->proposal . "' target='_blank' title='proposal'><i class=\"fa fa-file-pdf-o\"></i></a>";
              }else{
                echo "<a href='" . base_url() . "assets/images/penelitian/".$row->proposal . "' target='_blank' title='proposal'><i class=\"fa fa-file-image-o\" ></i></i></a>";
              }
            }
            echo "&nbsp;&nbsp;&nbsp;";
            if(!empty($row->lap_kemajuan)){
              if(substr($row->lap_kemajuan, -3) == "pdf"){
                echo "<a href='" . base_url() . "assets/images/penelitian/".$row->lap_kemajuan . "' target='_blank' title='Laporan Kemajuan'><i class=\"fa fa-file-pdf-o\"></i></a>";
              }else{
                echo "<a href='" . base_url() . "assets/images/penelitian/".$row->lap_kemajuan . "' target='_blank' title='Laporan Kemajuan'><i class=\"fa fa-file-image-o\" ></i></i></a>";
              }
            }
            echo "&nbsp;&nbsp;&nbsp;";  
            if(!empty($row->lap_keuangan)){
              if(substr($row->lap_keuangan, -3) == "pdf"){
                echo "<a href='" . base_url() . "assets/images/penelitian/".$row->lap_keuangan . "' target='_blank' title='Laporan Keuangan'><i class=\"fa fa-file-pdf-o\"></i></a>";
              }else{
                echo "<a href='" . base_url() . "assets/images/penelitian/".$row->lap_keuangan . "' target='_blank' title='Laporan Keuangan'><i class=\"fa fa-file-image-o\" ></i></i></a>";
              }
            }
            echo "&nbsp;&nbsp;&nbsp;";
            if(!empty($row->lap_akhir)){
              if(substr($row->lap_akhir, -3) == "pdf"){
                echo "<a href='" . base_url() . "assets/images/penelitian/".$row->lap_akhir . "' target='_blank' title='Laporan Akhir'><i class=\"fa fa-file-pdf-o\"></i></a>";
              }else{
                echo "<a href='" . base_url() . "assets/images/penelitian/".$row->lap_akhir . "' target='_blank' title='Laporan Akhir'><i class=\"fa fa-file-image-o\" ></i></i></a>";
              }
            }
            echo "<td>";
            echo "<ul>";
            echo "<li><a href='javascript:void(0)'>" . $row->nama_ketua . " (Ketua)</a></li>";
            $query = $this->db->query("select * from pegawai_anggota_penelitian where id_penelitian='" . $row->p_id . "'")->result();


            foreach($query as $anggota){

              if($anggota->jenis_anggota == 1){
                $pegawai = $this->db->query("select * from pegawai where id='" . $anggota->id_anggota . "'")->row();
                echo "<li><a href='javascript:void(0)'>" . $pegawai->nama . "(Anggota)</a></li>";
              }else{
                $mahasiswa = $this->db->query("select * from mahasiswa where id='" . $anggota->id_anggota . "'")->row();
                echo "<li><a href='javascript:void(0)'>" . $mahasiswa->nama . "(Anggota)</a></li>";
              }
              
            }
            echo "</ul>";
            echo "</td>";
            
            echo "<td><a href='#form-edit' id='edit' onclick='get_form_edit(" . $row->p_id . ")' ><i class=\"fa fa-pencil\"></i></a> &nbsp;&nbsp;&nbsp;<a href='#' id='delete' onclick='delete_pendidikan(" . $row->p_id . ")'><i class=\"fa fa-trash\"></i></a></td>";
            $i++;
            echo "</tr>";
          ?>
        
          <?php
          }
          ?>
        </tbody>
      </table>