<div id="thongbao"></div>
<div class="container sticky d-flex flex-column bg-light mt-3 rounded">
    <form method="POST" action="/Home/Checkout">
        <?php 
        $i = -1;
        foreach ($data['ListShoppingCarts'] as $key => $value) { 
            $i++;
            ?>
        <input type="text" name="product[<?=$i?>][ID_Product]" value="<?=$value['ID_Product']?>" hidden/>
        <div class="row bg-light mt-3 w-100 border-bottom flex-grow-1">
            <div class="col-sm-2">
                <img style="width: 100px;height: 100px;" src="<?=$value['Avatar']?>" alt="" >
            </div>
            <div class="col-sm-4 d-flex align-items-center ">
                <h5><?=$value['Name_Product']?></h5>
            </div>
            <div class="col-sm-2 d-flex align-items-center ">
                <span class="origin"><?=number_format($value['Price'],0) . ' đ'?></span>
            </div>
            <div class="col-sm-2 d-flex align-items-center ">
                <div class="input-group" style="width:50%">
                    <span class="input-group-btn">
                        <button class="btn btn-white btn-minuse" onclick="minuse(<?=$value['Price']?>,event)" type="button">-</button>
                    </span>
                    <input name="product[<?=$i?>][Amount]" type="text" class="form-control no-padding add-color text-center height-25 w-auto" maxlength="3" value="<?=$value['Amount']?>" onblur="checkAmount(event)">
                    <span class="input-group-btn">
                        <button class="btn btn-red btn-pluss" type="button" onclick="plus(<?=$value['Price']?>,event)">+</button>
                    </span>
                </div><!-- /input-group -->
                <input type="text" class="product-total-money" value="<?= $value['Price'] * $value['Amount'] ?>" hidden  />

            </div>
            <div class="col-sm-1 d-flex align-items-center ">
                <button onclick="delete_product(event,<?=$value['ID_Product']?>)" class="btn btn-danger">Xoá</button>
            </div>
        
        </div>
        <?php } ?>
    </form>
     <div class="row position-fixed bottom-0 bg-light flex-grow-1 container p-3">
        <div class="col-sm-3">
            <span>Tổng thanh toán:</span>
            <span id="total_money">0</span>
        </div>
        <div class="col-sm-1,2">
            <a class="btn btn-danger" onclick="Checkout()">Thanh toán</a>
        </div>
    </div>    
</div>
<script>
function delete_product(event,id)
{
    event.preventDefault();
    $.ajax({
            url:"../../../mvc/core/ajax/Delete-Product-form-card.php",
            method:'POST',
            data: {ID:id},
            success:function(res){
                location.reload();      
            }
        })
}
document.addEventListener('DOMContentLoaded',function(){

 
    total_money_solve();

});
function checkAmount(event) {
        var inputAmount = event.target;
        var amount = parseInt(inputAmount.value);

        if (amount > 50) {
            alert("Số lượng sản phẩm không được vượt quá 50");
            inputAmount.value = 50;
        }
    }

    function Checkout() {
        var form = document.getElementsByTagName('form')[0];
        var total_money = document.getElementById('total_money').innerHTML;

        // tạo một phần tử input mới
        var totalMoneyInput = document.createElement("input");

        // đặt các thuộc tính cho phần tử input
        totalMoneyInput.setAttribute("type", "hidden");
        totalMoneyInput.setAttribute("name", "total_money");
        totalMoneyInput.setAttribute("value", total_money);

        // thêm phần tử input mới vào trong form
        form.appendChild(totalMoneyInput);

        // kiểm tra số lượng sản phẩm có vượt quá 50 không
        var inputAmounts = document.querySelectorAll(".form-control.no-padding.add-color.text-center.height-25.w-auto");
        for (var i = 0; i < inputAmounts.length; i++) {
            var amount = parseInt(inputAmounts[i].value);
            if (amount > 50) {
                alert("Số lượng sản phẩm không được vượt quá 50");
                return false;
            }
        }

        form.submit();
    }
function total_money_solve()
{
    $el = $('#total_money');
    $allInput = $('.product-total-money');
    $total = 0;
    $allInput.each(function(){
        console.log($(this).val());
        $total += parseFloat($(this).val());
    });
    $el.html($total); 

}
function plus(price,event)
{
    var a = event.target.parentElement.previousElementSibling;
    var amount = parseInt(a.value) + 1;
    var input = event.target.parentElement.parentElement.nextElementSibling;
    input.value = price * amount;
    total_money_solve();
}
function minuse(price,event)
{
    var a = event.target.parentElement.nextElementSibling;
    var amount = parseInt(a.value) - 1;
    if(amount == 0)
        return;
    var input = event.target.parentElement.parentElement.nextElementSibling;
    input.value = price * amount;
    total_money_solve();   
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