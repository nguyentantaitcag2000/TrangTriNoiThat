<div id="thongbao"></div>

<section class="vh-100" style="background-image: linear-gradient(to right, #f6d9d9 , #e88e9d);">
  <div class="container justify-content-center py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100 w-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img style="width:100%; height: 100%;" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTCMacosvC6Y8agy0E2klaVql50Xx2rnSipwQ&usqp=CAU"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form onsubmit="return false">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <!-- <span class="h1 fw-bold mb-0">Logo</span> -->
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Đăng nhập tài khoản</h5>

                  <div class="form-outline mb-4">
                    <input type="email" id="email" class="form-control form-control-lg" />
                    <label class="form-label" for="email">Địa chỉ email</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="password" class="form-control form-control-lg" />
                    <label class="form-label" for="password">Mật khẩu</label>
                  </div>
<!--                   <div class="form-outline mb-4">
                    <input type="checkbox" id="remember" />
                    <label class="form-label" for="remember">Nhớ mật khẩu</label>
                  </div> -->
                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" type="submit">Đăng nhập</button>
                  </div>

                  <!-- <a class="small text-muted" href="#!">Quên mật khẩu?</a> -->
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Bạn chưa có tài khoản? <a href="/Auth/Register"
                      style="color: #393f81;">Đăng kí tại đây</a></p>
                  <!-- <a href="#!" class="small text-muted">Terms of use.</a>
                  <a href="#!" class="small text-muted">Privacy policy</a> -->
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
    var form = document.getElementsByTagName('form')[0];
    form.addEventListener('submit',function(event){
      var email = document.getElementById('email').value;
      var password = document.getElementById('password').value;
      // var isRemember = document.getElementById('remember').checked;
      var isRemember = false;
      event.preventDefault();
      Swal.fire({
              title: "Checking...",
              text: "Please wait",
              imageUrl: "/img/loading.gif",
              showConfirmButton: false,
              allowOutsideClick: false
            });

            $.ajax({
              url:"../../../mvc/core/ajax/Auth.php",
              method:"POST",
              data:{type:"Signin",email:email,password:password,remember:isRemember},
              success:function(res)
              {
                Swal.close();
                $('#thongbao').html(res);
              }
            });
    });
    
  </script>