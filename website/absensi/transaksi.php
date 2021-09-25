<?php 
	function rupiah($angka){
		
		$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
		return $hasil_rupiah;

	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "header.php"; ?>
	<title>Data Transaksi</title>
</head>
<body>
	<?php include "menu.php"; ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<h2 class="text-center">Data Transaksi</h2>
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
						$queryTampil = "SELECT `m.*`, `t.*` FROM `t_transaksi t` INNER JOIN `tb_masyarakat m` ON `t.masyarakat_id` = `m.masyarakat_id`";
						$sql = mysqli_query($konek, $queryTampil);
						echo $sql;
						$datas = mysqli_fetch_array($sql);
						$no = 0;
						foreach($datas as $data): ?>

							<tr>
								<td> <?php echo $no++; ?> </td>
								<td> <?php echo $data['masyarakat_nik']; ?> </td>
								<td> <?php echo $data['masyarakat_name']; ?> </td>
								<td> <?php echo rupiah($data['masyarakat_jumlah']); ?> </td>
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
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<?php include "footer.php"; ?>
	
</body>
</html>