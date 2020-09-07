<?php 
	include ("style/header.php");
	include ("style/sidebar.php");
?>
<div class="container-fluid">
	<div class="col-lg-12">
		<!-- Basic Card Example -->
		<div class="card shadow mt-3 mb-3">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Data Rental</h6>
			</div>
			<div class="card-body">
				<button class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#tambah_pemesanan"><i class="fas fa-plus fa-sm"></i> Tambah Rental</button>
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr align="center">
							<th>No</th>
							<th>Tanggal Rental</th>
							<th>Type Mobil - No. Polisi</th>
							<th>No. KTP</th>
							<th>Nama Pelanggan</th>
							<th>Harga</th>
							<th>Jumlah Harga</th>
							<th>Denda</th>
							<th>Total Harga</th>
							<th colspan="3">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							include ('../config/koneksi.php');
							$no = 1;
							$qq = mysqli_query($konek, "SELECT * FROM tbl_transaksi a LEFT JOIN tbl_pelanggan b ON a.kd_pelanggan=b.kd_pelanggan LEFT JOIN tbl_mobil c ON a.kd_mobil=c.kd_mobil");
							while($dd = mysqli_fetch_assoc($qq)){
						?>
						<tr>
							<td align="right"><?php echo $no++; ?></td>
							<td><?php echo $dd['tgl_sewa']; ?></td>
							<td><?php echo $dd['type_mobil']; ?> - <?php echo $dd['no_polisi']; ?></td>
							<td><?php echo $dd['no_ktp']; ?></td>
							<td><?php echo $dd['nm_pelanggan']; ?></td>
							<td><?php echo 'Rp. '. number_format($dd['harga']) ?></td>
							<td><?php echo 'Rp. '. number_format($dd['jml_harga']) ?></td>
							<td><?php echo 'Rp. '. number_format($dd['denda']) ?></td>
							<td><?php echo 'Rp. '. number_format($dd['jml_harga'] + $dd['denda']) ?></td>
							<td align="center">
								<a href="editrental.php?id=<?php echo $dd['kd_transaksi']; ?>"><i class="btn btn-sm btn-success"><span class="fas fa-edit"></span></i></a>
							</td>
							<td align="center">
								<a href="hapusrental.php?id=<?php echo $dd['kd_transaksi']; ?>"><i class="btn btn-sm btn-danger"><span class="fas fa-trash"></span></i></a>
							</td>
							<td align="center">
								<a href="cetakrental.php?id=<?php echo $dd['kd_transaksi']; ?>"><i class="btn btn-sm btn-primary"><span class="fas fa-print"></span></i></a>
							</td>
						</tr>
						<?php 
							}
						?>
					</tbody>
				</table>
			</div>
			</div>
		</div>
	</div>
</div>


<!-- MODAL TAMBAH -->
<!-- Button trigger modal -->
<div class="modal fade" id="tambah_pemesanan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Form Entry Data Rental</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
					<div class="form-group">
						<label>Type Mobil</label>
						<select name="kd_mobil" id="kd_mobil" class="form-control">
							<option value="--Silahkan Pilih--">--Silahkan Pilih--</option>
							<?php
							$daftar_mobil = array();
							include ("../config/koneksi.php"); 
							$qq = mysqli_query($konek,"SELECT * FROM tbl_mobil");
							while($dd = mysqli_fetch_assoc($qq)){
							if ($dd['status'] == "1" )
								{
							$daftar_mobil[] = $dd;
							?>

								?>
								<option value="<?php echo $dd['kd_mobil']; ?>"><?php echo $dd['type_mobil'] ?></option>
								<?php 
							}
							}
							?>
						</select>
						
						<input class="form-control mb-2" type="text" id="harga" name="harga" readonly="">

						<label>No. KTP</label>
						<select id="kd_pelanggan" name="kd_pelanggan" class="form-control mb-2">
							<option value="">Pilih Pelanggan</option>
							<?php
							include ("../config/koneksi.php"); 
							$qqqq = mysqli_query($konek,"SELECT * FROM tbl_pelanggan WHERE id='$_SESSION[id]'");
							while($dddd = mysqli_fetch_assoc($qqqq)){
							if ($dddd['status_peminjaman'] == "0" )
								{
							?>
								<option value="<?php echo $dddd['kd_pelanggan']; ?>"><?php echo $dddd['no_ktp']; ?></option>
							<?php 
								}
							}
							?>
						</select>

						<label>Tanggal Rental</label>
						<input name="tgl_sewa" type="date" class="form-control mb-2" required/>

						<label>Tanggal Selesai Rental</label>
						<input name="tgl_kembali" type="date" class="form-control mb-2" required/>

						<input name="denda" type="hidden" class="form-control mb-2" value="0" required>

						<input name="status_bayar" type="hidden" class="form-control mb-2" value="0" required>

						<input name="status_kembali" type="hidden" class="form-control mb-2" value="0" required>
					</div>
				<div class="modal-footer">
					<button type="submit" name="simpan-rental" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php 
	include ("../config/koneksi.php");
