

          <h1>
            Data Dosen
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"><i class="fa fa-files-o"></i> Data Dosen</a></li>
          </ol>
      
<hr>

<h5><b><?php echo date("l, M Y"); ?></b></h5>
<hr>

<h5><b>Data Dosen</b></h5>
<p>Berikut ini adalah data Anda yang terdaftar di database Universitas Budi Luhur:
</p>
<br>

<?php  

$query = "SELECT * FROM dosen where nid=$nid";
$sqli  = mysqli_query($conn,$query);
if ($sqli) {
	$data = mysqli_fetch_array($sqli);
}
?>

<div class="row">
	<div class="box box-info">
		<div class="box-header">
			 <i class="fa fa-user"></i>
             <h3 class="box-title">Data Pribadi</h3>
		</div>
		<div class="box-body">
			<div class="col-sm-6">
				<table class="table table-hover table-bordered table-stiped">
					<tr>
						<td><b>NID </b></td>
						<td>: <b><?php echo $data['nid']; ?></b></td>
					</tr>
					<tr>
						<td><b>Nama Lengkap</b></td>
						<td>: <b><?php echo $data['nm_dosen']; ?></b></td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>: <?php echo $data['jk']; ?></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>: <?php echo $data['alamat']; ?></td>
					</tr>
				</table>
			</div>

			<div class="col-sm-6">
				<?php  
                   if (isset($_SESSION['pesan']) && $_SESSION['pesan'] != "") {
                     echo $_SESSION['pesan'];
                     unset($_SESSION['pesan']);
                   }else echo "";
                ?>
				<form action="" method="post" enctype="multipart/form-data">
					<img src="
					<?php  
						if ($data['foto']=='') {
							echo 'images/dp.png';
						}else{
							echo "images/$data[foto]";
						}
					?>
					" alt="<?php echo $data['nm_dosen'];?>" title="<?php echo $data['nm_dosen'];?>" class="img-rounded" id="dp" width="20%" height="auto">
					<input type="file" name="dp" onchange="readURL(this);"><br>
					<button class="btn btn-primary" name="upload">Ganti DP</button>
				</form>	
			</div>

			<div class="col-sm-12" style="margin-top:20px;">
				<p><b>Note : </b><font color="red">Jika ada kesalahan pada data Anda, harap hubungi BAAK Universitas untuk memperbaiki.</font></p>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#dp').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
 </script>

 <?php  
function random_string($key) {
   
    $length = 30;
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }


    return $key.'.jpg';
}



$imageTypes = array(
    1 => 'GIF',
    2 => 'JPEG',
    3 => 'PNG',
    4 => 'SWF',
    5 => 'PSD',
    6 => 'BMP',
    7 => 'TIFF_II',
    8 => 'TIFF_MM',
    9 => 'JPC',
    10 => 'JP2',
    11 => 'JPX',
    12 => 'JB2',
    13 => 'SWC',
    14 => 'IFF',
    15 => 'WBMP',
    16 => 'XBM',
    17 => 'ICO');

if (isset($_POST['upload'])) {


	if ($_FILES['dp']['tmp_name'] == "") {
	 	$_SESSION['pesan'] = "<div class='alert alert-danger' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Display Profil tidak boleh kosong!
                              </div>";
      	echo "<script>window.location = 'index.php?page=2'</script>";
	}else{
		$type   = exif_imagetype($_FILES['dp']['tmp_name']);
		$types 	= $imageTypes[$type];
		if ($types != 'JPEG' && $types != 'GIF' && $types != 'PNG' && $types != 'JPG') {
			$_SESSION['pesan'] = "<div class='alert alert-danger' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Image harus dalam format JPEG, GIF, PNG atau JPG!
                              </div>";
      		echo "<script>window.location = 'index.php?page=2'</script>";
		}else{

			$nil = array();
			$dp_name = basename($_FILES["dp"]["name"]);
			$nil = explode('.', $dp_name);
			$dp_name = random_string($nil[0]);

			$target_file = "images/".$dp_name;

			if (move_uploaded_file($_FILES["dp"]["tmp_name"], $target_file)) {
		        $query = mysqli_query($conn,"UPDATE dosen SET foto = '$dp_name' WHERE nid = '$nid'");
		        if ($query) {
		        	$_SESSION['pesan'] = "<div class='alert alert-success' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Berhasil Ubah DP Profil!
                              </div>";
      				echo "<script>window.location = 'index.php?page=2'</script>";
		        }else echo mysqli_error($conn);
		    } else {
		        $_SESSION['pesan'] = "<div class='alert alert-danger' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Gagal Ubah DP Profil!
                              </div>";
      			echo "<script>window.location = 'index.php?page=2'</script>";
		    }

		}
	}
	
}
 ?>
