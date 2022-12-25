<?php
$dconn = mysqli_connect("localhost", "root", "", "raget_bags");

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

$dataCustomer = showData("SELECT * FROM customer CROSS JOIN akun_level");



// var_dump($dataCustomer);
// die;
$i = 1;
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
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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

                        <a class="nav-link active" href="data-admin.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            Data Customer
                        </a>

                        <a class="nav-link" href="data-produk.php">
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
                    <h1 class="mt-4 ms-3">Data Customer & Admin</h1>
                    <ol class="breadcrumb mb-4 ms-3">
                        <li class="breadcrumb-item active ms-1">Aplikasi Penjualan Tas </li>
                    </ol>


                    <div class="main_content">
                        <!--  <button type="button" class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            + Tambah Admin
                        </button>-->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Admin</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body container-fluid">
                                        <!-- USERNAME -->
                                        <div class="input-group">
                                            <div class="form-group container">
                                                <label for="usernameInput" class="mb-2"><span style="font-weight: bold;">Username</span></label>
                                                <input type="text" id="usernameInput" class="form-control" placeholder="Masukkan username" name="username" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <!-- PASSWORD -->
                                        <div class="input-group mt-3">
                                            <div class="form-group container">
                                                <label for="passwordInput" class="mb-2"><span style="font-weight: bold;">Password</span></label>
                                                <input type="password" id="passwordInput" class="form-control" placeholder="Masukkan password" name="password" required>
                                            </div>
                                        </div>

                                        <div class="input-group mt-3">
                                            <div class="form-group container">
                                                <label for="passwordInput" class="mb-2"><span style="font-weight: bold;">Password</span></label>
                                                <input type="password" id="passwordInput" class="form-control" placeholder="Masukkan password" name="password" required>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn container btn-primary" data-bs-dismiss="modal" name="login">Masuk</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Customer</th>
                                            <th>Email</th>
                                            <th>Nomor Hp</th>
                                            <th>Alamat</th>
                                            <th>Level</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Customer</th>
                                            <th>Email</th>
                                            <th>Nomor Hp</th>
                                            <th>Alamat</th>
                                            <th>Level</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                        <?php foreach ($dataCustomer as $row) : ?>


                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $row["nama_customer"]; ?></td>
                                                <td><?= $row["email"]; ?></td>
                                                <td><?= $row["nomor_hp"]; ?></td>
                                                <td><?= $row["alamat"]; ?></td>
                                                <td><?= $row["level_name"]; ?></td>
                                                <td class="row-cols-auto">
                                                    <div class="d-sm-flex">
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                            Edit
                                                        </button> &ensp;&nbsp;
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                            Hapus
                                                        </button>
                                                    </div>
                                                    <div>

                                                    </div>
                                                </td>
                                            </tr>


                                        <?php endforeach; ?>

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
    <script src="../javascript/index.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>