<?php 
include "../config/koneksi.php";

$kd_bayar=$_GET['kd'];

$edit = mysqli_query($konek,"UPDATE tbl_transaksi,tbl_pembayaran SET status_bayar=0 WHERE tbl_transaksi.kd_transaksi=tbl_pembayaran.kd_transaksi AND tbl_pembayaran.kd_bayar='$kd_bayar'");
		
$delete = mysqli_query($konek,"DELETE From tbl_pembayaran Where kd_bayar='$kd_bayar'");

if($delete) {
	echo "<script language=javascript>
	window.alert('Berhasil Menghapus!');
	window.location='databayarpel.php';
	</script>";
}else{
	echo "<script language=javascript>
	window.alert('Gagal Menghapus!');
	window.location='databayarpel.php';
	</script>";
}
?>

