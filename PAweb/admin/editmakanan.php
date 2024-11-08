<?php
require "../koneksi.php";

session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header('Location: ../index.php');
    exit;
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM makanan WHERE id = $id");

$menu_makanan = [];
while ($row = mysqli_fetch_assoc($result)) {
    $menu_makanan[] = $row;
}
$menu_makanan = $menu_makanan[0];

if (isset($_POST['ubah'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];

    // PHP Validation for harga to be a positive number
    if (!is_numeric($harga) || $harga < 0) {
        echo "
            <script>
                alert('Harga harus berupa angka positif!');
                document.location.href = 'editmakanan.php';
            </script>";
        exit;
    }

    // Check if the user uploaded a new image
    if ($_FILES['gambar']['name']) {
        $namaFile = $_FILES['gambar']['name'];
        $tmpName = $_FILES['gambar']['tmp_name'];
        $error = $_FILES['gambar']['error'];
        $size = $_FILES['gambar']['size'];

        // Limit file size (example: 2MB)
        if ($size > 2 * 1024 * 1024) {
            echo "<script>alert('Ukuran file terlalu besar! Maksimal 2MB.');</script>";
            exit;
        }

        // Validate file extension (jpg, jpeg, png)
        $extValid = ['jpg', 'jpeg', 'png'];
        $extFile = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
        if (!in_array($extFile, $extValid)) {
            echo "<script>alert('Format file tidak didukung! (jpg, jpeg, png)');</script>";
            exit;
        }

        // Delete old image
        if (file_exists('uploads/' . $menu_makanan['gambar'])) {
            unlink('uploads/' . $menu_makanan['gambar']);
        }

        // Save new image
        $namaBaru = uniqid() . '.' . $extFile;
        move_uploaded_file($tmpName, '../uploads/' . $namaBaru);

        // Update query with new image
        $sql = "UPDATE makanan SET nama='$nama', harga='$harga', gambar='$namaBaru' WHERE id=$id";
    } else {
        // If no new image, update other data only
        $sql = "UPDATE makanan SET nama='$nama', harga='$harga' WHERE id=$id";
    }

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "
        <script>
            alert('Data berhasil diubah!');
            document.location.href = 'menumakanan.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Data gagal diubah!');
            document.location.href = 'menumakanan.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Data Menu</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
          integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/rr.css">
</head>

<body>

<main class="tabel_section">
    <h1 class="data-mahasiswa-title">Ubah Data Menu</h1>

    <div class="container">
        <a href="menuminuman.php">
            <button class="back"><p>Back</p></button>
        </a>
    </div>

    <div class="form-mhs">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="input-field">
                <label class="label-field" for="nama">Nama Makanan</label>
                <input type="text" name="nama" id="nama" value="<?php echo $menu_makanan['nama']; ?>" required>
            </div>
            <div class="input-field">
                <label class="label-field" for="harga">Harga</label>
                <input type="text" name="harga" id="harga" value="<?php echo $menu_makanan['harga']; ?>" required>
            </div>
            <div class="input-field">
                <label class="label-field" for="gambar">Gambar (Optional)</label>
                <input type="file" name="gambar" id="gambar">
            </div>
            <input class="buton" type="submit" value="Ubah" name="ubah">
        </form>
    </div>

    <script>
      document.querySelector("form").addEventListener("submit", function(event) {
        const hargaInput = document.getElementById('harga').value;

        // Validate harga field to be a positive numeric value
        if (!/^\d+(\.\d+)?$/.test(hargaInput) || parseFloat(hargaInput) < 0) {
          alert('Harga harus berupa angka positif!');
          event.preventDefault();  // Prevent form submission
        }
      });
    </script>

</main>

</body>

</html>
