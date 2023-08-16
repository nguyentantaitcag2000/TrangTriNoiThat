<style>






.col-cart{
  background: #fffefb;
    box-shadow: 0 1px 1px 0 rgb(0 0 0 / 5%);
    border-top: 1px solid #f1f0ed;
    padding-top: 15px;
    display: grid;
    grid-template-columns: 1fr -webkit-max-content -webkit-max-content;
    grid-template-columns: 1fr max-content max-content;
    grid-template-rows: auto;
    grid-column-gap: 10px;
}




input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;

}









</style>


<div class="row" style="height: 100vh;">
  <div class="col-75">
    <div class="container justify-content-center">
      <form action="/Home/Order" method="POST" style="width:80%">
      
        <div class="row">
          <div class="col-50">
            <h3>Thông tin thanh toán</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" placeholder="Full Name" required>
           
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="Address" required>
            <label for="sdt"><i class="fa fa-phone"></i> Số điện thoại</label>
            <input type="text" id="sdt" name="sdt" placeholder="Số điện thoại" required>
            <label for="exampleFormControlTextarea1">Ghi chú (nếu có)</label>
            <textarea class="form-control" name="note" id="exampleFormControlTextarea1" rows="3"></textarea>
          

          <div class="col-50">
            <h3>Phương thức thanh toán</h3>
            <div class="form-check">
              <input class="form-check-input" type="radio" value="" id="defaultCheck1" checked>
              <label class="form-check-label" for="defaultCheck1">
                Thanh toán khi nhận hàng
              </label>
            </div>
          
          </div>

    		  <div class="col-cart p-3">
      			<div class>
      				<h4>Các sản phẩm: <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?=count($data['ListShoppingCarts'] )?></b></span></h4>
              <?php foreach ($data['ListShoppingCarts'] as $key => $value) { ?>
                <p><a href="#"><?=$value['Name_Product']?> (<?=$value['Amount']?>)</a> <span class="price"><?=$value['Price']?></span></p>  
                <input type="hidden" name="ListShoppingCarts[<?=$key?>][ID_Product]" value="<?= $value["ID_Product"] ?>">
                <input type="hidden" name="ListShoppingCarts[<?=$key?>][Amount]" value="<?= $value["Amount"] ?>">
                <input type="hidden" name="ListShoppingCarts[<?=$key?>][Price]" value="<?= $value["Price"] ?>">
              <?php }?>
      				<hr>
      				<p>Tổng tiền sản phẩm <span class="price" style="color:black"><b><?=$data['total_money']?> VND</b></span></p>
              <p>VAT  <span class="price" style="color:black"><b>8%</b></span></p>
              <p>Tổng phí VAT<span class="price" style="color:black"><b>&nbsp; <?=$data['total_money'] * 8 / 100?> VND</b></span></p>
              <p>Tổng tiền thanh toán<span class="price" style="color:black"><b>&nbsp; <?=$data['total_money'] + $data['total_money'] * 8 / 100?> VND</b></span></p>
             
              <input type="text" name="price" value="<?=$data['total_money']?>" hidden>
              <input type="text" name="total_money_checkout" value="<?=$data['total_money'] + $data['total_money'] * 8 / 100?>" hidden>
              
      			</div>
    			</div>

        </div>
        
        <input type="submit" value="Đặt hàng" class="btn-continue">
      </form>
    </div>
  </div>
</div>