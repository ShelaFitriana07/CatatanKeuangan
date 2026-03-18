<?php
session_start();
include "koneksi.php";

if (isset($_GET['id_pengeluaran'])) {
    $hapus_id = $_GET['id_pengeluaran'];

    $hapus_query = "DELETE FROM pengeluaran WHERE id_pengeluaran = $hapus_id";
    $hapus_result = mysqli_query($conn, $hapus_query);

    if ($hapus_result) {
        header("Location: pengeluaranPengurus.php");
    } else {
        echo "Gagal menghapus data dari database: " . mysqli_error($conn);
    }
} elseif (isset($_GET['id_pemasukan'])) {
    $hapus_id = $_GET['id_pemasukan'];

    $hapus_query = "DELETE FROM pemasukan WHERE id_pemasukan= $hapus_id";
    $hapus_result = mysqli_query($conn, $hapus_query);

    if ($hapus_result) {
        header("Location: pemasukanPengurus.php");
    } else {
        echo "Gagal menghapus data dari database: " . mysqli_error($conn);
    }
} elseif (isset($_GET['nis'])) {
    $hapus_id = $_GET['nis'];

    $hapus_query = "DELETE FROM pengguna WHERE nis= $hapus_id";
    $hapus_result = mysqli_query($conn, $hapus_query);

    if ($hapus_result) {
        header("Location: akun.php");
    } else {
        echo "Gagal menghapus data dari database: " . mysqli_error($conn);
    }
} else {
    echo "ID tidak valid.";
}
