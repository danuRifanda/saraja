<?php
    include "koneksi.php";

    //baca mode absensi
    $mode = mysqli_query($conn, "select * from alat");
    $data_mode = mysqli_fetch_array($mode);
    $mode_absen = $data_mode['mode'];

    $mode_absen = $mode_absen + 1;
    if($mode_absen > 2){
        $mode_absen = 1;
    }
    $simpan = mysqli_query($conn, "update alat set mode = '$mode_absen'");

    if($simpan){
        echo "Berhasil Ubah Mode ke '$mode_absen'";
    }else{
        echo "Gagal Ubah Mode";
    }

?>