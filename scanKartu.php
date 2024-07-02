<?php include "koneksi.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan Kartu</title>
    <?php include "header.php"?>
    <script type="text/javascript">
        $(document).ready(function(){
            setInterval(function(){
                $("#cekkartu").load('bacaKartu.php')
            }, 1000)
        });
    </script>
</head>
<body>
    <div class="container">
        <?php include "navbar.php"?>
        <div id="cekkartu"> </div>
    </div>

    
</body>
</html>