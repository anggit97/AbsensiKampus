<?php  
$query = mysqli_query($conn,"SELECT * FROM matkul WHERE id_matkul='$id_matkul'");
if ($query) {
  $row_m = mysqli_fetch_array($query);
}else echo mysqli_error($conn);
echo $id_matkul;
?>
          <h3>
            <b>Absensi Matakuliah "<?php echo $row_m['nm_matkul']; ?>"</b>
          </h3>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"><i class="fa fa-book"></i> Absensi Matakuliah</a></li>
          </ol>
       
    

    <h5><b><?php echo date("l, M Y"); ?></b></h5>
    <hr>
    <a href="index.php?page=24&&id_matkul=<?php echo $id_matkul; ?>&&nid=<?php echo $nid; ?>" class="btn btn-primary btn-lg" style="margin-right:10px;float:right;"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
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
                          <th>No</th>
                          <th>NIM</th>
                          <th>Nama</th>
                          <th>Hadir</th>
                          <th>Ijin</th>
                          <th>Sakit</th>
                          <th>Alfa</th>
                      </tr>
                  </thead>
                  
                  <tbody> 
                        <form action="" method="post">
                        <?php  
                        
                        $query = mysqli_query($conn,"SELECT a.*,b.*,c.*
                          FROM mahasiswa a, detil_matkul b, matkul c 
                          WHERE a.nim=b.nim AND c.id_matkul=b.id_matkul AND b.id_matkul='$id_matkul' ORDER BY b.nim");
                        if ($query) {
                          $no = 1;
                          $add = 1;
                          $nim = array();
                          while ($rows = mysqli_fetch_array($query)) {
                            
                        ?>
                                <tr>
                                  <td><?php echo $no++; ?></td>
                                  <td><?php echo $rows['nim']; ?></td>
                                  <td><?php echo $rows['nm_mhs']; ?></td>
                                  <td><input type="radio" checked value="Hadir" name="radio<?php echo $add; ?>"> Hadir</td>
                                  <td><input type="radio" value="Ijin" name="radio<?php echo $add; ?>"> Ijin</td>
                                  <td><input type="radio" value="Sakit" name="radio<?php echo $add; ?>"> Sakit</td>
                                  <td><input type="radio" value="Alfa" name="radio<?php echo $add; ?>"> Alfa</td>
                                </tr>

                               
                        <?php
                          $nim["".$add.""] = $rows['nim'];
                          $add++;
                          }
                        }
                    
                        ?>
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
  $rd = array();
  foreach ($_POST as $key => $value) {
    ${$key} = $value;
    $rd[] = $value; 
  }
  
  $no = $no-1;
  $i = 1;
  $num = 0;
  while ($i <= $no) {
    $nnim = "";
    $nnim = $nim[$i];
    $rds  = "";
    $rds  = $rd[$i-1];
    $query = mysqli_query($conn,"INSERT INTO absen_kelas VALUES(null,'$nnim','$date','$id_matkul','$row_m[jam_mulai]','$pertemuan','$rds')");
    if ($query) {
      $num++;
    }
    $i++;
  }

  if ($num == $no) {
    $_SESSION['pesan'] = "<div class='alert alert-success' style='margin-top:5px;'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Berhasil Melakukan Absensi Mahasiswa!
                              </div>";
    echo "<script>window.location = 'index.php?page=24&&id_matkul=$id_matkul&&nid=$nid'</script>";
  }else{
    $_SESSION['pesan'] = "<div class='alert alert-danger' style='margin-top:5px;'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Gagal Melakukan Absensi Mahasiswa!
                              </div>";
    echo "<script>window.location = 'index.php?page=24&&id_matkul=$id_matkul&&nid=$nid'</script>";
  }
}

?>