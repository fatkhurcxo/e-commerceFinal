<?php
session_start();
require '../../function-final.php';

if (isset($_POST["logoutAdmin"])) {
    # code...   
    session_destroy();
    echo "<script> alert('Anda keluar!');
                    document.location.href = '../user-login.php';
                        window.history.replaceState( null, null, window.location.href );
            </script>";
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang</title>

    <!-- LINK BOOTSTRAP 5.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body class="bg-light">


    <!-- MODAL ADD PRODUK -->
    <div class="modal fade" id="addProduk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-body">
                    <div class="row row-cols-1">
                        <div class="col border-bottom container-fluid">
                            <div class="float-start">
                                <h6 class="fw-bold">Tambah Produk</h6 class="fw-bold">
                            </div>
                            <div class="float-end">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="col mt-2 container-fluid">
                            <form action="tambah-barang/" method="post">
                                <div class="mb-3">
                                    <label for="produk" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" id="produk" autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="produkHarga" class="form-label">Harga Produk</label>
                                    <input type="text" class="form-control" id="produkHarga" autocomplete="off">
                                </div>
                                <div>
                                    <button type="submit" name="tambahProduk" class="container pt-1 pb-1">Lanjut</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- OFFCANVAS -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header text-white" style="background-color: #453C41;">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Raget Bags</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="row row-cols-1">
                <a href="../../admin/" class="text-decoration-none text-dark">
                    <div class="col pt-2 pb-2 border-bottom ps-3">
                        <div class="row row-cols-2 align-items-center">
                            <div class="col-2">
                                <img src="img-admin/home.png" alt="">
                            </div>
                            <div class="col pt-2">
                                <h5>Home</h6>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="../kelola-pesanan/" class="text-decoration-none text-dark">
                    <div class="col pt-2 pb-2 mt-2 border-bottom ps-3">
                        <div class="row row-cols-2 align-items-center">
                            <div class="col-2">
                                <img src="img-admin/inventory.png" alt="">
                            </div>
                            <div class="col pt-2">
                                <h5>Kelola Pesanan</h6>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="../barang/" class="text-decoration-none text-dark">
                    <div class="col pt-2 pb-2 mt-2 border-bottom ps-3">
                        <div class="row row-cols-2 align-items-center">
                            <div class="col-2">
                                <img src="img-admin/product.png" alt="">
                            </div>
                            <div class="col pt-2">
                                <h5>Produk</h6>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- NAVIGASI -->
    <nav class="navbar navbar-expand container-fluid text-white" style="background-color: #453C41;">
        <div class="navigasi d-flex flex-fill justify-content-between align-items-center ps-5 pe-5">
            <div class="logo-trigger">
                <button class="btn border-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                    <img src="img-admin/menu.png" alt="" width="30px" height="30px">
                </button>
            </div>
            <div class="">

            </div>
            <div class="admin-profile d-flex align-items-center">
                <div class="admin-name ms-2">
                    <div class="dropdown dropstart">
                        <button class="btn border-0 text-white dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Fatkhur Rozak
                        </button>
                        <ul class="dropdown-menu rounded-0">
                            <li><button class="dropdown-item" type="button">Profile</button></li>
                            <form action="" method="POST">
                                <li><button class="dropdown-item text-danger" type="submit" name="logoutAdmin">Log Out</button></li>
                            </form>
                        </ul>
                    </div>
                </div>
                <div class="profile-place bg-success rounded-circle border" style="width: 30px;height: 30px;">

                </div>
            </div>
        </div>
    </nav>

    <section class="section-3">
        <div class="container-fluid bg-light">
            <div class="row row-cols-2 me-5 pe-5 mt-3 rounded pt-1 ms-5 ps-5">
                <div class="col pt-3 pb-2 mb-2" style=" background-color: #D4DBE2;">
                    <h5 style="font-weight: 400;">Data Seluruh Produk</h4>
                </div>
                <div class="col pt-3 pb-2 mb-2 d-flex justify-content-end" style=" background-color: #D4DBE2;">
                    <button data-bs-toggle="modal" data-bs-target="#addProduk" class="pt-1 pb-1 ps-3 pe-3">Tambah
                        Produk</button>
                </div>
                <!-- TABLE PRODUK TERBARU -->
                <table class="table table-hover table-bordered">
                    <thead class="text-white" style="background-color: dimgrey;">
                        <tr>
                            <th>No.</th>
                            <th>Preview</th>
                            <th>Nama Produk</th>
                            <th>Varian</th>
                            <th>Harga</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>KMSDF9908</td>
                            <td>Ahmed</td>
                            <td>Jl. Ropek</td>
                            <td>Rp2,000,000.00</td>
                            <td class="text-center">
                                <button class="pb-1">Detail Produk <img class="img-fluid" src="img-admin/info.png" alt=""></button> |
                                <button class="pb-1" style="">Delete <img src="img-admin/delete.png" alt=""></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- PAGINATION -->
    <nav aria-label="Page navigation example" class="me-5 pe-5 mt-2">
        <ul class="pagination justify-content-end">
            <li class="page-item disabled">
                <a class="page-link">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>

    <!-- LINK JS AND POPPER -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>