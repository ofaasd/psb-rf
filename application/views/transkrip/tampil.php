<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Transkrip / Daftar Nilai</h5>
                </div>
                <div class="card-block">
                    <table class="table table-stripped">
                        <tr>
                            <td>NIM</td>
                            <td>Nama Lengkap</td>
                            <td>Keperluan</td>
                        </tr>
                        <?php
                            foreach($biodata as $row){
                                echo "<tr>";
                                echo "<td>" . $row->nim . "</td>";
                                echo "<td>" . $row->nama . "</td>";
                                echo "<td><select>
                                        <option selected='' disabled=''> -- Keperluan -- </option>
                                        
                                </select></td>";
                                echo "</tr>";
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>