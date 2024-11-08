<?php
  require "koneksi.php";

  session_start();
  if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'User') {
  // Jika belum login atau bukan admin, arahkan ke index.php
  header('Location: index.php');
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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Menu makanan</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/menu1.css">

<body>
<header>
    <h2>Menu Minuman</h2>
    <form action="" method="GET" class="search_bar_menu">
          <input type="text" name="search" placeholder="Cari Nama makanan"
          class="search-input-mahasiswa" />
          <button type="submit" class="search_button_menu">
          <i class="fa-solid fa-magnifying-glass fa-xl"></i>
          </button>
        </form>
      </search>
    <div class="button">
      <a href="home.php">Kembali</a>
    </div>
  </header>

  <div class="products">
      <?php $i = 1; foreach($menu_minuman as $minuman) : ?>
      <div class="product">
        <img src="uploads/<?php echo $minuman['gambar']; ?>" alt="minuman"  >
        <h2><?php echo $minuman['nama'] ?></h2>
        <h3><?php echo $minuman['harga'] ?></</h3>
      </div>
      <?php $i++; endforeach ?>
    </div>
</body>

</html>