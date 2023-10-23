<a href="#" id="add"  class="btn btn-primary waves-effect" data-toggle='modal' data-target='#tambah' onclick="">Tambah</a><br /><br /><br />
      <table class="table table-striped table-bordered nowrap">
        <thead>
          <tr>
            <th>No.</th>
            <th>Judul</th>
            <th>Nama Majalah</th>
            <th>Volume</th>
            <th>Nomor</th>
            <th>Bulan</th>
            <th>Tahun</th>
            <th>Link Url</th>
            <th>File</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          foreach($riwayat as $row){
            echo "<tr>";
            echo "<td>" . $i . "</td>";
            echo "<td>" . $row->judul . "</td>";
            echo "<td>" . $row->nama_majalah . "</td>";
            echo "<td>" . $row->volume . "</td>";
            echo "<td>" . $row->nomor . "</td>";
            echo "<td>" . $row->bulan . "</td>";
            echo "<td>" . $row->tahun . "</td>";
            echo "<td><a href='" . $row->link_url . "'>" . $row->link_url . "</a></td>";
            echo "<td>";
            if(!empty($row->file)){
              if(substr($row->file, -3) == "pdf"){
                echo "<a href='" . base_url() . "assets/images/karyailmiah/".$row->file . "' target='_blank' title='dokumen'><i class=\"fa fa-file-pdf-o\"></i></a>";
              }else{
                echo "<a href='" . base_url() . "assets/images/karyailmiah/".$row->file . "' target='_blank' title='dokumen'><i class=\"fa fa-file-image-o\" ></i></i></a>";
              }
            }
            echo "</td>";
            echo "<td><a href='#form-edit' id='edit' onclick='get_form_edit(" . $row->id . ")' ><i class=\"fa fa-pencil\"></i></a> &nbsp;&nbsp;&nbsp;<a href='#' id='delete' onclick='delete_pendidikan(" . $row->id . ")'><i class=\"fa fa-trash\"></i></a></td>";
            $i++;

          ?>
          <?php
          }
          ?>
        </tbody>
      </table>