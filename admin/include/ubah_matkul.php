
          <h1>
            Ubah Matakuliah
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"><i class="fa fa-book"></i> Ubah Matakuliah</a></li>
          </ol>
       
		<hr>

    <a href="index.php?page=10" class="btn btn-primary btn-lg" style="margin-right:10px;float:right;"><i class="fa fa-arrow-circle-left"></i> Kembali</a>

		<h5><b><?php echo date("l, M Y"); ?></b></h5>
		<hr>

		<h5><b>Ubah Matakuliah</b></h5>
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
                  <h3 class="box-title">Ubah Matakuliah</h3>
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
                      <input type="text" class="form-control" name="nm_matkul" id="nm_matkul" placeholder="Nama Matakuliah" value="<?php echo $rows['nm_matkul']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="">Hari : </label>
                      <select name="hari" id="hari" class="form-control">
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
                      <input type="time" class="form-control" name="jam_mulai" id="jam_mulai" placeholder="Jam Mulai" value="<?php echo $rows['jam_mulai']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="">Jam Selesai : </label>
                      <input type="time" class="form-control" name="jam_selesai" id="jam_selesai" placeholder="Jam Selesai" value="<?php echo $rows['jam_selesai']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="">Ruangan : </label>
                      <input type="text" class="form-control" name="ruang" id="ruang" placeholder="Ruangan" value="<?php echo $rows['ruangan']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="">Tahun Ajaran : </label>
                      <select name="ta" id="ta" class="form-control">
                        <option value="" disabled selected>-- Pilih Tahun Ajaran --</option>
                        <?php 
                        $i   = 0; 
                        $j   = 2007;
                        $k   = 2008;
                        $val = "";
                        while ($i < 10) {
                          $selecteds = "";
                          $val = $j."/".$k;
                          if ($val == $rows['tahun_ajaran']) {
                            $selecteds = "selected";
                          }
                        ?>
                        <option value="<?php echo $j."/".$k; ?>" <?php echo $selecteds; ?>><?php echo $j."/".$k; ?></option>
                        <?php
                        $i++;
                        $j++;
                        $k++;
                        }
                        ?>
                      </select>  
                    </div>
                    <div class="form-group">
                      <label for="">Dosen Pengajar : </label>
                      <select name="dosen" id="dosen" class="form-control">
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
                
                <div class="box-footer clearfix">
                  <button class="pull-right btn btn-primary" name="simpan">Simpan <i class="fa fa-arrow-circle-right"></i></button>
                  </form>
                </div>
              </div>

<?php 

  
  if (isset($_POST['simpan'])) {
    foreach ($_POST as $key => $value) {
      echo ${$key} = $value;
    }
    
    if ($id_matkul == "" || $nm_matkul == "" || $hari == "" || $jam_mulai == "" || $jam_selesai == "" || $ruang == "" || $dosen == "" || $ta == "") {
      $_SESSION['pesan'] = "<div class='alert alert-danger' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Tidak Boleh Ada Field yang Kosong!
                              </div>";
      echo "<script>window.location = 'index.php?page=12&&id_matkul=$id_matkul'</script>";
    }else{
     
      $query = mysqli_query($conn,"UPDATE matkul SET nm_matkul='$nm_matkul',hari='$hari',jam_mulai='$jam_mulai',jam_selesai='$jam_selesai',ruangan='$ruang',nid='$dosen',tahun_ajaran='$ta' WHERE id_matkul='$id_matkul'");
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
