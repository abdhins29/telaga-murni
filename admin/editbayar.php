<?php 
    include ('style/header.php');
    include ('style/sidebar.php');
	include ("../config/koneksi.php");
	$kd_bayar = $_GET['kd'];
?>
<div class="container-fluid">
	<!-- Basic Card Example -->
	<div class="card shadow mt-3 mb-3">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Pelanggan</h6>
		</div>
		<div class="card-body">
		<?php 
		$det = mysqli_query($konek,"SELECT * FROM tbl_pembayaran a LEFT JOIN tbl_transaksi b ON a.kd_transaksi=b.kd_transaksi WHERE kd_bayar='$kd_bayar'")or die(mysqli_error());
		while($d = mysqli_fetch_array($det)){
		?>
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="form-group">
      			<input type="hidden" class="form-control mb-2" name="kd_bayar" value="<?php echo $d['kd_bayar']; ?>">
      			<input type="text" class="form-control mb-2" name="kd_transaksi" value="<?php echo $d['kd_transaksi']; ?>" readonly>
      			<label>Tanggal Bayar</label>
      			<input type="date" class="form-control mb-2" name="tgl_bayar" value="<?php echo $d['tgl_bayar']; ?>" required="">
      			<label>Pembayaran</label>
      			<select class="form-control mb-2" name="pembayaran" required="required" id="pembayaran" onchange="proses()">
      				<option value=""> -- Silahkan Pilih -- </option>
      				<option value="Cash">Cash</option>
      				<option value="Transfer">Transfer</option>
      			</select>
      		<div id="transfer_bayar">
      			<input type="text" class="form-control mb-2" name="bank_anda" id="bank_anda" placeholder="Nama Bank Anda">
      			<input type="text" class="form-control mb-2" name="norek_anda" id="norek_anda" placeholder="No. Rek Anda">
      			<input type="text" class="form-control mb-2" name="nmrek_anda" id="nmrek_anda" placeholder="Nama Rek Anda">

      			<label for="">Bukti Bayar</label>
      			<input type="file" class="form-control mb-2" name="bukti_bayar" id="bukti_bayar">
      			</div>
      		</div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="edit" class="btn btn-success btn-sm">Edit</button>
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

$kd_bayar = $_POST['kd_bayar'];
$kd_transaksi=$_POST['kd_transaksi'];
$tgl_bayar=$_POST['tgl_bayar'];
$pembayaran=$_POST['pembayaran'];
$bank_anda=$_POST['bank_anda'];
$norek_anda=$_POST['norek_anda'];
$nmrek_anda=$_POST['nmrek_anda'];
$bukti_bayar 			= $_FILES['bukti_bayar']['name'];

$update = mysqli_query($konek,"UPDATE tbl_pembayaran set kd_transaksi='$kd_transaksi', tgl_bayar='$tgl_bayar', pembayaran='$pembayaran', nm_bank='$bank_anda', no_rek='$norek_anda', nm_rek='$nmrek_anda', bukti_bayar='$bukti_bayar' where kd_bayar='$kd_bayar'");
	move_uploaded_file($_FILES['bukti_bayar']['tmp_name'], "../bukti/".$_FILES['bukti_bayar']['name']);
	if($update){ // Cek jika proses simpan ke database sukses atau tidak
		// Jika Sukses, Lakukan :
		
		echo "<script language=javascript>
				window.alert('Berhasil Mengedit!');
				window.location='databayarpel.php';
				</script>"; // Redirect ke halaman datarental.php
	}else{
		// Jika Gagal, Lakukan :
		echo "<script language=javascript>
				window.alert('Gagal Mengedit!');
				window.location='databayarpel.php';
				</script>";
	}
}
?>

	<script type="text/javascript">
	function proses() {
		var pembayaran = { pembayaran: $('#pembayaran').val()};
		if (document.getElementById("pembayaran").value == "Cash"){
			$('#norek_anda').val("").hide("#transfer_bayar");
			$('#bank_anda').val("").hide("#transfer_bayar");
			$('#nmrek_anda').val("").hide("#transfer_bayar");
			$('#bukti_bayar').val("").hide("#transfer_bayar");
		}     
		else {
			$('#norek_anda').val("").show("#transfer_bayar");
			$('#bank_anda').val("").show("#transfer_bayar");
			$('#nmrek_anda').val("").show("#transfer_bayar");
			$('#bukti_bayar').val("").show("#transfer_bayar");
		}
	}
	</script>
<?php 
    include ('style/footer.php');
?>