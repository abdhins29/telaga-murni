<?php 
	include ("style/header.php");
	include ("style/sidebar.php");
?>
<div class="container-fluid">
	<div class="col-lg-12">
		<!-- Basic Card Example -->
		<div class="card shadow mt-3 mb-3">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Data Bank</h6>
			</div>
			<div class="card-body">
				<button class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#tambah_bank"><i class="fas fa-plus fa-sm"></i> Tambah Bank</button>
        <div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr align="center">
							<th>No</th>
							<th>Nama Bank</th>
							<th>No Rekening</th>
							<th>Nama Rekening</th>
							<th colspan="2">Aksi</th>
						</tr>
					</thead>
					<?php 
						include("../config/koneksi.php");
						$no=1;
						$sql = mysqli_query($konek, "SELECT * FROM tbl_bank");
						while($array = mysqli_fetch_assoc($sql)){
					?>
					<tbody>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $array['nm_bank']; ?></td>
							<td><?php echo $array['no_rek']; ?></td>
							<td><?php echo $array['nm_rek']; ?></td>
							<td><a href="editbank.php?kd=<?php echo $array['kd_bank']; ?>"><i class="btn btn-success btn-sm"><span class="fas fa-edit"></span></i></a></td>
							<td><a href="hapusbank.php?kd=<?php echo $array['kd_bank']; ?>"><i class="btn btn-danger btn-sm"><span class="fas fa-trash"></span></i></a></td>
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
<div class="modal fade" id="tambah_bank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Entry Data Bank</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form action="" method="POST" enctype="multipart/form-data">
      		<div class="form-group">
      			<input type="hidden" class="form-control mb-2" name="id" value="<?php echo $_SESSION['id']; ?>">
      			<input type="text" class="form-control mb-2" name="nm_bank" placeholder="Nama Bank" required="">
      			<input type="text" class="form-control mb-2" name="no_rek" placeholder="No. Rekening" required="">
      			<input type="text" class="form-control mb-2" name="nm_rek" placeholder="Nama Rekening" required="">
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
	$query2 = mysqli_query($konek,"SELECT * FROM tbl_bank ORDER BY kd_bank DESC");
    $data2 = mysqli_fetch_assoc($query2);
    $jml = mysqli_num_rows($query2);
    if($jml==0){
      $kd_bank='BNK001';
      }else{
        $subid = substr($data2['kd_bank'],3);
        if($subid>0 && $subid<=8){
          $sub = $subid+1;
          $kd_bank='BNK00'.$sub;
        }elseif($subid>=9 && $subid<=100){
          $sub = $subid+1;
          $kd_bank='BNK0'.$sub;
        }elseif($subid>=99 && $subid<=1000){
          $sub = $subid+1;
          $kd_bank='BNK'.$sub;
        }
      }

      $no_rek 		= $_POST['no_rek'];
      $nm_bank 		= $_POST['nm_bank'];
      $nm_rek 		= $_POST['nm_rek'];
	
	$save = mysqli_query($konek,"INSERT INTO tbl_bank VALUES('$kd_bank','$nm_bank','$no_rek','$nm_rek')");

	if($save) {
      echo "<script language=javascript>
          window.alert('Berhasil Menambah!');
          window.location='databank.php';
          </script>";
      }else{
        echo "<script language=javascript>
          window.alert('Gagal Menambah!');
          window.location='databank.php';
          </script>";
      }
}
?>

<?php 
	include ("style/footer.php");
?>