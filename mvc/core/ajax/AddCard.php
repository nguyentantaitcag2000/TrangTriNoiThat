<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/mvc/core/DB.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/mvc/core/App.php');
	$DB = new DB();
    //Kiểm tra nếu người dùng chưa đăng nhập thì chuyển sang trang login
    if(!isset($_SESSION['email'])){
        GO('/Auth/Login');
    }
	if(isset($_POST['productID']) && isset($_POST['amount']))
	{

		$productID = $_POST['productID'];
		$amount = $_POST['amount'];
		//Get ID User
		$result = mysqli_query($DB->con,"SELECT * FROM users WHERE Email = '".$_SESSION['email']."'");
		if(!$result)
		{
			alertError("Lỗi truy vấn user");

		}
		if(mysqli_num_rows($result) == 0)
		{
			alertError('User is not existed');
		}
		$return = mysqli_fetch_array($result);
		$ID_User = $return['ID_User'];

		$result = mysqli_query($DB->con,"INSERT INTO shoppingcart VALUES('".$productID."','".$return['ID_User']."',NULL, '".$amount."')");
		if(!$result)
		{
			alertError("Lỗi truy vấn thêm vào giỏ hàng");

		}
	    alertSuccess("Đã thêm vào giỏ hàng thành công");	
	}
	else
	{
	    alertError("Lỗi ! Chưa nhập đủ dữ liệu");

	}

?>