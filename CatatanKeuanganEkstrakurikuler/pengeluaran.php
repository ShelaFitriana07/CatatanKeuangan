<?php
session_start();
include "koneksi.php";

if (isset($_SESSION['nis']) && isset($_SESSION['username'])) {
    $nis = $_SESSION['nis'];

    $query = "SELECT * FROM pengguna";
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

        <body style="margin-bottom: 100px;">
            <div class="home" >
                <div class="header">
                    <h1>CATATAN KEUANGAN EKSTRAKURIKULER</h1>
                    <a href="logout.php"><img src="Asset/logout.png"></a>
                </div>
                <div class="menu">
                    <a href="pengeluaran.php" class="active">Pengeluaran</a>
                    <a href="pemasukan.php">Pemasukan</a>
                </div>
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
            }

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
                    </div>

                <?php
                }
            } else {
                ?>
                <div class="kosong">
                    <b>Ups, belum ada pengeluaran.</b>
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
                <div class="container-jumlah" style="bottom: 30px;">
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
