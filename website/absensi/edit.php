<!-- proses penyimpanan -->

<?php 
	include "koneksi.php";

	//baca ID data yang akan di edit
	$id = $_GET['id'];

	//baca data karyawan berdasarkan id
	$cari = mysqli_query($konek, "SELECT * FROM tb_masyarakat WHERE masyarakat_id='$id'");
	$hasil = mysqli_fetch_array($cari);


	//jika tombol simpan diklik
	if(isset($_POST['btnSimpan']))
	{
		//baca isi inputan form
		$nokartu = $_POST['nokartu'];
		$nama    = $_POST['nama'];
		$jKelamin= $_POST['jKelamin'];
		$alamat  = $_POST['alamat'];
		$jml     = $_POST['jumlah'];
		$sts     = $_POST['status'];

		//simpan ke tabel karyawan
		$simpan = mysqli_query($konek, "UPDATE tb_masyarakat SET masyarakat_nik='$nokartu', masyarakat_name='$nama', jenis_kelamin='$jKelamin', alamat='$alamat', masyarakat_jumlah='$jml', masyarakat_status='$sts' WHERE masyarakat_id='$id'");
		//jika berhasil tersimpan, tampilkan pesan Tersimpan,
		//kembali ke data karyawan
		if($simpan)
		{
			echo "
				<script>
					alert('Tersimpan');
					location.replace('datakaryawan.php');
				</script>
			";
		}
		else
		{
			echo "
				<script>
					alert('Gagal Tersimpan');
					location.replace('datakaryawan.php');
				</script>
			";
		}

	}
?>

<!DOCTYPE html>
<html>
<head>
	<?php include "header.php"; ?>
	<title>Tambah Data Karyawan</title>
</head>
<body>

	<?php include "menu.php"; ?>

	<!-- isi -->
	<div class="container-fluid">
		<h3>Tambah Data Karyawan</h3>

		<!-- form input -->
		<form method="POST">
			<div class="form-group">
				<label>No.Kartu</label>
				<input type="text" name="nokartu" id="nokartu" placeholder="nomor kartu RFID" class="form-control" style="width: 200px" value="<?php echo $hasil['masyarakat_nik']; ?>">
			</div>
			<div class="form-group">
				<label>Nama Karyawan</label>
				<input type="text" name="nama" id="nama" placeholder="nama karyawan" class="form-control" style="width: 400px" value="<?php echo $hasil['masyarakat_name']; ?>">
			</div>
			<div class="form-group">
				<label>Jenis Kelamin</label>
				<select class="form-control input-sm" name="jKelamin" style="width: 400px">
					<option value="">Pilih Jenis Kelamin</option>
					<option value="L" <?= $hasil['jenis_kelamin'] == 'L' ? 'selected' : ''; ?>>Laki Laki</option>
					<option value="W" <?= $hasil['jenis_kelamin'] == 'W' ? 'selected' : ''; ?>>Wanita</option>
				</select>
			</div>
			<div class="form-group">
				<label>Alamat</label>
				<textarea name="alamat" id="alamat" class="form-control input-sm" style="width: 400px"><?= $hasil['alamat'] ;?></textarea>
			</div>
			<div class="form-group">
				<label>Jumlah Pengambilan</label>
				<input type="text" name="jumlah" id="jumlah" placeholder="Jumlah Pengambilan" class="form-control" style="width: 400px" value="<?php echo $hasil['masyarakat_jumlah']; ?>">
			</div>
			<div class="form-group">
				<label>Status</label>
				<select class="form-control input-sm" name="status" style="width: 400px">
					<option value="">Pilih Status</option>
					<option value="A" <?= $hasil['masyarakat_status']=='A'?'selected':''; ?> >Aktif</option>
					<option value="H" <?= $hasil['masyarakat_status']=='H'?'selected':''; ?> >Nonaktif</option>
				</select>
			</div>

			<button class="btn btn-primary" name="btnSimpan" id="btnSimpan">Simpan</button>
		</form>
	</div>

	<?php include "footer.php"; ?>

</body>
</html>