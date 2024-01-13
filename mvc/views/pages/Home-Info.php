<div id="thongbao"></div>
<div class="container p-5 mt-5 bg-light" style="border-radius: 25px;">
	<div class="row w-100">
		<div class="col-sm-4">
			<div class="container p-3">
				<div class="row border w3-animate-zoom">
					<img src="<?=$data['Product']['Avatar']?>" >
				</div>
				<div class="row border">
					<?php foreach ($data['Detail_Product_Image'] as $key => $value) { ?>
						<img class="border w3-animate-zoom" style="width:120px" src="<?=$value['Image']?>">
					<?php }?>
				</div>	
			</div>
		</div>
		<div class="col-sm-8 w3-animate-bottom">
			<input value="<?=$data['Product']['ID_Product']?>" id="product_id" hidden>
			<h1><?=$data['Product']['Name_Product']?></h1>
			<p class="text-danger h3"><strong><?=number_format($data['Product']['Price'],0).' đ'?></strong></p>
			<form method="POST" action="/Home/Checkout/<?=$data['Product']['ID_Product']?>">
				<span><b>Màu sắc:</b> <?=$data['Product']['Name_Color']?></span><br>
				<span><b>Kích thước:</b> <?=$data['Product']['Size'] == NULL ? "Không xác định" : $data['Product']['Size']?></span><br>
				<span><b>Chất liệu:</b> <?=$data['Product']['Name_Material'] == NULL ? "Không xác định" : $data['Product']['Name_Material'] ?></span><br>
				<div class="row g-3 align-items-center">
				  <div class="col-auto">
				    <label for="inputPassword6" class="col-form-label">Số lượng</label>
				  </div>
				  <div class="col-auto">
				    <div class="input-group" style="width:50%">
	                    <span class="input-group-btn">
	                        <button class="btn btn-white btn-minuse" type="button">-</button>
	                    </span>
	                    <input id="amount" name="amount" type="text" class="form-control no-padding add-color text-center height-25" maxlength="3" value="1">
	                    <span class="input-group-btn">
	                        <button class="btn btn-red btn-pluss" type="button">+</button>
	                    </span>
	                </div><!-- /input-group -->
				  </div>
				  <button class="btn btn-primary" onclick="AddCart(event)"><i class="fas fa-shopping-cart me-2" ></i>Đặt vào giỏ hàng</button>
				  
				  <input class="btn btn-success" value="Mua" type="submit" >
				  
				</div>	
			</form>
			
		</div>
	</div>
	<div class="row ms-0 mt-5 w3-animate-bottom">
		<div class="row border" data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="50" style="position: relative;">
			<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
			  <div class="container-fluid">
			    <ul class="navbar-nav">
			      <li class="nav-item">
			        <a class="nav-link" href="#section1">Thông tin sản phẩm</a>
			      </li>
			    <!--   <li class="nav-item">
			        <a class="nav-link" href="#section2">Section 2</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="#section3">Section 3</a>
			      </li> -->
			    </ul>
			  </div>
			</nav>

			<div id="section1" class="container-fluid bg-light text-dark" style="padding:100px 20px;">
			  <h1>Thông tin sản phẩm</h1>
			  <div>
			  	<?=$data['Product']['Description']?>
			  </div>
			</div>

			<!-- <div id="section2" class="container-fluid bg-warning" style="padding:100px 20px;">
			  <h1>Section 2</h1>
			  <p>Try to scroll this section and look at the navigation bar while scrolling! Try to scroll this section and look at the navigation bar while scrolling!</p>
			  <p>Try to scroll this section and look at the navigation bar while scrolling! Try to scroll this section and look at the navigation bar while scrolling!</p>
			</div>

			<div id="section3" class="container-fluid bg-secondary text-white" style="padding:100px 20px;">
			  <h1>Section 3</h1>
			  <p>Try to scroll this section and look at the navigation bar while scrolling! Try to scroll this section and look at the navigation bar while scrolling!</p>
			  <p>Try to scroll this section and look at the navigation bar while scrolling! Try to scroll this section and look at the navigation bar while scrolling!</p>
			</div> -->
		</div>
	</div>
	<div class="container bg-light rounded pt-2 mt-3">
        <div class="row">
            <h3 class="h3 w3-animate-opacity">Các sản phẩm có liên quan</h3>    
        </div>
        <div class="row w-100">
            <?php foreach ($data['Product_Suggestion'] as $key => $value) { 
                $title = $value['Name_Product'];
                if (strlen($value['Name_Product']) > 34) {
                  $title = mb_substr($value['Name_Product'], 0, 34) . "...";
                }
                ?>
               <div class="col-md-2 col-sm-6 bg-light pt-3 border-end border-2 rounded rounded-3 w3-animate-bottom-08 mt-3 mb-4">
                    <div class="product-grid2">
                        <div class="product-image2">
                            <a href="/Home/Info/<?=$value['ID_Product']?>">
                                <img class="pic-1" src="<?= $value['Avatar']?>">
                            </a>
                            <ul class="social">
                                <li><a href="#" data-tip="Quick View"><i class="fa fa-eye"></i></a></li>
                                <li><a href="#" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                            <a class="add-to-cart" href="">Add to cart</a>
                        </div>
                        <div class="product-content">
                            <h3 class="title"><a href="#"><?=$title?></a></h3>
                            <span class="price"><?=number_format($value['Price'],0) . ' đ'?></span>
                        </div>
                    </div>
                </div> 
            <?php }?>
            

        </div>
    </div>
</div>

<script>
	function AddCart(event)
	{
		event.preventDefault();
		var productID =  document.getElementById('product_id').value;
		var amount =  document.getElementById('amount').value;
		$.ajax({
			url:"../../../mvc/core/ajax/AddCard.php",
			method:'POST',
			data: {productID:productID, amount:amount},
			success:function(res){
				$('#thongbao').html(res);
				$amount = $('#count_product_in_cart').html();
				$amount = Number($amount) + 1;
				$('#count_product_in_cart').html($amount);
			}
		})
	}
	$('.btn').on('click',function(){
	    $input = null; 
	    if($(this).hasClass('btn-minuse'))
	        $input = $(this).parent().next();
	    else
	        $input = $(this).parent().prev();

	    $val = $input.val();

	    if ($(this).hasClass('btn-minuse')) {
	     if($val >1)
	        $input.val(parseInt($val)-1);
	    } else {
	    $input.val(parseInt($val)+1);
    }
});
</script>