<?php 
	include ("style/header.php");
	include ("style/sidebar.php");
?>
<div class="container-fluid">
	<div class="col-lg-12">
		<!-- Basic Card Example -->
		<div class="card shadow mt-3 mb-3">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Informasi Tentang Jenis Mobil Rental</h6>
			</div>
			<div class="card-body">
				<p>Berikut adalah daftar mobil tersedia pada Telaga Murni Auto Rent.</p>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Foto Mobil</th>
							<th>Type Mobil</th>
							<th>Jenis Mobil</th>
							<th>Merk</th>
							<th>No. Polisi</th>
							<th>Warna</th>
							<th>Harga</th>
							<th>Status</th>
						</tr>
					</thead>
					<?php
					include ("config/koneksi.php");
					$no=1;
						$sql = mysqli_query($konek, "SELECT * FROM tbl_mobil a LEFT JOIN tbl_jenis b ON a.kd_jenis=b.kd_jenis");
						while($array = mysqli_fetch_assoc($sql)){
					?>
					<tbody>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><img src="fotomobil/<?php echo $array['foto_mobil']; ?>" alt="" width="100"></td>
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
<?php 
	include ("style/footer.php");
?>