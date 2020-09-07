<?php 
include "../config/koneksi.php";

$kd_kembali=$_GET['kd'];

mysqli_query($konek,"UPDATE tbl_transaksi,tbl_pengembalian SET status_kembali=0 WHERE tbl_transaksi.kd_transaksi=tbl_pengembalian.kd_transaksi AND tbl_pengembalian.kd_kembali='$kd_kembali'");
		
$delete = mysqli_query($konek,"DELETE From tbl_pengembalian Where kd_kembali='$kd_kembali'");

	if($delete){ // Cek jika proses simpan ke database sukses atau tidak
		// Jika Sukses, Lakukan :
		
		echo "<script language=javascript>
				window.alert('Berhasil Menghapus!');
				window.location='datakembalipel.php';
				</script>"; // Redirect ke halaman datarental.php
	}else{
		// Jika Gagal, Lakukan :
		echo "<script language=javascript>
				window.alert('Gagal Menghapus!');
				window.location='datakembalipel.php';
				</script>";
	}
?>

