<?php 
    include ('style/header.php');
    include ('style/sidebar.php');
	include ("../config/koneksi.php");
	$kd_transaksi = $_GET['id'];
?>
<div class="container-fluid">
	<!-- Basic Card Example -->
	<div class="card shadow mt-3 mb-3">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Pelanggan</h6>
		</div>
		<div class="card-body">
		<?php 
			$query = mysqli_query($konek,"SELECT * FROM tbl_transaksi a LEFT JOIN tbl_mobil b ON a.kd_mobil=b.kd_mobil where a.kd_transaksi='$kd_transaksi'")or die(mysqli_error());
			while($data = mysqli_fetch_array($query)){
		?>
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="form-group">
      			<input type="hidden" class="form-control mb-2" name="harga" value="<?php echo $data['harga']; ?>">
      			<input type="date" class="form-control mb-2" name="tgl_sewa" value="<?php echo $data['tgl_sewa']; ?>">
      			<input type="date" class="form-control mb-2" name="tgl_kembali" value="<?php echo $data['tgl_kembali']; ?>">
      		</div>
      	</div>
      	<div class="modal-footer">
      		<button type="submit" name="edit" class="btn btn-success btn-sm" >Edit</button>
      	</div>
		</form>
		<?php 
		}
		?>
	</div>
</div>

<?php
include ("../config/koneksi.php");

if(isset($_POST['edit'])) {

$harga 	  		= $_POST['harga'];
$tgl_sewa 	  	= $_POST['tgl_sewa'];
$tgl_kembali 	= $_POST['tgl_kembali'];

$dicekin  = date_create($_POST['tgl_sewa']);
$dicekout = date_create($_POST['tgl_kembali']);
$interval = date_diff($dicekin, $dicekout);

//$datetime1 = new DateTime($tgl_kembali);
//$datetime2 = new DateTime($tgl_sewa);
//$difference = $datetime1->diff($datetime2);
  
$jumlah_harga = $harga * $interval->d;

	$update = mysqli_query($konek,"UPDATE tbl_transaksi SET tgl_sewa='$tgl_sewa',tgl_kembali='$tgl_kembali', jml_harga='$jumlah_harga' WHERE kd_transaksi='$kd_transaksi'"); // Eksekusi/ Jalankan query dari variabel $query

	if($update){ // Cek jika proses simpan ke database sukses atau tidak
		// Jika Sukses, Lakukan :
		
		echo "<script language=javascript>
				window.alert('Berhasil Mengedit!');
				window.location='datarentalpel.php';
				</script>"; // Redirect ke halaman datarental.php
	}else{
		// Jika Gagal, Lakukan :
		echo "<script language=javascript>
				window.alert('Gagal Mengedit!');
				window.location='datarentalpel.php';
				</script>";
	}
}
?>

<?php 
    include ('style/footer.php');
?>