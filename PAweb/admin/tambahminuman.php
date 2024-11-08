<?php
require "../koneksi.php";

session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
// Jika belum login atau bukan admin, arahkan ke index.php
header('Location: ../index.php');
exit;
}

if (isset($_POST['tambah'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $harga = htmlspecialchars($_POST['harga']);

    if (!is_numeric($harga) || $harga < 0) {
      echo "
          <script>
              alert('Harga harus berupa angka positif!');
              document.location.href = 'tambahminuman.php';
          </script>";
      exit;
    }

    // Proses Upload File
    $gambar = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $gambar_size = $_FILES['gambar']['size'];
    $upload_dir = "../uploads/";

    // Batas ukuran 2MB (2 * 1024 * 1024 byte)
    if ($gambar_size > 2 * 1024 * 1024) {
        echo "
            <script>
                alert('Ukuran file terlalu besar. Maksimal 2MB!');
                document.location.href = 'CRUD.php';
            </script>";
        exit;
    }

    // Cek apakah direktori uploads ada, jika tidak, buat.
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $target_file = $upload_dir . basename($gambar);

    if (move_uploaded_file($tmp_name, $target_file)) {
        // Query untuk menyimpan data ke database
        $sql = "INSERT INTO minuman (nama, harga, gambar) 
                VALUES ('$nama', '$harga', '$gambar')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "
                <script>
                    alert('Berhasil menambah data menu!');
                    document.location.href = 'menuminuman.php';
                </script>";
        } else {
            echo "
                <script>
                    alert('Gagal menambah data menu!');
                    document.location.href = '../admin.html';
                </script>";
        }
    } else {
        echo "
            <script>
                alert('Gagal mengunggah file!');
                document.location.href = '../admin.html';
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tambah data</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../css/admin.css">
  <link rel="stylesheet" href="../css/rr.css">
</head>

<body>
  <main class="tabel_section">
    <h1 class="data-mahasiswa-title">
      Tambah Data Menu
    </h1>

    <div class="container">
      <a href="menuminuman.php">
        <button class="back">
          <p>Back</p>
        </button>
      </a>
    </div>

    <div class="form_menu">
      <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateFile()">
        <div class="input-field">
          <label class="label-field" for="nama">Nama minuman</label><br>
          <input type="text" name="nama" id="nama" required>
        </div>
        <div class="input-field">
          <label class="label-field" for="harga">Harga</label><br>
          <input type="text" name="harga" id="harga">
        </div>
        <div class="input-field">
            <label for="gambar">Upload gambar</label><br>
            <input type="file" name="gambar" id="gambar" required>
        </div>
        <input class="buton" type="submit" value="Tambah" name="tambah">
      </form>

      <script>
        function validateFile() {
          const fileInput = document.getElementById('gambar');
          const file = fileInput.files[0];
          const hargaInput = document.getElementById('harga').value;

          if (file && file.size > 2 * 1024 * 1024) {
            alert('Ukuran file tidak boleh lebih dari 2MB.');
            return false;
          }

          if (!/^\d+(\.\d+)?$/.test(hargaInput) || parseFloat(hargaInput) < 0) {
            alert('Harga harus berupa angka positif!');
            return false;
          }

          return true;
        }
      </script>
    </div>
  </main>
</body>
</html>
