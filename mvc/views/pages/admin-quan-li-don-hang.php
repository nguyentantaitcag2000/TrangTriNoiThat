<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello</title>
    <style>
        table, th, td
        {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <div class=>
        <div>
            <main>
                <div>
                    <h1 class="h1">Đơn hàng</h1>
                </div>
   
             <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover" style="width:100%">
                    <thead>
                      <tr>
                        <th>Đơn đặt hàng</th>
                        <th>Ngày</th> 
                        <th>Tình trạng</th>
                        <th>Giao hàng đến</th>
                        <th>Tổng</th>
                        <th>Các thao tác</th>
                      </tr>
                    </thead>
                    <tbody>
                <?php foreach ($data['Bill_List'] as $key => $bill) { ?>
                    <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label" for="vehicle1">#<?=$bill['ID_Bill']?></label>
                          </div>
                        </td>
                        <td><?=$bill['CreateDate']?></td>
                        <td><?=$bill['Name_BS']?></td>
                        <td><?=$bill['Address_Bill']?></td>
                        <td><?=$bill['TotalMoneyCheckout']?></td>
                        <td>
                                <a href="/Admin/CheckoutDone/<?=$bill['ID_Bill']?>" type="submit" class="btn btn-success">Đã thanh toán</a>    
                                <a href="/Admin/CheckoutNotDone/<?=$bill['ID_Bill']?>"  type="submit" class="btn btn-light">Chưa thanh toán</a>
                                <a href="/Admin/CheckoutShiping/<?=$bill['ID_Bill']?>"  type="submit" class="btn btn-primary">Đang vận chuyển</a>
                                <a href="/Admin/Destroy/<?=$bill['ID_Bill']?>"  type="submit" class="btn btn-danger">Hủy đơn</a>

                            
                        </td>
                      </tr>
                <?php }?>
                      
                 
                    </tbody>
                  </table>
                  <a href="/Admin/Bill/1" class="btn btn-link">Xem các đơn chưa thanh toán</a>
                  <a href="/Admin/Bill/2" class="btn btn-link">Xem các đơn đã thanh toán</a>
                  <a href="/Admin/Bill/3" class="btn btn-link">Xem các đơn đang vận chuyển</a>
                  <a href="/Admin/Bill/3" class="btn btn-link">Xem các đơn đã hủy</a>
                  <a href="/Admin/Bill"   class="btn btn-link">Tất cả</a>
                </div>
            </main>
        </div>
    </div>
</body>



</html>
