<a href="#form-add" id="add"  class="btn btn-primary waves-effect" onclick="add_form()">Tambah</a> <br /><br /><br />
      <table class="table">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama Kegiatan</th>
            <th>Tahun</th>
            <th>Tempat</th>
            <th>Link</th>
            <th>Bukti Kegiatan</th>
            <th>Proposal Kegiatan</th>
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
            echo "<td>" . $row->nama_kegiatan . "</td>";
            echo "<td>" . $row->tahun . "</td>";
            echo "<td>" . $row->tempat . "</td>";
            echo "<td>" . $row->link_url . "</td>";
            echo "<td align='left'>";
            if(!empty($row->bukti)){
              if(substr($row->bukti, -3) == "pdf"){
                echo "<a href='" . base_url() . "assets/images/pengabdian/".$row->bukti . "' target='_blank' title='bukti'><i class=\"fa fa-file-pdf-o\"></i></a>";
              }else{
                echo "<a href='" . base_url() . "assets/images/pengabdian/".$row->bukti . "' target='_blank' title='bukti'><i class=\"fa fa-file-image-o\" ></i></i></a>";
              }
            }
            echo "&nbsp;&nbsp;&nbsp;";
            echo "</td>";
			echo "<td align='left'>";
            if(!empty($row->proposal)){
              if(substr($row->proposal, -3) == "pdf"){
                echo "<a href='" . base_url() . "assets/images/pengabdian/".$row->proposal . "' target='_blank' title='Proposal'><i class=\"fa fa-file-pdf-o\"></i></a>";
              }else{
                echo "<a href='" . base_url() . "assets/images/pengabdian/".$row->proposal . "' target='_blank' title='Proposal'><i class=\"fa fa-file-image-o\" ></i></i></a>";
              }
            }
            echo "&nbsp;&nbsp;&nbsp;";
            echo "</td>";
			echo "<td>";
            echo "<ul>";
            echo "<li><a href='javascript:void(0)'>" . $row->nama_ketua . " (Ketua)</a></li>";
            $query = $this->db->query("select * from pegawai_anggota_pengabdian where id_pengabdian='" . $row->p_id . "'")->result();


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