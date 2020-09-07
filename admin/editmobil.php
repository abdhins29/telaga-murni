<?php 
    include ('style/header.php');
    include ('style/sidebar.php');
	include("../config/koneksi.php");
	$kd_mobil = $_GET['kd'];
?>
<div class="container-fluid">
	<!-- Basic Card Example -->
	<div class="card shadow mt-3 mb-3">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Mobil</h6>
		</div>
		<div class="card-body">
		<?php 
			$query = mysqli_query($konek,"SELECT * FROM tbl_mobil where kd_mobil='$kd_mobil'")or die(mysqli_error());
			while($data = mysqli_fetch_array($query)){
		?>
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<input type="hidden" class="form-control mb-2" name="kd_mobil" value="<?php echo $data['kd_mobil']; ?>">
      			<label for="">Foto Mobil</label>
   				<img src="../fotomobil/<?php echo $data['foto_mobil'] ?>" width="150px" height="120px" /></br>
				<input type="checkbox" name="ubahfotoktp" value="true"> Ceklis jika ingin mengubah foto<br>
				<input name="foto" type="file" class="form-control mb-2">
				<select class="form-control mb-2" name="kd_jenis">
      				<option value="">Pilih Jenis</option>
				<?php 
				$mysqli = mysqli_query($konek, "SELECT * FROM tbl_jenis");
				while($array = mysqli_fetch_array($mysqli)){
				?>
      				<option value="<?php echo $array['kd_jenis']; ?>"><?php echo $array['nama_jenis']; ?></option>
      			<?php 
      			}
      			?>
      			</select>
      			<input type="text" class="form-control mb-2" name="type_mobil" value="<?php echo $data['type_mobil'] ?>">
      			<input type="text" class="form-control mb-2" name="merk" value="<?php echo $data['merk']; ?>">
      			<input type="text" class="form-control mb-2" name="warna" value="<?php echo $data['warna'] ?>">
      			<input type="text" class="form-control mb-2" name="no_polisi" value="<?php echo $data['no_polisi'] ?>">
      			<input type="text" class="form-control mb-2" name="harga" value="<?php echo $data['harga'] ?>">
      			<select class="form-control" name="status">
      				<option value="">Pilih Status</option>
      				<option value="1" <?php if($data['status'] == '1'){ echo 'selected'; } ?>> Tersedia </option>
      				<option value="0" <?php if($data['status'] == '0'){ echo 'selected'; } ?>> Tidak Tersedia </option>
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

$type_mobil 		= $_POST['type_mobil'];
$kd_jenis 			= $_POST['kd_jenis'];
$merk 				= $_POST['merk'];
$no_polisi 			= $_POST['no_polisi'];
$warna 				= $_POST['warna'];
$harga 				= $_POST['harga'];
$status 			= $_POST['status'];

// Cek apakah ingin mengubah fotonya atau tidak
if(isset($_POST['ubahfotoktp'])){ // Jika menceklis checkbox yang ada di form ubah, lakukan :
	// Ambil data foto yang dipilih dari form
	$sumber = $_FILES['foto']['name'];
	$nama_gambar = $_FILES['foto']['tmp_name'];
	
	// Rename nama fotonya dengan menambahkan tanggal upload
	$fotobaru = date('d-m-Y').$sumber;
	
	// Set path folder tempat menyimpan fotonya
	$path = "../fotomobil/".$fotobaru;

	if(move_uploaded_file($nama_gambar, $path)){ // Cek apakah gambar berhasil diupload atau tidak
		// Query untuk menampilkan data 
		$sql1 = mysqli_query($konek,"SELECT * FROM tbl_mobil WHERE kd_mobil='$kd_mobil'");
		$data1 = mysqli_fetch_array($sql1);

		unlink("../fotomobil/".$data1['foto_mobil']); // Hapus file gambar sebelumnya yang ada di folder images
		
		// Proses ubah data ke Database
		$sql2 = mysqli_query($konek,"UPDATE tbl_mobil SET foto_mobil='$fotobaru', type_mobil='$type_mobil', kd_jenis='$kd_jenis', merk='$merk', no_polisi='$no_polisi', warna='$warna', harga='$harga', status='$status' WHERE kd_mobil='$kd_mobil'"); // Eksekusi/ Jalankan query dari variabel $query

		if($sql2){ // Cek jika proses simpan ke database sukses atau tidak
			// Jika Sukses, Lakukan :
			echo "<script language=javascript>
		          window.alert('Berhasil Menyimpan kedalam Database!');
		          window.location='datamobil.php';
		          </script>"; // Redirect ke halaman datamobil.php
		}else{
			// Jika Gagal, Lakukan :
			echo "<script language=javascript>
		          window.alert('Gagal Menyimpan kedalam Database!');
		          window.location='datamobil.php';
		          </script>";
		}
	}else{
		// Jika gambar gagal diupload, Lakukan :
		echo "<script language=javascript>
				window.alert('Foto Mobil Gagal diUpload!');
				window.location='datamobil.php';
				</script>";
	}
}else{ // Jika tidak menceklis checkbox yang ada di form ubah, lakukan :
	// Proses ubah data ke Database
	//var_dump($query); exit;
	$sql3 = mysqli_query($konek,"UPDATE tbl_mobil SET type_mobil='$type_mobil', kd_jenis='$kd_jenis', merk='$merk', no_polisi='$no_polisi', warna='$warna', harga='$harga', status='$status' WHERE kd_mobil='$kd_mobil'"); // Eksekusi/ Jalankan query dari variabel $query

	if($sql3){ // Cek jika proses simpan ke database sukses atau tidak
		// Jika Sukses, Lakukan :
		
		echo "<script language=javascript>
				window.alert('Berhasil Mengedit!');
				window.location='datamobil.php';
				</script>"; // Redirect ke halaman datamobil.php
	}else{
		// Jika Gagal, Lakukan :
		echo "<script language=javascript>
				window.alert('Gagal Mengedit!');
				window.location='datamobil.php';
				</script>";
	}
}
}
?>

<?php 
    include ('style/footer.php');
?>