<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raget Store</title>

    <!-- css bootstrap 5.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- head icon -->
    <link rel="icon" href="../img-assets/head-assets/raget-headIcon.png">

    <style>
        .buat-pesanan:hover {
            background-color: #6FABE8;
        }

        .buat-pesanan {
            background-color: #7895B2;
        }

        .btn-kembali:hover svg path {
            fill: red;
        }

        .btn-kembali:hover {
            color: red;
        }
    </style>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-md container bg-light rounded d-flex justify-content-center">
        <div class="con-logo">
            <img class="img-fluid" src="../img-assets/footer-assets/logo-footer-raget.png" alt="">
        </div>
    </nav>

    <section class="form-section container pt-3 pb-3 bg-light">
        <div class="row me-2 ms-2">
            <div class="col">
                <div class="row row-cols-1 border rounded">
                    <div class="col mt-2">
                        <label for="namaPenerima" class="form-label" style="font-weight: 500;">Nama Penerima</label>
                        <input name="namaPenerima" type="text" class="form-control" id="namaPenerima" placeholder="Masukkan nama lengkap penerima">
                    </div>
                    <div class="col mt-2">
                        <label for="exampleFormControlInput1" class="form-label" style="font-weight: 500;">Nomor Handphone</label>
                        <input name="nomorHP" type="email" class="form-control" id="exampleFormControlInput1" placeholder="Nomor handphone aktif">
                    </div>
                    <div class="col mt-2">
                        <div class="row">
                            <div class="col">
                                <label for="alamatPenerima" class="form-label" style="font-weight: 500;">Alamat Pengiriman</label>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <button class="btn btn-outline-primary btn-sm pe-3 ps-3">Ubah alamat</button>
                            </div>
                        </div>
                    </div>
                    <div class="col mt-2">
                        <textarea name="alamatPenerima" class="form-control" id="alamatPenerima" rows="3" placeholder=""></textarea>
                    </div>
                    <div class="col mt-2">
                        <label for="Pilihan Pengiriman" class="form-label" style="font-weight: 500;">Pilihan Jasa Pengiriman</label>
                        <select class="form-select" aria-label="Default select example" name="pilihanPengiriman">
                            <option value="JNE">JNE Regular</option>
                            <option value="J&T">J&T Express</option>
                            <option value="SiCepat">SiCepat</option>
                        </select>
                    </div>
                    <div class="col mt-2">
                        <label for="catatanPesanan" class="form-label" style="font-weight: 500;">Catatan Pesanan</label>
                        <textarea name="catatanPesanan" class="form-control" id="catatanPesanan" rows="2"></textarea>
                    </div>
                    <div class="col mt-3 mb-3">
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-kembali">
                                    <div class="row">
                                        <div class="col">
                                            <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14.9821 20.5833C14.8203 20.5839 14.6604 20.5481 14.5142 20.4788C14.3679 20.4094 14.2391 20.3082 14.1371 20.1825L8.90465 13.6825C8.74531 13.4886 8.6582 13.2455 8.6582 12.9946C8.6582 12.7436 8.74531 12.5005 8.90465 12.3066L14.3213 5.80664C14.5052 5.58541 14.7694 5.44628 15.0559 5.41987C15.3424 5.39346 15.6276 5.48192 15.8488 5.66581C16.07 5.84969 16.2092 6.11393 16.2356 6.40039C16.262 6.68685 16.1735 6.97207 15.9896 7.19331L11.1471 13L15.8271 18.8066C15.9596 18.9657 16.0438 19.1593 16.0696 19.3646C16.0955 19.57 16.062 19.7784 15.9731 19.9653C15.8842 20.1523 15.7437 20.3098 15.568 20.4193C15.3924 20.5288 15.1891 20.5857 14.9821 20.5833Z" fill="#7895B2" />
                                            </svg>
                                        </div>
                                        <div class="col d-flex align-items-center">
                                            <span class="text-kembali">Kembali</span>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            <div class="col">
                                <button class="buat-pesanan text-white btn border container pt-2 pb-2 pe-5 ps-5 rounded-0">Buat Pesanan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col ms-4">
                <div class="row container row-cols-1 border bg-white border-1 rounded">
                    <div class="col border-bottom pb-2 pt-2">
                        <span style="font-weight: 500;">No.pesanan</span>
                    </div>
                    <div class="col border-bottom pb-2 pt-2">
                        <div class="row">
                            <div class="col-2 bg-light d-flex justify-content-center">
                                <img class="img-fluid" src="../img-assets/product-assets/produk-2.png" alt="">
                            </div>
                            <div class="col">
                                <div class="row row-cols-1 align-items-center">
                                    <div class="col">
                                        <h5>Eiger Ngawior</h5>
                                    </div>
                                    <div class="col">
                                        <span>Varian: Olive</span>
                                    </div>
                                    <div class="col mt-4">
                                        <div class="float-start">
                                            <h6>147219471742</h6>
                                        </div>
                                        <div class="float-end">
                                            x 2
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-2 pt-2">
                        <div class="row row-cols-1">
                            <div class="col">
                                <div class="float-start">
                                    <span>Subtotal</span>
                                </div>
                                <div class="float-end">
                                    Rp1318208
                                </div>
                            </div>
                            <div class="col">
                                <div class="float-start">
                                    <span>Subtotal</span>
                                </div>
                                <div class="float-end">
                                    Rp1318208
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col border-bottom pb-3 pt-3">
                        <div class="float-start">
                            <h4>Total</h4>
                        </div>
                        <div class="float-end">
                            <h4>Rp1318208</h4>
                        </div>
                    </div>
                </div>
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