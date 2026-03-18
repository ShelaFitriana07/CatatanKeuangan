<?php

session_start();
include "koneksi.php";

// $nis = $_POST['nis'];
$uname = $_POST['uname'];
$pass = md5($_POST['password']);

if (isset($_POST['uname']) && isset($_POST['password'])) {

    if (empty($uname) || empty($pass)) {
        $errorMessage = "<span style='color: red;'>Silahkan masukkan username dan password</span>";
        header("Location: index.php?error=$errorMessage");
        exit();
    } elseif ($uname == 'admin') {
        $sql = "SELECT * FROM admin WHERE username='$uname' AND password='$pass'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($row['username'] == $uname && $row['password'] == $pass) {
                echo "Logged in!";
                $_SESSION['username'] = $row['username'];
                $_SESSION['id_admin'] = $row['id_admin'];
                header("location:pengeluaranPengurus.php");
                exit();
            } else {
                $errorMessage = "<span style='color: red;'>Username atau password salah</span>";
                header("location: index.php?error=$errorMessage");
                exit();
            }
        } else {
            $errorMessage = "<span style='color: red;'>Username atau password salah</span>";
            header("Location: index.php?error=$errorMessage");
            exit();
        }
    } else {
        $sql = "SELECT * FROM pengguna WHERE username='$uname' AND password='$pass'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($row['username'] == $uname && $row['password'] == $pass) {
                echo "Logged in!";
                $_SESSION['username'] = $row['username'];
                $_SESSION['nis'] = $row['nis'];
                header("location:pengeluaran.php");
                exit();
            } else {
                $errorMessage = "<span style='color: red;'>Username atau password salah</span>";
                header("location: index.php?error=$errorMessage");
                exit();
            }
        } else {
            $errorMessage = "<span style='color: red;'>Username atau password salah</span>";
            header("Location: index.php?error=$errorMessage");
            exit();
        }
    }
} else {
    header("Location: index.php");
    exit();
}
