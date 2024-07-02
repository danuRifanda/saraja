<?php 
    include "koneksi.php";

    $id_orang = $_GET['id_orang'];
    $sql = 'DELETE FROM orang WHERE id_orang = "'.$id_orang.'"';

    $result = mysqli_query($conn, $sql);

    if ($result){
        header('location: dataOrang.php');
    } else {
        echo 'Deleted Failed';
    }
?>