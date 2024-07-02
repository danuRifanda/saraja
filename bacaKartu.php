<?php
    include "koneksi.php";
    $sql = 'SELECT * FROM alat';    
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($query);
    $mode_alat = $data["mode"];

    $mode = "";
    if ($mode_alat == 1){
        $mode = "Baca Absen";
    }
    else if($mode_alat == 2){
        $mode = "Cek kartu";
    }

    $baca_kartu = mysqli_query($conn, "select * from tmpkartu");
    $data_kartu = mysqli_fetch_array($baca_kartu);
    error_reporting(E_ERROR | E_PARSE);
    $nokartu = $data_kartu['uid'];
?>
<div class="container text-center">
    <br>
    <?php if ($nokartu==""){?>
        <h2>Mode Alat = <?php echo $mode?></h2>
        <h2>Silahkan Tempelkan kartu Anda Pada Alat</h2>
    <?php } else {
        //cek kartu rfid apakah sudah terdaftar
        $cari_orang = mysqli_query($conn, "select * from orang where uid = '$nokartu'");
        $jumlah_data = mysqli_num_rows($cari_orang);

        if($jumlah_data==0){
            echo "<h2>Kartu Tidak Terdaftar Pada Database</h2>";
            echo "<h2>Harap Hubungi Admin</h2>";
        }else{
            $data_orang = mysqli_fetch_array($cari_orang);
            $nama_orang = $data_orang['nama'];
            $desa = $data_orang['desa'];
            $kelompok = $data_orang['kelompok'];

            //cek sudah absen atau belum
            date_default_timezone_set('Asia/Jakarta');
            $tanggal = date('Y-m-d');
            $jam = date('h:i:sa');

            $cek_absen = mysqli_query($conn, "select * from statusabsensi where uid='$nokartu' and tanggal='$tanggal'");
            $jumlah_absen = mysqli_num_rows($cek_absen);

            if($jumlah_absen == 0 && $mode_alat == 1){
                echo "<h2>Assalamualaikum <br> $nama_orang berhasil absen</h2>";
                // mysqli_query($conn, "insert into statusabsensi(uid, nama, desa, kelompok, tanggal, waktu) values ('$nokartu', '$nama_orang', '$desa', '$kelompok', '$tanggal', '$waktu')");
            }else{
                echo "<h2>Nama $nama_orang sudah absen</h2>";
                if($mode_alat == 2){
                    echo "<h2>Nomor Kartu: $nokartu </h2>";
                    echo "<h2>Nama Pemilik: $nama_orang </h2>";
                }
            }
        }
        mysqli_query($conn, "delete from tmpkartu");
    }?>

</div>