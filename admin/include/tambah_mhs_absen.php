    <style type="text/css">
    .dropdown-menu{
      width: 100%;
    }
    </style>
    <?php  
    $query = mysqli_query($conn,"SELECT * FROM matkul WHERE id_matkul='$id_matkul'");
    if ($query) {
      $rows = mysqli_fetch_array($query);
    }else echo mysqli_error($conn);
    ?>


          <h1>
            Tambah Mahasiswa 
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"><i class="fa fa-book"></i> Tambah Mahasiswa</a></li>
          </ol>
       
		<hr>

    <a href="index.php?page=14&&id_matkul=<?php echo $id_matkul; ?>" class="btn btn-primary btn-lg" style="margin-right:10px;float:right;"><i class="fa fa-arrow-circle-left"></i> Kembali</a>

		<h5><b><?php echo date("l, M Y"); ?></b></h5>
		<hr>

		<h5><b>Tambah Mahasiswa</b></h5>
		<p>Berikut ini adalah Form untuk menambah data mahasiswa :
		</p>
		<br>




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
                  <form action="" method="post">
                    <div class="form-group">
                      <label for="">ID Matakuliah : </label>
                      <input type="text" class="form-control" readonly="readonly" name="id_matkul" id="id_matkul" placeholder="ID Matakuliah" value="<?php echo $rows['id_matkul']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="">Nama Matakuliah : </label>
                      <input type="text" class="form-control" readonly="readonly" name="nm_matkul" id="nm_matkul" placeholder="Nama Matakuliah" value="<?php echo $rows['nm_matkul']; ?>">
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

                    <div class="form-group">
                      <label for="">Pilih Mahasiswa : </label>
                      <select name="mhs" id="mhs" class="combobox form-control">
                        <option value="" selected disabled>-- Pilih Mahasiswa --</option>
                        <?php  
                        $query = mysqli_query($conn,"SELECT * FROM mahasiswa");
                        if ($query) {
                          while ($rowss = mysqli_fetch_array($query)) {
                        ?>
                        <option value="<?php echo $rowss['nim']; ?>"><?php echo $rowss['nim']; ?> - <?php echo $rowss['nm_mhs']; ?></option>
                        <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                    
                </div>
                <div class="box-footer clearfix">
                  <button class="pull-right btn btn-primary" name="simpan">Simpan <i class="fa fa-arrow-circle-right"></i></button>
                  </form>
                </div>
              </div>

<script type="text/javascript">
  $(document).ready(function(){
    $('.combobox').combobox();
  });
</script>

<?php  

if (isset($_POST['simpan'])) {
    foreach ($_POST as $key => $value) {
      ${$key} = $value;
    }
    
    if ($mhs == "" ) {

      $_SESSION['pesan'] = "<div class='alert alert-danger' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Mahasiswa harus dipilih!
                              </div>";
      echo "<script>window.location = 'index.php?page=15&&id_matkul=$id_matkul'</script>";

    }else{

      $check = 0;
      $query_c = mysqli_query($conn,"SELECT * FROM detil_matkul WHERE id_matkul='$id_matkul'");
      if ($query_c) {
        if (mysqli_num_rows($query_c)>0) {
          while ($rows_c = mysqli_fetch_array($query_c)) {
            if ($rows_c['nim'] == $mhs) {
              $check = 1;
              break;
            }
          }
        }
      }else echo mysqli_error($conn);

      
      if ($check == 1) {
        $_SESSION['pesan'] = "<div class='alert alert-danger' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Anda sudah memilih mahasiswa ini sebelumnya untuk matakuliah ini, Pilih Mahasiswa Lain!
                              </div>";
        echo "<script>window.location = 'index.php?page=15&&id_matkul=$id_matkul'</script>";
      }else{
        $query = mysqli_query($conn,"INSERT INTO detil_matkul VALUES(null,'$id_matkul','$mhs')");
        if ($query) {
          $_SESSION['pesan'] = "<div class='alert alert-success' style='margin-top:5px;'>
                                  <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                  Berhasil Tambah Data Mahasiswa Ke Matakuliah!
                                </div>";
          echo "<script>window.location = 'index.php?page=15&&id_matkul=$id_matkul'</script>";
        }else{
          $_SESSION['pesan'] = "<div class='alert alert-danger' style='margin-top:5px;'>
                                  <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                  Gagal Tambah Data Mahasiswa Ke Matakuliah!
                                </div>";
          echo "<script>window.location = 'index.php?page=15&&id_matkul=$id_matkul'</script>";
        }
      }
    }

  }

?>
     

