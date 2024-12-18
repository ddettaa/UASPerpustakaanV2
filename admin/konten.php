<?php
// ========= Cek, apakah yang akses sudah login ==================
if (empty($_SESSION['username']) || empty($_SESSION['password']) || empty($_SESSION['role'])) {
	echo "Maaf, anda harus login.";
} 
else if ($_SESSION['role'] != 'admin') {
	echo "Maaf, anda tidak memiliki akses. Halaman ini khusus untuk admin.";
}
else
{
  // ====== Else panjang yang akan di eksekusi jika sudah login =====
  include '../config/koneksi.php';
?>
	<!-- Wajib ada, punya adminLTE Content Wrapper. Contains page content -->
	<div class="content-wrapper">

		<?php
//================================[ HOME ]====================================		
		if ($_GET['page'] == 'home') 
//----------------------------------------------------------------------------
		{
		?>
		    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Selamat Datang Admin 😊</h1>
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
		}

//==============================[ buku ]==================================		
		else if ($_GET['page'] == 'buku')
//--------------------------------------------------------------------------	
		{
		?>
			 <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Data Buku</h1>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
          <a href="?page=tambah_buku" class="btn btn-primary">Tambah Buku</a>
        </div>
          </div>
        </div>
      </section>
        <table class="table table-bordered table-hover">
          <tr style="background: linear-gradient(to right,rgb(21, 3, 102),rgb(48, 128, 234));">
            <th>Id Buku</th>
            <th>Judul Buku</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Tahun Terbit</th>
            <th>Kategori</th>
            <th>Aksi</th>
          </tr>
        <?php
        $hasil = $db->query(" 
          SELECT  b.id_buku, b.judul, b.penulis, b.penerbit, b.tahun_terbit, k.nama_kategori
          FROM buku b
          LEFT JOIN kategori k ON k.id_kategori=b.id_kategori		
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
              <td>
                <a href='?page=edit_buku&id={$d['id_buku']}' class='btn bg-warning'>Edit</a>
                <a href='?page=hapus_buku&id={$d['id_buku']}' class='btn delete bg-danger' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>
              </td>
            </tr>";
          }
        }
        ?>
        </table>
      </section>
		<?php
		} 
		else if ($_GET['page'] == 'tambah_buku') {
			?>
			  <section class="content-header">
				<div class="container-fluid">
				  <div class="row mb-2">
					<div class="col-sm-6">
					  <h1>Tambah Buku</h1>
					</div>
				  </div>
				</div>
			  </section>	
		<section class="content">
				<div class="card">
				  <div class="card-body">
					<form action="?page=buku_tambah" method="post">
					  <div class="form-group">
						<label>Judul Buku</label>
						<input type="text" name="judul" class="form-control" required>
					  </div>
					  <div class="form-group">
					  <label>Penulis</label>
					  <input type="text" name="penulis" class="form-control" required>
					</div>
					<div class="form-group">
					  <label>Penerbit</label>
					  <input type="text" name="penerbit" class="form-control" required>
					</div>
					<div class="form-group">
					  <label>Tahun Terbit</label>
					  <input type="text" name="tahun_terbit" class="form-control" required>
					</div>
					<div class="form-group">
					  <label>Kategori</label>
					  <select name="id_kategori" class="form-control" required>
						<option value="">Pilih Kategori</option>
						<?php
						$hasil = $db->query("SELECT id_kategori, nama_kategori FROM kategori");
						if (!$hasil) {
						  echo "<option value=''>Ada masalah: " . $db->error . "</option>";
						} else {
						  while ($d = $hasil->fetch_assoc()) {
							echo "<option value='{$d['id_kategori']}'>{$d['nama_kategori']}</option>";
						  }
						}
						?>
					  </select>
					</div>
					<div class="form-group">
					  <button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				  </form>
				</div>
			  </div>
			</section>
		  <?php
		} else if ($_GET['page'] == 'edit_buku') {
			  ?>
				<section class="content-header">
				  <div class="container-fluid">
					<div class="row mb-2">
					  <div class="col-sm-6">
						<h1>Edit Buku</h1>
					  </div>
					</div>
				  </div>
				</section>
				<section class="content">
				  <div class="card">
					<div class="card-body">
					  <?php
					  $id = $_GET['id'];
					  $hasil = $db->query("SELECT * FROM buku WHERE id_buku='$id'");
					  $d = $hasil->fetch_assoc();
					  ?>
					  <form action="?page=buku_edit" method="post">
						<input type="hidden" name="id_buku" value="<?= $d['id_buku'] ?>">
						<div class="form-group">
						  <label>Judul Buku</label>
						  <input type="text" name="judul" class="form-control" value="<?= $d['judul'] ?>" required>
						</div>
						<div class="form-group">
						<label>Penulis</label>
						<input type="text" name="penulis" class="form-control" value="<?= $d['penulis'] ?>" required>
					  </div>
					  <div class="form-group">
					  <label>Penerbit</label>
					  <input type="text" name="penerbit" class="form-control" value="<?= $d['penerbit'] ?>" required>
					</div>
					<div class="form-group">
					  <label>Tahun Terbit</label>
					  <input type="text" name="tahun_terbit" class="form-control" value="<?= $d['tahun_terbit'] ?>" required>
					</div>
					<div class="form-group">
					  <label>Kategori</label>
					  <select name="id_kategori" class="form-control" required>
						<option>Pilih Kategori</option>
						<?php
						$hasil = $db->query("SELECT id_kategori, nama_kategori FROM kategori");
						if (!$hasil) {
						  echo "<option value=''>Ada masalah: " . $db->error . "</option>";
            } else {
              while ($k = $hasil->fetch_assoc()) {
              $pilih = $d['id_kategori'] == $k['id_kategori'] ? 'selected' : '';
              echo "<option value='{$k['id_kategori']}' {$pilih}>{$k['nama_kategori']}</option>";
						  }
						}
						?>
					  </select>
					</div>
					<div class="form-group">
					  <button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				  </form>
				</div>
			  </div>
			</section>
		  <?php
		} else if ($_GET['page'] == 'hapus_buku') {
			$id = $_GET['id'];
			$hasil = $db->query("DELETE FROM buku WHERE id_buku='$id'");
			if ($hasil) {
			  header('location: ?page=buku');
			} else {
			  echo "Ada masalah: " . $db->error;
			}
		}
		else if ($_GET['page'] == 'buku_tambah') {
			$judul = $_POST['judul'];
			$penulis = $_POST['penulis'];
			$penerbit = $_POST['penerbit'];
			$tahun_terbit = $_POST['tahun_terbit'];
			$id_kategori = $_POST['id_kategori'];
		
			$hasil = $db->query("INSERT INTO buku (judul, penulis, penerbit, tahun_terbit, id_kategori) VALUES ('$judul', '$penulis', '$penerbit', '$tahun_terbit', '$id_kategori')");
			if ($hasil) {
			  header('location: ?page=buku');
			} else {
			  echo "Ada masalah: " . $db->error;
			}
		} else if ($_GET['page'] == 'buku_edit') {
			$id = $_POST['id_buku'];
			$judul = $_POST['judul'];
			$penulis = $_POST['penulis'];
			$penerbit = $_POST['penerbit'];
			$tahun_terbit = $_POST['tahun_terbit'];
			$id_kategori = $_POST['id_kategori'];
		
			$hasil = $db->query("UPDATE buku SET judul='$judul', penulis='$penulis', penerbit='$penerbit', tahun_terbit='$tahun_terbit', id_kategori='$id_kategori' WHERE id_buku='$id'");
			if ($hasil) {
			  header('location: ?page=buku');
			} else {
			  echo "Ada masalah: " . $db->error;
			}
	}
