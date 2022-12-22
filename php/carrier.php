<?php
session_start();
// KETIKA SESSION [CUSTOMER] TIDAK TERSEDIA, DIKEMBALIKAN KE HALAMAN LOGIN
if (!isset($_SESSION['customer'])) {
    # code...
    echo "<script> alert('Anda harus login terlebih dahulu');
                    document.location.href = 'user-login.php';
            </script>";
    exit;
}

require 'function-final.php';


// KETIKA TOMBOL LOG OUT DI KLIK
if (isset($_POST['log-out'])) {
    # code...
    logoutRaget();
}

// KETIKA TOMBOL MKERANJANG PADA MODAL DI KLIK
if (isset($_POST["btn-keranjang-modal"])) {
    # code...
    // var_dump($_POST);
    // die;
}

if (isset($_POST["ubahDataCustomer"])) {
    // var_dump($_POST);
    // die;
    # code...
    if (ubahDataCustomer($_POST) > 0) {
        # code...
        echo "<script> alert('Berhasil mengubah data!');

            </script>";
    } else {
        # code...
        echo mysqli_error($dconn);
    }
}

$id_akun = $_SESSION["id_akun"];

// UNTUK SHOW DATA KESELURUHAN MENGGUNAKAN LOOP
$dataproduk = showData("SELECT produk.id_produk, produk.nama, FORMAT(produk.harga, 2), produk_image.hero_img, produk_image.id_produk_image  
                        FROM produk_image CROSS JOIN produk ON produk_image.id_produk=produk.id_produk");

// SHOW DATA KERANJANG BELANJA
$cart = showData("SELECT * FROM keranjang_belanja WHERE id_akun='$_SESSION[id_akun]'");

$subTotal = showData("SELECT harga FROM keranjang_belanja WHERE id_akun='$_SESSION[id_akun]'");
// var_dump($subTotal);
// die;

$totalKeranjang = showDataTable("SELECT FORMAT(SUM(total), 2) Subtotal
                                    FROM keranjang_belanja
                                        WHERE id_akun='$_SESSION[id_akun]'");


$SubtotalKeranjang = showDataTable("SELECT SUM(total) Subtotal
                                        FROM keranjang_belanja
                                            WHERE id_akun=$id_akun");

// echo $ruangSubtotal;


// UNTUK SHOW DATA KE DALAM MODAL SESUAI DENGAN PRODUK YANG DIPILIH


// SHOW DATA UNTUK INFORMASI AKUN
$tableAkun = showDataTable("SELECT * FROM akun WHERE id_akun = '$_SESSION[id_akun]'");


// SHOW DATA UNTUK INFORMASI CUSTOMER
$tableCustomer = showDataTable("SELECT * FROM customer WHERE id_akun = '$_SESSION[id_akun]'");

// TABEL PESANAN
$pesanan = showData("SELECT id_pesanan, no_pesanan, status, bukti, FORMAT(total_pesanan, 2) FROM pesanan WHERE id_akun='$_SESSION[id_akun]'");

// TABLE PESANAN LOOPING
$idPesanan = showData("SELECT * FROM pesanan WHERE id_akun=$_SESSION[id_akun]");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raget Bags</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- head icon -->
    <link rel="icon" href="../img-assets/head-assets/raget-headIcon.png">

    <!-- css login-form -->
    <link rel="stylesheet" href="../css/index.css">

    <!-- css product -->
    <link rel="stylesheet" href="../css/product.css?v9">
</head>

<body class="bg-light">
    <!-- NAVIGASI -->
    <nav class="navbar navbar-expand-md bg-light fixed-top">
        <div class="container-fluid p-2 d-flex">
            <!-- <div class=""> -->
            <div class="nav-logo flex-fill d-flex align-items-center justify-content-between ms-sm-5">
                <div class="logo-search-collapse container-fluid d-flex align-items-center">
                    <div class="logo">
                        <a class="navbar-brand" href="#">
                            <svg width="169" height="50" viewBox="0 0 169 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 5C15 2.23858 17.2386 0 20 0H45V50H20C17.2386 50 15 47.7614 15 45V5Z" fill="#7895B2" />
                                <path d="M27.9219 20.5586V27.2852H31.2852C31.7461 27.2852 32.1797 27.1992 32.5859 27.0273C32.9922 26.8477 33.3477 26.6055 33.6523 26.3008C33.957 25.9961 34.1953 25.6406 34.3672 25.2344C34.5469 24.8203 34.6367 24.3828 34.6367 23.9219C34.6367 23.4609 34.5469 23.0273 34.3672 22.6211C34.1953 22.207 33.957 21.8477 33.6523 21.543C33.3477 21.2383 32.9922 21 32.5859 20.8281C32.1797 20.6484 31.7461 20.5586 31.2852 20.5586H27.9219ZM27.9219 34H24.5586V17.1953H31.2852C31.9023 17.1953 32.4961 17.2773 33.0664 17.4414C33.6367 17.5977 34.168 17.8242 34.6602 18.1211C35.1602 18.4102 35.6133 18.7617 36.0195 19.1758C36.4336 19.582 36.7852 20.0352 37.0742 20.5352C37.3711 21.0352 37.5977 21.5703 37.7539 22.1406C37.918 22.7109 38 23.3047 38 23.9219C38 24.5 37.9258 25.0625 37.7773 25.6094C37.6367 26.1562 37.4297 26.6758 37.1562 27.168C36.8906 27.6602 36.5625 28.1133 36.1719 28.5273C35.7812 28.9414 35.3438 29.3008 34.8594 29.6055L36.7227 34H33.1484L31.6836 30.6133L27.9219 30.6367V34ZM50.1055 27.2852V23.9219C50.1055 23.4609 50.0156 23.0273 49.8359 22.6211C49.6641 22.207 49.4258 21.8477 49.1211 21.543C48.8164 21.2383 48.457 21 48.043 20.8281C47.6367 20.6484 47.2031 20.5586 46.7422 20.5586C46.2812 20.5586 45.8438 20.6484 45.4297 20.8281C45.0234 21 44.668 21.2383 44.3633 21.543C44.0586 21.8477 43.8164 22.207 43.6367 22.6211C43.4648 23.0273 43.3789 23.4609 43.3789 23.9219V27.2852H50.1055ZM53.4688 34H50.1055V30.6367H43.3789V34H40.0273V23.9219C40.0273 22.9922 40.2031 22.1211 40.5547 21.3086C40.9062 20.4883 41.3828 19.7734 41.9844 19.1641C42.5938 18.5547 43.3047 18.0742 44.1172 17.7227C44.9375 17.3711 45.8125 17.1953 46.7422 17.1953C47.6719 17.1953 48.543 17.3711 49.3555 17.7227C50.1758 18.0742 50.8906 18.5547 51.5 19.1641C52.1094 19.7734 52.5898 20.4883 52.9414 21.3086C53.293 22.1211 53.4688 22.9922 53.4688 23.9219V34ZM69.7578 32.3008C68.9766 32.9648 68.1055 33.4766 67.1445 33.8359C66.1836 34.1875 65.1836 34.3633 64.1445 34.3633C63.3477 34.3633 62.5781 34.2578 61.8359 34.0469C61.1016 33.8438 60.4141 33.5547 59.7734 33.1797C59.1328 32.7969 58.5469 32.3438 58.0156 31.8203C57.4844 31.2891 57.0312 30.7031 56.6562 30.0625C56.2812 29.4141 55.9883 28.7188 55.7773 27.9766C55.5742 27.2344 55.4727 26.4648 55.4727 25.668C55.4727 24.8711 55.5742 24.1055 55.7773 23.3711C55.9883 22.6367 56.2812 21.9492 56.6562 21.3086C57.0312 20.6602 57.4844 20.0742 58.0156 19.5508C58.5469 19.0195 59.1328 18.5664 59.7734 18.1914C60.4141 17.8164 61.1016 17.5273 61.8359 17.3242C62.5781 17.1133 63.3477 17.0078 64.1445 17.0078C65.1836 17.0078 66.1836 17.1875 67.1445 17.5469C68.1055 17.8984 68.9766 18.4062 69.7578 19.0703L68 22C67.4922 21.4844 66.9062 21.082 66.2422 20.793C65.5781 20.4961 64.8789 20.3477 64.1445 20.3477C63.4102 20.3477 62.7188 20.4883 62.0703 20.7695C61.4297 21.0508 60.8672 21.4336 60.3828 21.918C59.8984 22.3945 59.5156 22.957 59.2344 23.6055C58.9531 24.2461 58.8125 24.9336 58.8125 25.668C58.8125 26.4102 58.9531 27.1055 59.2344 27.7539C59.5156 28.4023 59.8984 28.9688 60.3828 29.4531C60.8672 29.9375 61.4297 30.3203 62.0703 30.6016C62.7188 30.8828 63.4102 31.0234 64.1445 31.0234C64.5664 31.0234 64.9766 30.9727 65.375 30.8711C65.7734 30.7695 66.1523 30.6289 66.5117 30.4492V25.668H69.7578V32.3008ZM83.8672 34H72.3477V17.1953H83.8672V20.5586H75.7109V23.9219H81.2305V27.2852H75.7109V30.6367H83.8672V34ZM93.2773 34H89.9258V20.5586H84.875V17.1953H98.3164V20.5586H93.2773V34ZM120.266 28.9609C120.266 29.6562 120.133 30.3086 119.867 30.918C119.602 31.5273 119.238 32.0625 118.777 32.5234C118.324 32.9766 117.793 33.3359 117.184 33.6016C116.574 33.8672 115.922 34 115.227 34H106.824V17.1953H115.227C115.922 17.1953 116.574 17.3281 117.184 17.5938C117.793 17.8594 118.324 18.2227 118.777 18.6836C119.238 19.1367 119.602 19.668 119.867 20.2773C120.133 20.8867 120.266 21.5391 120.266 22.2344C120.266 22.5469 120.223 22.8672 120.137 23.1953C120.051 23.5234 119.93 23.8398 119.773 24.1445C119.617 24.4492 119.43 24.7266 119.211 24.9766C118.992 25.2266 118.75 25.4336 118.484 25.5977C118.758 25.7461 119.004 25.9492 119.223 26.207C119.441 26.457 119.629 26.7344 119.785 27.0391C119.941 27.3438 120.059 27.6641 120.137 28C120.223 28.3281 120.266 28.6484 120.266 28.9609ZM110.188 30.6367H115.227C115.461 30.6367 115.68 30.5938 115.883 30.5078C116.086 30.4219 116.262 30.3047 116.41 30.1562C116.566 30 116.688 29.8203 116.773 29.6172C116.859 29.4141 116.902 29.1953 116.902 28.9609C116.902 28.7266 116.859 28.5078 116.773 28.3047C116.688 28.1016 116.566 27.9258 116.41 27.7773C116.262 27.6211 116.086 27.5 115.883 27.4141C115.68 27.3281 115.461 27.2852 115.227 27.2852H110.188V30.6367ZM110.188 23.9219H115.227C115.461 23.9219 115.68 23.8789 115.883 23.793C116.086 23.707 116.262 23.5898 116.41 23.4414C116.566 23.2852 116.688 23.1055 116.773 22.9023C116.859 22.6914 116.902 22.4688 116.902 22.2344C116.902 22 116.859 21.7812 116.773 21.5781C116.688 21.375 116.566 21.1992 116.41 21.0508C116.262 20.8945 116.086 20.7734 115.883 20.6875C115.68 20.6016 115.461 20.5586 115.227 20.5586H110.188V23.9219ZM132.699 27.2852V23.9219C132.699 23.4609 132.609 23.0273 132.43 22.6211C132.258 22.207 132.02 21.8477 131.715 21.543C131.41 21.2383 131.051 21 130.637 20.8281C130.23 20.6484 129.797 20.5586 129.336 20.5586C128.875 20.5586 128.438 20.6484 128.023 20.8281C127.617 21 127.262 21.2383 126.957 21.543C126.652 21.8477 126.41 22.207 126.23 22.6211C126.059 23.0273 125.973 23.4609 125.973 23.9219V27.2852H132.699ZM136.062 34H132.699V30.6367H125.973V34H122.621V23.9219C122.621 22.9922 122.797 22.1211 123.148 21.3086C123.5 20.4883 123.977 19.7734 124.578 19.1641C125.188 18.5547 125.898 18.0742 126.711 17.7227C127.531 17.3711 128.406 17.1953 129.336 17.1953C130.266 17.1953 131.137 17.3711 131.949 17.7227C132.77 18.0742 133.484 18.5547 134.094 19.1641C134.703 19.7734 135.184 20.4883 135.535 21.3086C135.887 22.1211 136.062 22.9922 136.062 23.9219V34ZM152.352 32.3008C151.57 32.9648 150.699 33.4766 149.738 33.8359C148.777 34.1875 147.777 34.3633 146.738 34.3633C145.941 34.3633 145.172 34.2578 144.43 34.0469C143.695 33.8438 143.008 33.5547 142.367 33.1797C141.727 32.7969 141.141 32.3438 140.609 31.8203C140.078 31.2891 139.625 30.7031 139.25 30.0625C138.875 29.4141 138.582 28.7188 138.371 27.9766C138.168 27.2344 138.066 26.4648 138.066 25.668C138.066 24.8711 138.168 24.1055 138.371 23.3711C138.582 22.6367 138.875 21.9492 139.25 21.3086C139.625 20.6602 140.078 20.0742 140.609 19.5508C141.141 19.0195 141.727 18.5664 142.367 18.1914C143.008 17.8164 143.695 17.5273 144.43 17.3242C145.172 17.1133 145.941 17.0078 146.738 17.0078C147.777 17.0078 148.777 17.1875 149.738 17.5469C150.699 17.8984 151.57 18.4062 152.352 19.0703L150.594 22C150.086 21.4844 149.5 21.082 148.836 20.793C148.172 20.4961 147.473 20.3477 146.738 20.3477C146.004 20.3477 145.312 20.4883 144.664 20.7695C144.023 21.0508 143.461 21.4336 142.977 21.918C142.492 22.3945 142.109 22.957 141.828 23.6055C141.547 24.2461 141.406 24.9336 141.406 25.668C141.406 26.4102 141.547 27.1055 141.828 27.7539C142.109 28.4023 142.492 28.9688 142.977 29.4531C143.461 29.9375 144.023 30.3203 144.664 30.6016C145.312 30.8828 146.004 31.0234 146.738 31.0234C147.16 31.0234 147.57 30.9727 147.969 30.8711C148.367 30.7695 148.746 30.6289 149.105 30.4492V25.668H152.352V32.3008ZM153.957 22.2344C153.957 21.5391 154.09 20.8867 154.355 20.2773C154.621 19.668 154.98 19.1367 155.434 18.6836C155.895 18.2227 156.43 17.8594 157.039 17.5938C157.648 17.3281 158.301 17.1953 158.996 17.1953H166.707V20.5586H158.996C158.762 20.5586 158.543 20.6016 158.34 20.6875C158.137 20.7734 157.957 20.8945 157.801 21.0508C157.652 21.1992 157.535 21.375 157.449 21.5781C157.363 21.7812 157.32 22 157.32 22.2344C157.32 22.4688 157.363 22.6914 157.449 22.9023C157.535 23.1055 157.652 23.2852 157.801 23.4414C157.957 23.5898 158.137 23.707 158.34 23.793C158.543 23.8789 158.762 23.9219 158.996 23.9219H162.359C163.055 23.9219 163.707 24.0547 164.316 24.3203C164.934 24.5781 165.469 24.9375 165.922 25.3984C166.383 25.8516 166.742 26.3867 167 27.0039C167.266 27.6133 167.398 28.2656 167.398 28.9609C167.398 29.6562 167.266 30.3086 167 30.918C166.742 31.5273 166.383 32.0625 165.922 32.5234C165.469 32.9766 164.934 33.3359 164.316 33.6016C163.707 33.8672 163.055 34 162.359 34H154.895V30.6367H162.359C162.594 30.6367 162.812 30.5938 163.016 30.5078C163.219 30.4219 163.395 30.3047 163.543 30.1562C163.699 30 163.82 29.8203 163.906 29.6172C163.992 29.4141 164.035 29.1953 164.035 28.9609C164.035 28.7266 163.992 28.5078 163.906 28.3047C163.82 28.1016 163.699 27.9258 163.543 27.7773C163.395 27.6211 163.219 27.5 163.016 27.4141C162.812 27.3281 162.594 27.2852 162.359 27.2852H158.996C158.301 27.2852 157.648 27.1523 157.039 26.8867C156.43 26.6211 155.895 26.2617 155.434 25.8086C154.98 25.3477 154.621 24.8125 154.355 24.2031C154.09 23.5859 153.957 22.9297 153.957 22.2344Z" fill="black" />
                                <rect y="10" width="5" height="30" fill="#7895B2" />
                                <path d="M0 10C0 7.79086 1.79086 6 4 6H13V10H0Z" fill="#7895B2" />
                                <path d="M0 40C0 42.2091 1.79086 44 4 44H13V40H0Z" fill="#7895B2" />
                                <circle cx="20.5" cy="24.5" r="2.5" fill="#127681" />
                                <circle cx="20.5" cy="24.5" r="1.5" fill="white" />
                            </svg>
                        </a>
                    </div>
                    <!-- SEARCH NAV COLLAPSE-->
                    <div class="collapsing container-fluid" id="collapseSearch">
                        <form action="">
                            <input type="text" class="form-control pt-2 pb-2 container" id="searchNav" autocomplete="off" placeholder="Cari produk">
                        </form>
                    </div>
                </div>
                <!-- BUTTON COLLAPSE -->
                <div class="collapse-btn">
                    <button class="navbar-toggler btn btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon">

                        </span>
                    </button>
                    <!-- <button class="navbar-toggler btn btn-sm" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarIcon" aria-controls="navbarNavDropdown" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon">
    
                            </span>
                        </button> -->
                </div>
            </div>
            <!-- </div> -->
            <!-- NAVIGASI TEXT -->
            <div class="collapse navbar-collapse justify-content-end me-5 me-md-0" id="navbarNavDropdown">
                <div class="nav-container nav-txt">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link nav-txt" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle nav-txt" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Collection
                            </a>
                            <ul class="dropdown-menu text-black">
                                <li><a class="dropdown-item" href="#">Carrier</a></li>
                                <li><a class="dropdown-item" href="#">Backpack</a></li>
                                <li><a class="dropdown-item" href="#">Sling Bag</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-txt" href="#">About</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- NAVIGASI ICON -->
            <div class="d-none d-md-flex me-5" id="navbarIcon">
                <ul class="navbar-nav ms-5">
                    <li class="nav-item btn-search">
                        <a href="#collapseSearch" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseSearch">
                            <svg class="nav-icon" width="34" height="33" viewBox="0 0 34 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.0831 24.75C16.5828 24.7495 19.0106 23.9325 20.9797 22.429L27.1707 28.4735L29.1621 26.5293L22.9711 20.4847C24.5118 18.562 25.3491 16.1912 25.3497 13.75C25.3497 7.68488 20.2952 2.75 14.0831 2.75C7.87091 2.75 2.81641 7.68488 2.81641 13.75C2.81641 19.8151 7.87091 24.75 14.0831 24.75ZM14.0831 5.5C18.7432 5.5 22.5331 9.20012 22.5331 13.75C22.5331 18.2999 18.7432 22 14.0831 22C9.4229 22 5.63307 18.2999 5.63307 13.75C5.63307 9.20012 9.4229 5.5 14.0831 5.5Z" fill="black" />
                                <path d="M16.072 11.8058C16.6058 12.3283 16.9001 13.0185 16.9001 13.75H19.7168C19.718 13.0273 19.5726 12.3116 19.2888 11.6442C19.005 10.9767 18.5885 10.3708 18.0634 9.8615C15.9312 7.7825 12.2343 7.7825 10.1035 9.8615L12.0921 11.8085C13.1624 10.7663 15.0073 10.769 16.072 11.8058Z" fill="black" />
                            </svg>
                        </a>
                    </li>
                    <li class="nav-item btn-cart">
                        <a href="#offcanvascart" data-bs-toggle="offcanvas" role="button" aria-controls="offcanvascart">
                            <svg class="nav-icon" width="35" height="33" viewBox="0 0 35 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.13711 6.1875H32.4871L29.3184 19.5938H10.3059M29.3184 23.7188H11.3621L6.08086 2.0625H2.91211" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M27.2062 29.9062C28.373 29.9062 29.3187 28.9828 29.3187 27.8438C29.3187 26.7047 28.373 25.7812 27.2062 25.7812C26.0395 25.7812 25.0938 26.7047 25.0938 27.8438C25.0938 28.9828 26.0395 29.9062 27.2062 29.9062Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M13.4748 29.9062C14.6415 29.9062 15.5873 28.9828 15.5873 27.8438C15.5873 26.7047 14.6415 25.7812 13.4748 25.7812C12.3081 25.7812 11.3623 26.7047 11.3623 27.8438C11.3623 28.9828 12.3081 29.9062 13.4748 29.9062Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </li>
                    <li class="nav-item btn-account">
                        <a href="#offcanvasaccount" data-bs-toggle="offcanvas" role="button" aria-controls="offcanvasaccount">
                            <svg width="35" height="33" viewBox="0 0 35 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.4992 16.5C19.18 16.5 20.792 15.8481 21.9805 14.6877C23.169 13.5273 23.8367 11.9535 23.8367 10.3125C23.8367 8.67147 23.169 7.09766 21.9805 5.93728C20.792 4.7769 19.18 4.125 17.4992 4.125C15.8184 4.125 14.2064 4.7769 13.0179 5.93728C11.8294 7.09766 11.1617 8.67147 11.1617 10.3125C11.1617 11.9535 11.8294 13.5273 13.0179 14.6877C14.2064 15.8481 15.8184 16.5 17.4992 16.5V16.5ZM17.4992 18.5625C15.2581 18.5625 13.1088 17.6933 11.5242 16.1461C9.93948 14.599 9.04922 12.5005 9.04922 10.3125C9.04922 8.12446 9.93948 6.02604 11.5242 4.47887C13.1088 2.93169 15.2581 2.0625 17.4992 2.0625C19.7403 2.0625 21.8896 2.93169 23.4743 4.47887C25.059 6.02604 25.9492 8.12446 25.9492 10.3125C25.9492 12.5005 25.059 14.599 23.4743 16.1461C21.8896 17.6933 19.7403 18.5625 17.4992 18.5625ZM28.0617 28.875V25.7812C28.0617 24.9607 27.7279 24.1738 27.1336 23.5936C26.5394 23.0134 25.7334 22.6875 24.893 22.6875H10.1055C9.26506 22.6875 8.45908 23.0134 7.86482 23.5936C7.27057 24.1738 6.93672 24.9607 6.93672 25.7812V28.875C6.93672 29.1485 6.82544 29.4108 6.62735 29.6042C6.42926 29.7976 6.1606 29.9062 5.88047 29.9062C5.60033 29.9062 5.33167 29.7976 5.13359 29.6042C4.9355 29.4108 4.82422 29.1485 4.82422 28.875V25.7812C4.82422 24.4137 5.38063 23.1022 6.37106 22.1352C7.36149 21.1682 8.70479 20.625 10.1055 20.625H24.893C26.2936 20.625 27.6369 21.1682 28.6274 22.1352C29.6178 23.1022 30.1742 24.4137 30.1742 25.7812V28.875C30.1742 29.1485 30.0629 29.4108 29.8649 29.6042C29.6668 29.7976 29.3981 29.9062 29.118 29.9062C28.8378 29.9062 28.5692 29.7976 28.3711 29.6042C28.173 29.4108 28.0617 29.1485 28.0617 28.875Z" fill="black" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- NAVIGASI RESPONSIVE -->
    <nav class="nav-second fixed-bottom bg-light pt-3">
        <div class="container">
            <ul class="d-flex justify-content-evenly d-md-none list-unstyled">
                <li class="btn-search">
                    <a href="#collapseSearch" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseSearch">
                        <svg class="nav-icon" width="34" height="33" viewBox="0 0 34 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.0831 24.75C16.5828 24.7495 19.0106 23.9325 20.9797 22.429L27.1707 28.4735L29.1621 26.5293L22.9711 20.4847C24.5118 18.562 25.3491 16.1912 25.3497 13.75C25.3497 7.68488 20.2952 2.75 14.0831 2.75C7.87091 2.75 2.81641 7.68488 2.81641 13.75C2.81641 19.8151 7.87091 24.75 14.0831 24.75ZM14.0831 5.5C18.7432 5.5 22.5331 9.20012 22.5331 13.75C22.5331 18.2999 18.7432 22 14.0831 22C9.4229 22 5.63307 18.2999 5.63307 13.75C5.63307 9.20012 9.4229 5.5 14.0831 5.5Z" fill="black" />
                            <path d="M16.072 11.8058C16.6058 12.3283 16.9001 13.0185 16.9001 13.75H19.7168C19.718 13.0273 19.5726 12.3116 19.2888 11.6442C19.005 10.9767 18.5885 10.3708 18.0634 9.8615C15.9312 7.7825 12.2343 7.7825 10.1035 9.8615L12.0921 11.8085C13.1624 10.7663 15.0073 10.769 16.072 11.8058Z" fill="black" />
                        </svg>
                    </a>
                </li>
                <li class="btn-cart">
                    <a href="#offcanvascart" data-bs-toggle="offcanvas" role="button" aria-controls="offcanvascart">
                        <svg class="nav-icon" width="35" height="33" viewBox="0 0 35 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.13711 6.1875H32.4871L29.3184 19.5938H10.3059M29.3184 23.7188H11.3621L6.08086 2.0625H2.91211" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M27.2062 29.9062C28.373 29.9062 29.3187 28.9828 29.3187 27.8438C29.3187 26.7047 28.373 25.7812 27.2062 25.7812C26.0395 25.7812 25.0938 26.7047 25.0938 27.8438C25.0938 28.9828 26.0395 29.9062 27.2062 29.9062Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M13.4748 29.9062C14.6415 29.9062 15.5873 28.9828 15.5873 27.8438C15.5873 26.7047 14.6415 25.7812 13.4748 25.7812C12.3081 25.7812 11.3623 26.7047 11.3623 27.8438C11.3623 28.9828 12.3081 29.9062 13.4748 29.9062Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </li>
                <li class="btn-account">
                    <a href="#offcanvasaccount" data-bs-toggle="offcanvas" role="button" aria-controls="offcanvasaccount">
                        <svg width="35" height="33" viewBox="0 0 35 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.4992 16.5C19.18 16.5 20.792 15.8481 21.9805 14.6877C23.169 13.5273 23.8367 11.9535 23.8367 10.3125C23.8367 8.67147 23.169 7.09766 21.9805 5.93728C20.792 4.7769 19.18 4.125 17.4992 4.125C15.8184 4.125 14.2064 4.7769 13.0179 5.93728C11.8294 7.09766 11.1617 8.67147 11.1617 10.3125C11.1617 11.9535 11.8294 13.5273 13.0179 14.6877C14.2064 15.8481 15.8184 16.5 17.4992 16.5V16.5ZM17.4992 18.5625C15.2581 18.5625 13.1088 17.6933 11.5242 16.1461C9.93948 14.599 9.04922 12.5005 9.04922 10.3125C9.04922 8.12446 9.93948 6.02604 11.5242 4.47887C13.1088 2.93169 15.2581 2.0625 17.4992 2.0625C19.7403 2.0625 21.8896 2.93169 23.4743 4.47887C25.059 6.02604 25.9492 8.12446 25.9492 10.3125C25.9492 12.5005 25.059 14.599 23.4743 16.1461C21.8896 17.6933 19.7403 18.5625 17.4992 18.5625ZM28.0617 28.875V25.7812C28.0617 24.9607 27.7279 24.1738 27.1336 23.5936C26.5394 23.0134 25.7334 22.6875 24.893 22.6875H10.1055C9.26506 22.6875 8.45908 23.0134 7.86482 23.5936C7.27057 24.1738 6.93672 24.9607 6.93672 25.7812V28.875C6.93672 29.1485 6.82544 29.4108 6.62735 29.6042C6.42926 29.7976 6.1606 29.9062 5.88047 29.9062C5.60033 29.9062 5.33167 29.7976 5.13359 29.6042C4.9355 29.4108 4.82422 29.1485 4.82422 28.875V25.7812C4.82422 24.4137 5.38063 23.1022 6.37106 22.1352C7.36149 21.1682 8.70479 20.625 10.1055 20.625H24.893C26.2936 20.625 27.6369 21.1682 28.6274 22.1352C29.6178 23.1022 30.1742 24.4137 30.1742 25.7812V28.875C30.1742 29.1485 30.0629 29.4108 29.8649 29.6042C29.6668 29.7976 29.3981 29.9062 29.118 29.9062C28.8378 29.9062 28.5692 29.7976 28.3711 29.6042C28.173 29.4108 28.0617 29.1485 28.0617 28.875Z" fill="black" />
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- CART OFFCANVAS -->
    <div class="rounded offcanvas offcanvas-end" tabindex="-1" id="offcanvascart" aria-labelledby="off">
        <div class="offcanvas-header">
            <div class="final-bg container-fluid d-flex align-items-center pt-3 pb-3">
                <div class="title-container text-white container-fluid text-center">
                    <h5>Keranjang Belanja</h5>
                </div>
                <button type="button" class="btn-close btn-close-white me-1" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
        </div>
        <div class="offcanvas-body overflow-auto">
            <!-- PRODUK LIST -->
            <?php foreach ($cart as $row) : ?>
                <div class="product-list border-bottom container-fluid d-flex align-items-center">
                    <div class="row">
                        <div class="col-4 d-flex align-items-center">
                            <img src="../img-assets/product/<?= $row["hero_img"]; ?>" class="img-fluid" alt="">
                        </div>
                        <div class="col-8">
                            <div class="row row-cols-1">
                                <div class="col mt-3">
                                    <h6 class="title"><?= $row["nama_produk"]; ?></h6>
                                </div>
                                <div class="col">
                                    <span id="desc-whishlist">Color : <span><?= $row["varian"]; ?></span></span>
                                </div>
                                <div class="col pt-2">
                                    <div class="row row-cols-3 align-items-center">
                                        <div class="col-2">
                                            <button class="btn btn-outline-dark btn-sm">
                                                -
                                            </button>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" name="jumlahBarang" class="form-control form-control-sm text-center" value="<?= $row["jumlah"]; ?>">
                                        </div>
                                        <div class="col-2">
                                            <button class="btn btn-outline-dark btn-sm">
                                                +
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col pt-3 pb-4">
                                    <div class="row d-flex align-items-center">
                                        <div class="col product-price">
                                            <h6 class="pt-1 price">Rp<?= $row["total"]; ?></h6>
                                        </div>
                                        <div class="col-2 rounded bg-light delete-list d-flex justify-content-center p-1">
                                            <a href="delete.php?id_keranjang=<?= $row["id_keranjangBelanja"]; ?>" class="btn btn-sm" id="dlt-whislist">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M19 4H15.5L14.5 3H9.5L8.5 4H5V6H19M6 19C6 19.5304 6.21071 20.0391 6.58579 20.4142C6.96086 20.7893 7.46957 21 8 21H16C16.5304 21 17.0391 20.7893 17.4142 20.4142C17.7893 20.0391 18 19.5304 18 19V7H6V19Z" fill="black" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- CART NAV -->
        <div class="cart-nav">
            <div class="container">
                <div class="container">
                    <div class="row rounded ps-2 pe-2 row-cols-1">
                        <div class="col">
                            <div class="row bg-light p-3 rounded border">
                                <div class="col-2">
                                    <span id="subtotal">Subtotal</span>
                                </div>
                                <div class="col-10 text-end">
                                    <span>
                                        <h6>Rp<?= $totalKeranjang["Subtotal"]; ?></h6>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col mt-3 mb-3">
                            <form action="order-form.php" method="POST">
                                <input type="hidden" name="totalBelanja" value="<?= $SubtotalKeranjang["Subtotal"]; ?>">
                                <button type="submit" name="btn-checkout" class="btn container checkout-btn p-2" id="Checkout">
                                    Checkout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL UBAH INFORMASI DATA DIRI -->
    <div class="modal" id="modal-datacustomerUbah" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-body">
                    <div class="top border-bottom">
                        <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                        <h5>Informasi Akun</h5>
                    </div>
                    <div class="row row-cols-1 mt-2">
                        <form action="" method="POST">
                            <div class="col mb-2">
                                <input autocomplete="off" name="id_akun" type="hidden" class="form-control" id="exampleFormControlInput1" value="<?= $_SESSION["id_akun"]; ?>">
                            </div>
                            <div class="col mb-2">
                                <label for="exampleFormControlInput1" class="form-label">Nama Lengkap</label>
                                <input autocomplete="off" name="nama_customer" type="text" class="form-control" id="exampleFormControlInput1" value="<?= $tableCustomer["nama_customer"]; ?>">
                            </div>
                            <div class="col mb-2">
                                <label for="exampleFormControlInput2" class="form-label">Email</label>
                                <input autocomplete="off" name="email" type="email" class="form-control" id="exampleFormControlInput2" placeholder="username@gmail.com" value="<?= $tableCustomer["email"]; ?>">
                            </div>
                            <div class="col mb-2">
                                <label for="exampleFormControlInput3" class="form-label">Nomor Handphone</label>
                                <input autocomplete="off" name="nomor_hp" type="text" class="form-control" id="exampleFormControlInput3" placeholder="08xxxxxxxxxx" value="<?= $tableCustomer["nomor_hp"]; ?>">
                            </div>
                            <div class="col">
                                <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3"><?= $tableCustomer["alamat"]; ?></textarea>
                            </div>
                            <div class="col mt-3 d-flex justify-content-center">
                                <button name="ubahDataCustomer" type="submit" class="btn modal-show container rounded-0 w-25">Ubah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- OFFCANVAS ACCOUNT -->
    <div class="rounded offcanvas offcanvas-end" tabindex="-1" id="offcanvasaccount" aria-labelledby="off">
        <div class="offcanvas-header">
            <div class="final-bg container-fluid d-flex align-items-center pt-3 pb-3">
                <div class="title-container text-white container-fluid text-center">
                    <h5>Akun Saya</h5>
                </div>
                <button type="button" class="btn-close btn-close-white me-1" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
        </div>
        <div class="offcanvas-body">
            <div class="d-flex justify-content-center">
                <div class="row row-cols-2 container-fluid border p-3 border rounded bg-light">
                    <div class="col-4 d-flex justify-content-center align-items-center">
                        <div class="profile-container">
                            <img class="img-fluid rounded-circle" src="../img-assets/user-profile/<?= $tableAkun['avatar']; ?>" alt="">
                        </div>
                    </div>
                    <div class="col-8">
                        <h6><?= $tableAkun['username']; ?></h6>
                        <br>
                        <form action="" method="POST">
                            <button type="submit" name="log-out" class="btn btn-outline-danger btn-sm ps-3 pe-3">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="accordion mt-3 accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="informasiAkun">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            <h6>Informasi Akun</h6>
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#informasiAkun">
                        <div class="accordion-body">
                            <div class="row row-cols-1">
                                <div class="col">
                                    <div class="row row-cols-2 justify-content-between">
                                        <div class="col-6 d-flex align-items-center">
                                            <strong>Informasi Kontak</strong>
                                        </div>
                                        <div class="col-2">
                                            <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#modal-datacustomerUbah">Ubah</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col mt-3 border rounded pt-3">
                                    <p>
                                        <?= $tableCustomer['nama_customer']; ?>
                                        <br>
                                        <span><?= $tableCustomer['email']; ?></span>
                                        <br>
                                        <span><?= $tableCustomer['nomor_hp']; ?></span>
                                    </p>
                                </div>
                                <div class="col mt-3">
                                    <div class="row row-cols-2 justify-content-between">
                                        <div class="col-6 d-flex align-items-center">
                                            <strong>Alamat</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col mt-3 border rounded pt-3">
                                    <p>
                                        <?= $tableCustomer['alamat']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="daftarPesanan">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            <h6>Daftar Pesanan</h6>
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#daftarPesanan">
                        <div class="accordion-body">
                            <?php foreach ($pesanan as $data) : ?>
                                <div class="row mt-2 pt-2 row-cols-1" style="border: 1px solid #7895B2;">
                                    <div class="col border-bottom">
                                        <h6>Kode Pesanan : <?= $data["no_pesanan"]; ?></h6>
                                    </div>
                                    <div class="col">
                                        <?php
                                        $ordered = showData("SELECT * FROM ordered WHERE id_pesanan=$data[id_pesanan]");
                                        ?>
                                        <?php foreach ($ordered as $produk) : ?>
                                            <div class="row pt-3 pb-3">
                                                <div class="col-4 d-flex justify-content-center align-items-center">
                                                    <img class="img-fluid" src="../img-assets/product/<?= $produk["hero_img"]; ?>" alt="">
                                                </div>
                                                <div class="col">
                                                    <div class="row row-cols-1">
                                                        <div class="col">
                                                            <h6><?= $produk["nama_produk"]; ?></h6>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row justify-content-between">
                                                                <div class="col-4">
                                                                    <span><?= $produk["varian"]; ?></span>
                                                                </div>
                                                                <div class="col-3 text-end">
                                                                    <span>x <?= $produk["jumlah"]; ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col border-top mt-3 pt-1 text-end">
                                                            <span>Rp<?= $produk["total"]; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <div class="">
                                            <div class="row row-cols-2">
                                                <div class="col d-flex justify-content-between">
                                                    <span>Status</span>
                                                    <span> :</span>
                                                </div>
                                                <div class="col text-end text-danger">
                                                    <?= $data["status"]; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row bg-light pt-3 pb-3 rounded mt-2">
                                            <div class="col d-flex justify-content-between">
                                                <span>Status</span>
                                                <span> :</span>
                                            </div>
                                            <div class="col text-end">
                                                <strong>Rp<?= $data["FORMAT(total_pesanan, 2)"]; ?></strong>
                                            </div>
                                        </div>

                                        <!-- UNGGAH BNUKTI PEMBAYARAN -->
                                        <form action="unggah-bukti.php?id_pesanan=<?= $data["id_pesanan"]; ?>" method="POST" enctype="multipart/form-data">
                                            <div class="mb-3" id="input-bukti">
                                                <input class="form-control form-control-sm" id="formFileSm" name="bukti" type="file">
                                            </div>
                                            <div class="unggah float-end mb-2">
                                                <button name="unggahbukti" class="btn btn-outline-success rounded-0" type="submit">Unggah bukti</button>
                                            </div>
                                        </form>
                                        <div class="cara-bayar pt-2">
                                            <a style="font-size: small;" class="text-decoration-none" href="buktiPembayaran.php?bukti=<?= $data["bukti"]; ?>">Lihat bukti</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- TAMPILAN PRODUK BERDERET -->
    <section class="section-1">
        <div class="container">
            <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 row-cols-1">
                <?php foreach ($dataproduk as $row) : ?>
                    <div class="col mt-3 mt-sm-0">
                        <div class="container-product">
                            <div class="row row-cols-1 pt-4 pb-4">
                                <a href="product-detail.php?id=<?= $row["id_produk_image"]; ?>" class="text-decoration-none">
                                    <div class="col d-flex justify-content-center" style="height: 300px;">
                                        <img class="img-fluid" src="../img-assets/product/<?= $row["hero_img"]; ?>" alt="">
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col ps-2 pt-2">
                            <h5 class="product-name"><a href="product-detail.php?id=<?= $row["id_produk_image"]; ?>" class=""><?= $row["nama"]; ?></a></h5>
                        </div>
                        <div class="col ps-2">
                            <h5 class="product-price"><a href="product-detail.php" class="">Rp <?= $row["FORMAT(produk.harga, 2)"]; ?></a></h5>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- CONTACT OWNER -->
    <div class="container contact-owner mt-5 mb-3">
        <div class="text-center">
            <h3 class="judul">Get the latest product information</h3>
            <p class="text">Dapatkan informasi mengenai produk terbaru dan produk yang akan rilis</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 col">
                <form action="">
                    <div class="container d-flex justify-content-center text mt-4">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control ps-4 p-2" placeholder="Email Address" aria-label="Email Address" aria-describedby="button-addon2">
                            <button class="btn ps-5 pe-5" type="button" id="button-addon2">SEND</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="ini-fo  border-top">
        <div class="container-fluid contain-footer">
            <div class="row logo-raget">

                <!--  d-none d-sm-flex == display none in different layout-->

                <div class="col-md-4 pt-5 d-flex justify-content-md-start justify-content-center">
                    <div class="row w-75">
                        <div class="col d-flex justify-content-center">
                            <img src="../img-assets/footer-assets/logo-footer-raget.png" class="" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 kata-kata pt-5">
                    <h4>Don't ask to many question</h4>
                    <h4>JUST GO SHOPPING</h4>
                </div>
                <div class="col-md-4 d-flex justify-content-center justify-content-lg-end align-items-end pt-3 pt-sm-3">
                    <div class="container-sosmed row row-cols-1 w-75">
                        <div class="column-pertama col col-12">
                            <h5 style="text-align: center;">Follow Us</h5>
                        </div>
                        <div class="column-kedua col col-12 mt-3">
                            <div class="d-flex justify-content-evenly">
                                <div class="list-sosmed">
                                    <span>
                                        <a href="https://www.instagram.com/fatkhur.err/">
                                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14.52 10.5875C14.52 11.2576 14.3136 11.9126 13.9268 12.4698C13.54 13.0269 12.9902 13.4612 12.347 13.7176C11.7038 13.974 10.9961 14.0411 10.3133 13.9104C9.63047 13.7797 9.00326 13.457 8.51098 12.9832C8.0187 12.5094 7.68346 11.9057 7.54764 11.2485C7.41182 10.5913 7.48152 9.91004 7.74794 9.29097C8.01436 8.67189 8.46553 8.14276 9.04439 7.77048C9.62325 7.3982 10.3038 7.1995 11 7.1995C11.9327 7.20229 12.8263 7.56014 13.4858 8.19491C14.1453 8.82968 14.5171 9.68981 14.52 10.5875ZM22 5.929V15.246C22 16.8185 21.351 18.3265 20.1958 19.4384C19.0406 20.5503 17.4737 21.175 15.84 21.175H6.16C4.52627 21.175 2.95945 20.5503 1.80422 19.4384C0.648998 18.3265 0 16.8185 0 15.246V5.929C0 4.35653 0.648998 2.84847 1.80422 1.73656C2.95945 0.624661 4.52627 0 6.16 0H15.84C17.4737 0 19.0406 0.624661 20.1958 1.73656C21.351 2.84847 22 4.35653 22 5.929ZM16.28 10.5875C16.28 9.58237 15.9703 8.59982 15.3902 7.76409C14.81 6.92836 13.9854 6.27699 13.0206 5.89234C12.0558 5.5077 10.9941 5.40706 9.96992 5.60315C8.9457 5.79924 8.0049 6.28325 7.26648 6.99398C6.52806 7.70471 6.02518 8.61024 5.82145 9.59605C5.61772 10.5819 5.72229 11.6037 6.12192 12.5323C6.52155 13.4609 7.1983 14.2546 8.06659 14.813C8.93488 15.3714 9.95571 15.6695 11 15.6695C12.4003 15.6695 13.7433 15.1341 14.7335 14.181C15.7237 13.228 16.28 11.9353 16.28 10.5875ZM18.04 5.082C18.04 4.83072 17.9626 4.58508 17.8175 4.37615C17.6725 4.16722 17.4663 4.00437 17.2251 3.90821C16.9839 3.81205 16.7185 3.78689 16.4625 3.83591C16.2064 3.88493 15.9712 4.00594 15.7866 4.18362C15.602 4.3613 15.4763 4.58768 15.4254 4.83414C15.3744 5.08059 15.4006 5.33605 15.5005 5.5682C15.6004 5.80035 15.7696 5.99878 15.9866 6.13838C16.2037 6.27799 16.4589 6.3525 16.72 6.3525C17.0701 6.3525 17.4058 6.21864 17.6534 5.98038C17.9009 5.74211 18.04 5.41896 18.04 5.082Z" fill="black" />
                                            </svg>
                                        </a>
                                    </span>
                                    <span>
                                        <a href="">
                                            <svg width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_1423_636)">
                                                    <path d="M3.83447 0C1.71034 0 0 1.79179 0 4.01707V17.983C0 20.2082 1.71034 22 3.83447 22H11.0598V13.3994H8.88892V10.3029H11.0598V7.65739C11.0598 5.57894 12.3425 3.67057 15.2972 3.67057C16.4935 3.67057 17.3782 3.79089 17.3782 3.79089L17.3086 6.68252C17.3086 6.68252 16.4064 6.67359 15.4219 6.67359C14.3564 6.67359 14.1855 7.18791 14.1855 8.04173V10.3029H17.3932L17.2535 13.3994H14.1855V22H17.1655C19.2897 22 21 20.2083 21 17.983V4.01709C21 1.79181 19.2897 2.2e-05 17.1655 2.2e-05H3.83445L3.83447 0Z" fill="black" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_1423_636">
                                                        <rect width="21" height="22" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                    </span>
                                    <span>
                                        <a href="">
                                            <svg width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_1423_638)">
                                                    <path d="M17.5 6.90365C16.9896 7.14236 16.4382 7.30469 15.8457 7.39062C16.4655 7.00868 16.8893 6.45009 17.1172 5.71484C16.5247 6.07769 15.9141 6.32118 15.2852 6.44531C14.7292 5.8151 14.0319 5.5 13.1934 5.5C12.4004 5.5 11.7236 5.79362 11.1631 6.38086C10.6025 6.9681 10.3223 7.67708 10.3223 8.50781C10.3223 8.78472 10.3451 9.01389 10.3906 9.19531C9.21484 9.12847 8.11198 8.81814 7.08203 8.26432C6.05208 7.7105 5.17708 6.97049 4.45703 6.04427C4.19271 6.5217 4.06055 7.02778 4.06055 7.5625C4.06055 8.65104 4.47526 9.48655 5.30469 10.069C4.8763 10.0595 4.42057 9.93533 3.9375 9.69662V9.72526C3.9375 10.4414 4.16536 11.0788 4.62109 11.6374C5.07682 12.196 5.63737 12.5421 6.30273 12.6758C6.03841 12.7522 5.80599 12.7904 5.60547 12.7904C5.48698 12.7904 5.30924 12.7713 5.07227 12.7331C5.26367 13.3346 5.60319 13.8312 6.09082 14.2227C6.57845 14.6142 7.13216 14.8147 7.75195 14.8242C6.69466 15.6836 5.50521 16.1133 4.18359 16.1133C3.94661 16.1133 3.71875 16.099 3.5 16.0703C4.84896 16.9679 6.31641 17.4167 7.90234 17.4167C8.92318 17.4167 9.88021 17.2472 10.7734 16.9082C11.6667 16.5692 12.4323 16.1157 13.0703 15.5475C13.7083 14.9794 14.2575 14.3253 14.7178 13.5853C15.1781 12.8453 15.5199 12.0718 15.7432 11.265C15.9665 10.4581 16.0781 9.65365 16.0781 8.85156C16.0781 8.67969 16.0736 8.55078 16.0645 8.46484C16.6387 8.03516 17.1172 7.51476 17.5 6.90365ZM21 4.125V17.875C21 19.0113 20.6149 19.9829 19.8447 20.7897C19.0745 21.5966 18.1471 22 17.0625 22H3.9375C2.85286 22 1.92546 21.5966 1.15527 20.7897C0.385091 19.9829 0 19.0113 0 17.875V4.125C0 2.98872 0.385091 2.01714 1.15527 1.21029C1.92546 0.403429 2.85286 0 3.9375 0H17.0625C18.1471 0 19.0745 0.403429 19.8447 1.21029C20.6149 2.01714 21 2.98872 21 4.125Z" fill="black" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_1423_638">
                                                        <rect width="21" height="22" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                    </span>
                                </div>
                            </div>
                            <!-- <div class="row">
                                    <div class="col">
                                        <div>
                                            
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div>
                                            
                                        </div>
                                    </div>
                                    <div class="col">
                                        
                                    </div>
                                </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col pt-3 text-center">
                    <hr style="width: 50%; margin: auto;" class="mb-3">
                    <p style="letter-spacing: 0.02em;line-height: 32px;">© 2022 Raget bags.
                        All Rights reserved. <br>
                        <span> Ecommerce software by Kaftapus2 </span>
                    </p>
                </div>
            </div>
        </div>
    </footer>


    <!-- POPPER AND JS BOOSTRAP 5 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>