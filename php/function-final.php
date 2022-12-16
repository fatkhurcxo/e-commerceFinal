<?php


// CONNECT TO DATABASE NAME

$dconn = mysqli_connect("localhost", "root", "", "raget_bags");

// FUNCTION REGISTER
function registerRaget($data)
{

    global $dconn;

    $username = strtolower(stripslashes($data["reg-uname"]));
    $password = mysqli_real_escape_string($dconn, $data["reg-pass"]);
    $password2 = mysqli_real_escape_string($dconn, $data["password2"]);


    //  CEK USERNAME AVAILABLE

    $cek_username = mysqli_query($dconn, "SELECT username FROM akun WHERE username = '$username'");
    if (mysqli_fetch_assoc($cek_username)) {
        # code...
        echo "<script> alert('Username telah terdaftar, mohon gunakan username lain!'); </script>";

        return false;
    }
    // CEK PASSWORD MATCH
    if ($password !== $password2) {
        # code...
        echo "<script> alert('Password yang anda masukkan tidak sesuai'); </script>";

        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($dconn, "INSERT INTO akun (id_akun, username, password, level)
                            VALUES ('', '$username', '$password', 1001)
                                ");

    return mysqli_affected_rows($dconn);
}


// FUNCTION LOGIN
function loginRaget($data)
{
    global $dconn;

    $username = $data["username"];
    $password = $data["password"];

    // MENGAMBIL SEMUA DATA YANG SESUAI DENGAN INPUTAN
    $cek_username = mysqli_query($dconn, "SELECT * FROM akun WHERE username = '$username'");

    if (mysqli_num_rows($cek_username) === 1) {
        # code...

        $row = mysqli_fetch_assoc($cek_username);
        if (password_verify($password, $row["password"])) {
            # code...

            if ($row['level'] === '1001') {
                # code...
                session_start();
                $_SESSION["logged_akun"] = mysqli_fetch_assoc($cek_username);
                $_SESSION["id_akun"] = $row["id_akun"];
                $_SESSION["customer"] = true;
                header("location:index.php");
                exit;
            } elseif ($row['level'] === '1002') {
                # code...
                session_start();
                $_SESSION["admin"] = true;
                header("location:admin-raget.php");
                exit;
            } else {
                # code...
                echo "<script> alert('Akun anda tidak ter-identifikasi!!!');
                                document.location.href = 'user-login.php';
                        </script>";
            }
        }
    }

    $error = true;

    if (isset($error)) {
        # code...
        echo "<script> alert('Username atau password yang anda masukkan salah!'); </script>";
    }
}


// FUNCTION LOGOUT
function logoutRaget()
{
    session_destroy();
    echo "<script> alert('Anda keluar!');
                    document.location.href = 'user-login.php';
            </script>";
    exit();
}

// FUNCTION TAMBAH GAMBAR
function addAvatar($image)
{
    global $dconn;

    $avatar = uploadAvatar();

    if (!$avatar) {
        # code...
        return false;
    }

    $id_logged = $_SESSION["id_akun"];
    $query = "UPDATE akun SET avatar = '$avatar' WHERE akun.id_akun = $id_logged";

    mysqli_query($dconn, $query);

    return mysqli_affected_rows($dconn);
}

// FUNCTION UPLOAD ( FILE HANDLING)
function uploadAvatar()
{
    $fileName = $_FILES['user-profile']['name'];
    $fileSize = $_FILES['user-profile']['size'];
    $error = $_FILES['user-profile']['error'];
    $tmpName = $_FILES['user-profile']['tmp_name'];

    if ($error === 4) {
        # code...
        echo "<script> alert('Pilih gambar terlebih dahulu!'); </script>";
        return false;
    }

    $validExtension = ['jpg', 'jpeg', 'png'];
    $exImage = explode('.', $fileName);
    $exImage = strtolower(end($exImage));

    if (!in_array($exImage, $validExtension)) {
        # code...
        echo "<script> alert('Format file anda tidak sesuai!'); </script>";
        return false;
    }

    if ($fileSize > 2000000) {
        # code...
        echo "<script> alert('Ukuran file terlalu besar!'); </script>";
        return false;
    }

    $imageUploadName = uniqid();
    $imageUploadName .= '.';
    $imageUploadName .= $exImage;
    move_uploaded_file($tmpName, '../img-assets/user-profile/' . $imageUploadName);

    return $imageUploadName;
}

// SHOW PRODUCT ON LOOP
function showData($query)
{
    global $dconn;

    $result = mysqli_query($dconn, $query);

    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        # code...
        $rows[] = $row;
    }
    return $rows;
}

// SHOW DATA OF TABLE
function showDataTable($query)
{
    global $dconn;

    $result = mysqli_query($dconn, $query);

    $tableAkun = mysqli_fetch_assoc($result);

    return $tableAkun;
}

// FUNCTION TAMBAH BARANG KE KERANJANG
function addProduk($dataProduk)
{
    global $dconn;

    $id_akun = $dataProduk["id_akun"];
    $namaProduk = $dataProduk["nama_produk"];
    $hargaProduk = $dataProduk["harga_produk"];

    $query = "INSERT INTO keranjang_belanja (id_keranjangBelanja, nama_produk, harga, id_akun) VALUES ('', '$namaProduk', '$hargaProduk', '$id_akun')";

    mysqli_query($dconn, $query);
}


// TAMBAH BARANG
function tambahBarang($dataBarang)
{
    global $dconn;

    $idAkun = $dataBarang["idAkun"];
    $idPoduk = $dataBarang["idProduk"];
    $heroImg = $dataBarang["heroImg"];
    $namaProduk = $dataBarang["namaProduk"];
    $hargaProduk = $dataBarang["hargaProduk"];
    $varianProduk = $dataBarang["selected-varian"];
    $jumlahBarang = $dataBarang["jumlahBarang"];

    // Total
    $total = $hargaProduk * $jumlahBarang;
    if ($jumlahBarang <= "0") {
        # code...
        echo "<script> alert('Mohon masukkan jumlah barang yang valid!'); </script>";
        return false;
    }

    $query = "INSERT INTO keranjang_belanja
                VALUES ('', '$heroImg', '$namaProduk', $hargaProduk, '$varianProduk', $jumlahBarang, $total, $idPoduk, $idAkun )";

    mysqli_query($dconn, $query);

    return mysqli_affected_rows($dconn);
}

// TAMBAH DATA CUSTOMER
function dataCustomer($dataCustomer)
{
    global $dconn;

    $id_akun = $dataCustomer["id_akun"];
    $nama_customer = $dataCustomer["nama_customer"];
    $email = $dataCustomer["email"];
    $nomor_hp = $dataCustomer["nomor_hp"];
    $alamat = $dataCustomer["alamat"];

    $query = "INSERT INTO customer VALUES ('', $id_akun, '$nama_customer', '$email', '$nomor_hp', '$alamat')";

    mysqli_query($dconn, $query);

    return mysqli_affected_rows($dconn);
}

// UBAH DATA CUSTOMER
function ubahDataCustomer($ubahdataCustomer)
{
    global $dconn;

    $id_akun = $ubahdataCustomer["id_akun"];
    $nama_customer = $ubahdataCustomer["nama_customer"];
    $email = $ubahdataCustomer["email"];
    $nomor_hp = $ubahdataCustomer["nomor_hp"];
    $alamat = $ubahdataCustomer["alamat"];

    $query = "UPDATE customer
                SET nama_customer='$nama_customer', email='$email', nomor_hp='$nomor_hp', alamat='$alamat'
                    WHERE id_akun=$id_akun";

    mysqli_query($dconn, $query);

    return mysqli_affected_rows($dconn);
}


// DELETE KERANJANG
function deleteKeranjang($idKeranjang)
{
    global $dconn;

    $query = "DELETE FROM keranjang_belanja WHERE id_keranjangBelanja = $idKeranjang";

    mysqli_query($dconn, $query);

    $script = "<script> window.history.back(); </script>";

    echo $script;
}
