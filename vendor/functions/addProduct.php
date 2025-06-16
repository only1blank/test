<?php
require_once "../components/core.php";
if ($_POST && $_FILES) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $uploaddir = "../../uploads/";
    $uploadfile = $uploaddir . basename($_FILES['image']['name']);
    $img = basename($_FILES['image']['name']);
}
    if ('image' == substr($_FILES['image']['type'], 0, 5)) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
            $link->query("INSERT INTO `products`( `image`, `name`, `price`) VALUES ('$img','$name','$price')");
        }
    }
    header('Location: ../../Shop/market.php')

?>