//==============================[ Kategori ]==================================		
					else if ($_GET['page'] == 'kategori')
//--------------------------------------------------------------------------
		{
		?>
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Data Kategori</h1>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
          <a href="?page=tambah_kategori" class="btn btn-primary">Tambah Kategori</a>
        </div>
          </div>
        </div>
      </section>
        <table class="table table-bordered table-hover">
          <tr style="background: linear-gradient(to right,rgb(21, 3, 102),rgb(48, 128, 234));">
            <th>Id Kategori</th>
            <th>Nama Kategori</th>
			<th>Jumlah Buku</th>
            <th>Aksi</th>
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
              <td>
                <a href='?page=edit_kategori&id={$d['id_kategori']}' class='btn bg-warning'>Edit</a>
                <a href='?page=hapus_kategori&id={$d['id_kategori']}' class='btn delete bg-danger' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>
              </td>
            </tr>";
          }
        }
        ?>
        </table>
      </section>
    <?php
		}else if ($_GET['page'] == 'tambah_kategori') {
			?>
			  <section class="content-header">
				<div class="container-fluid">
				  <div class="row mb-2">
					<div class="col-sm-6">
					  <h1>Tambah Kategori</h1>
					</div>
				  </div>
				</div>
			  </section>
		
			  <section class="content">
				<div class="card">
				  <div class="card-body">
					<form action="?page=kategori_tambah" method="post">
					  <div class="form-group">
						<label>Nama Kategori</label>
						<input type="text" name="nama_kategori" class="form-control" required>
					  </div>
					  <div class="form-group">
						<button type="submit" class="btn btn-primary">Simpan</button>
					  </div>
					</form>
				  </div>
				</div>
			  </section>
			<?php
		} else if ($_GET['page'] == 'edit_kategori') {
			?>

			  <section class="content-header">
				<div class="container-fluid">
				  <div class="row mb-2">
					<div class="col-sm-6">
					  <h1>Edit Kategori</h1>
					</div>
				  </div>
				</div>
			  </section>
		
			  <section class="content">
				<div class="card">
				  <div class="card-body">
					<?php
					$id = $_GET['id'];
					$hasil = $db->query("SELECT * FROM kategori WHERE id_kategori='$id'");
					$d = $hasil->fetch_assoc();
					?>
					<form action="?page=kategori_edit" method="post">
					  <input type="hidden" name="id_kategori" value="<?= $d['id_kategori'] ?>">
					  <div class="form-group">
						<label>Nama Kategori</label>
						<input type="text" name="nama_kategori" class="form-control" value="<?= $d['nama_kategori'] ?>" required>
					  </div>
					  <div class="form-group">
					  <button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				  </form>
				</div>
			  </div>
			</section>
		  <?php
		} else if ($_GET['page'] == 'hapus_kategori') {
			$id = $_GET['id'];
			$hasil = $db->query("DELETE FROM kategori WHERE id_kategori='$id'");
			if ($hasil) {
			  header('location: ?page=kategori');
			} else {
			  echo "Ada masalah: " . $db->error;
			}
		} else if ($_GET['page'] == 'kategori_tambah') {
			$nama_kategori = $_POST['nama_kategori'];
		
			$hasil = $db->query("INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')");
			if ($hasil) {
			  header('location: ?page=kategori');
			} else {
			  echo "Ada masalah: " . $db->error;
			}
		} else if ($_GET['page'] == 'kategori_edit') {
			$id = $_POST['id_kategori'];
			$nama_kategori = $_POST['nama_kategori'];
		
			$hasil = $db->query("UPDATE kategori SET nama_kategori='$nama_kategori' WHERE id_kategori='$id'");
			if ($hasil) {
			  header('location: ?page=kategori');
			} else {
			  echo "Ada masalah: " . $db->error;
			}
}
//==============================[ Anggota ]==================================		
				else if ($_GET['page'] == 'anggota')
