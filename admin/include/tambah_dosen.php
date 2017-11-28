
          <h1>
            Tambah Dosen
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"><i class="fa fa-user"></i> Tambah Dosen</a></li>
          </ol>
       
		<hr>

    <a href="index.php?page=4" class="btn btn-primary btn-lg" style="margin-right:10px;float:right;"><i class="fa fa-arrow-circle-left"></i> Kembali</a>

		<h5><b><?php echo date("l, M Y"); ?></b></h5>
		<hr>

		<h5><b>Tambah Dosen</b></h5>
		<p>Berikut ini adalah Form untuk menambah data dosen di universitas:
		</p>
		<br>

<!-- quick email widget -->
              <div class="box box-info">
                <div class="box-header">
                  <i class="fa fa-user"></i>
                  <h3 class="box-title">Tambah Dosen</h3>
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
                      <label for="">NID : </label>
                      <input type="text" class="form-control" name="nid" id="nid" placeholder="NID">
                    </div>
                    <div class="form-group">
                      <label for="">Nama : </label>
                      <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Dosen">
                    </div>
                    <div class="form-group">
                      <label for="">Email : </label>
                      <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <label for="">Jenis Kelamin : </label>
                      <select name="jk" id="jk" class="form-control">
                        <option value="" selected disabled>-- Pilih Jenis Kelamin --</option>
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="">Alamat : </label>
                      <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="3" placeholder="Alamat"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="">No. Telp/HP : </label>
                      <input type="text" name="telp" id="telp" class="form-control" placeholder="No. HP/Telp">
                    </div>
                    <div class="form-group">
                      <label for="">Password </label>
                      <input type="password" name="pass" id="pass" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label for="">Konfirmasi Password </label>
                      <input type="password" name="con_pass" id="con_pass" class="form-control" placeholder="Konfirmasi Password">
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
    
    if ($nid == "" || $nama == "" || $jk == "" || $alamat == "" || $telp == "" || $pass == "" || $con_pass == "" || $email == "") {
      $_SESSION['pesan'] = "<div class='alert alert-danger' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Tidak Boleh Ada Field yang Kosong!
                              </div>";
      echo "<script>window.location = 'index.php?page=5'</script>";
    }elseif($pass != $con_pass){
      $_SESSION['pesan'] = "<div class='alert alert-danger' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Password tidak sesuai dengan konfirmasi password!
                              </div>";
      echo "<script>window.location = 'index.php?page=5'</script>";
    }else{
      $cost = 10;
      $hash = password_hash($pass, PASSWORD_BCRYPT, ["cost" => $cost]);
      $query = mysqli_query($conn,"INSERT INTO dosen (nid,nm_dosen,jk,alamat,telp_dosen,password,email)
        VALUES('$nid','$nama','$jk','$alamat','$telp','$hash','$email')");
      if ($query) {
        $_SESSION['pesan'] = "<div class='alert alert-success' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Berhasil Tambah Dosen!
                              </div>";
        echo "<script>window.location = 'index.php?page=5'</script>";
      }else{
        $_SESSION['pesan'] = "<div class='alert alert-danger' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Gagal Tambah Dosen!
                              </div>";
        echo "<script>window.location = 'index.php?page=5'</script>";
      }
    }

  }

?>
