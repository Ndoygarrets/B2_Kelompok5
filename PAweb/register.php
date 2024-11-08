<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengisian</title>

    <link rel="stylesheet" href="./css/form.css">
</head>

<body>
<div class="kontainer">
        <div class="box form-box">

        <?php 
include("koneksi.php");

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Periksa apakah username sudah ada
    $verify_query = mysqli_query($conn, "SELECT username FROM users WHERE username='$username'");
    
    if (mysqli_num_rows($verify_query) != 0) {
        echo "
        <script>
            alert('Gagal menambah akun! Username sudah ada.');
            document.location.href = 'index.php';
        </script>";
    } else {
        // Hash password sebelum disimpan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Simpan username dan password yang sudah di-hash ke database
        $query = "INSERT INTO users(username, password, role) VALUES('$username', '$hashed_password', '$role')";
        
        if (mysqli_query($conn, $query)) {
            echo "
            <script>
                alert('Berhasil menambah akun!');
                document.location.href = 'index.php';
            </script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
} else {
?>


            <header>Daftar Akun</header>
            <form method="POST">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="role" class="login-form-title">Role</label>
                    <select name="role" id="role" class="login-form-input" required>
                    <option name="role" value="Admin">Admin</option>
                    <option name="role" value="User">User</option>
                    </select>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Daftar">
                </div>
                <div class="link">
                    Sudah punya akun? <a href="index.php">Login</a>
                </div>
            </form>            
        </div>
        <?php } ?>
    </div>
</body>
</html>