if (isset($_POST['simpan-rental'])) {
	$query2 = mysqli_query($konek,"SELECT * FROM tbl_transaksi ORDER BY kd_transaksi DESC");
    $data2 = mysqli_fetch_assoc($query2);
    $jml = mysqli_num_rows($query2);
    if($jml==0){
      $kd_transaksi='TRS001';
      }else{
        $subid = substr($data2['kd_transaksi'],3);
        if($subid>0 && $subid<=8){
          $sub = $subid+1;
          $kd_transaksi='TRS00'.$sub;
        }elseif($subid>=9 && $subid<=100){
          $sub = $subid+1;
          $kd_transaksi='TRS0'.$sub;
        }elseif($subid>=99 && $subid<=1000){
          $sub = $subid+1;
          $kd_transaksi='TRS'.$sub;
        }
      }

$kd_mobil 		= $_POST['kd_mobil'];
$harga 			= $_POST['harga'];
$kd_pelanggan 	= $_POST['kd_pelanggan'];
$tgl_sewa 		= $_POST['tgl_sewa'];
$tgl_kembali 	= $_POST['tgl_kembali'];
$status_bayar 	= $_POST['status_bayar'];
$status_kembali = $_POST['status_kembali'];
$dicekin = date_create($_POST['tgl_sewa']);
$dicekout = date_create($_POST['tgl_kembali']);
$interval = date_diff($dicekin, $dicekout);

//$datetime1 = new DateTime($tgl_kembali);
//$datetime2 = new DateTime($tgl_sewa);
//$difference = $datetime1->diff($datetime2);
  
$jumlah_harga = $harga * $interval->d;

$dt=mysqli_query($konek,"SELECT tbl_mobil a LEFT JOIN tbl_jenis b ON a.kd_jenis=b.kd_jenis where kd_mobil='$kd_mobil'");
$data=mysqli_fetch_array($dt);
$a = 0;
$status=$data['status'];
$hasil_status = $status - $a;
mysqli_query($konek,"UPDATE tbl_mobil set status='$hasil_status' where kd_mobil='$kd_mobil'");

$dt2=mysqli_query($koneksi,"SELECT * FROM tb_pelanggan where kd_pelanggan='$kd_pelanggan'");
$data2=mysqli_fetch_array($dt2);
$b = 1;
$status_peminjaman=$data2['status_peminjaman'];
$hasil_status2 = $status_peminjaman + $b;
mysqli_query($konek,"UPDATE tbl_pelanggan set status_peminjaman='$hasil_status2' where kd_pelanggan='$kd_pelanggan'");

	$save = mysqli_query($konek,"INSERT INTO tbl_transaksi VALUES('$kd_transaksi','$kd_mobil','$kd_pelanggan','$tgl_sewa','$tgl_kembali','$jumlah_harga','$denda','$status_bayar','$status_kembali')");

	if($save) {
      echo "<script language=javascript>
          window.alert('Berhasil Menambah!');
          window.location='datarentalpel.php';
          </script>";
      }else{
        echo "<script language=javascript>
          window.alert('Gagal Menambah!');
          window.location='datarentalpel.php';
          </script>";
      }
}
 ?>

<script>
  document.getElementById("harga").value = 0;
  function tampilkanHargamobil()
  {
    var mobil = <?php echo json_encode($daftar_mobil); ?>;
    var mobil_terpilih = document.getElementById("kd_mobil").selectedIndex;
    var harga = 0;
    if(mobil_terpilih != 0)
    {
      harga = mobil[mobil_terpilih-1].harga;
    }
    document.getElementById("harga").value = harga;
  }
  // Daftarkan fungsi ke element HTML
  document.getElementById("kd_mobil").addEventListener("change", tampilkanHargamobil);
</script>

<!-- TUTUP MODAL TAMBAH -->
<?php 
	include ("style/footer.php");
?>