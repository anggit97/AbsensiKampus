      
          <h1>
            Data Handphone dan Email Dosen
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"><i class="fa fa-user"></i> Profil</a></li>
          </ol>
        
		<hr>

		<h5><b><?php echo date("l, M Y"); ?></b></h5>
		<hr>

		<h5><b>Data Handphone dan Email Dosen</b></h5>
		<p>Berikut ini adalah data Anda yang terdaftar di database Universitas Budi Luhur:
		</p>
		<br>

<!-- quick email widget -->
              <div class="box box-info">
                <div class="box-header">
                  <i class="fa fa-user"></i>
                  <h3 class="box-title">Data Handphone dan Email Mahasiswa</h3>
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
                      <span><b>NID : </b></span>
                      <input type="text" class="form-control" name="nid" value="<?php echo $data['nid']; ?>" disabled>
                    </div>
                    <div class="form-group">
                      <span><b>NAMA LENGKAP : </b></span>
                      <input type="text" class="form-control" name="nama" value="<?php echo $data['nm_dosen']; ?>" disabled>
                    </div>
                    <div class="form-group">
                      <span><b>Alamat : </b></span> 
                      <input type="text" class="form-control" name="alamat" value="<?php echo $data['alamat']; ?>">
                    </div>
                    <div class="form-group">
                      <span><b>Email :  </b></span> 
                      <input type="email" class="form-control" name="email" value="<?php echo $data['email']; ?>">
                    </div>
                    <div class="form-group">
	                	<font color="red">*Biarkan Password kosong jika tidak ingin mengubahnya</font>
	                </div>
                  
                </div>
                
                <div class="box-footer clearfix">
                  <button class="pull-right btn btn-primary" id="sendEmail" name="simpan">Simpan <i class="fa fa-arrow-circle-right"></i></button>
                </div>
                </form>
              </div>
    

<?php 
  $pesan = ""; 
  if (isset($_POST['simpan'])) {
    foreach ($_POST as $key => $value) {
      ${$key} = $value;
    }
    
    $sqli  = mysqli_query($conn,"UPDATE dosen set alamat='$alamat',email='$email' WHERE nid='$nid'");
    if ($sqli) {
      $_SESSION['pesan'] = "<div class='alert alert-success' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Berhasil Ubah Data Dosen!
                              </div>";
      echo "<script>window.location = 'index.php?page=4'</script>";
    }else{
      $_SESSION['pesan'] = "<div class='alert alert-danger' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Gagal Ubah Data Dosen!
                              </div>";
      echo "<script>window.location = 'index.php?page=4'</script>";
    }
  }
?>