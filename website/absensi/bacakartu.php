<?php 
	include "koneksi.php";
	// //baca tabel tmprfid
	// if(!empty($_GET['nokartu'])){
	// 	$nokartus = $_GET['nokartu'];
	// 	mysqli_query($konek, "delete from tmprfid");

	// 	$simpan = mysqli_query($konek, "insert into tmprfid(nokartu)values('$nokartus')");		
	// }

	$baca_kartu = mysqli_query($konek, "select * from tmprfid");
	$data_kartu = mysqli_fetch_array($baca_kartu);
	$nokartu    = $data_kartu['nokartu'];
?>


<div class="container-fluid" style="text-align: center;">
	<?php if($nokartu=="") { ?>

	<h3>Silahkan Tempelkan Kartu RFID Anda</h3>
	<img src="images/rfid.png" style="width: 200px"> <br>
	<img src="images/animasi2.gif">

	<?php } else {
		//cek nomor kartu RFID tersebut apakah terdaftar di tabel karyawan
		$cari_masyarakat = mysqli_query($konek, "SELECT * FROM tb_masyarakat where masyarakat_nik = '$nokartu'");
		$jumlah_data = mysqli_num_rows($cari_masyarakat);

		if($jumlah_data == 0)
			echo "<h2> Kartu Anda Tidak Terdaftar </h2>";
		else
		{
			//ambil nama karyawan
			$data_mas = mysqli_fetch_array($cari_masyarakat);
			
			if($data_mas['masyarakat_status'] == 'A'){
				$nik = $data_mas['masyarakat_nik'];
				$counter_jumlah = $data_mas['masyarakat_jumlah'] + 1;
				$update = mysqli_query($konek, "UPDATE tb_masyarakat SET masyarakat_jumlah = '$counter_jumlah' WHERE masyarakat_nik = '$nik'");

				$sqljumlah = mysqli_query($konek, "SELECT * FROM tb_masyarakat WHERE masyarakat_nik = '$nik'");
				$dataJumlah = mysqli_fetch_array($sqljumlah);

				if($dataJumlah['masyarakat_jumlah'] == 4){
					$update = mysqli_query($konek, "UPDATE tb_masyarakat SET masyarakat_status = 'H' WHERE masyarakat_nik = '$nik'");
				}?>

				<h3>Silahkan Tempelkan Kartu RFID Anda</h3>
				<h4>Selamat Sudah Di Ambil</h4>
				<img src="images/rfid.png" style="width: 200px"> <br>
				<img src="images/animasi2.gif">

			<?php } else if($data_mas['masyarakat_status'] == 'H'){?>
				<h3>Silahkan Tempelkan Kartu RFID Anda</h3>
				<h4>Anda Tidak Bisa Mengambil lagi</h4>
				<img src="images/rfid.png" style="width: 200px"> <br>
				<img src="images/animasi2.gif">
			<?php }
		}
		//kosongkan tabel tmprfid
		mysqli_query($konek, "delete from tmprfid");
	} ?>

</div>