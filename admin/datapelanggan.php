<?php 
    include ('style/header.php');
    include ('style/sidebar.php');
?>
<div class="container-fluid">
	<!-- Basic Card Example -->
	<div class="card shadow mt-3 mb-3">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Pelanggan</h6>
		</div>
		<div class="card-body">
			<button class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#tambah_pelanggan"><i class="fas fa-plus fa-sm"></i> Tambah Pelanggan</button>
			<div class="table-responsive">
			<table class="table table-bordered" width="100%">
				<thead>
					<tr align="center">
						<th>No</th>
						<th>No KTP</th>
						<th>Nama Pelanggan</th>
						<th>Tanggal Lahir</th>
						<th>Alamat</th>
						<th>No Hp</th>
						<th>Foto KTP</th>
						<th>Status Peminjaman</th>
						<th colspan="3">Aksi</th>
					</tr>
				</thead>
				<?php 
				include ('../config/koneksi.php');
				$no = 1;
				$query = mysqli_query($konek, "SELECT * FROM tbl_pelanggan");
				while($data = mysqli_fetch_assoc($query)){
				?>
				<tbody>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $data['no_ktp']; ?></td>
						<td><?php echo $data['nm_pelanggan']; ?></td>
						<td><?php echo $data['tgl_lahir']; ?></td>
						<td><?php echo $data['alamat']; ?></td>
						<td><?php echo $data['no_hp']; ?></td>
						<td><img src="../ktp-pelanggan/<?php echo $data['fotoktp']; ?>" alt="" width="100"></td>
						<td><?php if($data['status_peminjaman'] == 1){ 
									echo "Approve"; 
									}else{ 
									echo "Pandding"; 
									} ?>
						</td>
						<td><a href="editpelanggan.php?kd=<?php echo $data['kd_pelanggan']; ?>"><i class="btn btn-success btn-sm"><span class="fas fa-edit"></span></i></a></td>
						<td><a href="hapuspelanggan.php?kd=<?php echo $data['kd_pelanggan']; ?>"><i class="btn btn-danger btn-sm"><span class="fas fa-trash"></span></i></a></td>
						<td><a href="cetakpelanggan.php?kd=<?php echo $data['kd_pelanggan']; ?>"><i class="btn btn-primary btn-sm"><span class="fas fa-print"></span></i></a></td>
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

<!-- Modal -->
<div class="modal fade" id="tambah_pelanggan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Entry Data Pelanggan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form action="" method="POST" enctype="multipart/form-data">
      		<div class="form-group">
      			<input type="text" class="form-control mb-2" name="no_ktp" placeholder="Nomor KTP Anda" required="">
      			<input type="hidden" class="form-control mb-2" name="id" value="<?php echo $_SESSION['id']; ?>">
      			<input type="text" class="form-control mb-2" name="nm_pelanggan" placeholder="Nama Anda" required="">
      			<input type="date" class="form-control mb-2" name="tgl_lahir" placeholder="Tanggal Lahir Anda" required="">
      			<input type="text" class="form-control mb-2" name="alamat" placeholder="Alamat Anda">
      			<input type="text" class="form-control mb-2" name="no_hp" placeholder="No HP Anda" required="">
      			<label for="">Foto KTP</label>
      			<input type="file" class="form-control mb-2" name="fotoktp" required="">
      			<input type="hidden" class="form-control" name="status_peminjaman" value="0" readonly="">
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
	$query2 = mysqli_query($konek,"SELECT * FROM tbl_pelanggan ORDER BY kd_pelanggan DESC");
    $data2 = mysqli_fetch_assoc($query2);
    $jml = mysqli_num_rows($query2);
    if($jml==0){
      $kd_pelanggan='PLG001';
      }else{
        $subid = substr($data2['kd_pelanggan'],3);
        if($subid>0 && $subid<=8){
          $sub = $subid+1;
          $kd_pelanggan='PLG00'.$sub;
        }elseif($subid>=9 && $subid<=100){
          $sub = $subid+1;
          $kd_pelanggan='PLG0'.$sub;
        }elseif($subid>=99 && $subid<=1000){
          $sub = $subid+1;
          $kd_pelanggan='PLG'.$sub;
        }
      }

    $no_ktp 			= $_POST['no_ktp'];
	$id 				= $_POST['id'];
    $nm_pelanggan 		= $_POST['nm_pelanggan'];
    $tgl_lahir 			= $_POST['tgl_lahir'];
    $alamat 			= $_POST['alamat'];
    $no_hp 				= $_POST['no_hp'];
	$fotoktp 			= $_FILES['fotoktp']['name'];
	$status_peminjaman 	= $_POST['status_peminjaman'];
	
	$save = mysqli_query($konek,"INSERT INTO tbl_pelanggan VALUES('$kd_pelanggan','$id',
			'$no_ktp','$nm_pelanggan','$tgl_lahir','$alamat','$no_hp','$fotoktp','$status_peminjaman')");
	move_uploaded_file($_FILES['fotoktp']['tmp_name'], "../ktp-pelanggan/".$_FILES['fotoktp']['name']);

	if($save) {
      echo "<script language=javascript>
          window.alert('Berhasil Menambah!');
          window.location='datapelanggan.php';
          </script>";
      }else{
        echo "<script language=javascript>
          window.alert('Gagal Menambah!');
          window.location='datapelanggan.php';
          </script>";
      }
}
?>

<?php 
    include ('style/footer.php');
?>