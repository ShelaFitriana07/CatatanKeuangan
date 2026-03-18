<?php
session_start();
include "koneksi.php";

if (isset($_SESSION['id_admin']) && isset($_SESSION['username'])) {
    $id_pengguna = $_SESSION['id_admin'];

    $hapus_query = "DELETE FROM pengeluaran ";

    $hapus_result = mysqli_query($conn, $hapus_query);

    if ($hapus_result) {
        header("Location: pengeluaranPengurus.php");
    } else {
        echo "Gagal menghapus pengeluaran: " . mysqli_error($conn);
    }
} else {
    header("Location: pengeluaranPengurus.php");
    exit();
}
