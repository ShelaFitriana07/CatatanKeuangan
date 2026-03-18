<?php
session_start();
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $keterangan = $_POST['keterangan'];
    $tanggal = $_POST['tanggal'];
    $jumlah = $_POST['jumlah'];

    $query = "INSERT INTO pengeluaran ( keterangan, tanggal, jumlah) VALUES ('$keterangan', '$tanggal', $jumlah)";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Data berhasil disimpan ke database.";
        header("Location: pengeluaranPengurus.php");
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
        <a href="pengeluaranPengurus.php"><img src="Asset/arrow.png"></a>
        <h1>Tambah Data</h1>
    </div>
    <form action="" method="post" class="tambah-data">
        <div class="container-data">
            <label class="label-data" for="keterangan">Keterangan</label><br>
            <input class="input-data" type="text" name="keterangan" placeholder="Masukkan keterangan" required>
            <br>
        </div>
        <div class="container-data">
            <label class="label-data" for="tanggal">Tanggal</label><br>
            <input class="input-data" type="date" name="tanggal" placeholder="Masukkan tanggal" required>
            <br>
        </div>
        <div class="container-data">
            <label class="label-data" for="jumlah">Jumlah</label><br>
            <input class="input-data" type="number" name="jumlah" placeholder="Masukkan jumlah uang" required>
            <br>
        </div>
        <input type="submit" class="simpan" value="SIMPAN">
    </form>
</body>

</html>