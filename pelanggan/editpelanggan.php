<?php 
    include ('style/header.php');
    include ('style/sidebar.php');
	include("../config/koneksi.php");
	$kd_pelanggan = $_GET['kd'];
?>
<div class="container-fluid">
	<!-- Basic Card Example -->
	<div class="card shadow mt-3 mb-3">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Pelanggan</h6>
		</div>
		<div class="card-body">
		<?php 
			$query = mysqli_query($konek,"SELECT * FROM tbl_pelanggan where kd_pelanggan=
					'$kd_pelanggan'")or die(mysqli_error());
			while($data = mysqli_fetch_array($query)){
		?>
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="form-group">
      			<input type="text" class="form-control mb-2" name="no_ktp" value="<?php echo $data['no_ktp'] ?>">
      			<input type="hidden" class="form-control mb-2" name="id" value="<?php echo $data['id']; ?>">
      			<input type="text" class="form-control mb-2" name="nm_pelanggan" value="<?php echo $data['nm_pelanggan'] ?>">
      			<input type="date" class="form-control mb-2" name="tgl_lahir" value="<?php echo $data['tgl_lahir'] ?>">
      			<input type="text" class="form-control mb-2" name="alamat" value="<?php echo $data['alamat'] ?>">
      			<input type="text" class="form-control mb-2" name="no_hp" value="<?php echo $data['no_hp'] ?>">
      			<label for="">Foto KTP</label>
   				<img src="../ktp-pelanggan/<?php echo $data['fotoktp'] ?>" width="150px" height="120px" /></br>
				<input type="checkbox" name="ubahfotoktp" value="true"> Ceklis jika ingin mengubah foto<br>
				<input name="foto" type="file" class="form-control mb-2">
      			<select class="form-control" name="status_peminjaman">
      				<option value=""> -- Silahkan Pilih -- </option>
      				<option value="1" <?php if($data['status_peminjaman'] == '1'){ echo 'selected'; } ?>> Approve </option>
      				<option value="0" <?php if($data['status_peminjaman'] == '0'){ echo 'selected'; } ?>> Pandding </option>
      			</select>
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

$id 				= $_POST['id'];
$no_ktp 			= $_POST['no_ktp'];
$nm_pelanggan 		= $_POST['nm_pelanggan'];
$tgl_lahir 			= $_POST['tgl_lahir'];
$alamat 			= $_POST['alamat'];
$no_hp 				= $_POST['no_hp'];
$status_peminjaman 	= $_POST['status_peminjaman'];

// Cek apakah ingin mengubah fotonya atau tidak
if(isset($_POST['ubahfotoktp'])){ // Jika menceklis checkbox yang ada di form ubah, lakukan :
	// Ambil data foto yang dipilih dari form
	$sumber = $_FILES['foto']['name'];
	$nama_gambar = $_FILES['foto']['tmp_name'];
	
	// Rename nama fotonya dengan menambahkan tanggal upload
	$fotobaru = date('d-m-Y').$sumber;
	
	// Set path folder tempat menyimpan fotonya
	$path = "../ktp-pelanggan/".$fotobaru;

	if(move_uploaded_file($nama_gambar, $path)){ // Cek apakah gambar berhasil diupload atau tidak
		// Query untuk menampilkan data 
		$sql1 = mysqli_query($konek,"SELECT * FROM tbl_pelanggan WHERE kd_pelanggan='$kd_pelanggan'");
		$data1 = mysqli_fetch_array($sql1);

		unlink("../ktp-pelanggan/".$data1['fotoktp']); // Hapus file gambar sebelumnya yang ada di folder images
		
		// Proses ubah data ke Database
		$sql2 = mysqli_query($konek,"UPDATE tbl_pelanggan SET id='$id', no_ktp='$no_ktp', nm_pelanggan='$nm_pelanggan', tgl_lahir='$tgl_lahir', alamat='$alamat', no_hp='$no_hp', fotoktp='$fotobaru', status_peminjaman='$status_peminjaman' WHERE kd_pelanggan='$kd_pelanggan'"); // Eksekusi/ Jalankan query dari variabel $query

		if($sql2){ // Cek jika proses simpan ke database sukses atau tidak
			// Jika Sukses, Lakukan :
			echo "<script language=javascript>
		          window.alert('Berhasil Menyimpan kedalam Database!');
		          window.location='datapelanggan.php';
		          </script>"; // Redirect ke halaman datapelanggan.php
		}else{
			// Jika Gagal, Lakukan :
			echo "<script language=javascript>
		          window.alert('Gagal Menyimpan kedalam Database!');
		          window.location='datapelanggan.php';
		          </script>";
		}
	}else{
		// Jika gambar gagal diupload, Lakukan :
		echo "<script language=javascript>
				window.alert('Foto KTP Gagal diUpload!');
				window.location='datapelanggan.php';
				</script>";
	}
}else{ // Jika tidak menceklis checkbox yang ada di form ubah, lakukan :
	// Proses ubah data ke Database
	//var_dump($query); exit;
	$sql3 = mysqli_query($konek,"UPDATE tbl_pelanggan SET id='$id',no_ktp='$no_ktp', nm_pelanggan='$nm_pelanggan', tgl_lahir='$tgl_lahir', alamat='$alamat', no_hp='$no_hp', status_peminjaman='$status_peminjaman' WHERE kd_pelanggan='$kd_pelanggan'"); // Eksekusi/ Jalankan query dari variabel $query

	if($sql3){ // Cek jika proses simpan ke database sukses atau tidak
		// Jika Sukses, Lakukan :
		
		echo "<script language=javascript>
				window.alert('Berhasil Mengedit!');
				window.location='datapelanggan.php';
				</script>"; // Redirect ke halaman datapelanggan.php
	}else{
		// Jika Gagal, Lakukan :
		echo "<script language=javascript>
				window.alert('Gagal Mengedit!');
				window.location='datapelanggan.php';
				</script>";
	}
}
}
?>

<?php 
    include ('style/footer.php');
?>