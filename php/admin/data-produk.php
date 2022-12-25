<?php
$con = mysqli_connect("localhost", "root", "", "raget_bags");

session_start();
// if (!isset($_SESSION['admin'])) {
//     # code...
//     echo "<script> alert('Anda bukan admin!!!'); 
//                     document.location.href = 'user-login.php';
//             </script>";
//     exit();
//   }



require 'function-final.php';
// $product = query("SELECT * FROM raget_product");
if (isset($_POST['log-out'])) {
    # code...
    logoutRaget();
}



$i = 1;

if (isset($_POST["inputbarang"])) {
    $namabarang = $_POST['namabarang'];
    $hargabarang = $_POST['hargabarang'];

    $query = "INSERT INTO produk (nama, harga)
          VALUES ('$namabarang', '$hargabarang')";
    $sql = mysqli_query($con, $query); // Eksekusi/ Jalankan query dari variabel $query

    echo "<script> window.history.replaceState(null, null, window.location.href); </script>";
}

if (isset($_POST["inputgambar"])) {

    $nama_file = $_FILES['uploadGambar1']['name'];
    $ext = pathinfo($nama_file, PATHINFO_EXTENSION);
    $random = crypt($nama_file, time());
    $ukuran_file = $_FILES['uploadGambar1']['size'];
    $tipe_file = $_FILES['uploadGambar1']['type'];
    $tmp_file = $_FILES['uploadGambar1']['tmp_name'];
    $path = "../img-assets/product/" . $random . '.' . $ext;
    $pathdb = "produk_image/" . $random . '.' . $ext;


    if ($tipe_file == "image/jpeg" || $tipe_file == "image/png") {
        if ($ukuran_file <= 10000000) {
            if (move_uploaded_file($tmp_file, $path)) {

                $query = "INSERT INTO produk_image (hero_img, second_img, third_img, features_1_img, features_2_img, features_3_img)
			  VALUES ('$pathdb')";
                $sql = mysqli_query($con, $query); // Eksekusi/ Jalankan query dari variabel $query

                if ($sql) {

                    echo "<br><meta http-equiv='refresh' content='5; URL=data-produk.php'> You will be redirected to the form in 5 seconds";
                } else {
                    // Jika Gagal, Lakukan :
                    echo "Sorry, there's a problem while submitting.";
                    echo "<br><meta http-equiv='refresh' content='5; URL=data-produk.php'> You will be redirected to the form in 5 seconds";
                }
            } else {
                // Jika gambar gagal diupload, Lakukan :
                echo "Sorry, there's a problem while uploading the file.";
                echo "<br><meta http-equiv='refresh' content='5; URL=data-produk.php'> You will be redirected to the form in 5 seconds";
            }
        } else {
            // Jika ukuran file lebih dari 1MB, lakukan :
            echo "Sorry, the file size is not allowed to more than 10mb";
            echo "<br><meta http-equiv='refresh' content='5; URL=data-produk.php'> You will be redirected to the form in 5 seconds";
        }
    } else {
        // Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
        echo "Sorry, the image format should be JPG/PNG.";
        echo "<br><meta http-equiv='refresh' content='5; URL=data-produk.php'> You will be redirected to the form in 5 seconds";
    }
};
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - Admin Raget</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../css/admin-ragetFinal.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="admin-RagetFinal.php">Raget Bags</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <form action="" method="POST">
                        <button type="submit" name="log-out" class="btn btn-outline-danger ms-3">Log Out</button>
                    </form>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="admin-ragetFinal.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Home
                        </a>

                        <a class="nav-link" href="data-admin.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            Data Admin
                        </a>

                        <a class="nav-link active" href="data-produk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-cart-shopping"></i></div>
                            Data Product
                        </a>




                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    KAFTAPUS2
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Data Product</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Aplikasi Penjualan Tas </li>
                    </ol>


                    <!-- MODAL BUTTON -->
                    <button type="button" class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#inputbarang">
                        + Tambah Produk
                    </button>

                    <!-- MODAL LAYOUT -->
                    <div class="modal fade" id="inputbarang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content rounded-0">
                                <div class="modal-body">
                                    <form action="data-produk.php" method="POST" enctype="multipart/form-data">
                                        <div class="row row-cols-1">
                                            <div class="col d-flex justify-content-between border-bottom">
                                                <div>
                                                    <h5>Tambah Produk</h5>
                                                </div>
                                                <div>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label for="namabarang" class="form-label">Nama Barang</label>
                                                <input type="text" class="form-control" name="namabarang" id="namabarang" placeholder="Masukkan nama produk">
                                            </div>
                                            <div class="col">
                                                <label for="hargabarang" class="form-label">Harga Barang</label>
                                                <input type="number" class="form-control" name="hargabarang" id="hargabarang" placeholder="Masukkan harga produk">
                                            </div>
                                            <div class="col d-flex justify-content-between mt-3">
                                                <div>
                                                    <button type="submit" name="inputbarang" class="btn btn-sm btn-primary">Tambah</button>
                                                </div>
                                                <div>
                                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#inputgambar">Lanjut</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL KEDUA -->
                    <div class="modal fade" id="inputgambar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content rounded-0">
                                <form action="data-produk.php" method="POST" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="row row-cols-1">
                                            <div class="col d-flex justify-content-between border-bottom">
                                                <div>
                                                    <h5>Gambar Produk</h5>
                                                </div>
                                                <div>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label><strong>&nbsp;Hero Image</strong></label>
                                                <input type="file" class="form-control" name=" uploadGambar1" required>
                                                <br>
                                            </div>
                                            <div class="col">
                                                <label><strong>&nbsp;Second Image</strong></label>
                                                <input type="file" class="form-control" name=" uploadGambar2" required>
                                                <br>
                                            </div>
                                            <div class="col">
                                                <label>&nbsp;<strong>Third Image</strong></label>
                                                <input type="file" class="form-control" name=" uploadGambar3" required>
                                                <br>
                                            </div>
                                            <div class="col">
                                                <label><strong>&nbsp;Features Image 1</strong></label>
                                                <input type="file" class="form-control" name=" uploadGambar4" required>
                                                <br>
                                            </div>
                                            <div class="col">
                                                <label> <strong>&nbsp;Features Image 2</strong></label>
                                                <input type="file" class="form-control" name=" uploadGambar5" required>
                                                <br>
                                            </div>
                                            <div class="col">
                                                <label><strong>&nbsp;Features Image 3</strong></label>
                                                <input type="file" class="form-control" name=" uploadGambar6" required>
                                                <br>
                                            </div>
                                            <!-- button selesai -->
                                            <div class="col mt-3">
                                                <button type="submit" name="inputgambar" class="btn container btn-primary">Selesai</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!--
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Produk</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body container-fluid">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="input-group">
                                                <div class="form-group container">
                                                    <label><span style="font-weight: bold;">Nama Produk</span></label>
                                                    <input type="text" class="form-control" placeholder="Masukkan Nama Produk" name="namaProduk" autocomplete="off" required>
                                                </div>
                                            </div>
                                            
                                            <div class="input-group mt-3">
                                                <div class="form-group container">
                                                    <label><span style="font-weight: bold;">Harga Produk</span></label>
                                                    <input type="number" class="form-control" placeholder="Masukkan Harga" name="hargaProduk" required>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                <input name="addproduct" type="submit" class="btn btn-primary" value="Tambah" data-bs-target="#exampleModal2">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
