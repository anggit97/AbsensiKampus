<?php  
$query = mysqli_query($conn,"SELECT * FROM absen_dosen WHERE id_absendsn='$id_absen'");
if ($query) {
  $rows = mysqli_fetch_array($query);
}else echo mysqli_error($conn);
?>
          <h1>
            Ubah Deskripsi Pertemuan ke - <b><?php echo $rows['pertemuan']; ?></b>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"><i class="fa fa-pencil"></i> Ubah Deskripsi Pertemuan</a></li>
          </ol>
       
		<hr>

    <a href="index.php?page=9&&id_matkul=<?php echo $id_matkul; ?>" class="btn btn-primary btn-lg" style="margin-right:10px;float:right;"><i class="fa fa-arrow-circle-left"></i> Kembali</a>

		<h5><b><?php echo date("l, M Y"); ?></b></h5>
		<hr>

		<h5><b>Ubah Deskripsi Pertemuan ke - <?php echo $rows['pertemuan']; ?></b></h5>
		<p>Berikut ini adalah Form untuk mengubah Deskripsi Pertemuan di universitas:
		</p>
		<br>


              <div class="box box-info">
                <div class="box-header">
                  <i class="fa fa-user"></i>
                  <h3 class="box-title">Ubah Deskripsi Pertemuan</h3>
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
                      <label for="">Judul Topik Pertemuan : </label>
                      <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul Topik Pertemuan" value="<?php echo $rows['judul']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="">Deskripsi Topik Pertemuan : </label>
                      <textarea name="deskripsi" id="deskripsi" class="form-control" cols="30" rows="3" placeholder="Deskripsi Topik Pertemuan"><?php echo $rows['topik']; ?></textarea>
                    </div>                    
                </div>
                
                <div class="box-footer clearfix">
                  <button class="pull-right btn btn-primary" name="simpan">Simpan <i class="fa fa-arrow-circle-right"></i></button>
                  </form>
                </div>
              </div>

<?php 

  $date = date('Y-m-d');
  
  if (isset($_POST['simpan'])) {
    foreach ($_POST as $key => $value) {
      echo ${$key} = $value;
    }
    
    if ($judul == "" || $deskripsi == "") {
      $_SESSION['pesan'] = "<div class='alert alert-danger' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Tidak Boleh Ada Field yang Kosong!
                              </div>";
      echo "<script>window.location = 'index.php?page=13&&pertemuan=$pertemuan&&id_matkul=$id_matkul&&id_absen=$id_absen'</script>";
    }else{
     
      $query = mysqli_query($conn,"UPDATE absen_dosen SET judul='$judul',topik='$deskripsi' WHERE id_absendsn='$id_absen'");
      if ($query) {
        $_SESSION['pesan'] = "<div class='alert alert-success' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Berhasil Mengubah Deskripsi Pertemuan!
                              </div>";
        echo "<script>window.location = 'index.php?page=13&&pertemuan=$pertemuan&&id_matkul=$id_matkul&&id_absen=$id_absen'</script>";
      }else{
        $_SESSION['pesan'] = "<div class='alert alert-danger' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Gagal Mengubah Deskripsi Pertemuan!
                              </div>";
        echo "<script>window.location = 'index.php?page=13&&pertemuan=$pertemuan&&id_matkul=$id_matkul&&id_absen=$id_absen'</script>";
      }
    }

  }

?>
