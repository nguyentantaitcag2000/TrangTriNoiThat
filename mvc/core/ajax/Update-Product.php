<?php
	require_once('../App.php');
	require_once('../DB.php');
	$DB = new DB();
	if(isset($_POST['name_product']) && isset($_POST['price_product']) && isset($_POST['description_product']) && isset($_POST['category_product'])&& isset($_POST['id_product']))
	{
		$oldImage;
		$oldDetailImage = array();
		$name_product = $_POST['name_product'];
		$description_product = $_POST['description_product'];
		$price_product = $_POST['price_product'];
		$category_product = $_POST['category_product'];
		$id_product = $_POST['id_product'];
		$size_product = isset($_POST['size_product']) ? $_POST['size_product'] : NULL; 
        $material_product = isset($_POST['material_product']) ? $_POST['material_product'] : NULL; 
		//Lấy ra đường dẫn folder chứa sản phẩm
		$row = $DB->get_row("SELECT * FROM Product WHERE ID_Product = '$id_product' ");
		if(!$row)
		{
			alertError("Sản phẩm không tồn tại");
		}
		$folderName = dirname($row['Avatar']);
		$folderImage = $_SERVER['DOCUMENT_ROOT'] . $folderName;
        $folderImage_Absolute = $folderName;
        if(isset($_FILES['image_product']) && $_FILES['image_product']['name'] != '') //Xử lí trường hợp người dùng không nhấn vào sửa ảnh đại diện
        {
        	$image_product = $_FILES['image_product'];
	        $image_name = $image_product['name'];
	        $image_tmp_name = $image_product['tmp_name'];
	        $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
	        $image_new_name = uniqid() . "." . $image_extension;
	        $image_upload_path = $folderImage . '/' . $image_new_name;
	        $image_upload_path_Absolute = $folderImage_Absolute . '/' . $image_new_name;	
        }
        
        // kiểm tra thư mục có tồn tại không
        if (!file_exists($folderImage))
        {
        	// nếu không tồn tại, tạo mới thư mục
            mkdir($folderImage, 0777, true);
        }
        //Lấy ra hình ảnh của sản phẩm và hình ảnh của sản phẩm liên quan, để tí nữa sau khi cập nhật hoàn thành sẽ xoá đi hình ảnh cũ
        $oldImage = $row['Avatar'];
        $list = $DB->get_list("SELECT Image FROM detail_product_image WHERE ID_Product = '$id_product' ");
        foreach ($list as $key => $value) {
        	$oldDetailImage[] = $value['Image'];
        }
        //Cập nhật sản phẩm
        $result = $DB->update("product",array(
        	"Name_Product" => $name_product,
        	"Description" => $description_product,
        	"Price" => $price_product,
        	"ID_Category" => $category_product,
        	"Avatar" => isset($image_upload_path_Absolute) ? $image_upload_path_Absolute: $oldImage,
        	"Material" => $material_product,
        	"Size" => $size_product
        ), " ID_Product = '$id_product'");
        //Cập nhật màu sắc
        if(isset($_POST['color_list']))
        {
        	$DB->query("DELETE FROM detail_product_color WHERE ID_Product = '$id_product' ");
            $color_list = $_POST['color_list'];
            $color_array = [];
            if($color_list != '')
            {
                $color_array = explode(',', $color_list);
            }
            if($color_array>0)
            {
                foreach ($color_array as $key => $id_color) {
                    $result = $DB->insert("detail_product_color",array(
                        "ID_Color" => $id_color,
                        "ID_Product" => $id_product
                    ));
                    if(!$result)
                    {
                        alertError("Lỗi: thêm màu sắc sản phẩm thất bại");
                    }
                }
            }
            
        }
        //
        if(isset($image_upload_path))
        {
        	//Thêm ảnh đại diện mới/cũ vào folder
	        if (move_uploaded_file($image_tmp_name, $image_upload_path)) {
	            $query = "INSERT INTO `product`
	                  VALUES (NULL,'$category_product','$name_product', '$description_product', '$price_product', '$image_upload_path_Absolute')";
	        } else {
	            alertError("Lỗi: Upload ảnh đại diện sản phẩm thất bại");
	        }
	        //Xoá đi hình ảnh cũ
	        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $oldImage)) {
	            unlink($_SERVER['DOCUMENT_ROOT'] . $oldImage);
	        }
        }
        if(isset($_FILES['detail_image_product'])) //Xử lí trường hợp người dùng không nhấn vào sửa ảnh chi tiết
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

          	
	        
        }
        //Xoá hết các ảnh chi tiết liên quan đến sản phẩm
      	$condition = ' ';
      	$stillKeepDetailImage_List = [];
      	if(isset($_POST['stillKeepDetailImage'])) // Nếu trường hợp sản phẩm đã có hình ảnh chi tiết cũ mà người dùng vẫn chưa nhấn xoá sẽ bỏ qua, không xoá trong csdl 
      	{

      		$stillKeepDetailImages = json_decode($_POST['stillKeepDetailImage']);
      		for ($i=0; $i < count($stillKeepDetailImages); $i++) { 
      			//$stillKeepDetailImages =  http://localhost:85/public/images/products/63f9e752900af/63fa0412639c26.89227349.jpg
      			$path = parse_url($stillKeepDetailImages[$i], PHP_URL_PATH);

				$pathWithoutSlash = '/' . substr($path, 1);

				// output: /public/images/products/63f9e752900af/63fa0412639c26.89227349.jpg
			    $condition = $condition . " AND Image != '".$pathWithoutSlash."'";
			    $stillKeepDetailImage_List[] = $pathWithoutSlash;
      		}
			
      	}
        mysqli_query($DB->con,"DELETE FROM detail_product_image WHERE ID_Product = '$id_product' $condition");
      	//Thêm lại ảnh mới
      	if(isset($detail_image_upload_paths_Absolute))
      	{
      		foreach ($detail_image_upload_paths_Absolute as $key => $path) {
	            $query = "INSERT INTO `detail_product_image` (`Image`, `ID_Product`) 
	                      VALUES ('$path', '$id_product')";
	            if (!mysqli_query($DB->con, $query))
	            {
	                //Nếu lỗi thì sẽ không commit, những câu insert trước nếu có thành công thì cũng sẽ không được lưu
	                alertError("Lỗi: Thêm hình ảnh thất bại");
	            }
	        }
	        //Xoá đi hình ảnh chi tiết cũ
	        foreach ($oldDetailImage as $key => $oldImage) {
	        	$flag = false;
	        	foreach ($stillKeepDetailImage_List as $key => $src) {
	      			if($src == $oldImage)
	      			{
	      				$flag = true;
	      				break;
	      			}
	      		}
	      		if(!$flag)
	      		{
	      			if (file_exists($_SERVER['DOCUMENT_ROOT'] . $oldImage)) {
			            unlink($_SERVER['DOCUMENT_ROOT'] . $oldImage);
			        }	
	      		}
	        	
	        }
      	}
        alertSuccess("Cập nhật thành công");	
		// /* set autocommit to off */
		// $DB->con->autocommit(FALSE);
		// $stmp = $DB->con->prepare("UPDATE `product` SET Name = ?, Description = ?, Price = ?, ID_Category = ?, Avatar =  ? WHERE ID = ?");
		// $stmp->bind_param('sssisi',$name_product,$description_product,$price_product,$category_product,$image_product,$id_product);
	    // if (!$stmp->execute())
	    // {
	    // 	alertError("Lỗi: Cập nhật sản phẩm thất bại");
	    // }
	    // //Clear all old images
	    // $stmp = $DB->con->prepare('DELETE FROM `detail_product_image` WHERE ID_Product = ?');
		// $stmp->bind_param('i',$id_product);
		// if (!$stmp->execute())
	    // {
	    // 	alertError("Lỗi: Clear hình ảnh chi tiết thất bại");
	    // }
	    // //Add new
	    // if(isset($_POST['detail_image_product'])){
	    // 	$detail_image_product = $_POST['detail_image_product'];
	    // 	foreach ($detail_image_product as $key => $image) {
	    // 		$stmp = $DB->con->prepare('INSERT INTO `detail_product_image` VALUES (NULL,?,?)');
		// 		$stmp->bind_param('si',$image,$id_product);
		// 	    if (!$stmp->execute())
		// 	    {
		// 	    	//Nếu lỗi thì sẽ không commit, những câu insert trước nếu có thành công thì cũng sẽ không được lưu
		// 	    	alertError("Lỗi: Thêm hình ảnh chi tiết thất bại");
		// 	    }
			   
	    // 	}
	    // }
	    // // Nếu không có lỗi gì thì sẽ submit
		// $DB->con->commit();
	    // alertSuccess("Cập nhật thành công");	
	    
	}
	else
	{
	    alertError("Lỗi ! Chưa nhập đủ dữ liệu");

	}

?>