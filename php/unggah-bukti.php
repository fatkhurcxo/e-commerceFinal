<?php
require 'function-final.php';

$id_pesanan = $_GET["id_pesanan"];

if (unggahbBukti($id_pesanan) > 0) {

    echo "<script>  alert('Berhasil upload bukti!');
                        window.history.replaceState( null, null, window.location.href );
                            window.history.go(-1);
        </script>";
} else {
    # code...
    echo "<script> alert('Gagal upload!!!');
                    window.history.replaceState( null, null, window.location.href );
                        window.history.go(-1);
            </script>";
    echo mysqli_error($dconn);
}
