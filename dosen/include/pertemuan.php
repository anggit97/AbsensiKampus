

          <h1>
            <b>Pertemuan Matkul</b>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"><i class="fa fa-book"></i> Pertemuan Matkul</a></li>
          </ol>
       
		

		<h5><b><?php echo date("l, M Y"); ?></b></h5>
		<hr>

		<h5><b>Daftar Petemuan Matakuliah</b></h5>
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
                          <th>Pertemuan Ke - </th>
                          <th>Topik</th>
                          <th>Deskripsi</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                          <th>No</th>
                          <th>Pertemuan Ke - </th>
                          <th>Topik</th>
                          <th>Deskripsi</th>
                          <th>Aksi</th>
                      </tr>
                  </tfoot>
                  <tbody> 

                        <?php  
                       
                          $no = 1;
                          $per = 1;
                          while ($per <= 14) {
                          $num = 0;
                          $query = mysqli_query($conn,"SELECT a.*,b.* FROM absen_kelas a, absen_dosen b WHERE a.id_matkul='$id_matkul' AND a.id_matkul=b.id_matkul AND b.pertemuan=$per AND a.pertemuan=$per AND a.id_matkul='$id_matkul' AND a.pertemuan=$per");
                          if ($query) {
                              
                              $rows = mysqli_fetch_array($query);
                              $num_mhs = mysqli_num_rows($query);
                              $query_num = mysqli_query($conn,"SELECT a.* FROM absen_kelas a WHERE a.id_matkul='$id_matkul' AND a.pertemuan=$per");
                              if ($query_num) {
                                $num = mysqli_num_rows($query_num);
                              }

                              $query_dosen = mysqli_query($conn,"SELECT * FROM absen_dosen WHERE id_matkul='$id_matkul' AND pertemuan='$per'");
                              $num2 = mysqli_num_rows($query_dosen);
                              $row_d = mysqli_fetch_array($query_dosen);
                              $status = $row_d['status']; 
                              if ($num2 > 0) {
                                if ($row_d['status'] == "Alfa") {
                                 
                                }
                              }else $status = "";
                          }
                        ?>
                                <tr>
                                  <td><?php echo $no++; ?></td>
                                  <td align="center"><b><?php echo $per++; ?></b></td>
                                  <td><?php echo $rows['judul']; ?></td>
                                  <td><?php echo $rows['topik'];?></td>
                                    
                                  <td>
                                  <?php
                                    if($status == "Alfa"){
                                    ?>
                                    <a href="index.php?page=15&&pertemuan=<?php echo $per-1; ?>&&id_matkul=<?php echo "$id_matkul"; ?>" class="btn btn-primary" data-tt="tooltip" title="Klik Untuk Melakukan Absensi Dosen dan Membuka Absensi Mahasiswa">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Absensi Dosen&nbsp;&nbsp;&nbsp;&nbsp;</a> 
                                    <?php  
                                    }elseif($num != 0) {
                                    ?>
                                    <button href="index.php?page=11&&pertemuan=<?php echo $per-1; ?>&&id_matkul=<?php echo "$id_matkul"; ?>" class="btn btn-primary" data-tt="tooltip" title="Hubungi Admin untuk mengubah absensi" style="margin-bottom:5px;" disabled="false">Absensi Mahasiswa</button><br>
                                    <a href="index.php?page=13&&pertemuan=<?php echo $per-1; ?>&&id_matkul=<?php echo "$id_matkul"; ?>&&id_absen=<?php echo $row_d['id_absendsn']; ?>" class="btn btn-primary" data-tt="tooltip" title="Klik Untuk Menambah Deskripsi dan Juga Absen Dosen">&nbsp;&nbsp;&nbsp;&nbsp;Ubah Deskripsi&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                    <?php
                                    }elseif($num_mhs == 0 && $num2 != 0){
                                    ?>
                                    <a href="index.php?page=10&&pertemuan=<?php echo $per-1; ?>&&id_matkul=<?php echo "$id_matkul"; ?>" class="btn btn-primary" data-tt="tooltip" title="Klik Untuk Melakukan Absensi">Absensi Mahasiswa</a>
                                    <a href="index.php?page=13&&pertemuan=<?php echo $per-1; ?>&&id_matkul=<?php echo "$id_matkul"; ?>&&id_absen=<?php echo $row_d['id_absendsn']; ?>" class="btn btn-primary" data-tt="tooltip" title="Klik Untuk Menambah Deskripsi dan Juga Absen Dosen">&nbsp;&nbsp;&nbsp;&nbsp;Ubah Deskripsi&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                    <?php
                                    }else{
                                    ?>
                                    <a href="index.php?page=14&&pertemuan=<?php echo $per-1; ?>&&id_matkul=<?php echo "$id_matkul"; ?>" class="btn btn-primary" data-tt="tooltip" title="Klik Untuk Melakukan Absensi Dosen dan Membuka Absensi Mahasiswa">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Absensi Dosen&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                    <?php 
                                    }
                                  ?>
                                  </td>
                                </tr>

                               
                        <?php
                          }
                      
                        ?>
                   
                                
                    
                    </tbody>
                  </table>
                </div>
                
                
              </div>


<script>
  $(document).ready(function() {
      $('#table').DataTable({
        "pageLength": 25
      });
   });

   $(document).ready(function(){
        $('[data-tt="tooltip"]').tooltip(); 
    });
</script>