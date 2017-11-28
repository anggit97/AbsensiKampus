<?php  
$query = mysqli_query($conn,"SELECT * FROM matkul WHERE id_matkul='$id_matkul'");
if ($query) {
  $row_m = mysqli_fetch_array($query);
}else echo mysqli_error($conn);

$query_dosen = mysqli_query($conn,"SELECT * FROM dosen WHERE nid='$row_m[nid]'");
if ($query_dosen) {
  $rowss = mysqli_fetch_array($query_dosen);
}else echo mysqli_error($conn);
?>
          <h3>
            <b>Absensi Dosen "<?php echo $row_m['nm_matkul']; ?> - Pertemuan <?php echo $pertemuan; ?>"</b>
          </h3>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"><i class="fa fa-book"></i> Absensi Matakuliah</a></li>
          </ol>
       
		

		<h5><b><?php echo date("l, M Y"); ?></b></h5>
		<hr>
    <a href="index.php?page=9&&id_matkul=<?php echo $id_matkul; ?>" class="btn btn-primary btn-lg" style="margin-right:10px;float:right;"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
		<h5><b>Daftar Mahasiswa matakuliah "<?php echo $row_m['nm_matkul']; ?>"</b></h5>
		<p>Berikut ini adalah daftar mahasiswa anda pada matakuliah "<?php echo $row_m['nm_matkul']; ?>":
		</p>
		<br>

<!-- quick email widget -->
              <div class="box box-info">
                <div class="box-header">
                  <i class="fa fa-pencil"></i>
                  <h3 class="box-title">Daftar Mahasiswa</h3>
                  <!-- tools box -->
                      
                </div>
                
                <?php  
                   if (isset($_SESSION['pesan']) && $_SESSION['pesan'] != "") {
                     echo $_SESSION['pesan'];
                     unset($_SESSION['pesan']);
                   }else echo "";
                ?>


                <div class="box-body">

                <table class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th>Pertemuan</th>
                          <th>NID</th>
                          <th>Nama</th>
                          <th>Hadir</th>
                          <th>Ijin</th>
                          <th>Sakit</th>
                          <th>Alfa</th>
                      </tr>
                  </thead>
                  
                  <tbody> 
                        <form action="" method="post">
                        
                                <tr>
                                  <td><?php echo $pertemuan; ?></td>
                                  <td><?php echo $rowss['nid']; ?></td>
                                  <td><?php echo $rowss['nm_dosen']; ?></td>
                                  <td><input type="radio" checked value="Hadir" name="radio"> Hadir</td>
                                  <td><input type="radio" value="Ijin" name="radio"> Ijin</td>
                                  <td><input type="radio" value="Sakit" name="radio"> Sakit</td>
                                  <td><input type="radio" value="Alfa" name="radio"> Alfa</td>
                                </tr>

                               
            
                            <tr>
                              <td colspan="7"><button class="pull-right btn btn-primary" name="simpan" style="margin-right:40px;">Simpan <i class="fa fa-save"></i></button></td>
                              <td style="display:none"></td>
                              <td style="display:none"></td>
                              <td style="display:none"></td>
                              <td style="display:none"></td>
                              <td style="display:none"></td>

                              <td style="display:none"></td>
                              
                            </tr>
                        </form>      
                    
                    </tbody>
                  </table>
                    
                
                </div>
                
                
              </div>






<script>
  $(document).ready(function() {
      $('#table').DataTable({
        "pageLength": 50
      });
   });

   $(document).ready(function(){
        $('[data-tt="tooltip"]').tooltip(); 
    });
</script>

<?php  
$date =  date('Y-m-d');
if (isset($_POST['simpan'])) {
  
  foreach ($_POST as $key => $value) {
    ${$key} = $value;
    
  }
  
  
  
  $query = mysqli_query($conn,"INSERT INTO absen_dosen (tgl_absen,id_matkul,jam_datang,jam_plg,status,pertemuan)
    VALUES('$date','$id_matkul','$row_m[jam_mulai]','$row_m[jam_selesai]','$radio','$pertemuan')");
  if ($query) {
    $_SESSION['pesan'] = "<div class='alert alert-success' style='margin-top:5px;'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Berhasil Melakukan Absensi Dosen!
                              </div>";
    echo "<script>window.location = 'index.php?page=9&&id_matkul=$id_matkul'</script>";
  }else{
   $_SESSION['pesan'] = "<div class='alert alert-danger' style='margin-top:5px;'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Gagal Melakukan Absensi Dosen!
                              </div>";
    echo "<script>window.location = 'index.php?page=9&&id_matkul=$id_matkul'</script>";
  }

}

?>