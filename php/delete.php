<?php

require 'function.php';

$product_id = $_GET["product_id"];

if (DeleteRaget($product_id) > 0) {
    # code...
    echo "<script> alert('Data berhasil dihapus'); 
                        document.location.href = 'admin-raget.php';
            </script>";
} else {
    # code...
    echo "<script> alert('Data gagal dihapus'); document.location.href = 'admin-raget.php'; </script>";
}
