<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <title>Login</title>
    <link rel="icon" type="image/png" href="Asset/logo web.png">
</head>

<body class="index">
    <div class="login-logo">
        <img src="asset/wallet.png" alt="">
        <div class="judul-aplikasi">
            <h1 class="judul1">CATATAN KEUANGAN</h1>
            <h1 class="judul2">EKSTRAKURIKULER</h1>
        </div>
    </div>

    <form action="login.php" method="post" class="login">
        <div class="judul-login">
            <h1>LOGIN</h1>
        </div>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <label for="" class="label-login">Username</label>
        <input type="text" name="uname" class="input-login" placeholder="Masukkan Username" id=""><br>
        <label for="" class="label-login">Password</label>
        <input type="password" name="password" class="input-login" placeholder="Masukkan Password" id=""><br>
        <button class="button-login" type="submit">Login</button>

    </form>
</body>

</html>