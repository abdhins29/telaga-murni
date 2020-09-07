<?php 
    include ('style/header.php');
    include ('style/sidebar.php');
    include ('../config/koneksi.php');
?>

<div class="container-fluid">
	<!-- Basic Card Example -->
	<div class="card shadow mt-3 mb-3">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Pengembalian</h6>
		</div>
		<div class="card-body">
			<button class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#tambah_pengembalian"><i class="fas fa-plus fa-sm"></i> Tambah Pengembalian</button>
			<table class="table table-bordered">
				<thead>
					<tr align="center">
						<th>No</th>
						<th>Kode Transaksi - Nama Pelanggan</th>
						<th>Jumlah Terlambat</th>
					</tr>
				</thead>
				<?php 
				include ('../config/koneksi.php');
				$no = 1;
				$query = mysqli_query($konek, "SELECT * FROM tbl_pengembalian a LEFT JOIN tbl_transaksi b ON a.kd_transaksi=b.kd_transaksi LEFT JOIN tbl_pelanggan c ON b.kd_pelanggan=c.kd_pelanggan WHERE c.id= '$_SESSION[id]'");
				while($data = mysqli_fetch_assoc($query)){
				?>
				<tbody>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $data['kd_transaksi']; ?> - <?php echo $data['nm_pelanggan']; ?></td>
						<td><?php echo $data['terlambat']; ?></td>
					</tr>
				</tbody>
				<?php 
				}
				?>
			</table>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambah_pengembalian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Entry Data Pengembalian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form action="" method="POST" enctype="multipart/form-data">
      		<div class="form-group">
      			<input type="hidden" class="form-control mb-2" name="id" value="<?php echo $_SESSION['id']; ?>">
      			<label>Kode Transaksi</label>
      			<select id="kd_transaksi" name="kd_transaksi" class="form-control mb-2">
      				<option value="">Pilih Kode Transaksi</option>
      				<?php
      				include ("../config/koneksi.php"); 
      				$qqq = mysqli_query($konek,"SELECT * FROM tbl_transaksi a LEFT JOIN tbl_pelanggan b ON a.kd_pelanggan=b.kd_pelanggan");
      				while($ddd = mysqli_fetch_assoc($qqq)){
      					if ($ddd['status_kembali'] == "0" )
      					{
      						?>
      						<option value="<?php echo $ddd['kd_transaksi']; ?>"><?php echo $ddd['kd_transaksi']; ?> - <?php echo $ddd['nm_pelanggan']; ?></option>
      						<?php 
      					}
      				}
      				?>
      			</select>
            <label>Jumlah Terlambat/Hari</label>
      			<input type="text" class="form-control mb-2" name="terlambat" placeholder="Masukan dengan Angka" required="">
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
	$query2 = mysqli_query($konek,"SELECT * FROM tbl_pengembalian ORDER BY kd_kembali DESC");
    $data2 = mysqli_fetch_assoc($query2);
    $jml = mysqli_num_rows($query2);
    if($jml==0){
      $kd_kembali='KBL001';
      }else{
        $subid = substr($data2['kd_kembali'],3);
        if($subid>0 && $subid<=8){
          $sub = $subid+1;
          $kd_kembali='KBL00'.$sub;
        }elseif($subid>=9 && $subid<=100){
          $sub = $subid+1;
          $kd_kembali='KBL0'.$sub;
        }elseif($subid>=99 && $subid<=1000){
          $sub = $subid+1;
          $kd_kembali='KBL'.$sub;
        }
      }

      $kd_transaksi 	= $_POST['kd_transaksi'];
      $terlambat 		= $_POST['terlambat'];

      $dt=mysqli_query($konek,"SELECT * FROM tbl_transaksi a LEFT JOIN tbl_pelanggan b ON a.kd_pelanggan=b.kd_pelanggan LEFT JOIN tbl_mobil c ON a.kd_mobil=c.kd_mobil WHERE kd_transaksi='$kd_transaksi'");
      $dataqws=mysqli_fetch_array($dt);
      $a = 1;
      $status = $dataqws['status_kembali'] + $a;
      $denda = $terlambat * $dataqws['harga'] ;
      mysqli_query($konek,"update tbl_transaksi set status_kembali='$status', denda='$denda' where kd_transaksi='$kd_transaksi'");

	$save = mysqli_query($konek,"INSERT INTO tbl_pengembalian VALUES('$kd_kembali','$kd_transaksi','$terlambat')");

	if($save) {
      echo "<script language=javascript>
          window.alert('Berhasil Menambah!');
          window.location='datakembali.php';
          </script>";
      }else{
        echo "<script language=javascript>
          window.alert('Gagal Menambah!');
          window.location='datakembali.php';
          </script>";
      }
}
?>

<?php 
    include ('style/footer.php');
?>