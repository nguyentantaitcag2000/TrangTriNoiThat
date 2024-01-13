<?php
    require_once('../App.php');
    require_once('../DB.php');
    $DB = new DB();
    
    if(isset($_FILES['image_product']) && $_FILES['image_product']['name'] != '' && isset($_POST['name_product']) && isset($_POST['price_product']) && isset($_POST['description_product']) && isset($_POST['category_product']))
    {


        $name_product = $_POST['name_product'];
        $description_product = $_POST['description_product'];
        $price_product = $_POST['price_product'];
        $category_product = $_POST['category_product'];
        $size_prodict = isset($_POST['size_product']) ? $_POST['size_product'] : NULL; 
        $material_product = isset($_POST['material_product']) ? $_POST['material_product'] : NULL; 
        // process uploaded avatar image
        $folderName = uniqid();
        $folderImage = $_SERVER['DOCUMENT_ROOT'] . "/public/images/products/". $folderName;
        $folderImage_Absolute = "/public/images/products/". $folderName;
        $image_product = $_FILES['image_product'];
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
            $query = "INSERT INTO `product`
                  VALUES (NULL,'$category_product','$name_product', '$description_product', '$price_product', '$image_upload_path_Absolute','$size_prodict','$material_product')";
        } else {
            alertError("Lỗi: Upload ảnh sản phẩm thất bại");
        }
        

        if (mysqli_query($DB->con, $query)) {
            $ID_last_product = mysqli_insert_id($DB->con); // Đây sẽ trả về ID của sản phẩm phía trên khi được tạo ra từ AUTO_INCREMENT
            //Thêm màu sắc
            if(isset($_POST['color_list']))
            {

                $color_list = $_POST['color_list'];
                $color_array = [];
                if($color_list != '')
                {
                    $color_array = explode(',', $color_list);
                }
                if(count($color_array)>0)
                {
                    foreach ($color_array as $key => $id_color) {
                        $result = $DB->insert("detail_product_color",array(
                            "ID_Color" => $id_color,
                            "ID_Product" => $ID_last_product
                        ));
                        if(!$result)
                        {
                            alertError("Lỗi: thêm màu sắc sản phẩm thất bại");
                        }
                    }
                }
                else
                {

                    $result = $DB->insert("detail_product_color",array(
                            "ID_Color" => 0,
                            "ID_Product" => $ID_last_product
                        ));
                    if(!$result)
                    {
                        alertError("Lỗi: thêm màu sắc sản phẩm thất bại");
                    }
                }
                
            }
            //
             //Thêm màu sắc
             if(isset($_POST['material_list']))
             {
 
                 $material_list = $_POST['material_list'];
                 $material_array = [];
                 if($material_list != '')
                 {
                     $material_array = explode(',', $material_list);
                 }
                 if(count($material_array)>0)
                 {
                     foreach ($material_array as $key => $id_material) {
                         $result = $DB->insert("detail_product_material",array(
                             "ID_Material" => $id_material,
                             "ID_Product" => $ID_last_product
                         ));
                         if(!$result)
                         {
                             alertError("Lỗi: thêm chất liệu sản phẩm thất bại");
                         }
                     }
                 }
                 else
                 {
 
                     $result = $DB->insert("detail_product_material",array(
                             "ID_Material" => 0,
                             "ID_Product" => $ID_last_product
                         ));
                     if(!$result)
                     {
                         alertError("Lỗi: thêm chất liệu sản phẩm thất bại");
                     }
                 }
                 
             }
             //
            if(isset($_FILES['detail_image_product']))
            {

               // Lấy thông tin các file ảnh chi tiết được upload lên
                $detail_image_files = $_FILES['detail_image_product'];
                $detail_image_names = $detail_image_files['name'];
                $detail_image_tmp_names = $detail_image_files['tmp_name'];

                // Lấy thông tin phần mở rộng của các file ảnh
                $detail_image_extensions = array();
                foreach ($detail_image_names as $detail_image_name) {
                    $extension = pathinfo($detail_image_name, PATHINFO_EXTENSION);
                    array_push($detail_image_extensions, $extension);
                }

                // Tạo tên mới cho các file ảnh
                $detail_image_new_names = array();
                foreach ($detail_image_extensions as $extension) {
                    $new_name = uniqid('', true) . '.' . $extension;
                    array_push($detail_image_new_names, $new_name);
                }
                // Tạo đường dẫn upload cho các file ảnh
                $detail_image_upload_paths = array();
                $detail_image_upload_paths_Absolute = array();
                foreach ($detail_image_new_names as $new_name) {
                    $upload_path = $folderImage . '/' . $new_name;
                    $upload_path_Absolute = $folderImage_Absolute . '/' . $new_name;
                    array_push($detail_image_upload_paths, $upload_path);
                    array_push($detail_image_upload_paths_Absolute, $upload_path_Absolute);

                }
                    
                // Upload các file ảnh lên thư mục đã chỉ định
                $detail_image_upload_result = array();
                foreach ($detail_image_tmp_names as $key => $detail_image_tmp_name) {
                    $upload_result = move_uploaded_file($detail_image_tmp_name, $detail_image_upload_paths[$key]);
                    array_push($detail_image_upload_result, $upload_result);

                    if (!$upload_result) {
                        alertError("Detail image file upload failed");
                    }
                }
              
                foreach ($detail_image_upload_paths_Absolute as $key => $path) {
                    $query = "INSERT INTO `detail_product_image` (`Image`, `ID_Product`) 
                              VALUES ('$path', '$ID_last_product')";
                    if (!mysqli_query($DB->con, $query))
                    {
                        //Nếu lỗi thì sẽ không commit, những câu insert trước nếu có thành công thì cũng sẽ không được lưu
                        alertError("Lỗi: Thêm hình ảnh thất bại");
                    }
                }
            }
            // Nếu không có lỗi gì thì sẽ submit
            $DB->con->commit();
            alertSuccess("Thêm thành công"); 
        } else {
            alertError("Lỗi: Thêm sản phẩm thất bại");
        }
    }
    else
    {
        alertError("Lỗi ! Chưa nhập đủ dữ liệu");

    }
?>