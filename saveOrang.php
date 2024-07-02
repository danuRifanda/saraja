<?php
    include 'koneksi.php';

    $id_orang = $_POST['id_orang'];
    $uid = $_POST['noKartu'];
    $nama = $_POST['nama'];
    $desa = $_POST['desa'];
    $kelompok = $_POST['kelompok'];

    //cek uid sudah ada atau belum
    $cek= mysqli_query($conn, "select * from orang where uid = '$uid'");
    $data = mysqli_num_rows($cek);

    if ($data == 0){
        if (empty($id_orang)){
            $sql = 'INSERT INTO orang VALUE ("", "'.$uid.'", "'.$nama.'", "'.$desa.'", "'.$kelompok.'")';
        } else {
            $sql = "UPDATE orang SET uid='$uid', nama='$nama', desa='$desa',kelompok = '$kelompok'  WHERE id_orang='$id_orang'";
        }
    } else{
        if (!empty($id_orang)){
            $sql = "UPDATE orang SET uid='$uid', nama='$nama', desa='$desa',kelompok = '$kelompok'  WHERE id_orang='$id_orang'";
        } else{
            echo '<script>alert("Data Uid Sudah terdaftar");</script>'; 
            mysqli_query($conn, "delete from tmpkartu");
            header('Location: dataKartu.php');
        }
    }
    

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header('Location: dataOrang.php');
        mysqli_query($conn, "delete from tmpkartu");
    } else {
        if (empty($id_orang)){
            echo 'Inserted Failed.';
        } else {
            echo 'Update Failed.';
        }
        
    }
?>