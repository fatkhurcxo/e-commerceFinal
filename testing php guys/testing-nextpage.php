<?php
require 'test.php';

$id = mysqli_insert_id($database);

if ($id) {
    # code...
    // SELECT * FROM WHERE $id (TERBARU)
} else {
    # code...
    // SELECT * FROM WHERE $id_akun
    echo "<script> alert('Tidak ada data terbaru yang masuk!!!'); </script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing 2</title>
</head>

<body>
    <div>
        <h3>Nih Halaman Testing</h3>
        <br>
        Data yang di post pada halaman ini adalah : <?php if ($_POST) {
                                                        # code...
                                                        echo $_POST["testing"];
                                                    } else {
                                                        # code...
                                                    } ?>
        <br>
        NIH ID TERBARUNYA <?php if ($id) {
                                # code...
                                echo $id;
                            } else {
                                # code...
                                echo "Gaada anjing";
                            } ?>
    </div>
</body>

</html>