<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/mvc/core/DB.php');
	$DB = new DB();
	if(isset($_POST['ID_Product']))
	{
		$result = mysqli_query($DB->con,"SELECT * FROM detail_product_image WHERE ID_Product = ".$_POST['ID_Product']."");
		if(!$result)
		{
			die('ERROR: Truy vấn lỗi');
		}
		$return = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $return[] = $row;
        }
        mysqli_free_result($result);
        die(json_encode($return)) ;
	}
	else
	{
		die('ERROR: NOT FOUND PRODUCT ID !');
	}
?>