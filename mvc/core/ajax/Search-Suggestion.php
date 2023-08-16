<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/mvc/core/DB.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/mvc/core/App.php');
 require_once($_SERVER['DOCUMENT_ROOT'] . '/mvc/core/Controller.php');
$DB = new DB();
$Controller = new Controller();
if(isset($_POST['query']))
{

	$search_suggestion =  $Controller->model('Option')->GetOption("search_suggestion");
	if($search_suggestion["Status"])
	{
		// Thực hiện truy vấn CSDL và lấy danh sách gợi ý tìm kiếm
		$searchQuery = $_POST['query'];
		$results = mysqli_query($DB->con,"SELECT * FROM product WHERE Name_Product LIKE '%$searchQuery%' LIMIT 10");

		// Tạo một mảng chứa các gợi ý tìm kiếm
		$suggestions = array();
		while ($row = $results->fetch_assoc()) {
		    $suggestions[] = $row['Name_Product'];
		}

		// Chuyển đổi mảng gợi ý tìm kiếm thành chuỗi JSON
		$json = json_encode($suggestions);

		// Trả về chuỗi JSON cho client
		echo $json;		
	}
	else
		echo json_encode("");		

	
}


?>