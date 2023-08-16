<?php
require_once('../App.php');
require_once('../DB.php');

if(isset($_POST['ID'])) {
    $ID = $_POST['ID'];
    $DB = new DB();
    $query = "SELECT `Image` FROM `detail_product_image` WHERE `ID_Product` = $ID";
    $result = mysqli_query($DB->con, $query);
    if ($result) {
        while ($row = mysqli_fetch_array($result)) {
            // Delete detail product image file
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . $row['Image'])) {
                unlink($_SERVER['DOCUMENT_ROOT'] . $row['Image']);
            }
        }
    }

    // Delete detail product images from the database
    $query = "DELETE FROM `detail_product_image` WHERE `ID_Product` = $ID";
    mysqli_query($DB->con, $query);

    // Get product image path
    $query = "SELECT `Avatar` FROM `product` WHERE `ID_Product` = $ID";
    $result = mysqli_query($DB->con, $query);
    if ($result) {
        $row = mysqli_fetch_array($result);
        $product_image_path = $_SERVER['DOCUMENT_ROOT'] . $row['Avatar'];

        // Delete product image file
        if (file_exists($product_image_path)) {
            unlink($product_image_path);
        }
    }

    // Delete product from the database
    $query = "DELETE FROM `product` WHERE `ID_Product` = $ID";
    mysqli_query($DB->con, $query);

    // Delete product folder
    $product_folder_path = dirname($product_image_path);
    if (is_dir($product_folder_path)) {
        rmdir($product_folder_path);
    }

    alertSuccess("Xoá thành công");
}
else {
    alertError("Lỗi ! Chưa nhập đủ dữ liệu");
}
?>
