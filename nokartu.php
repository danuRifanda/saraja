<?php include "koneksi.php";
    $act = 'add';
    $sql = mysqli_query($conn, "select * from tmpkartu");
    $result = mysqli_fetch_array($sql);
    if (mysqli_num_rows($sql) == 0) {
        $uid = 'Silahkan Scan Kartu';
    }else{
        $uid = $result['uid']; 
    }
?>
<div class="mb-3">
        <label class="form-label">No Kartu</label>
        <input type="text" class="form-control" name="noKartu" placeholder="No Kartu" value="<?php if ($act == 'add') echo $uid; ?>"
            required>
</div>