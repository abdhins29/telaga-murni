<?php 
    include ('style/header.php');
    include ('style/sidebar.php');
    include ('../config/koneksi.php');
?>

<div class="container-fluid">
	<!-- Basic Card Example -->
	<div class="card shadow mt-3 mb-3">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Pembayaran</h6>
		</div>
		<div class="card-body">
			<button class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#tambah_bayar"><i class="fas fa-plus fa-sm"></i> Tambah Bayar</button>
			<table class="table table-bordered">
				<thead>
					<tr align="center">
						<th>No</th>
						<th>Tanggal Bayar</th>
						<th>Kode Transaksi - Nama Pelanggan</th>
						<th>Pembayaran</th>
						<th>Bukti Pembayaran</th>
					</tr>
				</thead>
				<?php 
				include ('../config/koneksi.php');
				$no = 1;
				$query = mysqli_query($konek, "SELECT * FROM tbl_pembayaran a LEFT JOIN tbl_transaksi b ON a.kd_transaksi=b.kd_transaksi LEFT JOIN tbl_pelanggan c ON b.kd_pelanggan=c.kd_pelanggan WHERE c.id= '$_SESSION[id]'");
				while($data = mysqli_fetch_assoc($query)){
				?>
				<tbody>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $data['tgl_bayar']; ?></td>
						<td><?php echo $data['kd_transaksi']; ?> - <?php echo $data['nm_pelanggan']; ?></td>
						<td><?php echo $data['pembayaran']; ?></td>
						<td><img src="../bukti/<?php echo $data['bukti_bayar']; ?>" alt="" width="100"></td>
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
<div class="modal fade" id="tambah_bayar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Entry Data Pembayaran</h5>
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
      					if ($ddd['status_bayar'] == "0" )
      					{
      						?>
      						<option value="<?php echo $ddd['kd_transaksi']; ?>"><?php echo $ddd['kd_transaksi']; ?> - <?php echo $ddd['nm_pelanggan']; ?></option>
      						<?php 
      					}
      				}
      				?>
      			</select>
      			<label>Daftar Bank</label>
      			<select id="kd_bank" name="kd_bank" class="form-control mb-2">
      				<option value="">Pilih Bank</option>
      				<?php
      				$daftar_bank = array();
      				include ("../config/koneksi.php"); 
      				$qqq = mysqli_query($konek,"SELECT * FROM tbl_bank");
      				while($ddd = mysqli_fetch_assoc($qqq)){
      				$daftar_bank[] = $ddd;
      				?>
      				<option value="<?php echo $ddd['kd_bank']; ?>"><?php echo $ddd['nm_bank']; ?></option>
      				<?php
      				}
      				?>
      			</select>
      			<input type="text" class="form-control mb-2" name="no_rek" id="no_rek" readonly>
      			<input type="text" class="form-control mb-2" name="nm_rek" id="nm_rek" readonly>
      			
      			<label>Tanggal Bayar</label>
      			<input type="date" class="form-control mb-2" name="tgl_bayar" required="">
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
        <button type="submit" name="tambah" class="btn btn-primary btn-sm">Tambah</button>
      </div>
      	</form>
    </div>
  </div>
</div>
<?php 
	include ("../config/koneksi.php");
	if (isset($_POST['tambah'])) {
	$query2 = mysqli_query($konek,"SELECT * FROM tbl_pembayaran ORDER BY kd_bayar DESC");
    $data2 = mysqli_fetch_assoc($query2);
    $jml = mysqli_num_rows($query2);
    if($jml==0){
      $kd_bayar='BYR001';
      }else{
        $subid = substr($data2['kd_bayar'],3);
        if($subid>0 && $subid<=8){
          $sub = $subid+1;
          $kd_bayar='BYR00'.$sub;
        }elseif($subid>=9 && $subid<=100){
          $sub = $subid+1;
          $kd_bayar='BYR0'.$sub;
        }elseif($subid>=99 && $subid<=1000){
          $sub = $subid+1;
          $kd_bayar='BYR'.$sub;
        }
      }

      $kd_transaksi 	= $_POST['kd_transaksi'];
      $tgl_bayar 		= $_POST['tgl_bayar'];
      $pembayaran 		= $_POST['pembayaran'];
      $bank_anda 		= $_POST['bank_anda'];
      $norek_anda 		= $_POST['norek_anda'];
      $nmrek_anda 		= $_POST['nmrek_anda'];
      $bukti_bayar 		= $_FILES['bukti_bayar']['name'];

      $dt=mysqli_query($konek,"SELECT * FROM tbl_transaksi WHERE kd_transaksi='$kd_transaksi'");
      $dataqws=mysqli_fetch_array($dt);
      $a = 1;
      $status=$dataqws['status_bayar'] + $a;
      mysqli_query($konek,"update tbl_transaksi set status_bayar='$status' where kd_transaksi='$kd_transaksi'");

	$save = mysqli_query($konek,"INSERT INTO tbl_pembayaran VALUES('$kd_bayar','$kd_transaksi','$tgl_bayar','$pembayaran','$bank_anda','$norek_anda','$nmrek_anda','$bukti_bayar')");
	move_uploaded_file($_FILES['bukti_bayar']['tmp_name'], "../bukti/".$_FILES['bukti_bayar']['name']);

	if($save) {
      echo "<script language=javascript>
          window.alert('Berhasil Menambah!');
          window.location='databayar.php';
          </script>";
      }else{
        echo "<script language=javascript>
          window.alert('Gagal Menambah!');
          window.location='databayar.php';
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
<script>
  document.getElementById("no_rek").value = 0;
  document.getElementById("nm_rek").value = 0;
  function tampilkanHargamobil()
  {
    var bank = <?php echo json_encode($daftar_bank); ?>;
    var bank_terpilih = document.getElementById("kd_bank").selectedIndex;
    var no_rek = 0;
    if(bank_terpilih != 0)
    {
      no_rek = bank[bank_terpilih-1].no_rek;
      nm_rek = bank[bank_terpilih-1].nm_rek;
    }
    document.getElementById("no_rek").value = no_rek;
    document.getElementById("nm_rek").value = nm_rek;
  }
  // Daftarkan fungsi ke element HTML
  document.getElementById("kd_bank").addEventListener("change", tampilkanHargamobil);
</script>

<?php 
    include ('style/footer.php');
?>