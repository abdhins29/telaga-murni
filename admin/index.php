<?php 
    include ('style/header.php');
    include ('style/sidebar.php');
    include ('../config/koneksi.php');
?>
<div class="container-fluid">
	<!-- Basic Card Example -->
	<div class="card shadow mt-3 mb-3">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Dashboard</h6>
		</div>
		<div class="card-body" align="center">
			<h2>Selamat Datang <?php echo $_SESSION['username']; ?></h2>
			<h3>Website Telaga Murni Auto Rent</h3>
			<h4>Semoga Hari <?php echo $_SESSION['username']; ?> Menyenangkan !</h4>
		</div>
	</div>
</div>
<?php 
    include ('style/footer.php');
?>