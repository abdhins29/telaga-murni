<?php 
	include ('style/header.php');
	include ('style/sidebar.php');
?>
<div class="container-fluid">
	<div class="col-lg-12">
		<!-- Basic Card Example -->
		<div class="card shadow mt-3 mb-3">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Laporan Bulanan Data Rental</h6>
			</div>
				<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="post">
					<div class="input-group">
						<select class="form-control bg-light border-0 small mt-2 mb-2" name="bulan" aria-label="Search" aria-describedby="basic-addon2">
							<option value="0" selected="">-- Silahkan Pilih Bulan --</option>
							<option value="01">Januari</option>
							<option value="02">Februari</option>
							<option value="03">Maret</option>
							<option value="04">April</option>
							<option value="05">Mei</option>
							<option value="06">Juni</option>
							<option value="07">Juli</option>
							<option value="08">Agustus</option>
							<option value="09">September</option>
							<option value="10">Oktober</option>
							<option value="11">November</option>
							<option value="12">Desember</option>
						</select>
						<div class="input-group-append">
							<button class="btn btn-primary mt-2 mb-2" type="submit" name="check">
								<i class="fas fa-search fa-sm mt"></i>
							</button>
						</div>
					</div>
				</form>

				<?php
				include ("../config/koneksi.php");
				$no = 1;
				if(isset($_POST['check'])){
					$bulan 	= $_POST['bulan'];
				?>

			<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr align="center">
							<th>No</th>
							<th>Kode Transaksi</th>
							<th>Nama Pelanggan</th>
							<th>Type Mobil</th>
							<th>Tanggal Rental</th>
							<th>Tanggal Kembali</th>
							<th>Jumlah Harga</th>
							<th>Denda</th>
							<th>Total Harga</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query 	= mysqli_query($konek,"SELECT * FROM tbl_transaksi a LEFT JOIN tbl_pelanggan b ON a.kd_pelanggan=b.kd_pelanggan LEFT JOIN tbl_mobil c ON a.kd_mobil=c.kd_mobil LEFT JOIN tbl_pengembalian d ON a.kd_transaksi=d.kd_transaksi WHERE month(a.tgl_sewa) = '$bulan'");
						?>
						<a href="cetakbulanan.php?bulan=<?php echo $bulan;?>" target="_blank();" class="btn btn-success mb-2"><i class="fas fa-print"></i></a>
						<?php
							while($data = mysqli_fetch_assoc($query)){ 
						?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $data['kd_transaksi']; ?></td>
							<td><?php echo $data['nm_pelanggan'];?></td>
							<td><?php echo $data['type_mobil']; ?></td>
							<td><?php echo $data['tgl_sewa']; ?></td>
							<td><?php echo $data['tgl_kembali']; ?></td>
							<td><?php echo 'Rp. '. number_format($data['jml_harga']); ?></td>
							<td><?php echo 'Rp. '. number_format($data['denda']); ?></td>
							<td><?php echo 'Rp. '. number_format($data['jml_harga'] + $data['denda']) ?></td>
						</tr>
						<?php 
							}
						?>
					</tbody>
				</table>
			</div>
			</div>
			<?php 
			}
			?>
		</div>
	</div>
</div>
<?php 
	include ('style/footer.php');
?>