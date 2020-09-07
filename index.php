<?php 
	include ("style/header.php");
	include ("style/sidebar.php");
?>
<div class="container-fluid">
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
  </ol>
  <div class="carousel-inner">
  	<div class="carousel-item active">
  		<img src="assets/img/3.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>SELAMAT DATANG DI TELAGA MURNI AUTO - RENT</h5>
        <p>KEPUASAN ANDA ADALAH PRIORITAS KAMI</p>
      </div>
  	</div>
  	<div class="carousel-item">
  		<img src="assets/img/2.png" class="d-block w-100" alt="...">
  	  <div class="carousel-caption d-none d-md-block">
        <h5>NIKMATI PERJALANAN ANDA DENGAN MOBIL TERBAIK KAMI</h5>
        <p>ANDA PUAS ADALAH SUATU KEBANGGAAN BAGI KAMI</p>
      </div> 
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>
<?php
	include ("style/footer.php");
?>