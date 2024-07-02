<?php
    include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "header.php"?>
    <title>Data Absensi</title>
</head>
<body>
    <div class="container">
        <?php include "navbar.php"?>
        <br>
        <h2>Data Absensi</h2>
        <!-- <a href="addOrang.php" class="tambah btn btn-sm btn-primary mb-3">Tambah</a> -->
        <table class="table">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Desa</th>
                    <th>kelompok</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
            <?php
                date_default_timezone_set('Asia/Jakarta');
                $tanggal = date('Y-m-d');

                $sql = "SELECT * FROM statusabsensi where tanggal = '$tanggal' ";

                $query = mysqli_query($conn, $sql);
                $no = 0;
                while ($row = mysqli_fetch_object($query)) {
                    $no++;
            ?>

                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $row->nama; ?></td>
                    <td><?php echo $row->desa; ?></td>
                    <td><?php echo $row->kelompok; ?></td>
                    <td><?php echo $row->tanggal; ?></td>
                    <td><?php echo $row->waktu; ?></td>
                    <td> 
                        <!-- <a href="deleteAbsen.php?id_absensi=<?php echo $row->id_absensi; ?> " class="btn btn-sm btn-danger" 
                        onclick="return confirm('apakah anda yakin ingin menghapus data?');">HAPUS</a>
                        <a href="updateOrang.php?id_absensi=<?php echo $row->id_absensi; ?> " class="btn btn-sm btn-warning">UBAH</a> -->
                    </td>
                </tr>

            <?php
                } if (mysqli_num_rows($query) == 0) {
                    echo '<tr><td colspan="6" class="text-center">Tidak ada data.</td></tr>';
                }
            ?>
            </tbody>
        </table>
    </div>
    
<?php include "footer.php"?>
</body>
</html>