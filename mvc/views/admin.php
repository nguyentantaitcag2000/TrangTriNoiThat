<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../public/CSS/bootstrap.min.css">
    <script type="text/javascript" src="../../../public/JS/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="../../../public/JS/jquery.min.js"></script>
    <script type="text/javascript" src="../../../public/JS/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../../../public/JS/main.js"></script>
    <link rel="stylesheet" href="../../../public/CSS/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../../../public/CSS/font-awesome.css">

    <script type="text/javascript" src="../../../public/sweetalert/node_modules/sweetalert2/dist/sweetalert2.js"></script>
    <link rel="stylesheet" href="../../../public/sweetalert/node_modules/sweetalert2/dist/sweetalert2.css">

    <title>Hello</title>
</head>
<body>
    
    <div class="container-fluid">
        <div class="row">
            <!-- SideBar -->
         
            <div class="col-xs-12 col-md-12 col-lg-3"  >
                <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="height:100%">
                    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                      <span class="fs-4">Sidebar</span>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                      <li class="nav-item">
                        <a href="/Admin" class="nav-link active" aria-current="page">
                          <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                          Home
                        </a>
                      </li>
                      <li>
                        <a href="/Admin/Product" class="nav-link text-white">
                          <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                          Products
                        </a>
                      </li>
                      <li>
                        <a href="/Admin/Category" class="nav-link text-white">
                          <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                          Categories
                        </a>
                      </li>
                      <li>
                        <a href="/Admin/Bill" class="nav-link text-white">
                          <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                          Quản lí đơn hàng
                        </a>
                      </li>
                    </ul>
                    <hr>
                    <div class="dropdown">
                      <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../public/images/logo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong>mdo</strong>
                      </a>
                      <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
                      </ul>
                    </div>
                </div>
            </div>
            <div class="col">
                 <?php
                    require_once "./mvc/views/pages/".$data['Page'].".php";
                    ?>
            </div>
        </div>
    </div>
    
   
</body>
</html>