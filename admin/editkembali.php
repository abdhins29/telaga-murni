<?php 
	include ("style/header.php");
	include ("style/sidebar.php");
	include ("../config/koneksi.php");
	$kd_kembali = $_GET['kd'];
?>
<div class="container-fluid">
	<div class="col-lg-12">
		<!-- Basic Card Example -->
		<div class="card shadow mt-3 mb-3">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Edit Data Bank</h6>
			</div>
			<div class="card-body">
				<?php 
					include ("../config/koneksi.php");					
					$qq = mysqli_query($konek, "SELECT * FROM tbl_pengembalian a LEFT JOIN tbl_transaksi b ON a.kd_transaksi=b.kd_transaksi WHERE kd_kembali='$kd_kembali'");
					$dd = mysqli_fetch_assoc($qq);
				?>
				<form action="" method="POST">
					<input type="hidden" class="form-control" name="kd_kembali" value="<?php echo $dd['kd_kembali']; ?>" readonly="">
					<input type="text" class="form-control mb-2" name="kd_transaksi" value="<?php echo $dd['kd_transaksi']; ?>" required="">
					<input type="text" class="form-control mb-2" name="terlambat" value="<?php echo $dd['terlambat']; ?>" required="">
					<div class="form-group">
						<button type="submit" name="edit" class="btn btn-md btn-success">Edit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php 
include ('../config/koneksi.php');
if (isset($_POST['edit'])) {

	$kd_kembali = $_POST['kd_kembali'];
	$kd_transaksi=$_POST['kd_transaksi'];
	$terlambat=$_POST['terlambat'];

	$dt=mysqli_query($konek,"SELECT * FROM tbl_transaksi a LEFT JOIN tbl_pelanggan b ON a.kd_pelanggan=b.kd_pelanggan LEFT JOIN tbl_mobil c ON a.kd_mobil=c.kd_mobil WHERE kd_transaksi = '$kd_transaksi'");
	$data=mysqli_fetch_array($dt);
	$denda = $terlambat * $data['harga'] ;
	mysqli_query($konek,"UPDATE tbl_transaksi set denda='$denda' where kd_transaksi='$kd_transaksi'");

	$update = mysqli_query($konek,"UPDATE tbl_pengembalian  set kd_transaksi='$kd_transaksi', terlambat='$terlambat' where kd_kembali='$kd_kembali'");
	if($update) {
      echo "<script language=javascript>
          window.alert('Berhasil Mengedit!');
          window.location='datakembalipel.php';
          </script>";
      }else{
        echo "<script language=javascript>
          window.alert('Gagal Mengedit!');
          window.location='datakembalipel.php';
          </script>";
      }

}
?>

<?php 
	include ("style/footer.php");
?>