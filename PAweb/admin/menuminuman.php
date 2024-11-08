<?php
  require "../koneksi.php";

  session_start();
  if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
  // Jika belum login atau bukan admin, arahkan ke index.php
  header('Location: ../index.php');
  exit;
}

  $sql = mysqli_query($conn, "SELECT * FROM minuman");

  $menu_minuman = [];
  while ($row = mysqli_fetch_assoc($sql)) {
      $menu_minuman[] = $row;
  }

  if (isset($_GET['search'])) {
    $search = $_GET['search'];

    $sql = mysqli_query($conn, "SELECT * FROM minuman WHERE nama LIKE '%$search%'");

    $menu_minuman = [];

    while ($row = mysqli_fetch_assoc($sql)) {
    $menu_minuman[] = $row;
    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Minuman</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/rr.css">

</head>
<body>
    <nav class="nav">
        <div class="logo">
            <a href="../admin.html">
                <h1>logo</h1>
            </a>
        </div>
        <div class="navigasi">
            <a href="menumakanan.php">
                <h5>Makanan</h5>
            </a>
            <a href="">
                <h5>Minumnan</h5>
            </a>
            <a href="user.php">
                <h5>User</h5>
            </a>
        </div>
        <div class="bottom">
            <h5>Copyright</h5>
        </div>
    </nav>

    <main class="tabel_section">
    <h1 class="title_menu">
            DATA MENU MINUMAN
        </h1>
        <div class="container">
          <a href="tambahminuman.php">
            <button class="buton">
              <p>Tambah</p>
            </button>
          </a>
          <a href="../logout.php">
            <button class="buton">
              <p>Logout</p>
            </button>
          </a>
        </div>
        <search>
        <form action="" method="GET" class="search_bar_menu">
          <input type="text" name="search" placeholder="Cari Nama minuman"
          class="search-input-mahasiswa" />
          <button type="submit" class="search_button_menu">
          <i class="fa-solid fa-magnifying-glass fa-xl"></i>
          </button>
        </form>
        </search>
    </main>

    
        <table class="table_menu">
          <thead>
            <tr class="table_menu_row">
              <th class="table_menu_header">ID</th>
              <th class="table_menu_header">Gambar</th>
              <th class="table_menu_header">Nama Makanan</th>
              <th class="table_menu_header">Harga</th>
              <th class="table_menu_header">Aksi</th>
            </tr>
          </thead>
    
          <tbody>
            <?php $i = 1; foreach($menu_minuman as $minuman) : ?>
                <tr class="table_menu_row">
                    <td class="table_menu_data"><?php echo $i ?></td>
                    <td class="table_menu_data">
                    <img src="../uploads/<?php echo $minuman['gambar']; ?>" 
                    alt="<?php echo $minuman['nama']; ?>" 
                    width="80px" height="100px" style="display: block;">
                    </td>
                    <td class="table_menu_data"><?php echo $minuman['nama'] ?></td>
                    <td class="table_menu_data"><?php echo $minuman['harga'] ?></td>
                    <td class="table-mahasiswa-data">
                    <div class="button-UD">
                        <a href="editminuman.php?id=<?php echo $minuman['id']?>">
                        <button class="edit-data">
                            <i class="fa-solid fa-pen" style="color: #ffffff;"></i>
                        </button>
                        </a>
                        <a href="hapusminuman.php?id=<?php echo $minuman['id']?>" onclick="return confirm('Yakin ingin menghapus data ini?');">
                        <button class="hapus-data">
                            <i class="fa-solid fa-trash-can" style="color: #ffffff;"></i>
                        </button>
                        </a>
                    </div>
                    </td>
                </tr>
            <?php $i++; endforeach ?>
          </tbody>
        </table>
</body>
</html>