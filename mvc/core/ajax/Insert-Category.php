<?php
	require_once('../App.php');
	require_once('../DB.php');
	$DB = new DB();
    
	if(isset($_FILES['image_category']) && $_FILES['image_category']['name'] != '' && isset($_POST['name_category']))
	{

		$name_category = $_POST['name_category'];
		
		// process uploaded avatar image
        $folderImage = $_SERVER['DOCUMENT_ROOT'] . "/public/images/categories";
        $folderImage_Absolute = "/public/images/categories";
        $image_product = $_FILES['image_category'];
        $image_name = $image_product['name'];
        $image_tmp_name = $image_product['tmp_name'];
        $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
        $image_new_name = uniqid() . "." . $image_extension;
        $image_upload_path = $folderImage . '/' . $image_new_name;
        $image_upload_path_Absolute = $folderImage_Absolute . '/' . $image_new_name;

        // kiểm tra thư mục có tồn tại không
        if (!file_exists($folderImage)) {
            // nếu không tồn tại, tạo mới thư mục
            mkdir($folderImage, 0777, true);
        }
        if (move_uploaded_file($image_tmp_name, $image_upload_path)) {
            $query = "INSERT INTO `category`
                  VALUES (NULL,'$name_category','$image_upload_path_Absolute')";
        } else {
            alertError("Lỗi: Upload ảnh sản phẩm thất bại");
        }
        if(mysqli_query($DB->con, $query))
	    	alertSuccess("Thêm thành công");	
	    else
            alertError("Lỗi: Thêm danh mục thất bại");
	}
	else
	{
        alert('ádasd');

	    alertError("Lỗi ! Chưa nhập đủ dữ liệu");

	}

?>