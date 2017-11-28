
          <h1>
            Profil
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"><i class="fa fa-user"></i> Profil</a></li>
          </ol>
       
		<hr>

		<h5><b><?php echo date("l, M Y"); ?></b></h5>
		<hr>

		<h5><b>Ganti Password</b></h5>
		<p>Berikut ini adalah data Anda yang terdaftar di database Universitas Budi Luhur:
		</p>
		<br>

<!-- quick email widget -->
              <div class="box box-info">
                <div class="box-header">
                  <i class="fa fa-user"></i>
                  <h3 class="box-title">Ubah Password</h3>
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
                      <input type="password" class="form-control" name="password_lama" id="password_lama" placeholder="Password Lama">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" name="password_baru" id="password_baru" placeholder="Password Baru">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" name="retype_password_baru" id="retype_password_baru" placeholder="Ulangi Password Baru">
                    </div>
                    <div class="form-group">
	                	<font color="red">*Biarkan Password kosong jika tidak ingin mengubahnya</font>
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
    
    if ($password_lama == "" || $password_baru == "" || $retype_password_baru == "") {
      $_SESSION['pesan'] = "<div class='alert alert-danger' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Tidak Boleh Ada Field yang Kosong!
                              </div>";
      echo "<script>window.location = 'index.php?page=3'</script>";
    }elseif (!password_verify($password_lama,$data['password'])){
      $_SESSION['pesan'] = "<div class='alert alert-danger' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Password Lama tidak sesuai dengan Inputan!
                              </div>";
      echo "<script>window.location = 'index.php?page=3'</script>";
    }elseif ($password_baru != $retype_password_baru) {
      $_SESSION['pesan'] = "<div class='alert alert-danger' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Password Baru tidak sesuai dengan konfirmasi password!
                              </div>";
      echo "<script>window.location = 'index.php?page=3'</script>";
    }else{
      $cost = 10;
      $hash = password_hash($password_baru, PASSWORD_BCRYPT, ["cost" => $cost]);
      $sqli = mysqli_query($conn, "UPDATE dosen SET password='$hash' WHERE nid='$nid'");
      if ($sqli) {
        $_SESSION['pesan'] = "<div class='alert alert-success' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Berhasil ubah passaword!
                              </div>";
        echo "<script>window.location = 'index.php?page=3'</script>";
      }else{
        echo "<script>alert('Gagal ubah Password')</script>";
        $_POST['pesan'] = "Gagal";
      } 
    }

  }

?>
