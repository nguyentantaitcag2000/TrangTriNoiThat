<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/mvc/core/DB.php');
$DB = new DB();
if(!isset($data))
{
	require_once('../Controller.php');
	require_once('../App.php');
	$Controller = new Controller();
	$product = $Controller->model('Product');

	$result = $product->GetProducts();
  $data['ListProduct'] = $result;
}
foreach ($data['ListProduct'] as $key => $value) {
  $description = mb_substr($value['Description'], 0, 65) . "...";
  ?>
<tr>
  <td><?=$value['ID_Product']?></td>
  <td class="w-25 container">
      <div class="container">
        <div class="row">
          <div class="col">
              <img src="<?=$value['Avatar']?>" class="img-fluid img-thumbnail" alt="Sheep" style="width:100px">
          </div>
          <div class="col">
              <?php foreach (mysqli_query($DB->con,"SELECT * FROM `detail_product_image` WHERE ID_Product = ".$value['ID_Product']." LIMIT 2 ") as $key2 => $detailImage) { ?>
                <div class="row">
                  <img src="<?=$detailImage['Image']?>" class="img-fluid img-thumbnail" alt="Sheep" style="width:50px">
                </div>
              <?php }?>
          </div>
        </div>
      </div>
  </td>
  <td><?=$value['Name_Product']?></td>
  <td><?=$value['Name_Color']?></td>
  <td><?=$description?></td>
  <td><?=format_cash($value['Price'])?></td>
  <td><?=$value['Name_Category']?></td>
  <td>

  	<button type="button" data-bs-toggle="modal" data-bs-target="#updateModal" data-bs-whatever="@mdo" class="btn btn-warning p-1 m-1" onclick="UpdateProduct(event,<?=$value['ID_Product']?>)"
      data-product-name="<?=$value['Name_Product']?>"
      data-product-description="<?=$value['Description']?>"
      data-product-price="<?=$value['Price']?>"
      data-product-category="<?=$value['ID_Category']?>"
      data-product-image="<?=$value['Avatar']?>"
      data-product-id_colors="<?=$value['ID_Color']?>"
      data-product-size="<?=$value['Size']?>"
      data-product-material="<?=$value['Material']?>"
      >Update</button>
  	<button class="btn btn-danger p-1 m-1" onclick="DeleteProduct(<?=$value['ID_Product']?>)">Delete</button>
  </td>
</tr>

<?php }?>