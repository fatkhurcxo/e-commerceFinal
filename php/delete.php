<?php

require 'function-final.php';

$id_keranjang = $_GET["id_keranjang"];

deleteKeranjang($id_keranjang);


// if (deleteKeranjang($id_keranjang) > 0) {
//     echo "<script> alert('Keranjang dihapus');
//                     window.history.back();
//             </script>";
// } else {
//     # code...
//     echo mysqli_error($dconn);
// }

// if (DeleteRaget($product_id) > 0) {
//     # code...
//     echo "<script> alert('Data berhasil dihapus'); 
//                         document.location.href = 'admin-raget.php';
//             </script>";
// } else {
//     # code...
//     echo "<script> alert('Data gagal dihapus'); document.location.href = 'admin-raget.php'; </script>";
// }
