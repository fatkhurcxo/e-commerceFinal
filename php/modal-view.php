<?php

$id_produk = $_GET["id"];
$produkModal = showDataTable("SELECT produk_image.hero_img, produk_image.second_img, produk_image.third_img, produk.nama, FORMAT(produk.harga, 2), produk_desc.material
                                FROM produk_image
                                    INNER JOIN produk ON produk_image.id_produk=produk.id_produk
                                        INNER JOIN produk_desc ON produk_desc.id_produk=produk
                                            WHERE id_produk=$id_produk
                                ");
// var_dump($hargaProduk);
// die;
?>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="col justify-content-end d-flex d-lg-none">
                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="row row-cols-lg-2 row-cols-1">
                    <div class="col">
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="false">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="../img-assets/product/<?= $row["hero_img"]; ?>" class="d-block img-fluid ms-auto me-auto" style="height: 400px;" alt="...">
                                </div>
                                <div class="carousel-item ">
                                    <img src="../img-assets/product/<?= $row["second_img"]; ?>" class="d-block img-fluid ms-auto me-auto" style="height: 400px;" alt="...">
                                </div>
                                <div class="carousel-item ">
                                    <img src="../img-assets/product/<?= $row["third_img"]; ?>" class="d-block img-fluid ms-auto me-auto" style="height: 400px;" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.99 13L19 13C19.55 13 20 12.55 20 12C20 11.45 19.55 11 19 11L7.99 11V9.21004C7.99 8.76004 7.45 8.54004 7.14 8.86004L4.36 11.65C4.17 11.85 4.17 12.16 4.36 12.36L7.14 15.15C7.45 15.47 7.99 15.24 7.99 14.8V13V13Z" fill="#111111" />
                                </svg>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <svg width="30" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.01 11H5C4.45 11 4 11.45 4 12C4 12.55 4.45 13 5 13H16.01V14.79C16.01 15.24 16.55 15.46 16.86 15.14L19.64 12.35C19.83 12.15 19.83 11.84 19.64 11.64L16.86 8.84996C16.55 8.52996 16.01 8.75996 16.01 9.19996V11V11Z" fill="#111111" />
                                </svg>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row row-cols-1 mt-lg-0 mt-3">
                            <div class="col justify-content-end d-none d-lg-flex">
                                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="col">
                                <h4><?= $row["nama"]; ?></h4>
                            </div>
                            <div class="col">
                                <h5 class="product-price"><a href="" class="">Rp<?= $row["FORMAT(produk.harga, 2)"]; ?></a></h5>
                            </div>
                            <div class="col mt-5">
                                <p>
                                    <?= $row["material"]; ?>
                                </p>
                            </div>
                            <div class="col modal-btn">
                                <div class="row ps-lg-0 ps-3 pe-lg-0 pe-3">
                                    <div class="col">
                                        <div class="row rounded">
                                            <div class="col-lg-6 col-4 d-flex justify-content-center align-items-center">
                                                <div>
                                                    <span style="font-size: large; font-weight: 100;">Jumlah</span>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <form method="POST" action="">
                                                    <div class="input-group">
                                                        <button class="btn btn-sm btn-count">
                                                            <svg class="svg-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M16 17.18L16 6.82005C16 6.03005 15.13 5.55005 14.46 5.98005L6.32 11.16C6.17749 11.2502 6.0601 11.375 5.97876 11.5227C5.89742 11.6705 5.85476 11.8364 5.85476 12.0051C5.85476 12.1737 5.89742 12.3396 5.97876 12.4874C6.0601 12.6351 6.17749 12.7599 6.32 12.8501L14.46 18.02C14.6108 18.1176 14.7852 18.1726 14.9647 18.1794C15.1442 18.1861 15.3222 18.1442 15.4799 18.0582C15.6376 17.9722 15.7691 17.8452 15.8607 17.6906C15.9522 17.5361 16.0004 17.3597 16 17.18V17.18Z" fill="#9F9F9F" />
                                                            </svg>
                                                        </button>
                                                        <input type="text" name="count" class="form-control border-0" value="1" min="1" max="20">
                                                        <button class="btn btn-sm btn-count">
                                                            <svg class="svg-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M8 6.81995V17.18C8 17.97 8.87 18.45 9.54 18.02L17.68 12.84C17.8225 12.7498 17.9399 12.625 18.0212 12.4773C18.1026 12.3295 18.1452 12.1636 18.1452 11.9949C18.1452 11.8263 18.1026 11.6604 18.0212 11.5126C17.9399 11.3649 17.8225 11.2401 17.68 11.1499L9.54 5.97995C9.38917 5.88239 9.2148 5.82736 9.0353 5.82064C8.85579 5.81393 8.6778 5.85579 8.52011 5.94181C8.36241 6.02782 8.23085 6.15481 8.13931 6.30936C8.04777 6.46392 7.99964 6.64032 8 6.81995V6.81995Z" fill="#9F9F9F" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <form action="" method="POST">
                                            <button type="submit" class="btn btn-keranjang container" name="btn-keranjang-modal">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 9C12.55 9 13 8.55 13 8V6H15C15.55 6 16 5.55 16 5C16 4.45 15.55 4 15 4H13V2C13 1.45 12.55 1 12 1C11.45 1 11 1.45 11 2V4H9C8.45 4 8 4.45 8 5C8 5.55 8.45 6 9 6H11V8C11 8.55 11.45 9 12 9ZM7 18C5.9 18 5.01 18.9 5.01 20C5.01 21.1 5.9 22 7 22C8.1 22 9 21.1 9 20C9 18.9 8.1 18 7 18ZM17 18C15.9 18 15.01 18.9 15.01 20C15.01 21.1 15.9 22 17 22C18.1 22 19 21.1 19 20C19 18.9 18.1 18 17 18ZM8.1 13H15.55C16.3 13 16.96 12.59 17.3 11.97L20.54 5.83C20.6622 5.59878 20.6887 5.32883 20.6139 5.07823C20.5391 4.82763 20.369 4.6164 20.14 4.49C20.024 4.42649 19.8966 4.3867 19.7651 4.37295C19.6336 4.35921 19.5007 4.37179 19.3741 4.40995C19.2475 4.44811 19.1297 4.5111 19.0278 4.59524C18.9258 4.67937 18.8415 4.78297 18.78 4.9L15.55 11H8.53L4.27 2H2C1.45 2 1 2.45 1 3C1 3.55 1.45 4 2 4H3L6.6 11.59L5.25 14.03C4.52 15.37 5.48 17 7 17H18C18.55 17 19 16.55 19 16C19 15.45 18.55 15 18 15H7L8.1 13Z" fill="white" />
                                                </svg>
                                                Keranjang
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>