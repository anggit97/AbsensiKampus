
          <h1>
            Daftar Mahasiswa
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"><i class="fa fa-book"></i> Daftar Mahasiswa</a></li>
          </ol>
       
		<hr>

    <a href="index.php?page=13" class="btn btn-primary btn-lg" style="margin-right:10px;float:right;"><i class="fa fa-arrow-circle-left"></i> Kembali</a>

		<h5><b><?php echo date("l, M Y"); ?></b></h5>
		<hr>

		<h5><b>Daftar Mahasiswa</b></h5>
		<p>Berikut ini adalah Form untuk menambah data matakuliah :
		</p>
		<br>

    <?php  
        $query = mysqli_query($conn,"SELECT * FROM matkul WHERE id_matkul='$id_matkul'");
        if ($query) {
          $rows = mysqli_fetch_array($query);
          
          $includes = array();
          for($i = 1 ; $i <= 7 ;$i++){
            $includes[] = "include".$i;
          }
          foreach ($includes as $key => $value) {
            ${$value} = "";
          }

          $hri = $rows['hari'];
          switch ($hri) {
            case 'Senin':
              $include1 = "selected";
              break;
            case 'Selasa':
              $include2 = "selected";
              break;
            case 'Rabu':
              $include3 = "selected";
              break;
            case 'Kamis':
              $include4 = "selected";
              break;
            case 'Jumat':
              $include5 = "selected";
              break;
            case 'Sabtu':
              $include6 = "selected";
              break;
            case 'Minggu':
              $include7 = "selected";
              break;
            default:
              foreach ($includes as $key => $value) {
                ${$value} = "";
              }
              break;
          }
        }else echo mysqli_error($conn);
    ?>

