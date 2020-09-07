<?php 
	include ('style/header.php');
	include ('style/sidebar.php');
?>
<div class="container-fluid">
	<div class="col-lg-12">
		<!-- Basic Card Example -->
		<div class="card shadow mt-3 mb-3">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Laporan Tahunan Data Rental</h6>
			</div>
				<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="post">
					<div class="input-group">
						<select class="form-control bg-light border-0 small mt-2 mb-2" name="tahun" aria-label="Search" aria-describedby="basic-addon2">
							<option value="0" selected="">-- Silahkan Pilih Tahun --</option>
							<option value="2018">2018</option>
							<option value="2019">2019</option>
							<option value="2020">2020</option>
							<option value="2021">2021</option>
							<option value="2022">2022</option>
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
					$tahun 	= $_POST['tahun'];
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
						$query 	= mysqli_query($konek,"SELECT * FROM tbl_transaksi a LEFT JOIN tbl_pelanggan b ON a.kd_pelanggan=b.kd_pelanggan LEFT JOIN tbl_mobil c ON a.kd_mobil=c.kd_mobil LEFT JOIN tbl_pengembalian d ON a.kd_transaksi=d.kd_transaksi WHERE year(a.tgl_sewa) = '$tahun'");
						?>
						<a href="cetaktahunan.php?tahun=<?php echo $tahun;?>" target="_blank();" class="btn btn-success mb-2"><i class="fas fa-print"></i></a>
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