<?php 
  session_start();
    include ('../config/koneksi.php');
    if($_SESSION['level']==""){
      echo "<script language=javascript>
          window.alert('Anda Harus Login Sebagai Admin!');
          window.location='../login.php';
          </script>";
    }
?>
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <i class="fas fa-user"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><?php echo $_SESSION['username']; ?></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
          Data
        </div>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
          <a class="nav-link" href="datamobil.php">
            <i class="fas fa-fw fa-database"></i>
            <span>Mobil</span></a>
            <a class="nav-link" href="databank.php">
              <i class="fas fa-fw fa-database"></i>
              <span>Bank</span></a>
              <a class="nav-link" href="datapelanggan.php">
                <i class="fas fa-fw fa-database"></i>
                <span>Data Pelanggan</span></a>
                <a class="nav-link" href="datarentalpel.php">
                  <i class="fas fa-fw fa-database"></i>
                  <span>Rental Pelanggan</span></a>
                  <a class="nav-link" href="databayarpel.php">
                    <i class="fas fa-fw fa-database"></i>
                    <span>Bayar Pelanggan</span></a>
                    <a class="nav-link" href="datakembalipel.php">
                      <i class="fas fa-fw fa-database"></i>
                      <span>Kembali Pelanggan</span></a>
                    </li>

            <div class="sidebar-heading">
              Laporan
            </div>

            <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-report"></i>
                <span>Laporan Rental</span>
              </a>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="bg-white py-2 collapse-inner rounded">
                  <a class="collapse-item" href="rentalbulanan.php">Bulanan</a>
                  <a class="collapse-item" href="rentaltahunan.php">Tahunan</a>
                </div>
              </div>
            </li>                          
                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                  <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

              </ul>
              <!-- End of Sidebar -->

              <!-- Content Wrapper -->
              <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                  <!-- Topbar -->
                  <nav class="navbar navbar-expand bg-blue topbar mb-4 static-top shadow">
                    TELAGA MURNI AUTO RENT - Jl. Tuanku Nan Renceh, Padang Baru, Lubuk Basung
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - Tables -->
                        <li class="nav-item">
                          <a class="nav-link" href="logout.php">
                            <i class="fas fa-fw fa-sign-out-alt"></i>
                            <span>Logout</span></a>
                          </li>

                        </ul>

                      </nav>
        <!-- End of Topbar -->