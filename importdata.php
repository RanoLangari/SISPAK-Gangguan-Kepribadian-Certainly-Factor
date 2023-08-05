<?php
require 'functions.php';
if (isset($_POST["AddExcel"])) {
    if (importDataViaExcel($_FILES['excel']) > 0) {
        echo "
            <script>
                alert('Data berhasil ditambahkan');
                window.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal ditambahkan');
            </script>
            window.location.href = 'importdata.php';
        ";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- title -->
    <title>Import Data Excel</title>
</head>

<body>
    <!-- Modal tambah Data via excel -->
    <div id="myModalExcel" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">TAMBAH DATA VIA EXCEL</h4>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>File Excel</label>
                            <input type="file" name="excel" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="AddExcel" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>