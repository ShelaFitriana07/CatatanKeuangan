<?php
$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "catatankeuanganekstrakurikuler_34_35_36";
$conn = mysqli_connect($sname, $uname, $password, $db_name);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error()); 
}
return $conn;
?>