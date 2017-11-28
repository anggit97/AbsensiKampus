<?php  
session_start();
include "../../koneksi/koneksi.php";
if (isset($_GET['nim']) && isset($_GET['id_matkul']) && isset($_GET['id_detil'])) {
	$nim = $_GET['nim'];
	$id_matkul = $_GET['id_matkul'];
	$id_detil = $_GET['id_detil'];
	$query = mysqli_query($conn,"DELETE FROM detil_matkul WHERE id_detil='$id_detil'");
	if ($query) {
		$_SESSION['pesan'] = "<div class='alert alert-success' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Berhasil hapus data mahasiswa di Matkul!
                              </div>";
      	echo "<script>window.location = '../dashboard/index.php?page=14&&id_matkul=$id_matkul'</script>";
	}else echo mysqli_error($conn);
}
?>