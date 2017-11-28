
          <h1>
            Tambah Matakuliah
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"><i class="fa fa-user"></i> Tambah Matakuliah</a></li>
          </ol>
       
		<hr>

    <a href="index.php?page=10" class="btn btn-primary btn-lg" style="margin-right:10px;float:right;"><i class="fa fa-arrow-circle-left"></i> Kembali</a>

		<h5><b><?php echo date("l, M Y"); ?></b></h5>
		<hr>

		<h5><b>Tambah Matakuliah</b></h5>
		<p>Berikut ini adalah Form untuk menambah data matakuliah :
		</p>
		<br>

    <?php  
        $query="select * from matkul order by id_matkul desc limit 1";
        $baris=mysqli_query($conn,$query);
        if($baris){
          if(mysqli_num_rows($baris)>0){
            $auto=mysqli_fetch_array($baris);
            $kode=$auto['id_matkul'];
            $baru=substr($kode,2,4);
            $nol=(int)$baru;
          } 
          else{
            $nol=0;
            }
          $nol=$nol+1;
          $nol2="";
          $nilai=3-strlen($nol);
          for ($i=1;$i<=$nilai;$i++){
            $nol2= $nol2."0";
            }

            $kode2 ="KP".$nol2.$nol;
            
        }
        else{
        echo mysqli_error();
        }

    ?>

<!-- quick email widget -->
              <div class="box box-info">
                <div class="box-header">
                  <i class="fa fa-user"></i>
                  <h3 class="box-title">Tambah Matakuliah</h3>
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
                      <input type="text" class="form-control" readonly="readonly" name="id_matkul" id="id_matkul" placeholder="ID Matakuliah" value="<?php echo $kode2; ?>">
                    </div>
                    <div class="form-group">
                      <label for="">Nama Matakuliah : </label>
                      <input type="text" class="form-control" name="nm_matkul" id="nm_matkul" placeholder="Nama Matakuliah">
                    </div>
                    <div class="form-group">
                      <label for="">Hari : </label>
                      <select name="hari" id="hari" class="form-control">
                        <option value="" disabled selected>-- Pilih Hari --</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                        <option value="Minggu">Minggu</option>
                      </select>
                    </div>
                    
                    <div class="form-group">
                      <label for="">Jam Mulai : </label>
                      <input type="time" class="form-control" name="jam_mulai" id="jam_mulai" placeholder="Jam Mulai">
                    </div>
                    <div class="form-group">
                      <label for="">Jam Selesai : </label>
                      <input type="time" class="form-control" name="jam_selesai" id="jam_selesai" placeholder="Jam Selesai">
                    </div>
                    <div class="form-group">
                      <label for="">Ruangan : </label>
                      <input type="text" class="form-control" name="ruang" id="ruang" placeholder="Ruangan">
                    </div>
                    <div class="form-group">
                      <label for="">Tahun Ajaran : </label>
                      <select name="ta" id="ta" class="form-control">
                        <option value="" disabled selected>-- Pilih Tahun Ajaran --</option>
                        <?php 
                        $i   = 0; 
                        $j   = 2007;
                        $k   = 2008;
                        while ($i < 10) {
                        ?>
                        <option value="<?php echo $j."/".$k; ?>"><?php echo $j."/".$k; ?></option>
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
                          while ($rows = mysqli_fetch_array($query)) {
                        ?>
                        <option value="<?php echo $rows['nid']; ?>"><?php echo $rows['nid']; ?> - <?php echo $rows['nm_dosen']; ?></option>
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
    
    if ($id_matkul == "" || $nm_matkul == "" || $hari == "" || $jam_mulai == "" || $jam_selesai == "" || $ruang == "" || $dosen == "") {
      $_SESSION['pesan'] = "<div class='alert alert-danger' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Tidak Boleh Ada Field yang Kosong!
                              </div>";
      echo "<script>window.location = 'index.php?page=11'</script>";
    }else{
     
      $query = mysqli_query($conn,"INSERT INTO matkul VALUES('$id_matkul','$nm_matkul','$hari','$jam_mulai','$jam_selesai','$ruang','$ta','$dosen')");
      if ($query) {
        $_SESSION['pesan'] = "<div class='alert alert-success' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Berhasil Tambah Data Matakuliah!
                              </div>";
        echo "<script>window.location = 'index.php?page=11'</script>";
      }else{
        $_SESSION['pesan'] = "<div class='alert alert-danger' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Gagal Tambah Data Matakuliah!
                              </div>";
        echo "<script>window.location = 'index.php?page=11'</script>";
      }
    }

  }

?>
