<?php  
$query = mysqli_query($conn,"SELECT * FROM matkul WHERE id_matkul='$id_matkul'");
if ($query) {
    $rows = mysqli_fetch_array($query);
}else echo mysqli_error($conn);

$query2 = mysqli_query($conn,"SELECT * FROM dosen WHERE nid='$nid'");
if ($query2) {
    $rows_m = mysqli_fetch_array($query2);
}else echo mysqli_error($conn);
?>

          <h3>
            Nilai Absensi "<b><?php echo $rows['nm_matkul']; ?>"</b>
          </h3>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"><i class="fa fa-user"></i> Nilai Absensi</a></li>
          </ol>
       
        <hr>

        <h5><b><?php echo date("l, M Y"); ?></b></h5>
        <hr>

        <a href="index.php?page=16" class="btn btn-primary btn-lg" style="margin-right:10px;float:right;"><i class="fa fa-reply"></i> Kembali</a>

        <h5><b>Nilai Absensi Dosen </b></h5>
        <p>Berikut ini adalah Nilai Absensi Dosen yang terdaftar di database universitas : 
        </p>
        <br>

<div class="box">
    <div class="box-header">
        <i class="fa fa-user"></i>
        <h3 class="box-title">Data Dosen</h3>
    </div>
    <div class="box-body">
        
        <table class="table table-bordered table-hover table-striped" style="width:45%;float:left;margin-left:30px;">
            <tr>
                <td>NID</td>
                <td>: <b><?php echo $rows_m['nid']; ?></b></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>: <?php echo $rows_m['email']; ?></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>: <?php echo $rows_m['jk']; ?></td>
            </tr>
        </table>

        <table class="table table-bordered table-hover table-striped" style="width:45%;float:right;margin-right:30px;">
            <tr>
                <td>Nama</td>
                <td>: <b><?php echo $rows_m['nm_dosen']; ?></b></td>
            </tr>
            <tr>
                <td>Telp</td>
                <td>: <?php echo $rows_m['telp_dosen']; ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: <?php echo $rows_m['alamat']; ?></td>
            </tr>
        </table>
        
    </div>
</div>

<div class="box">
    <div class="box-header">
        <i class="fa fa-user"></i>
        <h3 class="box-title">Nilai Absensi</h3>
        <?php  
            if (isset($_SESSION['pesan']) && $_SESSION['pesan'] != "") {
                echo $_SESSION['pesan'];
                unset($_SESSION['pesan']);
            }else echo "";
        ?>
    </div>
    <div class="box-body">
        <table id="dosen" class="row-border" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tgl.Absen</th>
                        <th>Pertemuan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Tgl.Absen</th>
                        <th>Pertemuan</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
                <tbody>
                <?php  
                $num1  = 0;
                $num2  = 0;
                $x     = 0;
                $query = mysqli_query($conn,"SELECT * FROM absen_dosen WHERE id_matkul='$id_matkul' ORDER BY pertemuan");
                if ($query) {
                    $no = 1;
                    
                     $x     = mysqli_num_rows($query);
                    while ($rows = mysqli_fetch_array($query)) {
                         $color = "";
                         $font = "";
                        if ($rows['status'] == "Hadir" || $rows['status'] == "Ijin" || $rows['status'] == "Sakit" ) {
                            $color = "#76FF03";
                            $font = "black";
                            $num1++;
                        }else{
                            $color = "#F44336";
                            $font = "white";
                            $num2++;
                        }

                ?>
                    <tr style="background-color:<?php echo $color; ?>;color:<?php echo $font; ?>;">
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $rows['tgl_absen']; ?></td>
                        <td><?php echo $rows['pertemuan']; ?></td>
                        <td><?php echo $rows['status']; ?></td>
                    </tr>
                <?php
                    }
                }else echo mysqli_error($conn);
                ?>
                </tbody>
            </table>
            <?php  
            $nil = 0;
            if ($num1 != 0 || $x != 0) {
                $nil = ($num1/$x) * 100;
                $nil = $nil."%";
            }else $nil = "Belum ada absen";

            ?>
            <br>

            <table class="table table-bordered" style="width:50%;background-color:yellow;color:black;">
               <tr>
                    <th><h4>Nilai Absensi</h4></th>
                    <th><h4><u><?php echo $nil; ?></u></h4></th>
                </tr> 
            </table>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#dosen').DataTable();
    } );

    $(".btn btn-danger").click(function(e) {
      var id = $(this).attr('id');
      var modal_id = "confirm-delete_"+id;
      $("#"+modal_id).modal('hide');
    });

    
</script>