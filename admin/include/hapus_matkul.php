<?php  
session_start();
include "../../koneksi/koneksi.php";
if (isset($_GET['id_matkul'])) {
	$id_matkul = $_GET['id_matkul'];
	$query = mysqli_query($conn,"DELETE FROM matkul WHERE id_matkul='$id_matkul'");
	if ($query) {
		$_SESSION['pesan'] = "<div class='alert alert-success' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Berhasil hapus data Matkul!
                              </div>";
      	echo "<script>window.location = '../dashboard/index.php?page=10'</script>";
	}else echo mysqli_error($conn);
}
?>