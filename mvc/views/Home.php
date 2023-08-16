<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <link rel="stylesheet" href="../../../public/CSS/w3.css">
    <link rel="stylesheet" href="../../../public/CSS/font-awesome.css">
    <script type="text/javascript" src="../../../public/JS/font-awesome-kit.js"></script>

    <link rel="stylesheet" href="../../../public/CSS/grid-product.css">
    <link rel="stylesheet" href="../../../public/CSS/bootstrap.min.css">
     <link rel="stylesheet" href="../../../public/CSS/main.css">
     <link rel="icon" type="image/x-icon" href="../../../public/images/shopping-cart.png">
    <script type="text/javascript" src="../../../public/JS/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="../../../public/JS/jquery.min.js"></script>
    <script type="text/javascript" src="../../../public/JS/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="../../../public/JS/main.js"></script>
    <script type="text/javascript" src="../../../public/JS/jquery.scrollie.min.js"></script>

    <script type="text/javascript" src="../../../public/sweetalert/node_modules/sweetalert2/dist/sweetalert2.js"></script>
    <link rel="stylesheet" href="../../../public/sweetalert/node_modules/sweetalert2/dist/sweetalert2.css">
    <title><?=$data['Title']?></title>
</head> 
<body style="background-color: #f6d9d9;">
    <nav class="navbar navbar-expand-sm w3-animate-top bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="../../../public/images/icon.png" class="rounded-circle" width="50" height="50">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
          <i class="fa fa-bars" style="font-size:24px;color:black"></i>
        </button>
        <div class="collapse navbar-collapse" id="mynavbar">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <a class="nav-link text-dark" href="/Home/Introduce">Giới thiệu</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link text-dark" href="/Home/Contact">Liên hệ</a>
            </li>
          </ul>
          <div class="d-flex me-auto position-relative" id="search_bar">
            <input id="search" class="form-control me-2" type="text" style="height: 50px;" placeholder="Tìm kiếm thứ gì đó">
            <ul id="search-results" class="list-group" style="top:40px"></ul>

            <button id="btn_search" class="btn btn-primary" type="button">Search</button>
          </div>

          <?php if(!isset($_SESSION['email'])) {?>
          <div>
                <a href="/Auth/Login" class="btn btn-success">Sign in</a>
                <a href="/Auth/Register" class="btn btn-danger">Sign up</a>
          </div>
          <?php }?>
         
          <div class="position-relative btn hover">
              <span id='count_product_in_cart' class="position-absolute d-block bg-danger text-light rounded-circle w-25 text-center" style="right: 15px;top: -13px;"><?=count($data['ListShoppingCarts'])?></span>
              <a href="/Home/Cart">
                <img src="../../../public/images/shopping-cart.png" class="me-3" style="width:35px;padding: 0;">  
              </a>
          </div>
           <?php if(isset($_SESSION['email'])) {?>
          <div class="btn dropdown">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              <?= explode('@', $_SESSION['email'])[0] ;?>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item " href="/Auth/Logout">Đăng xuất</a></li>
            </ul>
            <img src="./public/images/profile.png" style="width:35px">
          </div>
          <?php }?>       
          
        </div>
      </div>
    </nav>

    
    <div class="container bg-light">
         <?php require_once "./mvc/views/pages/".$data["Page"].".php" ?>
    </div>
    <?php if($data["Page"] != 'Home-Cart') {?>
    <footer class="w3-animate-opacity">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h3>Về chúng tôi</h3>
            <p>Chúng tôi cung cấp các sản phẩm trang trí nội thất chất lượng cao với giá cả hợp lý. Chúng tôi cam kết mang lại sự hài lòng cho khách hàng.</p>
          </div>
          <div class="col-md-4">
            <h3>Liên hệ</h3>
            <p>Địa chỉ: Số 123, đường ABC, quận XYZ, TP. Cần Thơ</p>
            <p>Điện thoại: 0123456789</p>
            <p>Email: info@example.com</p>
          </div>
          <div class="col-md-4">
            <h3>Theo dõi chúng tôi</h3>
            <ul class="list-inline social-media">

              <li><a href="#"><i class="fa-brands fa-facebook"></i>&nbsp;&nbsp;&nbsp;Facebook</a></li>
              <li><a href="#"><i class="fa fa-twitter"></i>&nbsp;&nbsp;&nbsp;Twitter</a></li>
              <li><a href="#"><i class="fa fa-instagram"></i>&nbsp;&nbsp;&nbsp;Instagram</a></li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
    <?php }?>
    <script>
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var timeOut = 4000;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}
  x[myIndex-1].style.display = "block";
  var dataTimeout = x[myIndex-1].getAttribute('data-timeout');
  if(dataTimeout!=null)
    timeOut = parseInt(dataTimeout);   
  setTimeout(carousel, timeOut); // Change image every 2 seconds

}

$(document).ready(function() {
    let timerId = null;
    function search(searchQuery)
    {

      $.ajax({
          url: '../../mvc/core/ajax/Search-Suggestion.php',
          type: 'post',
          data: { query: searchQuery },
          success: function(response) {
            var suggestions = JSON.parse(response);
            var listItems = '';
            for (var i = 0; i < suggestions.length; i++) {
                listItems += '<li class="list-group-item hover" onclick="location.href=this.querySelector(\'a\').href;"><a href="/Home/Search/'+suggestions[i]+'">' + suggestions[i] + '</a></li>';
            }
            $('#search-results').html(listItems);
            // Xóa timer
            clearTimeout(timerId);
          },
          error: function(xhr, status, error) {
              console.log(error); // Hiển thị lỗi nếu có
          }
      });
      
    }
    $('#search').on('keydown', function(event) {
      if (event.which === 13 || event.keyCode === 13) {
        // Phím Enter đã được nhấn
        location.href = "/Home/Search/Keywords/" + $(this).val();

      } else {
        // Xóa timer cũ (nếu có)
        if(timerId)
          clearTimeout(timerId);
        var searchQuery = $(this).val();
        // Đặt timer mới
        if (searchQuery.length >= 2) { // Chỉ gửi Ajax request nếu từ khóa tìm kiếm có độ dài >= 2 ký tự
          timerId = setTimeout(function(){search(searchQuery);}, 300); // Sau 300ms nếu người dùng ngưng gõ thì mởi call tới server
        }
        else {
              $('#search-results').html(''); // Xóa kết quả gợi ý tìm kiếm nếu từ khóa tìm kiếm có độ dài < 2 ký tự
          }
      }
      
    });
    $('#btn_search').on('click',function(){
      location.href = "/Home/Search/Keywords/" + $('#search').val();     
    });
    $('html').on('click',function(){
      $('#search-results').html('');
    });

});
</script>

</body>
</html>