<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../public/CSS/bootstrap.min.css">
    <script type="text/javascript" src="../../../public/JS/bootstrap.bundle.js"></script>
    <title></title>
</head>
<body>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Dashboard</h1>
                    </div>
                
                </div>
            </div>
        </section>
        <section class="content">
            <div class="row">
                <section class="col-lg-6 connectedSortable pt-5">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="small-box bg-info p-2">
                                <div class="inner">
                                    <h3 id="total_users"><?=count($data['ListUser']);?></h3>
                                    <p>Tổng thành viên</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="small-box bg-success text-light p-2">
                                <div class="inner">
                                    <h3 id="total_accounts">
                                        <?=count($data['ListProduct']);?>
                                    </h3>
                                    <p>Sản phẩm đang bán</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-store"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 pt-3">
                            <div class="small-box bg-success text-light p-2">
                                <div class="inner">
                                    <h3 id="total_accounts">
                                        <?=$data['soLuongHangTonKho'];?>
                                    </h3>
                                    <p>Sản phẩm hàng tồn kho</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-store"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 pt-3">
                            <div class="small-box bg-success text-light p-2">
                                <div class="inner">
                                    <h3 id="total_accounts">
                                        <?=$data['soLuongHangDangXuLy'];?>
                                    </h3>
                                    <p>Số đơn hàng đang xử lý</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-store"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 pt-3">
                            <div class="small-box bg-success text-light p-2">
                                <div class="inner">
                                    <h3 id="total_accounts">
                                        <?=number_format($data['tongDoanhThu']) . ' đ'?>
                                    </h3>
                                    <p>Tổng doanh thu</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-store"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
               
                
            </div>


<h1>Top các sản phẩm được mua nhiều nhất</h1>
<table class="table">
    <thead>
        <tr>
            <th>Tên sản phẩm</th>
            <th>Tổng số lượng sản phẩm được bán</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['Top10SanPhamDuocMuaNhieuNhat'] as $sanpham) { ?>
        <tr>
            <td><?php echo $sanpham['Name_Product']; ?></td>
            <td><?php echo $sanpham['TongSoLuong']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
            <!-- /.content -->
<h1>Quản lí khách hàng</h1>
<table class="table">
    <thead>
        <tr>
            <th>Email khách hàng</th>
            <th>Số đơn đã thanh toán</th>
            <th>Số đơn đã hủy</th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($data['ListUser'] as $key => $user) { ?>


        <tr>
            <td><?php echo $user['Email']; ?></td>
            <td><?php echo $user['SoLuongDaThanhToan']; ?></td>
            <td><?php echo $user['SoLuongDaHuy']; ?></td>
        </tr>

<?php }?>
    </tbody>
</table>
    </div>




    


</body>
</html>

