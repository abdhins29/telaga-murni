<?php 
include "../config/koneksi.php";

$kd_transaksi=$_GET['id'];

mysqli_query($konek,"UPDATE tbl_mobil,tbl_transaksi SET status=1 WHERE tbl_mobil.kd_mobil=tbl_transaksi.kd_mobil AND tbl_transaksi.kd_transaksi='$kd_transaksi'");

mysqli_query($konek,"UPDATE tbl_pelanggan,tbl_transaksi SET status_peminjaman=0 WHERE tbl_pelanggan.kd_pelanggan=tbl_transaksi.kd_pelanggan AND tbl_transaksi.kd_transaksi='$kd_transaksi'");
		
$delete = mysqli_query($konek,"Delete From tbl_transaksi Where kd_transaksi='$kd_transaksi'");

	if($delete){ // Cek jika proses simpan ke database sukses atau tidak
		// Jika Sukses, Lakukan :
		
		echo "<script language=javascript>
				window.alert('Berhasil Menghapus!');
				window.location='datarentalpel.php';
				</script>"; // Redirect ke halaman datarental.php
	}else{
		// Jika Gagal, Lakukan :
		echo "<script language=javascript>
				window.alert('Gagal Menghapus!');
				window.location='datarentalpel.php';
				</script>";
	}
?>