//--------------------------------------------------------------------------
{
    ?>
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Data Anggota</h1>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
          <a href="?page=tambah_anggota" class="btn btn-primary">Tambah Anggota</a>
          </div>
        </div>
      </section>
        <table class="table table-bordered table-hover">
          <tr style="background: linear-gradient(to right,rgb(21, 3, 102),rgb(48, 128, 234));">
            <th>Id Anggota</th>
            <th>Nama Anggota</th>
            <th>Alamat</th>
            <th>No Telepon</th>
            <th>Aksi</th>
          </tr>
        <?php
        $hasil = $db->query("SELECT id_anggota, nama, alamat, no_telepon FROM anggota");
        if (!$hasil) {
          echo "<tr><td colspan='4'>Ada masalah: " . $db->error . "</td></tr>";
        } else {
          while ($d = $hasil->fetch_assoc()) {
            echo "
            <tr>
              <td>{$d['id_anggota']}</td>
              <td>{$d['nama']}</td>
              <td>{$d['alamat']}</td>
              <td>{$d['no_telepon']}</td>
              <td>
                <a href='?page=edit_anggota&id={$d['id_anggota']}' class='btn bg-warning'>Edit</a>
                <a href='?page=hapus_anggota&id={$d['id_anggota']}' class='btn delete bg-danger' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>
                </td>
            </tr>";
          }
        }
        ?>
        </table>
      </section>
    <?php
} else if ($_GET['page'] == 'tambah_anggota') {
    ?>
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Tambah Anggota</h1>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="card">
          <div class="card-body">
            <form action="?page=anggota_tambah" method="post">
              <div class="form-group">
                <label>Nama Anggota</label>
                <input type="text" name="nama" class="form-control" required>
              </div>
              <div class="form-group">
              <label>Alamat</label>
              <input type="text" name="alamat" class="form-control" required>
            </div>
            <div class="form-group">
              <label>No Telepon</label>
              <input type="text" name="no_telepon" class="form-control" required>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  <?php
} else if ($_GET['page'] == 'edit_anggota') {
    ?>
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Edit Anggota</h1>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="card">
          <div class="card-body">
            <?php
            $id = $_GET['id'];
            $hasil = $db->query("SELECT * FROM anggota WHERE id_anggota='$id'");
            $d = $hasil->fetch_assoc();
            ?>
            <form action="?page=anggota_edit" method="post">
              <input type="hidden" name="id_anggota" value="<?= $d['id_anggota'] ?>">
              <div class="form-group">
                <label>Nama Anggota</label>
                <input type="text" name="nama" class="form-control" value="<?= $d['nama'] ?>" required>
              </div>
              <div class="form-group">
              <label>Alamat</label>
              <input type="text" name="alamat" class="form-control" value="<?= $d['alamat'] ?>" required>
            </div>
            <div class="form-group">
              <label>No Telepon</label>
              <input type="text" name="no_telepon" class="form-control" value="<?= $d['no_telepon'] ?>" required>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  <?php
} else if ($_GET['page'] == 'hapus_anggota') {
    $id = $_GET['id'];
    $hasil = $db->query("DELETE FROM anggota WHERE id_anggota='$id'");
    if ($hasil) {
      header('location: ?page=anggota');
    } else {
      echo "Ada masalah: " . $db->error;
    }
} else if ($_GET['page'] == 'anggota_tambah') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_telepon = $_POST['no_telepon'];

    $hasil = $db->query("INSERT INTO anggota (nama, alamat, no_telepon) VALUES ('$nama', '$alamat', '$no_telepon')");
    if ($hasil) {
      header('location: ?page=anggota');
    } else {
      echo "Ada masalah: " . $db->error;
    }
} else if ($_GET['page'] == 'anggota_edit') {
    $id = $_POST['id_anggota'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_telepon = $_POST['no_telepon'];

    $hasil = $db->query("UPDATE anggota SET nama='$nama', alamat='$alamat', no_telepon='$no_telepon' WHERE id_anggota='$id'");
    if ($hasil) {
      header('location: ?page=anggota');
    } else {
      echo "Ada masalah: " . $db->error;
    }
}
//==============================[ Anggota ]==================================		
				else if ($_GET['page'] == 'peminjaman')
//--------------------------------------------------------------------------
{
	?>
	<section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Data Peminjaman</h1>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
          <a href="?page=tambah_pinjam" class="btn btn-primary">Tambah Peminjaman</a>
        </div>
          </div>
        </div>
      </section>
        <table class="table table-bordered table-hover">
          <tr style="background: linear-gradient(to right,rgb(21, 3, 102),rgb(48, 128, 234));">
            <th>Id Peminjaman</th>
            <th>Petugas</th>
            <th>Anggota</th>
            <th>Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Aksi</th>
          </tr>
        <?php
        $hasil = $db->query("
        SELECT p.id_peminjaman, u.username, a.nama, b.judul, p.tanggal_pinjam, p.tanggal_kembali 
        FROM peminjaman p
        LEFT JOIN user u ON u.id_petugas=p.id_petugas
        LEFT JOIN anggota a ON a.id_anggota=p.id_anggota
        LEFT JOIN buku b ON b.id_buku=p.id_buku

        ");
        if (!$hasil) {
          echo "<tr><td colspan='5'>Ada masalah: " . $db->error . "</td></tr>";
        } else {
          while ($d = $hasil->fetch_assoc()) {
            echo "
            <tr>
              <td>{$d['id_peminjaman']}</td>
              <td>{$d['username']}</td>
              <td>{$d['nama']}</td>
              <td>{$d['judul']}</td>
              <td>{$d['tanggal_pinjam']}</td>
              <td>{$d['tanggal_kembali']}</td>
              <td>
                <a href='?page=edit_pinjam&id={$d['id_peminjaman']}' class='btn bg-warning'>Edit</a>
                <a href='?page=hapus_pinjam&id={$d['id_peminjaman']}' class='btn delete bg-danger' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>
              </td>
            </tr>";
          }
        }
        ?>
        </table>
      </section>
    <?php
} else if ($_GET['page'] == 'tambah_pinjam') {
    ?>
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Tambah Peminjaman</h1>
            </div>
          </div>
        </div>
      </section>
      <section class="content">
        <div class="card">
          <div class="card-body">
            <form action="?page=pinjam_tambah" method="post">
              <div class="form-group">
              <label>Id Petugas</label>
              <input type="text" name="id_petugas" class="form-control" required>
            </div>
              <div class="form-group">
                <label>Id Anggota</label>
                <input type="text" name="id_anggota" class="form-control" required>
              </div>
              <div class="form-group">
					  <label>Buku</label>
					  <select name="id_buku" class="form-control" required>
						<option>Pilih Buku</option>
						<?php
						$hasil = $db->query("SELECT id_buku, judul FROM buku");
						if (!$hasil) {
						  echo "<option value=''>Ada masalah: " . $db->error . "</option>";
            } else {
              while ($k = $hasil->fetch_assoc()) {
              $pilih = $d['id_buku'] == $k['id_buku'] ? 'selected' : '';
              echo "<option value='{$k['id_buku']}' {$pilih}>{$k['judul']}</option>";
						  }
						}
						?>
					  </select>
					</div>
            <div class="form-group">
              <label>Tanggal Pinjam</label>
              <input type="date" name="tanggal_pinjam" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Tanggal Kembali</label>
              <input type="date" name="tanggal_kembali" class="form-control">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  <?php
}
else if ($_GET['page']== 'edit_pinjam'){
    ?>
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Edit Peminjaman</h1>
            </div>
          </div>
        </div>
      </section>
      <section class="content">
        <div class="card">
          <div class="card-body">
            <?php
            $id = $_GET['id'];
            $hasil = $db->query("SELECT * FROM peminjaman WHERE id_peminjaman='$id'");
            $d = $hasil->fetch_assoc();
            ?>
            <form action="?page=pinjam_edit" method="post">
              <input type="hidden" name="id_peminjaman" value="<?= $d['id_peminjaman'] ?>">
              <div class="form-group">
              <label>Id Petugas</label>
              <input type="text" name="id_petugas" class="form-control" value="<?= $d['id_petugas'] ?>" required>
            </div>
              <div class="form-group">
                <label>Id Anggota</label>
                <input type="text" name="id_anggota" class="form-control" value="<?= $d['id_anggota'] ?>" required>
              </div>
              <div class="form-group">
					  <label>Buku</label>
					  <select name="id_buku" class="form-control" required>
						<option>Pilih Buku</option>
						<?php
						$hasil = $db->query("SELECT id_buku, judul FROM buku");
						if (!$hasil) {
						  echo "<option value=''>Ada masalah: " . $db->error . "</option>";
            } else {
              while ($k = $hasil->fetch_assoc()) {
              $pilih = $d['id_buku'] == $k['id_buku'] ? 'selected' : '';
              echo "<option value='{$k['id_buku']}' {$pilih}>{$k['judul']}</option>";
						  }
						}
						?>
					  </select>
					</div>
            <div class="form-group">
              <label>Tanggal Pinjam</label>
              <input type="date" name="tanggal_pinjam" class="form-control" value="<?= $d['tanggal_pinjam'] ?>" required>
            </div>
            <div class="form-group">
              <label>Tanggal Kembali</label>
              <input type="date" name="tanggal_kembali" class="form-control" value="<?= $d['tanggal_kembali'] ?>" required>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  <?php
} else if ($_GET['page'] == 'hapus_pinjam') {
    $id = $_GET['id'];
    $hasil = $db->query("DELETE FROM peminjaman WHERE id_peminjaman='$id'");
    if ($hasil) {
      header('location: ?page=peminjaman');
    } else {
      echo "Ada masalah: " . $db->error;
    }
} else if ($_GET['page'] == 'pinjam_tambah') {
  $id_petugas = $_POST['id_petugas'];
  $id_anggota = $_POST['id_anggota'];
  $id_buku = $_POST['id_buku'];
  $tanggal_pinjam = $_POST['tanggal_pinjam'];
  $tanggal_kembali = $_POST['tanggal_kembali'];
  // Periksa apakah tanggal_kembali kosong
  if (empty($tanggal_kembali)) {
    $tanggal_kembali = "NULL"; // Atur nilai menjadi NULL untuk database
  } 
  $hasil = $db->query("INSERT INTO peminjaman (id_petugas, id_anggota, id_buku, tanggal_pinjam, tanggal_kembali) 
                       VALUES ('$id_petugas', '$id_anggota', '$id_buku', '$tanggal_pinjam', $tanggal_kembali)"); // Perhatikan tidak ada tanda kutip di sekitar $tanggal_kembali
  if ($hasil) {
    header('location: ?page=peminjaman');
  } else {
    echo "Ada masalah: " . $db->error;
  }
} else if ($_GET['page'] == 'pinjam_edit') {
    $id = $_POST['id_peminjaman'];
    $id_petugas = $_POST['id_petugas'];
    $id_anggota = $_POST['id_anggota'];
    $id_buku = $_POST['id_buku'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    $hasil = $db->query("UPDATE peminjaman SET id_anggota='$id_anggota', id_petugas='$id_petugas',  id_buku='$id_buku', tanggal_pinjam='$tanggal_pinjam', tanggal_kembali='$tanggal_kembali' WHERE id_peminjaman='$id'");
    if ($hasil) {
      header('location: ?page=peminjaman');
    } else {
      echo "Ada masalah: " . $db->error;
    }
}
//==============================[ About ]==================================		
					else if ($_GET['page'] == 'about')
//------------------------------------------------------------
{
?>
<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Tentang Pembuat</h1>
				</div>
			</div>
		</div>
			</section>
				<section class="content">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Aditya Rahman</h3>
						</div>
					<div class="card-body">
						<p>Halo Perkenalkan nama saya Aditya Rahman dengan NIM C030323004</p>
				</div>
			</div>
		</section>
	<?php
}
//==============================[ logout ]==================================		
				else if ($_GET['page'] == 'logout')
//--------------------------------------------------------------------
{
	session_destroy();
  echo "<script>alert('Anda telah logout');</script>";
    header('location: ../index.php');
}
}

	?>

	</div>
	<!-- Wajib ada, penutup konten milik AdminLTE /.content-wrapper -->