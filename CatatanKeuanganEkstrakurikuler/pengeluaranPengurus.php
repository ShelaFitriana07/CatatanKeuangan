<?php
session_start();
include "koneksi.php";

if (isset($_SESSION['id_admin']) && isset($_SESSION['username'])) {

    $query = "SELECT * FROM pengeluaran";
    $result = mysqli_query($conn, $query);

    if ($result) {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Home</title>
            <link rel="icon" type="image/png" href="Asset/logo web.png">
            <link rel="stylesheet" href="stylesheet.css">
        </head>

        <body>
            <div class="home">
                <div class="header">
                    <a href="akun.php">
                        <img src="Asset/group-users.png">
                    </a>
                    <h1>CATATAN KEUANGAN EKSTRAKURIKULER</h1>
                    <a href="logout.php"><img src="Asset/logout.png"></a>
                </div>
                <div class="menu">
                    <a href="pengeluaranPengurus.php" class="active">Pengeluaran</a>
                    <a href="pemasukanPengurus.php">Pemasukan</a>
                </div>

            <?php
            $total_query = "SELECT SUM(jumlah) AS total_pengeluaran FROM pengeluaran";

            $total_result = mysqli_query($conn, $total_query);

            if ($total_result) {
                $total_data = mysqli_fetch_assoc($total_result);
                $total_pengeluaran = $total_data['total_pengeluaran'];
            ?>
                <div class="container-total">
                    <div class="p-total">
                        <p>Total Pengeluaran Bulan Ini :</p>
                    </div>
                    <div class="jumlah-total">
                        <?php
                        echo "Rp $total_pengeluaran";
                        ?>
                    </div>
                </div>
                <?php
            } else {
                echo "Gagal mendapatkan jumlah pengeluaran: " . mysqli_error($conn);
            }?>
            <div class="isi"></div>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="container-result">
                        <div class="result">

                            <div class="keterangan">
                                <?php echo $row["keterangan"] . "<br>"; ?>
                            </div>
                            <div class="jumlah">
                                <?php echo "Rp " . $row["jumlah"] . "<br>"; ?>
                                
                            </div>
                            <div class="tanggal">
                                <?php echo $row["tanggal"] . "<br>"; ?>
                            </div>
                        </div>
                        <div class="delete">
                            <?php
                            echo "<a href='delete.php?id_pengeluaran={$row['id_pengeluaran']}'>";
                            echo "<img src='Asset/trash.png' alt='Hapus' width='20' height='20'>";
                            echo "</a>";
                            ?>
                        </div>
                    </div>
                    
                <?php
                }
            } else {
                ?>
                <div class="kosong">
                    <b>Ups, belum ada pengeluaran.</b>
                    <br>
                    <b>Yuk catat pengeluaran kamu!</b>
                </div>
            <?php
            }
            ?>
            <?php
            $total_query = "SELECT SUM(jumlah) AS total_pemasukan FROM pemasukan";
            $total_result = mysqli_query($conn, $total_query);

            $total_data = mysqli_fetch_assoc($total_result);
            $total_pemasukan = $total_data['total_pemasukan'];

            if ($total_result) {
                $total_result = $total_pemasukan - $total_pengeluaran; ?>
                <div class="container-jumlah">
                    <div >
                        <b>Total Saldo :</b>
                    </div>
                    <div >
                        <?php
                        if($total_result>0){
                            echo "<b> Rp $total_result </b>";
                        }else{
                            echo "<b style='color: #B80000;'> Rp $total_result </b>";
                            
                        }
                        ?>
                    </div>
                </div>
                <?php
                } else {
                    echo "Gagal mendapatkan total saldo: " . mysqli_error($conn);
                }
                    ?>

                <div class="tambah">
                    <a href="inputPengeluaran.php"><img src="Asset/Tambah.png"></a>
                </div>
                <div class="hapus-semua">
                    <a href="deletePengeluaran.php">HAPUS SEMUA</a>
                </div>
                </div>
        </body>

        </html>
<?php
    } else {
        echo "Gagal Menjalankan Query" . mysqli_error($conn);
    }
} else {
    header("Location: index.php");
    exit();
}