<!-- quick email widget -->
              <div class="box box-info">
                <div class="box-header">
                  <i class="fa fa-book"></i>
                  <h3 class="box-title">Data Matakuliah</h3>
                  <?php  
                   if (isset($_SESSION['pesan']) && $_SESSION['pesan'] != "") {
                     echo $_SESSION['pesan'];
                     unset($_SESSION['pesan']);
                   }else echo "";
                  ?>
                </div>
                <div class="box-body">
                  
                    <div class="form-group">
                      <label for="">ID Matakuliah : </label>
                      <input type="text" class="form-control" readonly="readonly" name="id_matkul" id="id_matkul" placeholder="ID Matakuliah" value="<?php echo $rows['id_matkul']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="">Nama Matakuliah : </label>
                      <input type="text" class="form-control" readonly="readonly" name="nm_matkul" id="nm_matkul" placeholder="Nama Matakuliah" value="<?php echo $rows['nm_matkul']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="">Hari : </label>
                      <select name="hari" id="hari" class="form-control" disabled>
                        <option value="" disabled selected>-- Pilih Hari --</option>
                        <option value="Senin" <?php echo $include1; ?>>Senin</option>
                        <option value="Selasa" <?php echo $include2; ?>>Selasa</option>
                        <option value="Rabu" <?php echo $include3; ?>>Rabu</option>
                        <option value="Kamis" <?php echo $include4; ?>>Kamis</option>
                        <option value="Jumat" <?php echo $include5; ?>>Jumat</option>
                        <option value="Sabtu" <?php echo $include6; ?>>Sabtu</option>
                        <option value="Minggu" <?php echo $include7; ?>>Minggu</option>
                      </select>
                    </div>
                    
                    <div class="form-group">
                      <label for="">Jam Mulai : </label>
                      <input type="time" class="form-control" readonly="readonly" name="jam_mulai" id="jam_mulai" placeholder="Jam Mulai" value="<?php echo $rows['jam_mulai']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="">Jam Selesai : </label>
                      <input type="time" class="form-control" readonly="readonly" name="jam_selesai" id="jam_selesai" placeholder="Jam Selesai" value="<?php echo $rows['jam_selesai']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="">Ruangan : </label>
                      <input type="text" class="form-control" readonly="readonly" name="ruang" id="ruang" placeholder="Ruangan" value="<?php echo $rows['ruangan']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="">Dosen Pengajar : </label>
                      <select name="dosen" id="dosen" class="form-control" disabled>
                        <option value="" selected disabled>-- Pilih Dosen --</option>
                        <?php  
                        $query = mysqli_query($conn,"SELECT * FROM dosen");
                        if ($query) {
                          while ($rowss = mysqli_fetch_array($query)) {
                            $selected = "";
                            if ($rows['nid'] == $rowss['nid']) {
                              $selected = "selected";
                            }
                        ?>
                        <option value="<?php echo $rowss['nid']; ?>" <?php echo $selected; ?>><?php echo $rowss['nid']; ?> - <?php echo $rowss['nm_dosen']; ?></option>
                        <?php                            
                          }
                        }
                        ?>
                      </select>
                    </div>
                    
                </div>
                
              </div>

             
              <div class="box box-info">
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
                <a href="index.php?page=15&&id_matkul=<?php echo $id_matkul; ?>" class="btn btn-primary btn-lg" style="float:right;margin-right:10px;margin-bottom:10px;"><i class="fa fa-plus"></i> Tambah Mahasiswa</a>

                <div class="box-body">
                  <table id="table" class="row-border" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Aksi</th>
                    </tfoot>
                    <tbody>
                    <?php  

                    $query = mysqli_query($conn,"SELECT a.*,b.* FROM detil_matkul a, mahasiswa b WHERE b.nim=a.nim AND a.id_matkul='$id_matkul' ORDER BY a.nim");
                    if ($query) {
                      $no = 1;
                      while ($rows = mysqli_fetch_array($query)) {
                    ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $rows['nim']; ?></td>
                        <td><?php echo $rows['nm_mhs']; ?></td>
                        <td><?php echo $rows['jk']; ?></td>
                        <td><a href="#" data-toggle="modal" data-target="#confirm-delete_<?php echo $rows['nim']; ?>" class="btn btn-primary">HAPUS</a></td>
                      </tr>

                      <div class="modal fade" id="confirm-delete_<?php echo $rows['nim'] ;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      Hapus Data Mahasiswa di Matakuliah ini
                                  </div>
                                  <div class="modal-body">
                                      Apakah anda yakin menghapus data Mahasiswa di Matakuliah ini?
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                      <a class="btn btn-danger btn-ok" id="<?php echo $rows['nim'] ;?>" href="../include/hapus_mhs_absen.php?nim=<?php echo $rows['nim']; ?>&&id_matkul=<?php echo $id_matkul; ?>&&id_detil=<?php echo $rows['id_detil']; ?>">Hapus</a>
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
      $('#table').DataTable();
  } );

  $(".btn btn-danger").click(function(e) {
    var id = $(this).attr('id');
    var modal_id = "confirm-edit_"+id;
    $("#"+modal_id).modal('hide');
  });
</script>

<?php 

  
  if (isset($_POST['simpan'])) {
    foreach ($_POST as $key => $value) {
      echo ${$key} = $value;
    }
    
    if ($id_matkul == "" || $nm_matkul == "" || $hari == "" || $jam_mulai == "" || $jam_selesai == "" || $ruang == "" || $dosen == "") {
      $_SESSION['pesan'] = "<div class='alert alert-danger' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Tidak Boleh Ada Field yang Kosong!
                              </div>";
      echo "<script>window.location = 'index.php?page=12&&id_matkul=$id_matkul'</script>";
    }else{
     
      $query = mysqli_query($conn,"UPDATE matkul SET nm_matkul='$nm_matkul',hari='$hari',jam_mulai='$jam_mulai',jam_selesai='$jam_selesai',ruangan='$ruang',nid='$dosen' WHERE id_matkul='$id_matkul'");
      if ($query) {
        $_SESSION['pesan'] = "<div class='alert alert-success' style='margin-top:5px;'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Berhasil Ubah Data Matakuliah!
                              </div>";
        echo "<script>window.location = 'index.php?page=12&&id_matkul=$id_matkul'</script>";
      }else{
        $_SESSION['pesan'] = "<div class='alert alert-danger' style='margin-top:5px;'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Gagal Ubah Data Matakuliah!
                              </div>";
        echo "<script>window.location = 'index.php?page=12&&id_matkul=$id_matkul'</script>";
      }
    }

  }

?>
