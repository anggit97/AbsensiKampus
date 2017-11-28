		
		<?php 

			$qeury_m = mysqli_query($conn,"SELECT * FROM ujian where kode_matkul='$kd_matkul'");
			if ($qeury_m) {
				if (mysqli_num_rows($qeury_m)>0) {
					$rows = mysqli_fetch_array($qeury_m);
					$query_n = mysqli_query($conn,"SELECT * FROM matkul where kode_matkul='$rows[kode_matkul]'");
					$rowss = mysqli_fetch_array($query_n);
				}else echo mysqli_error($conn);
			}else echo mysqli_error($conn);
		?>

<!-- Content Header (Page header) -->
        
          <h1>
            <b><?php echo $rowss['nama_matkul']; ?></b>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"><i class="fa fa-user"></i>Matkul</a></li>
          </ol>
       
		

		<h5><b><?php echo date("l, M Y"); ?></b></h5>
		<hr>
		<div class="box box-info">
			<div class="box-header">
				 <i class="fa fa-user"></i>
	             <h3 class="box-title">Data Pribadi</h3>
			</div>
			<a href="index.php?page=5" class="btn btn-primary btn-lg" style="margin-right:10px;float:right;"><i class="fa fa-arrow-circle-left"></i> Kembali</a>

			<div class="box-body">
				
				<h5><b>Daftar Mahasiswa</b></h5>
				<p>Berikut ini adalah daftar Mahasiswa yang mengikuti matakuliah <b><?php echo $rowss['nama_matkul']; ?></b>:
				</p>
				<br>
				
				<table class="row-border" id="table" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>No</th>
							<th>Tgl Ujian</th>
							<th>NIM</th>
							<th>Nama MHS</th>
							<th>Absen</th>
							<th>Tugas</th>
							<th>UTS</th>
							<th>UAS</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>No</th>
							<th>Tgl Ujian</th>
							<th>NIM</th>
							<th>Nama MHS</th>
							<th>Absen</th>
							<th>Tugas</th>
							<th>UTS</th>
							<th>UAS</th>
							<th>Aksi</th>
						</tr>
					</tfoot>
					<tbody>
						<?php  
						$query_mhs = mysqli_query($conn,"SELECT * FROM ujian where nid='$nid' AND kode_matkul='$kd_matkul'");
						if ($query_mhs) {
							if (mysqli_num_rows($query_mhs)>0) {
								$no = 1;
								while ($rowss = mysqli_fetch_array($query_mhs)) {
									$query_mhs_2 = mysqli_query($conn,"SELECT nama_mhs FROM mahasiswa where nim='$rowss[nim]'");
									if ($query_mhs_2) {
										while ($rowsss = mysqli_fetch_array($query_mhs_2)) {
						?>
							<tr>
								<td><?php echo $no; ?></td>
								<td><?php echo $rowss['tgl_ujian']; ?></td>
								<td><?php echo $rowss['nim'] ?></td>
								<td><?php echo $rowsss['nama_mhs']; ?></td>
								<td><?php echo $rowss['nilai_absen']; ?></td>
								<td><?php echo $rowss['nilai_tugas']; ?></td>
								<td><?php echo $rowss['nilai_uts']; ?></td>
								<td><?php echo $rowss['nilai_uas']; ?></td>
								<td><a href="index.php?page=8&&id_ujian=<?php echo $rowss['id_ujian']; ?>">Ubah</a></a></td>
							</tr>
						<?php
							$no++;				
										}
									}
						
								}
							}else echo "<center><h4>Data tidak ada</h4></center>";
						}else echo mysqli_error($conn);
						?>
					</tbody>
				</table>
			</div>
		</div>

<script>
	$(document).ready(function() {
	    $('#table').DataTable();
	} );
</script>