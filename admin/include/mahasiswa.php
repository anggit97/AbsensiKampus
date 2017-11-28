
          <h1>
            Mahasiswa
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"><i class="fa fa-user"></i> Mahasiswa</a></li>
          </ol>
       
		<hr>

		<h5><b><?php echo date("l, M Y"); ?></b></h5>
		<hr>

        <a href="index.php?page=8" class="btn btn-primary btn-lg" style="margin-right:10px;float:right;"><i class="fa fa-plus"></i> Tambah Mahasiswa</a>

		<h5><b>Daftar Mahasiswa</b></h5>
		<p>Berikut ini adalah daftar Mahasiswa yang terdaftar di database universitas : 
		</p>
		<br>

<div class="box">
    <div class="box-header">
        <i class="fa fa-user"></i>
        <h3 class="box-title">Daftar Mahasiswa</h3>
        <?php  
            if (isset($_SESSION['pesan']) && $_SESSION['pesan'] != "") {
                echo $_SESSION['pesan'];
                unset($_SESSION['pesan']);
            }else echo "";
        ?>
    </div>
    <div class="box-body">
        <table id="dosen" class="row-border" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>JK</th>
                        <th>Alamat</th>
                        <th>Telp/Hp</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>JK</th>
                        <th>Alamat</th>
                        <th>Telp/Hp</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                <?php  
                $query = mysqli_query($conn,"SELECT * FROM mahasiswa");
                if ($query) {
                    $no = 1;
                    while ($rows = mysqli_fetch_array($query)) {
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $rows['nim']; ?></td>
                        <td><?php echo $rows['nm_mhs']; ?></td>
                        <td><?php echo $rows['jk']; ?></td>
                        <td><?php echo $rows['alamat_mhs']; ?></td>
                        <td><?php echo $rows['telp_mhs']; ?></td>
                        <td><?php echo $rows['email']; ?></td>
                        <td><a href="index.php?page=9&&nim=<?php echo $rows['nim']; ?>">UBAH</a> | <a href="#" data-toggle="modal" data-target="#confirm-delete_<?php echo $rows['nim']; ?>">HAPUS</a></td>
                    </tr>

                    <div class="modal fade" id="confirm-delete_<?php echo $rows['nim'] ;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    Hapus Data Dosen
                                </div>
                                <div class="modal-body">
                                    Apakah anda yakin menghapus data Dosen ini?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                    <a class="btn btn-danger btn-ok" id="<?php echo $rows['nim'] ;?>" href="../include/hapus_mhs.php?nim=<?php echo $rows['nim']; ?>">Hapus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                }
                ?>
                </tbody>
            </table>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#dosen').DataTable();
    } );

    $(".btn btn-danger").click(function(e) {
      var id = $(this).attr('id');
      var modal_id = "confirm-delete_"+id;
      $("#"+modal_id).modal('hide');
    });

    
</script>