<?php 
  include("../config/koneksi.php");
	$kd_transaksi=$_GET['id'];
?>
<body onload="window.print();">
<center>
<p style="font-size:30px;padding:0px;margin-bottom:-15px;">TELAGA MURNI - AUTO RENT</p>
<p style="font-size:18px;padding:0px;margin-bottom:-12px;">Jl. TUANKU NAN RENCEH, PADANG BARU, LUBUK BASUNG</p>
<p style="font-size:18px;padding:0px;margin-bottom:0px;">Telp. 0812-6675-3519</p>
<hr>
<br>
</center>
  <?php 
	$no = 1;
	$q = mysqli_query($konek,"SELECT * FROM tbl_transaksi a LEFT JOIN tbl_pelanggan b ON a.kd_pelanggan=b.kd_pelanggan LEFT JOIN tbl_mobil c ON a.kd_mobil=c.kd_mobil WHERE kd_transaksi = '$kd_transaksi'");
	$d = mysqli_fetch_assoc($q);
?>
<div class="container-fluid">
	<h5 style="text-decoration: underline;">A. RIWAYAT RENTAL PELANGGAN</h5>
	<table width="100%" style="text-align: left;">
		<tr>
			<th>NIK Pelanggan</th>
			<th>:</th>
			<th><?php echo $d['no_ktp']; ?></th>

			<th>Type Mobil</th>
			<th>:</th>
			<th><?php echo $d['type_mobil']; ?></th>
		</tr>
		<tr>
			<th>Nama Pelanggan</th>
			<th>:</th>
			<th><?php echo $d['nm_pelanggan']; ?></th>

			<th>No. Polisi</th>
			<th>:</th>
			<th><?php echo $d['no_polisi']; ?></th>
		</tr>
		<tr>
			<th>Tanggal Lahir</th>
			<th>:</th>
			<th><?php echo $d['tgl_lahir']; ?></th>

			<th>Warna Mobil</th>
			<th>:</th>
			<th><?php echo $d['warna']; ?></th>
		</tr>
		<tr>
			<th>Alamat</th>
			<th>:</th>
			<th><?php echo $d['alamat']; ?></th>

			<th>Harga Rental/Hari</th>
			<th>:</th>
			<th><?php echo 'Rp. '. number_format($d['harga']); ?></th>
		</tr>
		<tr>
			<th>No. Hp</th>
			<th>:</th>
			<th><?php echo $d['no_hp']; ?></th>
		</tr>
	</table>
</div>
  <center>
  	<div class="table-responsive">
  		<table width="100%" border="1" cellpadding="5">
  			<thead>
  				<tr>
  					<th>No</th>
  					<th>Tanggal Rental</th>
  					<th>Tanggal Selesai Rental</th>
  					<th>Jumlah Harga</th>
  					<th>Denda</th>
  					<th>Total Harga</th>
  				</tr>
  			</thead>
  			<?php
  			$no = 1;
  			$sqlqw = mysqli_query($konek,"SELECT * FROM tbl_transaksi WHERE kd_transaksi='$kd_transaksi'");
  			while($dataqw = mysqli_fetch_assoc($sqlqw)){
  				?>
  				<tbody>
  					<tr>
  						<td align="right"><?php echo $no++; ?></td>
  						<td><?php echo date('d F Y', strtotime($dataqw['tgl_sewa'])); ?></td>
  						<td><?php echo date('d F Y', strtotime($dataqw['tgl_kembali'])); ?></td>
  						<td align="right"><?php echo 'Rp. '. number_format($dataqw['jml_harga']); ?></td>
  						<td align="right"><?php echo 'Rp. '. number_format($dataqw['denda']); ?></td>
  						<td align="right"><?php echo 'Rp. '. number_format($dataqw['jml_harga'] + $dataqw['denda']); ?></td>
  					</tr>
  					<?php
  				}
  				?>
  			</tbody>
  		</table>
      </div>
</center>
<h4 style="margin-left: 70%; margin-bottom: 5%;">Lubuk Basung, <?php echo date('d F y') ?></h3>
<br>
<br>
<h5 style="margin-left: 72%; margin-bottom: 1%;">TELAGA MURNI-AUTO RENT</h3>
<h5 style="margin-left: 77%; margin-top: 1%;">SUMATERA BARAT</h3>       
</body>
?>