<?php 
	include ("../config/koneksi.php");
	$bulan = $_GET['bulan'];
if($bulan == "01")
{
	$bln = "Januari";
}
else if($bulan == "02")
{
	$bln == "Februari";
}
else if($bulan == "03")
{
	$bln = "Maret";
}
else if($bulan == "04")
{
	$bln = "April";
}
else if($bulan == "05")
{
	$bln = "Mei";
}
else if($bulan == "06")
{
	$bln = "Juni";
}
else if($bulan == "07")
{
	$bln = "Juli";
}
else if($bulan == "08")
{
	$bln = "Agustus";
}
else if($bulan == "09")
{
	$bln = "September";
}
else if($bulan == "10")
{
	$bln = "Oktober";
}
else if($bulan == "11")
{
	$bln = "November";
}
else if($bulan == "12")
{
	$bln = "Desember";
}
		
?>
<body onload="window.print();">
<center>
	<p style="font-size:30px;padding:0px;margin-bottom:-15px;">TELAGA MURNI - AUTO RENT</p>
	<p style="font-size:18px;padding:0px;margin-bottom:-12px;">Jl. TUANKU NAN RENCEH, PADANG BARU, LUBUK BASUNG</p>
	<p style="font-size:18px;padding:0px;margin-bottom:0px;">Telp. 0812-6675-3519</p>
</center>
<hr>
<hr>
<div class="container-fluid">
	<h3 style="text-decoration: underline;">Laporan Bulanan Telaga Murni - Auto Rent</h3>
	<table width="50%" style="text-align: left; margin-bottom: 5px;">
		<tr>
			<th>Bulan</th>
			<th>:</th>
			<th><?php echo $bln; ?></th>
		</tr>
	</table>
</div>
<div class="container-fluid">
	<table border="1">
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
			$no = 1;
			$total = 0;
			$query 	= mysqli_query($konek,"SELECT * FROM tbl_transaksi a LEFT JOIN tbl_pelanggan b ON a.kd_pelanggan=b.kd_pelanggan LEFT JOIN tbl_mobil c ON a.kd_mobil=c.kd_mobil LEFT JOIN tbl_pengembalian d ON a.kd_transaksi=d.kd_transaksi WHERE month(a.tgl_sewa) = '$bulan'");
			while($data = mysqli_fetch_assoc($query)){ 
				$total = $total+($data['jml_harga']+$data['denda']);
				?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $data['kd_transaksi']; ?></td>
					<td><?php echo $data['nm_pelanggan'];?></td>
					<td><?php echo $data['type_mobil']; ?></td>
					<td><?php echo date('d F Y', strtotime($data['tgl_sewa'])); ?></td>
					<td><?php echo date('d F Y', strtotime($data['tgl_kembali'])); ?></td>
					<td><?php echo 'Rp. '. number_format($data['jml_harga']); ?></td>
					<td><?php echo 'Rp. '. number_format($data['denda']); ?></td>
					<td><?php echo 'Rp. '. number_format($data['jml_harga'] + $data['denda']) ?></td>
				</tr>
				<?php 
			}
			?>
				<tr>
                    <td colspan="8" align="center"> Total </td>
                    <td><?php echo "Rp ".number_format($total,0,',','.'); ?></td>
                </tr>
		</tbody>
	</table>
<h4 style="margin-left: 70%; margin-bottom: 5%;">Lubuk Basung, <?php echo date('d F y') ?></h3>
<br>
<br>
<h5 style="margin-left: 72%; margin-bottom: 1%;">TELAGA MURNI-AUTO RENT</h3>
<h5 style="margin-left: 77%; margin-top: 1%;">SUMATERA BARAT</h3>       
</div>
</body>