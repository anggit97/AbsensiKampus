
          <h1>
            Ubah Mahasiswa
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"><i class="fa fa-user"></i> Ubah Mahasiswa</a></li>
          </ol>
       
		<hr>

    <a href="index.php?page=7" class="btn btn-primary btn-lg" style="margin-right:10px;float:right;"><i class="fa fa-arrow-circle-left"></i> Kembali</a>

		<h5><b><?php echo date("l, M Y"); ?></b></h5>
		<hr>

		<h5><b>Ubah Mahasiswa</b></h5>
		<p>Berikut ini adalah Form untuk mengubah data Mahasiswa di universitas:
		</p>
		<br>

    <?php  

    $query = mysqli_query($conn,"SELECT * FROM mahasiswa WHERE nim='$nim'");
    if ($query) {
      $rows = mysqli_fetch_array($query);
      $selected1 = "";
      $selected2 = "";
      if ($rows['jk'] == "Pria") {
        $selected1 = "selected";
      }elseif($rows['jk'] == "Wanita"){
        $selected2 = "selected";
      }else{
        $selected1 = "";
        $selected2 = "";
      }
    }else echo mysqli_error($conn);

    ?>

<!-- quick email widget -->
              <div class="box box-info">
                <div class="box-header">
                  <i class="fa fa-user"></i>
                  <h3 class="box-title">Ubah Mahasiswa</h3>
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
                      <label for="">NIM : </label>
                      <input type="text" class="form-control" readonly="readonly" name="nim" id="nim" placeholder="NIM" value="<?php echo $rows['nim']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="">Nama : </label>
                      <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Mahasiswa" value="<?php echo $rows['nm_mhs']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="">Email : </label>
                      <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $rows['email']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="">Jenis Kelamin : </label>
                      <select name="jk" id="jk" class="form-control">
                        <option value="" disabled>-- Pilih Jenis Kelamin --</option>
                        <option value="Pria" <?php echo $selected1; ?>>Pria</option>
                        <option value="Wanita" <?php echo $selected2; ?>>Wanita</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="">Alamat : </label>
                      <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="3" placeholder="Alamat"><?php echo $rows['alamat_mhs']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="">No. Telp/HP : </label>
                      <input type="text" name="telp" id="telp" class="form-control" placeholder="No. HP/Telp" value="<?php echo $rows['telp_mhs']; ?>">
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
      ${$key} = $value;
    }
    
    if ($nim == "" || $nama == "" || $jk == "" || $alamat == "" || $telp == "" || $email == "") {
      $_SESSION['pesan'] = "<div class='alert alert-danger' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Tidak Boleh Ada Field yang Kosong!
                              </div>";
      echo "<script>window.location = 'index.php?page=9&&nim=$nim'</script>";
    }else{
      $query = mysqli_query($conn,"UPDATE mahasiswa SET nm_mhs='$nama',jk='$jk',alamat_mhs='$alamat',telp_mhs='$telp',email='$email' WHERE nim='$nim'");
      if ($query) {
        $_SESSION['pesan'] = "<div class='alert alert-success' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Berhasil Ubah Data Mahasiswa!
                              </div>";
        echo "<script>window.location = 'index.php?page=9&&nim=$nim'</script>";
      }else{
        $_SESSION['pesan'] = "<div class='alert alert-danger' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Gagal Ubah Data Mahasiswa!
                              </div>";
        echo "<script>window.location = 'index.php?page=9&&nim=$nim'</script>";
      }
    }

  }

?>
