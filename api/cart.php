<?php
// Start the session
session_start();
require dirname(__FILE__) . "/../../include/dbConnect.php";
require 'item.php';

if (isset($_GET['id']) && !isset($_POST['update'])) {
    $sql = "SELECT * FROM product WHERE id=" . $_GET['id'];
    $result = mysqli_query($con, $sql);
    $product = mysqli_fetch_object($result);
    $item->id = $product->id;
    $item->nama = $product->nama;
    $item->harga = $product->harga;
    $stokItem = $product->stok;
    $item->stok = 1;

    $cart = unserialize(serialize($_SESSION['cart'])); // set $cart as an array, unserialize() converts a string into array
    for ($i = 0; $i < count($cart); $i++) {
        if ($cart[$i]->id == $_GET['id']) {
            $index = $i;
            break;
        }
    }

    if ($index == -1) {
        $_SESSION['cart'][] = $product;
    }
    // $_SESSION['cart']: set $cart as session variable
    else {

        if (($cart[$index]->stok) < $stokItem) {
            $cart[$index]->stok++;
        }

        $_SESSION['cart'] = $cart;
    }
}
