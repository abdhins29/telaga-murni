<?php 
  session_start();
    include ('../config/koneksi.php');
    if($_SESSION['level']==""){
      echo "<script language=javascript>
          window.alert('Silahkan Login!');
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
          Entry
        </div>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
          <a class="nav-link" href="datapelanggan.php">
            <i class="fas fa-fw fa-file"></i>
            <span>Entry Pelanggan</span></a>
          </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
          <a class="nav-link" href="datarental.php">
            <i class="fas fa-fw fa-file"></i>
            <span>Entry Rental</span></a>
          </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
          <a class="nav-link" href="databayar.php">
            <i class="fas fa-fw fa-file"></i>
            <span>Entry Pembayaran</span></a>
          </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
          <a class="nav-link" href="datakembali.php">
            <i class="fas fa-fw fa-file"></i>
            <span>Entry Pengembalian</span></a>
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