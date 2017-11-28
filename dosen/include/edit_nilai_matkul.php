		
		<?php

			$qeury_m = mysqli_query($conn,"SELECT * FROM ujian where id_ujian='$id_ujian'");
			if ($qeury_m) {
				if (mysqli_num_rows($qeury_m)>0) {
					$rows = mysqli_fetch_array($qeury_m);
					$query_mk = mysqli_query($conn,"SELECT nama_matkul FROM matkul where kode_matkul='$rows[kode_matkul]'");
					if ($query_mk) {
						$rowss = mysqli_fetch_array($query_mk);
					}else echo mysqli_error($conn);

					$query_mhs = mysqli_query($conn,"SELECT nama_mhs FROM mahasiswa WHERE nim='$rows[nim]'");
					if ($query_mhs) {
						$rowsss = mysqli_fetch_array($query_mhs);
					}echo mysqli_error($conn);
				}else echo mysqli_error($conn);
			}else echo mysqli_error($conn);

			
			
		?>

<!-- Content Header (Page header) -->
        
          <h3>
            Edit Nilai Mahasiswa : <b><?php echo $rowss['nama_matkul']; ?></b>
          </h3>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"><i class="fa fa-user"></i>Edit Nilai Matakuliah</a></li>
          </ol>
       
		

		<h5><b><?php echo date("l, M Y"); ?></b></h5>
		<hr>
      
    <a href="index.php?page=7&&kode_matkul=<?php echo $rows['kode_matkul']; ?>" class="btn btn-lg btn-primary" style="margin-right:10px;float:right;"><i class="fa fa-arrow-circle-left"></i> Kembali</a>

		<h5><b>Edit Nilai Mahasiswa</b></h5>
		<p>Berikut ini adalah Form Edit Nilai Mahasiswa <b><?php echo $rowsss['nama_mhs']; ?></b>:
		</p>
		<br>
		
		
		<div class="box box-info">
                <div class="box-header">
                  <i class="fa fa-user"></i>
                  <h3 class="box-title">Edit Nilai Mahasiswa (<b><?php echo $rowsss['nama_mhs']; ?></b>)</h3>
                  <!-- tools box -->
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
                      <label for="">Nilai Absen : </label>
                      <input type="number" class="form-control" name="nil_absen" id="nil_absen" max="100" min="0" value="<?php echo $rows['nilai_absen']; ?>" placeholder="Nilai Absen">
                    </div>
                    <div class="form-group">
                      <label for="">Nilai Tugas : </label>
                      <input type="number" class="form-control" name="nil_tugas" id="nil_tugas" max="100" min="0" value="<?php echo $rows['nilai_tugas']; ?>" placeholder="Nilai Tugas">
                    </div>
                    <div class="form-group">
                      <label for="">Nilai UTS : </label>
                      <input type="number" class="form-control" name="nil_uts" id="nil_uts" max="100" min="0" value="<?php echo $rows['nilai_uts']; ?>" placeholder="Nilai UTS">
                    </div>
                    <div class="form-group">
                      <label for="">Nilai UAS : </label>
                      <input type="number" class="form-control" name="nil_uas" id="nil_uas" max="100" min="0" value="<?php echo $rows['nilai_uas']; ?>" placeholder="Nilai UAS">
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

      					$query_nilai = mysqli_query($conn,"UPDATE ujian set nilai_absen=$nil_absen,nilai_tugas=$nil_tugas,nilai_uts=$nil_uts,nilai_uas=$nil_uas WHERE id_ujian='$id_ujian'");
      					if ($query_nilai) {
      						$_SESSION['pesan'] = "<div class='alert alert-success' style='margin-top:5px;'>
                                      <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                      Berhasil Ubah Nilai Mahasiswa!
                                    </div>";
            					echo "<script>window.location = 'index.php?page=8&&id_ujian=$id_ujian'</script>";
      					}else{
      						$_SESSION['pesan'] = "<div class='alert alert-success' style='margin-top:5px;'>
                                      <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                      Gagal Ubah Data Mahasiswa!
                                    </div>";
            					echo "<script>window.location = 'index.php?page=8&&id_ujian=$id_ujian'</script>";
      					}
      				}

              ?>
		