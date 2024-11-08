<?php
    require "../koneksi.php";

    session_start();
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    // Jika belum login atau bukan admin, arahkan ke index.php
    header('Location: ../index.php');
    exit;
    }

    $id = $_GET['id'];

    $result = mysqli_query($conn, "DELETE FROM users WHERE id = $id");

    if ($result) {
        echo "
        <script>
            alert('Data berhasil dihapus!');
            document.location.href = 'user.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Data gagal dihapus!');
            document.location.href = 'CRUD.php';
        </script>";
    }
?>