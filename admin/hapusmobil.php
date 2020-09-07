<?php
include ("../config/koneksi.php");
$kd_mobil= $_GET['kd'];

$sql1 = mysqli_query($konek,"SELECT * FROM tbl_mobil WHERE kd_mobil='$kd_mobil'");
$data1 = mysqli_fetch_array($sql1);
unlink("../fotomobil/".$data1['foto_mobil']);
$delete = mysqli_query($konek,"DELETE FROM tbl_mobil WHERE kd_mobil = '$kd_mobil'");

if($delete) {
	echo "<script language=javascript>
	window.alert('Berhasil Menghapus!');
	window.location='datamobil.php';
	</script>";
}else{
	echo "<script language=javascript>
	window.alert('Gagal Menghapus!');
	window.location='datamobil.php';
	</script>";
}

?>