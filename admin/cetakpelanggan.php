<?php 
  include("../config/koneksi.php");
	$kd_pelanggan=$_GET['kd'];
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
	$q = mysqli_query($konek,"SELECT * FROM  tbl_pelanggan  WHERE kd_pelanggan = '$kd_pelanggan'");
	$d = mysqli_fetch_assoc($q);
?>
<div class="container-fluid">
	<h5 style="text-decoration: underline;">DATA PELANGGAN</h5>
	<table width="100%" style="text-align: left;">
		<tr>
			<th>NIK Pelanggan</th>
			<th>:</th>
			<th><?php echo $d['no_ktp']; ?></th>
		</tr>
		<tr>
			<th>Nama Pelanggan</th>
			<th>:</th>
			<th><?php echo $d['nm_pelanggan']; ?></th>
		</tr>
		<tr>
			<th>Tanggal Lahir</th>
			<th>:</th>
			<th><?php echo date('d F Y', strtotime($d['tgl_lahir'])); ?></th>
		</tr>
		<tr>
			<th>Alamat</th>
			<th>:</th>
			<th><?php echo $d['alamat']; ?></th>
		</tr>
		<tr>
			<th>No. Hp</th>
			<th>:</th>
			<th><?php echo $d['no_hp']; ?></th>
		</tr>
		<tr>
			<th>Foto KTP</th>
			<th>:</th>
			<th><img src="../ktp-pelanggan/<?php echo $d['fotoktp'];?>" alt="" width="500"></th>
		</tr>
	</table>
</div>
<h4 style="margin-left: 70%; margin-bottom: 5%;">Lubuk Basung, <?php echo date('d F y') ?></h3>
<br>
<br>
<h5 style="margin-left: 72%; margin-bottom: 1%;">TELAGA MURNI-AUTO RENT</h3>
<h5 style="margin-left: 77%; margin-top: 1%;">SUMATERA BARAT</h3>       
</body>
?>