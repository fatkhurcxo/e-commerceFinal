<?php

$db_connect = mysqli_connect("localhost", "root", "", "raget_bags");


# LOGIN
if (isset($_POST['login'])) {
    # code...
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $cek_user = mysqli_query($db_connect, "SELECT * FROM user WHERE username='$username' and password='$password'");

    $hitung = mysqli_num_rows($cek_user);

    #ambil data dengan fetch
    if ($hitung > 0) {
        $ubah_data = mysqli_fetch_array($cek_user);
        $level = $ubah_data['level'];

        if ($level == 'admin') {
            # code...

            $_SESSION["login"] = true;
            $_SESSION["admin"] = true;
            header('location:admin-raget.php');
        } else {
            # code...
            $_SESSION["login"] = true;
            $_SESSION["user"] = true;
            header('location:index.php');
        }
    } else {
        # code...
        echo "<script> alert('Login gagal sayang'); </script>";
    }
};

#REGISTER
if (isset($_POST['register'])) {
    # code...
    $nama = $_POST['namaLengkap'];
    $usernya = $_POST['reg-uname'];
    $pwnya = $_POST['reg-pass'];
    $pwnya2 = $_POST['password2'];

    $cek_user = mysqli_query($db_connect, "SELECT * FROM user WHERE username = '$usernya'");
    $cek_login = mysqli_num_rows($cek_user);

    if ($cek_login > 0) {
        # code...
        echo "<script> alert('Username telah terdaftar'); </script>";
    } else {
        if ($pwnya != $pwnya2) {
            # code...
            echo "<script> alert('Password tidak sesuai'); </script>";
        } else {
            mysqli_query($db_connect, "INSERT INTO user VALUES ('','$nama', '$usernya', '$pwnya', 'user')");
            echo "<script> alert('Berhasil buat akun'); window.location('user-login.php'); </script>";
        }
    }
}
#SHOW INFORMASI AKUN

#LOGOUT
if (isset($_POST['log-out'])) {
    # code...
    session_destroy();
    echo "<script> alert('Anda keluar!'); document.location.href = 'user-login.php'; </script>";
    exit();
}


#TAMBAH DATA

function AddRaget($product)
{

    global $db_connect;

    $namaProduk = $product['product_name'];
    $hargaProduk = $product['produk_price'];
    $varianProduk = $product['product_varian'];
    $gambarProduk = $product['product_image'];


    $query = "INSERT INTO raget_product
                VALUES
                    ('', '$namaProduk', '$hargaProduk', '$gambarProduk', '$varianProduk')
                        ";

    mysqli_query($db_connect, $query);

    return mysqli_affected_rows($db_connect);
}

#BUTTON ACTION
if (isset($_POST['add'])) {
    # code...
    if (AddRaget($_POST) > 0) {
        # code...
        echo "<script> alert('Data berhasil ditambahkan'); 
                        document.location.href = 'admin-raget.php';
            </script>";
    } else {
        # code...
        echo "<script> alert('Data gagal ditambahkan'); </script>";
    }
}

#HAPUS
function DeleteRaget($id)
{
    global $db_connect;

    mysqli_query($db_connect, "DELETE FROM raget_product WHERE product_id = $id");

    mysqli_affected_rows($db_connect);
}

#SHOW PRODUCT
# code...
function query($query)
{
    global $db_connect;
    $result = mysqli_query($db_connect, $query);

    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        # code...
        $rows[] = $row;
    }
    return $rows;
}
