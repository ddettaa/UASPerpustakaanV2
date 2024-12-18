<?php
include 'config/koneksi.php';
?>

<div class="content-wrapper">

  <?php
  if ($_GET['page'] == 'home') {
  ?>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sistem Informasi Perpustakaan</h1>
          </div>
        </div>
      </div></section>

    <section class="content">

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Home</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          Selamat datang di pemrograman sederhana sistem informasi WEB.<br>
          Silahkan pilih menu yang tersedia.
        </div>
        </div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Kalender Hari Ini</h3>
          <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button>
    </div>
        </div>
        <div class="card-body">
          <?php
          $bulan = date('n');
          $tahun = date('Y');
          $hari = date('t');
          $haripertama = date('w', strtotime("$tahun-$bulan-01"));
          $hariini = date('j'); // Get current day of month

          echo "<table class='table table-bordered'>";
          echo "<tr style='background: linear-gradient(to right,rgb(21, 3, 102),rgb(48, 128, 234)); color: white;'>
          <th style='background: linear-gradient(to right,rgb(143, 37, 37),rgb(249, 97, 97));'>Minggu</th>
          <th>Senin</th>
          <th>Selasa</th>
          <th>Rabu</th>
          <th>Kamis</th>
          <th>Jumat</th>
          <th>Sabtu</th>
          </tr>";

          $hitunghari = 1;
          echo "<tr>";

          for ($i = 0; $i < $haripertama; $i++) {
            echo "<td></td>";
          }

          while ($hitunghari <= $hari) {
            if (($hitunghari + $haripertama - 1) % 7 == 0) {
              echo "</tr><tr>";
            }
            $kalender = ($hitunghari == $hariini) ? " style='background-color: #007bff; color: white;'" : "";
            echo "<td$kalender>$hitunghari</td>";
            $hitunghari++;
          }

          echo "</tr></table>";
          ?>
        </div>
      </div>
      </section>
    <?php
  } else if ($_GET['page'] == 'buku') {
  ?>

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Buku</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="content">

      <table class="table table-bordered table-hover">
        <tr style="background: linear-gradient(to right,rgb(21, 3, 102),rgb(48, 128, 234));">
          <th>Id Buku</th>
          <th>Judul Buku</th>
          <th>Penulis</th>
          <th>Penerbit</th>
          <th>Tahun Terbit</th>
          <th>Kategori</th>
        </tr>
        <?php
        $hasil = $db->query(" 
              SELECT  b.id_buku, b.judul, b.penulis, b.penerbit, b.tahun_terbit, k.nama_kategori
              FROM buku b 
              left join kategori k on b.id_kategori = k.id_kategori
              ");

        if (!$hasil) {
          echo "<tr><td colspan='6'>Ada masalah: " . $db->error . "</td></tr>";
        } else {
          while ($d = $hasil->fetch_assoc()) {
            echo "
                  <tr>
                    <td>{$d['id_buku']}</td>
                    <td>{$d['judul']}</td>
                    <td>{$d['penulis']}</td>
                    <td>{$d['penerbit']}</td>
                    <td>{$d['tahun_terbit']}</td>
                    <td>{$d['nama_kategori']}</td>
                  </tr>";
          }
        }
        ?>
      </table>
    </section>
    <?php
  } else if ($_GET['page'] == 'kategori') {
  ?>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Kategori</h1>
          </div>
          <div>
          </div>
        </div>
        <section class="content">
      </div>
      <table class="table table-bordered table-hover">
        <tr style="background: linear-gradient(to right,rgb(21, 3, 102),rgb(48, 128, 234));">
          <th>Id Kategori</th>
          <th>Nama Kategori</th>
          <th>Jumlah Buku</th>
        </tr>
      <?php
      $hasil = $db->query("
        SELECT k.id_kategori, k.nama_kategori, (SELECT COUNT(*) FROM buku b WHERE b.id_kategori = k.id_kategori) as jumlah_buku 
        FROM kategori k
      ");

      if (!$hasil) {
        echo "<tr><td colspan='3'>Ada masalah: " . $db->error . "</td></tr>";
      } else {
        while ($d = $hasil->fetch_assoc()) {
          echo "
          <tr>
            <td>{$d['id_kategori']}</td>
            <td>{$d['nama_kategori']}</td>
            <td>{$d['jumlah_buku']}</td>
          </tr>";
        }
      }
      ?>
      </table>
      </section>


  <?php
  } else if ($_GET['page'] == 'login') {
  ?>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Silahkan Login Terlebih Dahulu</h1>
          </div>
        </div>
      </div></section>

    <section class="content">

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Login</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-4 col-6">
              <form action="?page=ceklogin" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="user" placeholder="Masukkan Username anda">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="pass" id="exampleInputPassword1" placeholder="Masukkan Password anda">
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">Login</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
        </div>
      </section>
    <?php
  } else if ($_GET['page'] == 'ceklogin') {
    session_start();
    $pass = md5($_POST['pass']);
    $hasil = $db->query("
              select * from user where username = '" . $db->real_escape_string($_POST['user']) . "'
              ");

    if (!$hasil) {
      echo "ada masalah " . $db->error;
      exit;
    }

    $d = $hasil->fetch_assoc();

    if ($d && $d['password'] == $pass) {
      $_SESSION['username'] = $d['username'];
      $_SESSION['password'] = $pass;

      if ($d['role'] == 'admin') {
        $_SESSION['role'] = 'admin';
        header('location:admin/tampil.php?page=home');
      } else if ($d['role'] == 'petugas') {
        $_SESSION['role'] = 'petugas';
        header('location:petugas/tampil.php?page=home');
      } else {
        echo "Anda tidak memiliki akses ke sistem.";
      }
      exit;
    } else {
      echo "<div class='card'>
        <div class='card-header'>
          <h3 class='card-title'>Login Gagal</h3>
        </div>
        <div class='card-body'>
          <p>Username atau password yang anda masukkan salah.</p>
          <a href='?page=login' class='btn btn-primary'>Login Ulang</a>
        </div>
      </div>";
    }
  } else {
    echo "Halaman tidak ditemukan";
  }
    ?>

</div>