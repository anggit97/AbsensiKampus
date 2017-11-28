<?php  
session_start();
include '../../koneksi/koneksi.php';
if (isset($_POST['ubahTgl'])) {
	foreach ($_POST as $key => $value) {
		${$key} = $value;
	}
	$query = mysqli_query($conn,"UPDATE ujian SET tgl_ujian = '$tgl_ujian' WHERE kode_matkul='$kd_matkul'");
	if ($query) {
		$_SESSION['pesan'] = "<div class='alert alert-success' style='margin-top:5px;'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Berhasil Ubah Tanggal Ujian!
                              </div>";
      	echo "<script>window.location = '../admin/index.php?page=5'</script>";
	}else{
		$_SESSION['pesan'] = "<div class='alert alert-danger' style='margin-top:5px;'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Gagal Ubah Tanggal Ujian!
                              </div>";
      	echo "<script>window.location = '../admin/index.php?page=5'</script>";
	}
}else echo mysqli_error($conn);
?>