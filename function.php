<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "library";

try {
    $link = mysqli_connect($host, $user, $pass, $db);
} catch (Exception $e) {
    echo $e->getMessage();
}



//Konfigurasi 

//jumlah data yang ingin ditampilkan perhalaman
$jumlahDataPerHalaman = 8;

//hitung jumlah data yang ada 
$jumlahData = count(get("SELECT * FROM product"));

/*tentukan jumlah halaman dengan membagi jumlah data dengan jumlah data yang ingin
ditampilkan perhalaman*/
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

//tentukan halaman yang sedang aktif menggunakan request method GET 
$halamanAktif = (isset($_GET['page'])) ? $_GET['page']  : 1;

//tentukan awal data dengan pengalian jumlah halaman dengan halaman aktif di kurang jumlah halaman
$awalData = ($jumlahHalaman * $halamanAktif) - $jumlahHalaman;

function get($query)
{
    global $link;
    $result = mysqli_query($link, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
function register($user, $pass)
{
    global $link;
    $usern = strtolower(stripslashes($user));
    $passw = password_hash($pass, PASSWORD_DEFAULT);
    mysqli_query($link, "INSERT INTO user (username,pass) VALUES('$usern','$passw')");

    echo "<script>alert('user berhasil registrasi')</script>";
}

function login($user, $pass)
{
    global $link;
    $sql = mysqli_query($link, "SELECT * FROM user where username = '$user'");
    while ($res = mysqli_fetch_assoc($sql)) {
        if (password_verify($pass, $res['pass'])) {
            $_SESSION['isLoggin'] = true;
            header("Location:dashboard.php");
        } else {
            $error = true;
        }
    }
}

function search($keyword)
{
    global $link;
    $sql = "SELECT * FROM product WHERE product_name LIKE '%$keyword%' OR color LIKE '%$keyword%' OR category LIKE '%$keyword%' OR price LIKE '%$keyword%'";
    return get($sql);
}


function update($name, $color, $category, $price, $id)
{
    global $link;
    mysqli_query($link, "UPDATE product SET product_name = '$name', color = '$color', category = '$category', price = '$price' WHERE id = '$id'");
    if (mysqli_affected_rows($link) > 0) {
        echo "<script>alert('data berhasil diperbarui')</script>";
        header("Location:dashboard.php");
        exit;
    } else {
        echo "<script>alert('data berhasil di perbarui')</script>";
        return false;
    }
}


function put($name, $color, $category, $price)
{
    global $link;
    mysqli_query($link, "INSERT INTO product (product_name, color, category, price,) values ('$name','$color','$category','$price')");
    if (mysqli_affected_rows($link) > 0) {
        echo "<script>alert('data berhasil di masukkan')</script>";
        header("Location:dashboard.php");
        exit;
    } else {
        echo "<script>alert('data berhasil di perbarui')</script>";
        return false;
    }
}
