<?php  
$query = mysqli_query($conn,"SELECT * FROM dosen WHERE nid='$nid'");
if ($query) {
  $rows = mysqli_fetch_array($query);
}else echo mysqli_error($conn);
?>

          <h3>
            <b>Daftar Mata Kuliah Dosen "<?php echo $rows['nm_dosen']; ?>"</b>
          </h3>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"><i class="fa fa-book"></i> Daftar Matkul Dosen</a></li>
          </ol>
       
	 <a href="index.php?page=19" class="btn btn-primary btn-lg" style="margin-right:10px;float:right;"><i class="fa fa-reply"></i> Kembali</a>

		<h5><b><?php echo date("l, M Y"); ?></b></h5>
		<hr>

		<h5><b>Daftar Matakuliah</b></h5>
		<p>Berikut ini adalah daftar matakuliah anda pada semester ini:
		</p>
		<br>

<!-- quick email widget -->
              <div class="box box-info">
                <div class="box-header">
                  <i class="fa fa-pencil"></i>
                  <h3 class="box-title">Matkul</h3>
                  <!-- tools box -->
                      
                </div>
                
                <?php  
                   if (isset($_SESSION['pesan']) && $_SESSION['pesan'] != "") {
                     echo $_SESSION['pesan'];
                     unset($_SESSION['pesan']);
                   }else echo "";
                ?>


                <div class="box-body">

                <table id="table" class="row-border" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>ID Matkul</th>
                          <th>Nama Matkul</th>
                          <th>Hari</th>
                          <th>Jam Mulai</th>
                          <th>Jam Selesai</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                          <th>No</th>
                          <th>ID Matkul</th>
                          <th>Nama Matkul</th>
                          <th>Hari</th>
                          <th>Jam Mulai</th>
                          <th>Jam Selesai</th>
                          <th>Aksi</th>
                      </tr>
                  </tfoot>
                  <tbody> 

                        <?php  
                        $query = mysqli_query($conn,"SELECT * FROM matkul WHERE nid='$nid'");
                        if ($query) {
                          $no = 1;
                          while ($rows = mysqli_fetch_array($query)) {
                        ?>
                                <tr>
                                  <td><?php echo $no++; ?></td>
                                  <td><?php echo $rows['id_matkul']; ?></td>
                                  <td><?php echo $rows['nm_matkul']; ?></td>
                                  <td><?php echo $rows['hari']; ?></td>
                                  <td><?php echo $rows['jam_mulai']; ?></td>
                                  <td><?php echo $rows['jam_selesai']; ?></td>
                                  <td><a href="index.php?page=21&&id_matkul=<?php echo $rows['id_matkul']; ?>&&nid=<?php echo $nid; ?>" class="btn btn-success" data-tt="tooltip" title="Klik Untuk Melihat Absensi Dosen">Lihat Nilai Absensi Dosen</a></td>
                                </tr>

                               
                        <?php
                          }
                        }
                        ?>
                   
                                
                    
                    </tbody>
                  </table>
                </div>
                
                
              </div>


<script>
  $(document).ready(function() {
      $('#table').DataTable();
  } );

   $(document).ready(function(){
        $('[data-tt="tooltip"]').tooltip(); 
    });
</script>