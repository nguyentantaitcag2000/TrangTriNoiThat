<?php
require_once('../App.php');
require_once('../DB.php');
$DB = new DB();

if (isset($_POST['id_category']) && isset($_POST['name_category'])) {

    $id_category = $_POST['id_category'];
    $name_category = $_POST['name_category'];
    $old_image_path = ''; // khởi tạo biến lưu đường dẫn ảnh cũ

    // kiểm tra nếu người dùng chọn ảnh mới
    if (isset($_FILES['image_category']) && $_FILES['image_category']['name'] != '') {

        // xử lý ảnh danh mục
        $folderImage = $_SERVER['DOCUMENT_ROOT'] . "/public/images/categories";
        $folderImage_Absolute = "/public/images/categories";
        $image_category = $_FILES['image_category'];
        $image_name = $image_category['name'];
        $image_tmp_name = $image_category['tmp_name'];
        $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
        $image_new_name = uniqid() . "." . $image_extension;
        $image_upload_path = $folderImage . '/' . $image_new_name;
        $image_upload_path_Absolute = $folderImage_Absolute . '/' . $image_new_name;

        // kiểm tra thư mục có tồn tại không
        if (!file_exists($folderImage)) {
            // nếu không tồn tại, tạo mới thư mục
            mkdir($folderImage, 0777, true);
        }

        // lấy đường dẫn ảnh cũ
        $query_select_old_image = "SELECT Icon FROM category WHERE id_category = $id_category";
        $result = mysqli_query($DB->con, $query_select_old_image);
        $old_image_path = mysqli_fetch_array($result)['Icon'];

        // upload ảnh mới
        if (move_uploaded_file($image_tmp_name, $image_upload_path)) {
            $query_update_category = "UPDATE category SET name_category = '$name_category', Icon = '$image_upload_path_Absolute' WHERE id_category = $id_category";
        } else {
            alertError("Lỗi: Upload ảnh danh mục thất bại");
        }
    } else { // không có ảnh mới được chọn
        $query_update_category = "UPDATE category SET name_category = '$name_category' WHERE id_category = $id_category";
    }

    if (mysqli_query($DB->con, $query_update_category)) {
        // xoá ảnh cũ
        if (!empty($old_image_path) && file_exists($_SERVER['DOCUMENT_ROOT'] . $old_image_path)) {
            unlink($_SERVER['DOCUMENT_ROOT'] . $old_image_path);
        }
        alertSuccess("Cập nhật thành công");
        
    } else {
        alertError("Lỗi: Cập nhật danh mục thất bại");
    }
} else {
    alertError("Lỗi: Chưa nhập đủ dữ liệu");
}
?>