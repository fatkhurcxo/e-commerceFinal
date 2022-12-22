<?php
require 'function-final.php';

$bukti = $_GET["bukti"];

$dataBukti = showDataTable("SELECT * FROM pesanan WHERE bukti='$bukti'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pembayaran</title>
    <!-- css bootstrap 5.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- head icon -->
    <link rel="icon" href="../img-assets/head-assets/raget-headIcon.png">
</head>

<body>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded-0">
                <div class="modal-body">
                    <div class="container">
                        <div class="d-flex justify-content-between">
                            <div class="">
                                <h5>LIHATTTTTTTTTTT</h5>
                            </div>
                            <div class="">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <img class="img-fluid" src="../img-assets/bg-assets/WIN_20211105_02_13_50_Pro.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="container">
        <div class="row mt-5 row-cols-1">
            <div class="col pb-2 pt-2">
                <div class="row row-cols-1">
                    <div class="col mt-3 text-end">
                        <span style="font-style: italic; font-weight: 400;">Jika ada yang lebih indah dari surga, mungkin itu senyumanku</span> <br>
                        <a class="text-decoration-none" data-bs-toggle="modal" href="#staticBackdrop">Lihat senyumku</a>
                    </div>
                    <div class="col">
                        <button onclick="history.go(-1);" class="btn btn-outline-danger btn-sm ps-3 pe-3">Kembali</button>
                    </div>
                </div>
            </div>
            <div style="background-color: #7895B2;" class="text-white col pt-2 pb-2 mb-3 rounded border d-flex justify-content-between align-items-center">
                <div>
                    <h3>Bukti Pembayaran Anda</h3>
                </div>
                <div>
                    <h6>Kode Pesanan : <span style="font-weight: 500; font-size: larger;"><?= $dataBukti["no_pesanan"]; ?></span>
                    </h6>
                </div>
            </div>
            <div class="col border pt-5 pb-5 d-flex justify-content-center">
                <img class="img-fluid" src="../img-assets/buktiPembayaran/<?= $dataBukti["bukti"]; ?>" alt="">
            </div>
        </div>
    </section>

    <footer class="fixed-bottom">
        <div class="miniFooter container-fluid text-center text-white pt-2 pb-2" style="background-color: #7895B2;">
            <span>© 2022 Raget bags. All Rights reserved. Ecommerce software by Kaftapus2 </span>
        </div>
    </footer>

    <!-- POPPER AND JS BOOSTRAP 5 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>