<?php 
	function rupiah($angka){
		
		$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
		return $hasil_rupiah;

	}

?>

<!DOCTYPE html>
<html>
<head>
	<?php include "header.php"; ?>
	<title>Data Masyarakat</title>
</head>
<body>

	<?php include "menu.php"; ?>

	<!--isi -->
	<div class="container-fluid">
		<h2 class="text-center">Data Masyarakat</h2>
		<!-- tombol tambah data karyawan -->
		<a href="tambah.php" class="btn btn-primary">Tambah Data Masyarakat</a>
		<br/><br>
		<table class="table table-bordered mt-sm-1">
			<thead>
				<tr style="background-color: grey; color: white;">
					<th style="width: 10px; text-align: center">No.</th>
					<th style="width: 200px; text-align: center">Nik</th>
					<th style="width: 400px; text-align: center">Nama</th>
					<th style="text-align: center">Jumlah</th>
					<th style="text-align: center">status</th>
					<th style="width: 100px; text-align: center">Aksi</th>
				</tr>
			</thead>
			<tbody>

				<?php
					//koneksi ke database
					include "koneksi.php";

					//baca data karyawan
					$sql = mysqli_query($konek, "select * from tb_masyarakat");
					$no = 0;
					while($data = mysqli_fetch_array($sql))
					{
						$no++;
				?>

				<tr>
					<td> <?php echo $no; ?> </td>
					<td> <?php echo $data['masyarakat_nik']; ?> </td>
					<td> <?php echo $data['masyarakat_name']; ?> </td>
					<td> <?php echo $data['masyarakat_jumlah']; ?> </td>
					<td> 
						<?php 
							if($data['masyarakat_status'] == 'A'){
								echo "Aktif";
							}else{
								echo "Habis";
							} 
						?> 
					</td>
					<td>
						<a href="edit.php?id=<?php echo $data['masyarakat_id']; ?>"> Edit</a> | <a href="hapus.php?id=<?php echo $data['masyarakat_id']; ?>"> Hapus</a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>

		
	</div>

	<?php include "footer.php"; ?>

</body>
</html>