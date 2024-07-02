<?php
    include "koneksi.php";
    $nokartu = $_GET["nokartu"];
    $sql = 'SELECT * FROM alat';    
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($query);
    $mode_alat = $data["mode"];

    $cari_orang = mysqli_query($conn, "select * from orang where uid = '$nokartu'");
    $jumlah_data = mysqli_num_rows($cari_orang);
    if($jumlah_data > 0){
        $data_orang = mysqli_fetch_array($cari_orang);
        $nama_orang = $data_orang['nama'];
        $desa = $data_orang['desa'];
        $kelompok = $data_orang['kelompok'];
    }
   
    //cek sudah absen atau belum
    date_default_timezone_set('Asia/Jakarta');
    $tanggal = date('Y-m-d');
    $jam = date('H:i:sa');

    mysqli_query($conn, "delete from tmpkartu");
    $simpan = mysqli_query($conn, "INSERT INTO `tmpkartu`(`id_kartu`, `uid`) VALUES ('','$nokartu')");

    $cek_absen = mysqli_query($conn, "select * from statusabsensi where uid='$nokartu' and tanggal='$tanggal'");
    $jumlah_absen = mysqli_num_rows($cek_absen);

    if($simpan){
        if($jumlah_absen == 0 && $mode_alat == 1 && $jumlah_data>0){
            // echo "<h2>Assalamualaikum <br> $nama_orang berhasil absen</h2>";
            mysqli_query($conn, "insert into statusabsensi(uid, nama, desa, kelompok, tanggal, waktu) values ('$nokartu', '$nama_orang', '$desa', '$kelompok', '$tanggal', '$jam')");
            mysqli_query($conn, "delete from tmpkartu");
            echo "$nama_orang Berhasi Absen";
        }
        elseif($jumlah_absen > 0 && $mode_alat == 1 && $jumlah_data>0){
            echo "$nama_orang Sudah Absen"; 
        }
        elseif($jumlah_data==0){
            echo "Kartu tidak terdaftar";
        }elseif($jumlah_data>0 && $mode_alat == 2){
            echo "Kartu ini punya $nama_orang";
        }
    }else{
        echo "Gagal Koneksi";
    }
?> 