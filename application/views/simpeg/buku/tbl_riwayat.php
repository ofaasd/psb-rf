<a href="#" id="add"  class="btn btn-primary waves-effect" data-toggle='modal' data-target='#tambah' onclick="">Tambah</a><br /><br /><br />
<table class="table table-striped table-bordered nowrap">
        <thead>
          <tr>
            <th>No.</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>ISBN</th>
            <th>Tahun</th>
            <th>Dokumen</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          foreach($riwayat as $row){
            echo "<tr>";
            echo "<td>" . $i . "</td>";
            echo "<td>" . $row->judul_buku . "</td>";
            echo "<td>" . $row->penulis . "</td>";
            echo "<td>" . $row->isbn . "</td>";
            echo "<td>" . $row->tahun . "</td>";
            echo "<td><a href='" . $row->link_dokumen . "'>" . $row->link_dokumen . "</a></td>";
            echo "<td><a href='#form-edit' id='edit' onclick='get_form_edit(" . $row->id . ")' ><i class=\"fa fa-pencil\"></i></a> &nbsp;&nbsp;&nbsp;<a href='#' id='delete' onclick='delete_pendidikan(" . $row->id . ")'><i class=\"fa fa-trash\"></i></a></td>";
            $i++;

          ?>
          <?php
          }
          ?>
        </tbody>
      </table>