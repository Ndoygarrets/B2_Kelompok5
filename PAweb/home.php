<?php 
  session_start();
  if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'User') {
  // Jika belum login atau bukan admin, arahkan ke index.php
  header('Location: index.php');
  exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Warmindo</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/me.css">
    <link rel="stylesheet" href="./css/header.css" />
  </head>
  <body>
    <!-- Awal Header -->

    <header>
      <h1 class="logo"><img src="image/warmindo.png" alt="Logo"></h1>
      <nav>
        <div class="off-screen-menu">
          <ul>
            <li class="history">
              <a href="logout.php">Log out</a>
            </li>
          </ul>
        </div>

        <div class="ham-menu">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </nav>
    </header>

    <!-- Akhir Header -->

    <section class="container">
      <div class="main">
        <h2>
          Selamat datang <br> di warung indomie
        </h2>
        <div class="items">
          <div class="item">
            <img src="image/mie.png" alt="">
            <h1>Menu makanan</h1>
            <a class="button" href="makanan.php">Liat menu</a>
          </div>
          <div class="item">
            <img src="image/minuman.png" alt="">
            <h1>Menu minuman</h1>
            <a class="button" href="minuman.php">Liat menu</a>
          </div>
        </div>
      </div>
    </section>


    <footer class="">
      <h1>
        Copyright 2024 By Warmindo
      </h1>
    </footer>

    <script src="script.js"></script>
  </body>
</html>