-->



                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Gambar</th>
                                        <th>Nama Produk</th>
                                        <th>Harga Produk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Gambar</th>
                                        <th>Nama Produk</th>
                                        <th>Harga Produk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>

                                <tbody>

                                    <?php
                                    $dataproduk = mysqli_query($con, "SELECT `produk`.`nama`, `harga`, `produk_image`.`hero_img`
                                    FROM `produk` 
                                        LEFT JOIN `produk_image` ON `produk_image`.`id_produk` = `produk`.`id_produk`;");
                                    while ($p = mysqli_fetch_array($dataproduk)) {

                                    ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><img class="img-fluid" src="../img-assets/product/<?php echo $p['hero_img'] ?>"></td>
                                            <td><?php echo $p["nama"] ?></td>
                                            <td>Rp <?php echo $p["harga"] ?></td>

                                            <td class="row-cols-auto">
                                                <div class="d-sm-flex">
                                                    <button type="button" class="btn btn-primary d-sm-flex" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                        Edit
                                                    </button> &ensp;&nbsp;
                                                    <button type="button" class="btn btn-danger d-sm-flex" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                        Hapus
                                                    </button>
                                                </div>
                                                <div>

                                                </div>
                                            </td>
                                        </tr>


                                    <?php  } ?>



                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>


        </div>

        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Ecommerce software by Kaftapus2<br> 2022 Raget bags. All Rights reserved. </div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../javascript/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="../javascript/datatables-simple-demo.js"></script>

</body>

</html>