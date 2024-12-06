<?php
    $koneksi = mysqli_connect("localhost","root","","taskifyme");
    // var_dump($koneksi);
    if (!$koneksi){
        die(mysqli_connect_error());
    } else {
        // echo "Koneksi berhasil";
    }
?>