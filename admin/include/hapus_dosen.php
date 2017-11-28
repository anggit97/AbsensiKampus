<?php  
session_start();
include "../../koneksi/koneksi.php";
if (isset($_GET['nid'])) {
	$nid = $_GET['nid'];
	$query = mysqli_query($conn,"DELETE FROM dosen WHERE nid='$nid'");
	if ($query) {
		$_SESSION['pesan'] = "<div class='alert alert-success' style='margin-top:5px;'>
                                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Berhasil hapus data dosen!
                              </div>";
      	echo "<script>window.location = '../dashboard/index.php?page=4'</script>";
	}else echo mysqli_error($conn);
}
?>