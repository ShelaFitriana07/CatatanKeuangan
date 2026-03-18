<?php
session_start();
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $keterangan = $_POST['keterangan'];
    $tanggal = $_POST['tanggal'];
    $jumlah = $_POST['jumlah'];

    $query = "INSERT INTO pemasukan ( keterangan, tanggal, jumlah) VALUES ('$keterangan', '$tanggal', $jumlah)";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Data berhasil disimpan ke database.";
        header("Location: pemasukanPengurus.php");
        exit();
    } else {
        echo "Gagal menyimpan data ke database: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="icon" type="image/png" href="Asset/logo web.png">
    <title>Tambah Data</title>
</head>

<body>
    <div class="header-input">
        <a href="pemasukanPengurus.php"><img src="Asset/arrow.png"></a>
        <h1>Tambah Data</h1>
    </div>
    <form action="" method="post" class="tambah-data">
        <div class="container-data">
            <label for="keterangan" class="label-data">Keterangan</label><br>
            <input type="text" name="keterangan" class="input-data" placeholder="Masukkan keterangan" required>
            <br>

        </div>
        <div class="container-data">
            <label for="tanggal" class="label-data">Tanggal</label><br>
            <input type="date" name="tanggal" class="input-data" placeholder="Masukkan tanggal" required>
            <br>

        </div>
        <div class="container-data">
            <label for="jumlah" class="label-data">Jumlah</label><br>
            <input type="number" name="jumlah" class="input-data" placeholder="Masukkan jumlah uang" required>
            <br>
        </div>
        <input type="submit" class="simpan" value="SIMPAN">
    </form>
    <div class="form">
</body>

</html>