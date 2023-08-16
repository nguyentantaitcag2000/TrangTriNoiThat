<?php
    require_once('../App.php');
    require_once('../DB.php');
    $DB = new DB();

    if(isset($_POST['ID'])) {
        $id = $_POST['ID'];
        // lấy thông tin danh mục
        $result = mysqli_query($DB->con, "SELECT * FROM `category` WHERE `ID_Category` = '$id'");
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $imagePath = $row['Icon'];
            // xóa danh mục
            $query = "DELETE FROM `category` WHERE `ID_Category` = '$id'";
            if(mysqli_query($DB->con, $query)) {
                // xóa ảnh danh mục
                if(file_exists($_SERVER['DOCUMENT_ROOT'].$imagePath)) {
                    unlink($_SERVER['DOCUMENT_ROOT'].$imagePath);
                }
                alertSuccess("Xóa thành công");
            }
            else {
                alertError("Lỗi: Xóa danh mục thất bại");
            }
        }
        else {
            alertError("Không tìm thấy danh mục");
        }
    }
    else {
        alertError("Lỗi ! Chưa nhập đủ dữ liệu");
    }
?>