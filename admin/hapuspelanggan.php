<?php
include ("../config/koneksi.php");
$kd_pelanggan= $_GET['kd'];


$sql1 = mysqli_query($konek,"SELECT * FROM tbl_pelanggan WHERE kd_pelanggan='$kd_pelanggan'");
$data1 = mysqli_fetch_array($sql1);
unlink("../ktp-pelanggan/".$data1['fotoktp']);
$delete = mysqli_query($konek,"DELETE FROM tbl_pelanggan WHERE kd_pelanggan = '$kd_pelanggan'");

if($delete) {
	echo "<script language=javascript>
	window.alert('Berhasil Menghapus!');
	window.location='datapelanggan.php';
	</script>";
}else{
	echo "<script language=javascript>
	window.alert('Gagal Menghapus!');
	window.location='datapelanggan.php';
	</script>";
}

?>