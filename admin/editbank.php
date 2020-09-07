<?php 
	include ("style/header.php");
	include ("style/sidebar.php");
	include ("../config/koneksi.php");
	$kd_bank = $_GET['kd'];
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
					$qq = mysqli_query($konek, "SELECT * FROM tbl_bank WHERE kd_bank = '$kd_bank'");
					$dd = mysqli_fetch_assoc($qq);
				?>
				<form action="" method="POST">
					<input type="hidden" class="form-control" name="kd_bank" value="<?php echo $dd['kd_bank']; ?>" readonly="">
					<div class="form-group">
						<label>Nama Dokter</label>
						<input type="text" class="form-control" name="nm_bank" value="<?php echo $dd['nm_bank']; ?>">
					</div>
					<div class="form-group">
						<label>Gender</label>
						<input type="text" class="form-control" name="no_rek" value="<?php echo $dd['no_rek']; ?>">
					</div>
					<div class="form-group">
						<label>Jam Kerja</label>
						<input type="text" class="form-control" name="nm_rek" value="<?php echo $dd['nm_rek']; ?>">
					</div>
					<div class="form-group">
						<button type="submit" name="edit" class="btn btn-md btn-success">Edit</button>
						<button type="reset" name="reset" class="btn btn-md btn-danger">Reset</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php 
include ('../config/koneksi.php');
if (isset($_POST['edit'])) {

	$kd_bank	= $_POST['kd_bank'];
	$nm_bank	= $_POST['nm_bank'];
	$no_rek     = $_POST['no_rek'];
	$nm_rek		= $_POST['nm_rek'];

	$update = mysqli_query($konek, "UPDATE tbl_bank SET kd_bank = '$kd_bank', nm_bank = '$nm_bank', no_rek = '$no_rek', nm_rek = '$nm_rek' WHERE kd_bank = '$kd_bank'");
	if($update) {
      echo "<script language=javascript>
          window.alert('Berhasil Mengedit!');
          window.location='databank.php';
          </script>";
      }else{
        echo "<script language=javascript>
          window.alert('Gagal Mengedit!');
          window.location='databank.php';
          </script>";
      }

}
?>

<?php 
	include ("style/footer.php");
?>