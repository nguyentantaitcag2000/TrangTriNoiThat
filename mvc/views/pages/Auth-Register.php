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

                <form id="form">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <!-- <span class="h1 fw-bold mb-0">Logo</span> -->
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Đăng kí tài khoản</h5>

                  <div class="form-outline mb-4">
                    <input type="email" id="email" class="form-control form-control-lg" required/>
                    <label class="form-label" for="email">Địa chỉ Email</label>
                    <div id="notify_email"></div>

                  </div>
                  <div class="form-outline mb-4">
                    <input type="password" id="password" data-password-strength-status="<?=$data["password_strength"]["Status"]?>" class="form-control form-control-lg" required />
                    <label class="form-label" for="password">Mật khẩu</label>
                    <div id="notify_password"></div>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="password2" class="form-control form-control-lg" required/>
                    <label class="form-label" for="password2">Nhập lại mật khẩu</label>
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" type="submit">Đăng kí</button>
                  </div>

                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Bạn đã có tài khoản? <a href="/Auth/Login"
                      style="color: #393f81;">Đăng nhập tại đây</a></p>
                 
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
    $('#email').on('focusout',function(){
      TAI.Check.ValidEmail(this.value,'vie');

    });
    $('#password').on('keyup',function(){
      if(this.getAttribute("data-password-strength-status") == "1")
        TAI.Check.PasswordSecure(this.value,"vie");
    });
    $('#form').submit(function(event){
      event.preventDefault();
      var password = document.getElementById('password').value;
      var password2 = document.getElementById('password2').value;
      var email =  document.getElementById('email').value;
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
              data:{type:"Signup",password:password,password2:password2,email:email},
              success:function(res)
              {
                Swal.close();
                $('body').append(res);
              }
            });
    });
</script>