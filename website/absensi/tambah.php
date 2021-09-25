<!-- proses penyimpanan -->

<?php 
	include "koneksi.php";

	//jika tombol simpan diklik
	if(isset($_POST['btnSimpan']))
	{
		//baca isi inputan form
		$nokartu = $_POST['nokartu'];
		$nama    = $_POST['nama'];
		$jKelamin= $_POST['jKelamin'];
		$alamat  = $_POST['alamat'];
		$jumlah  = $_POST['jumlah'];
		$status  = $_POST['status'];

		//simpan ke tabel karyawan
		$simpan = mysqli_query($konek, "INSERT INTO tb_masyarakat(masyarakat_nik, masyarakat_name, jenis_kelamin, alamat, masyarakat_jumlah, masyarakat_status)values('$nokartu', '$nama', '$jKelamin', '$alamat', '$jumlah', '$status')");

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

	//kosongkan tabel tmprfid
	mysqli_query($konek, "delete from tmprfid");
?>

<!DOCTYPE html>
<html>
<head>
	<?php include "header.php"; ?>
	<title>Tambah Data Masyarakat</title>

	<!-- pembacaan no kartu otomatis -->
	<script type="text/javascript">
		$(document).ready(function(){
			setInterval(function(){
				$("#norfid").load('nokartu.php')
			}, 0);  //pembacaan file nokartu.php, tiap 1 detik = 1000
		});
	</script>

</head>
<body>

	<?php include "menu.php"; ?>

	<!-- isi -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<h3>Tambah Data Masyarakat</h3>
				<form method="POST">
					<div id="norfid"></div>
					<div class="form-group">
						<label>Nama Masyarakat</label>
						<input type="text" name="nama" id="nama" placeholder="nama karyawan" class="form-control input-sm" style="width: 400px">
					</div>
					<div class="form-group">
						<label>Jenis Kelamin</label>
						<select class="form-control input-sm" name="jKelamin" style="width: 400px">
							<option value="">Pilih Jenis Kelamin</option>
							<option value="L">Laki Laki</option>
							<option value="W">Wanita</option>
						</select>
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<textarea name="alamat" id="alamat" class="form-control input-sm" style="width: 400px"></textarea>
					</div>
					<div class="form-group">
						<label>Jumlah Pengambilan</label>
						<select class="form-control input-sm" name="jumlah" style="width: 400px">
							<option value="">Pilih Jenis Pengambilan</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
						</select>
					</div>
					<div class="form-group">
						<label>Status</label>
						<select class="form-control input-sm" name="status" style="width: 400px">
							<option value="">Pilih Status</option>
							<option value="A">Aktif</option>
							<option value="H">Nonaktif</option>
						</select>
					</div>

					<button class="btn btn-primary" name="btnSimpan" id="btnSimpan" style="width: 400px">Simpan</button>
				</form>
			</div>
		</div>
		<!-- form input -->
	</div>

	<?php include "footer.php"; ?>

</body>
</html>