<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>perpustakaan</title>
  <link rel="shortcut icon" href="../adminlte310/dist/img/favicon.ico" type="image/x-icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../adminlte310/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../adminlte310/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../adminlte310/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../adminlte310/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="../css/penghilang.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../adminlte310/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light"  style="background: linear-gradient(to right,rgb(21, 3, 102),rgb(48, 128, 234));">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
</nav>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: linear-gradient(to bottom,rgb(21, 3, 102),rgb(48, 128, 234));">
  <a href="?page=home" class="brand-link">
    <img src="../img/logo-poliban-jurusan-elektro.webp" alt="Perpustakaan" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-bold">Perpustakaan</span>
  </a>

  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../img/adit.jpg" class="img-circle elevation-2" alt="Aditya Rahman">
      </div>
      <div class="info">
        <a href="?page=about" class="d-block">Aditya Rahman</a>
      </div>
    </div>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Home Menu -->
        <li class="nav-item">
          <a href="?page=home" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>Home</p>
          </a>
        </li>

        <!-- Data Master Menu -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>Data Master <i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?page=buku" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Buku</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?page=kategori" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Kategori</p>
              </a>
            </li>
			<li class="nav-item">
				<a href="?page=anggota" class="nav-link">
					<i class="far fa-circle nav-icon"></i>
					<p>Data Anggota</p>
					</a>
			</li>
			<li class="nav-item">
				<a href="?page=peminjaman" class="nav-link">
					<i class="far fa-circle nav-icon"></i>
					<p>Data Peminjaman</p>
					</a>
			</li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="?page=logout" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Logout</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>