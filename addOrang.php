<?php 
    include 'header.php';
    include 'koneksi.php';

    $act = 'add';
    
    if(!empty($_GET['id_orang'])) {
        $sql = 'SELECT * FROM orang WHERE id_orang="'.$_GET['id_orang'].'"';
        
        $query = mysqli_query($conn, $sql);
   
        if(mysqli_num_rows($query)) {
            $act = 'edit';

            $row = mysqli_fetch_object($query);
        }
    }
?>
<head>
    <script type="text/javascript">
        $(document).ready(function(){
            setInterval(function(){
                $("#nokartu").load('nokartu.php')
            }, 0)
        });
    </script>
</head>


<h1 class="mt-3 mb-3 container">Form Data Orang</h1>
<form action="saveOrang.php" method="POST" class="container" >

    <!-- <div class="mb-3">
        <label class="form-label">No Kartu</label>
        <input type="text" class="form-control" name="noKartu" placeholder="No Kartu" value="<?php if ($act == 'edit') echo $row->uid; ?>"
            required>
    </div> -->
    <div id="nokartu"> </div>
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" class="form-control" name="nama" placeholder="Nama" value="<?php if ($act == 'edit') echo $row->nama; ?>"
            required>
        <input type="hidden" name="id_orang" value="<?php if ($act == 'edit') echo $row->id_orang; ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Desa</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="desa" value="1" id="1" checked>
            <label class="form-check-label" for="1">
                1
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="desa" value="2" id="2"
                <?php if ($act == 'edit' && $row->desa == '2') echo 'checked'; ?>>
            <label class="form-check-label" for="2">
                2
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="desa" value="3" id="3"
                <?php if ($act == 'edit' && $row->desa == '3') echo 'checked'; ?>>
            <label class="form-check-label" for="3">
                3
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="desa" value="4" id="4"
                <?php if ($act == 'edit' && $row->desa == '4') echo 'checked'; ?>>
            <label class="form-check-label" for="4">
                4
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="desa" value="5" id="5"
                <?php if ($act == 'edit' && $row->desa == '5') echo 'checked'; ?>>
            <label class="form-check-label" for="5">
                5
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="desa" value="6" id="6"
                <?php if ($act == 'edit' && $row->desa == '6') echo 'checked'; ?>>
            <label class="form-check-label" for="6">
                6
            </label>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Kelompok</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="kelompok" value="1" id="1" checked>
            <label class="form-check-label" for="1">
                1
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="kelompok" value="2" id="2"
                <?php if ($act == 'edit' && $row->kelompok == '2') echo 'checked'; ?>>
            <label class="form-check-label" for="2">
                2
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="kelompok" value="3" id="3"
                <?php if ($act == 'edit' && $row->kelompok == '3') echo 'checked'; ?>>
            <label class="form-check-label" for="3">
                3
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="kelompok" value="4" id="4"
                <?php if ($act == 'edit' && $row->kelompok == '4') echo 'checked'; ?>>
            <label class="form-check-label" for="4">
                4
            </label>
        </div>
    </div>
    <div class="mb-3">
        <input type="submit" value="Simpan" class="btn btn-sm btn-success">
        <a href="dataOrang.php" class="btn btn-sm btn-warning">BATAL</a>
    </div>
</form>
