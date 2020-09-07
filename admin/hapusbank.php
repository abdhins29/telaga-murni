<?php
include ("../config/koneksi.php");
$kd_bank= $_GET['kd'];

$delete = mysqli_query($konek,"DELETE FROM tbl_bank WHERE kd_bank = '$kd_bank'");
if($delete) {
	echo "<script language=javascript>
	window.alert('Berhasil Menghapus!');
	window.location='databank.php';
	</script>";
}else{
	echo "<script language=javascript>
	window.alert('Gagal Menghapus!');
	window.location='databank.php';
	</script>";
}

?>