<?php
	include "koneksi.php";

	//baca nomor kartu dari NodeMCU
	$nokartu = $_GET['nokartu'];
	//kosongkan tabel tmprfid
	mysqli_query($konek, "delete from tmprfid");

	//simpan nomor kartu yang baru ke tabel tmprfid
	$simpan = mysqli_query($konek, "insert into tmprfid(nokartu)values('$nokartu')");

	$cari_masyarakat = mysqli_query($konek, "SELECT * FROM tb_masyarakat where masyarakat_nik = '$nokartu'");
	$jumlah_data = mysqli_num_rows($cari_masyarakat);
	if($jumlah_data == 0)
			echo "kosong";
		else
		{
			//ambil nama karyawan
			$data_mas = mysqli_fetch_array($cari_masyarakat);
			if($data_mas['masyarakat_status'] == 'A'){
				echo "ambil";  
			} else if($data_mas['masyarakat_status'] == 'H'){
				echo "habis";
			}
		}
	
?>