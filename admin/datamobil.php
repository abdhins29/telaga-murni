<?php 
	include ("style/header.php");
	include ("style/sidebar.php");
?>
<div class="container-fluid">
	<div class="col-lg-12">
		<!-- Basic Card Example -->
		<div class="card shadow mt-3 mb-3">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Data Mobil</h6>
			</div>
			<div class="card-body">
				<button class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#tambah_mobil"><i class="fas fa-plus fa-sm"></i> Tambah Mobil</button>
      <div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr align="center">
							<th>No</th>
							<th>Foto Mobil</th>
							<th>Type Mobil</th>
							<th>Jenis Mobil</th>
							<th>Merk</th>
							<th>No. Polisi</th>
							<th>Warna</th>
							<th>Harga</th>
							<th>Status</th>
							<th colspan="2">Aksi</th>
						</tr>
					</thead>
					<?php 
						include("../config/koneksi.php");
						$no=1;
						$sql = mysqli_query($konek, "SELECT * FROM tbl_mobil a LEFT JOIN tbl_jenis b ON a.kd_jenis=b.kd_jenis");
						while($array = mysqli_fetch_assoc($sql)){
					?>
					<tbody>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><img src="../fotomobil/<?php echo $array['foto_mobil']; ?>" alt="" width="100"></td>
							<td><?php echo $array['type_mobil']; ?></td>
							<td><?php echo $array['nama_jenis']; ?></td>
							<td><?php echo $array['merk']; ?></td>
							<td><?php echo $array['no_polisi']; ?></td>
							<td><?php echo $array['warna']; ?></td>
							<td><?php echo 'Rp. '. number_format($array['harga']); ?></td>
							<td><?php if($array['status'] == 1){ 
									echo "Tersedia"; 
									}else{ 
									echo "Tidak Tersedia"; 
									} ?>
							</td>
							<td><a href="editmobil.php?kd=<?php echo $array['kd_mobil']; ?>"><i class="btn btn-success btn-sm"><span class="fas fa-edit"></span></i></a></td>
							<td><a href="hapusmobil.php?kd=<?php echo $array['kd_mobil']; ?>"><i class="btn btn-danger btn-sm"><span class="fas fa-trash"></span></i></a></td>
						</tr>
					</tbody>
					<?php 
					} 
					?>
				</table>
      </div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambah_mobil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Entry Data Mobil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form action="" method="POST" enctype="multipart/form-data">
      		<div class="form-group">
      			<input type="hidden" class="form-control mb-2" name="id" value="<?php echo $_SESSION['id']; ?>">
      			<label for="">Foto Mobil</label>
      			<input type="file" class="form-control mb-2" name="foto_mobil" required="">
      			<input type="text" class="form-control mb-2" name="type_mobil" placeholder="Type Mobil" required="">
      			<select name="kd_jenis" class="form-control mb-2">
      				<option value="">Pilih Jenis</option>
      				<?php 
      				$mysqli = mysqli_query($konek, "SELECT * FROM tbl_jenis");
      				while($fetch = mysqli_fetch_assoc($mysqli)){
      				?>
      				<option value="<?php echo $fetch['kd_jenis']; ?>"><?php echo $fetch['nama_jenis']; ?></option>
      				<?php 
      				}
      				?>
      			</select>
      			<input type="text" class="form-control mb-2" name="merk" placeholder="Merk Mobil" required="">
      			<input type="text" class="form-control mb-2" name="no_polisi" placeholder="No. Polisi Mobil" required="">
      			<input type="text" class="form-control mb-2" name="warna" placeholder="Warna Mobil" required="">
      			<input type="text" class="form-control mb-2" name="harga" placeholder="Harga Rental/Hari Mobil" required="">
      			<input type="hidden" class="form-control mb-2" name="status" value="1" readonly="">
      		</div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="tambah" class="btn btn-primary btn-sm">Tambah</button>
      </div>
      	</form>
    </div>
  </div>
</div>


<?php 
	include ("../config/koneksi.php");
	if (isset($_POST['tambah'])) {
	$query2 = mysqli_query($konek,"SELECT * FROM tbl_mobil ORDER BY kd_mobil DESC");
    $data2 = mysqli_fetch_assoc($query2);
    $jml = mysqli_num_rows($query2);
    if($jml==0){
      $kd_mobil='MBL001';
      }else{
        $subid = substr($data2['kd_mobil'],3);
        if($subid>0 && $subid<=8){
          $sub = $subid+1;
          $kd_mobil='MBL00'.$sub;
        }elseif($subid>=9 && $subid<=100){
          $sub = $subid+1;
          $kd_mobil='MBL0'.$sub;
        }elseif($subid>=99 && $subid<=1000){
          $sub = $subid+1;
          $kd_mobil='MBL'.$sub;
        }
      }

      $foto_mobil 		= $_FILES['foto_mobil']['name'];
      $type_mobil 		= $_POST['type_mobil'];
      $kd_jenis 			= $_POST['kd_jenis'];
      $merk 			= $_POST['merk'];
      $no_polisi 			= $_POST['no_polisi'];
      $warna 				= $_POST['warna'];
      $harga 		= $_POST['harga'];
      $status 	= $_POST['status'];
	
	$save = mysqli_query($konek,"INSERT INTO tbl_mobil VALUES('$kd_mobil','$foto_mobil','$type_mobil','$kd_jenis','$merk','$no_polisi','$warna','$harga','$status')");
	move_uploaded_file($_FILES['foto_mobil']['tmp_name'], "../fotomobil/".$_FILES['foto_mobil']['name']);

	if($save) {
      echo "<script language=javascript>
          window.alert('Berhasil Menambah!');
          window.location='datamobil.php';
          </script>";
      }else{
        echo "<script language=javascript>
          window.alert('Gagal Menambah!');
          window.location='datamobil.php';
          </script>";
      }
}
?>

<?php 
	include ("style/footer.php");
?>