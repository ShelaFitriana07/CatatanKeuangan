<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="icon" type="image/png" href="Asset/logo web.png">

    <title>Daftar Akun</title>
</head>

<body>
    <div class="header-input">
        <a href="pengeluaranPengurus.php"><img src="Asset/arrow.png"></a>
        <h1>Daftar akun</h1>
    </div>
    <?php
    include "koneksi.php"; ?>
    <div class="" id="update">
        <?php
        if (isset($_POST['update'])) {
            $nis = $_POST['nis'];
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            $update_query = "UPDATE pengguna  SET  username=?, password=? WHERE nis=?";
            $stmt = mysqli_prepare($conn, $update_query);
            mysqli_stmt_bind_param($stmt, "sss", $username, $password, $nis);
            $result = mysqli_stmt_execute($stmt);
            if ($result) {
                header("location:akun.php");
            } else {
                echo "<script>alert('Gagal mengupdate data');</script>";
            }
        }
        ?>
        <div class="" id="tambah">
            <?php
            if (isset($_POST['submit'])) {
                $nis = $_POST['nis'];
                $username = $_POST['username'];
                $password = md5($_POST['password']); // Menggunakan fungsi md5() untuk mengenkripsi password

                $insert_query = "INSERT INTO pengguna (nis, username, password) VALUES ('$nis', '$username', '$password')";

                $result = mysqli_query($conn, $insert_query);
                if ($result) {
                    header("location:akun.php");
                } else {
                    echo "<script>alert('Gagal menambahkan data');</script>";
                }
            }
            ?>
        </div>
    </div>
    </div>
    <?php
    $total_akun = "SELECT * FROM pengguna";
    $akun = mysqli_query($conn, $total_akun);

    if (mysqli_num_rows($akun) > 0) {

        while ($row = mysqli_fetch_assoc($akun)) {
    ?>
            <div class="container-akun">
                <?php if (isset($_POST['edit']) && $_POST['edit'] == $row['nis']) : ?>
                    <form method="post">
                        <input type="hidden" name="nis" value="<?php echo $row['nis']; ?>">
                        <div class="tabel-akun" style="background-color: #EEEEEE;">
                            <div class="daftar-nis">
                                <input type="number" name="nis" value="<?php echo $row["nis"]; ?>">
                            </div>
                            <div class="daftar-username">
                                <input type="text" name="username" value="<?php echo $row["username"]; ?>">
                            </div>
                            <div class="daftar-password">
                                <input type="text" name="password" value="<?php echo $row["password"]; ?>">
                            </div>
                            <div class="tombol-akun">
                                <input type="submit" class="tombol-akun" name="update" value="Simpan">

                            </div>
                        </div>
                    </form>
                <?php else : ?>
                    <form method="post" class="tabel-akun">
                        <input type="hidden" name="edit" value="<?php echo $row['nis']; ?>">
                        <div class="tabel-akun">
                            <div class="daftar-nis">
                                <?php echo $row["nis"]; ?>
                            </div>
                            <div class="daftar-username">
                                <?php echo $row["username"]; ?>
                            </div>
                            <div class="daftar-password">
                                <?php echo $row["password"]; ?>
                            </div>
                            <div class="container-tombol">
                                <div class="tombol-akun">
                                    <input type="submit" value="Edit" class="tombol-akun">
                                </div>
                                <div class="tombol-akun" style="background-color: #B80000;">

                                    <?php
                                    echo "<a href='delete.php?nis={$row['nis']}'>Hapus</a>";
                                    ?>
                                </div>

                            </div>
                    </form>
            </div>
        <?php endif; ?>
        </div>
    <?php
        }
    } else {
    ?>
    <div class="kosong">
        <b>Tidak ada akun</b>
    </div>
<?php
    }
?>
<form method="post" class="form-tambah">
    <label for="nis">NIS:</label>
    <input type="text" id="nis" name="nis" required>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <div class="tombol-akun" style="background-color: #40A2E3;">
        <input class="tombol-akun" type="submit" name="submit" style="background-color: #40A2E3;" value="Tambah">

    </div>
</form>
</body>

</html>