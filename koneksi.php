<?php 
session_start();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$koneksi = mysqli_connect("localhost", "root", "", "eperpus");

//check connection
if (mysqli_connect_errno()) {
    echo "Failes to connect to MySQL:" . mysqli_connect_error();
}

?>