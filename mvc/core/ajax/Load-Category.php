<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/mvc/core/DB.php');
$DB = new DB();

foreach (mysqli_query($DB->con,"SELECT * FROM `category` ORDER BY ID_Category DESC") as $key => $value) {?>
<tr>

  <td><img src="<?=$value['Icon']?>" class="img-fluid img-thumbnail" alt="Sheep"></td>
  <td><?=$value['Name_Category']?></td>
	<td>
    <button type="button" data-bs-toggle="modal" data-bs-target="#updateModal" data-bs-whatever="@mdo" class="btn btn-warning p-1 m-1" onclick="UpdateCategory(event,<?=$value['ID_Category']?>)"
    data-product-name="<?=$value['Name_Category']?>"
    data-product-image="<?=$value['Icon']?>"
    >Update</button>
	<button class="btn btn-danger p-1 m-1" onclick="DeleteProduct(<?=$value['ID_Category']?>)">Delete</button>
  </td>
</tr>

<?php }?>