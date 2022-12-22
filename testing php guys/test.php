<?php

session_start();

$database = mysqli_connect("localhost", "root", "", "test_query");

if (isset($_POST["testbutton"])) {
    # code...
    mysqli_query($database, "INSERT INTO testing VALUES ('', 'beli sekarang') ");
}

if (isset($_POST["testbutton2"])) {
    # code...
    mysqli_query($database, "INSERT INTO testing VALUES ('', 'masukkan keranjang')");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TESTING</title>
</head>

<body>
    <form action="testing-nextpage.php" method="POST">
        <input type="text" name="testing" value="2203">
        <button type="submit" name="testbutton2" formaction="">Masukkan Keranjang</button>
        <button type="submit" name="testbutton">Beli Sekarang</button>
    </form>
</body>

</html>