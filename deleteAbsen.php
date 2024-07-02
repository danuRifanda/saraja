<?php 
    include "koneksi.php";

    $id_absensi = $_GET['id_absensi'];
    $sql = 'DELETE FROM statusabsensi WHERE id_absensi = "'.$id_absensi.'"';

    $result = mysqli_query($conn, $sql);

    if ($result){
        header('location: dataAbsen.php');
    } else {
        echo 'Deleted Failed';
    }
?>