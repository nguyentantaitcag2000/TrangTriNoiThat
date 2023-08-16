<?php
require_once('../App.php');
require_once('../DB.php');
global $ck_email;
if(isset($_POST['ID'])) {
    $ID = $_POST['ID'];
    $DB = new DB();
     if(!isset($_SESSION[$ck_email]))
    {
        GO('/Auth/Signin');
    }
    $query = "DELETE FROM `shoppingcart`  WHERE `ID_Product` = '$ID' AND ID_User = (SELECT ID_User from users s WHERE Email = '$_SESSION[$ck_email]') LIMIT 1" ;
    $result = mysqli_query($DB->con, $query);
    if ($result) {
        alertSuccess("Xoá thành công");
    }
    else
        alertError("Xoá thất bại");

}
else {
    alertError("Lỗi ! Chưa nhập đủ dữ liệu");
}
?>
