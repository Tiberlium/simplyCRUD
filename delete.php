<?php
if(isset($_SESSION['isLoggin'])){
    header("Location:index.php");
}

require 'function.php';
$id = $_GET['id'];

$sql = mysqli_query($link, "DELETE FROM product WHERE id = '$id'");

header("Location:dashboard.php");

exit;
