<?php 

if(!isset($_SESSION['email']))
{
	GO("/Auth/Login");
}
$DB = new DB();
$result = mysqli_query($DB->con,"SELECT * FROM users WHERE Email = '".$_SESSION['email']."'");
if(mysqli_num_rows($result)==0)
{
	alertError("Username not existed","/Auth/Login");
}
$row = mysqli_fetch_array($result);
if($row['verify'] !== NULL)
{
	GO("/");
}
?>

<div class="container">

	<form action="" method="POST" id="form">
	  <div>
	    <img src="/public/images/logo.png" alt="Avatar" class="mx-auto d-block">
		<h1 class="text-center">Verify your email</h1>

	  </div>

	  <div class="container" style="width: 500px;
margin: auto;">

	    <label 	for="email"><b>Email:</b></label>
	    <input disabled value="<?=$row['Email']?>" style="width: 300px;" type="text" placeholder="Enter Email" name="email" id="email" required>
	    <button id="send_otp" class="btn btn-primary">Send OTP</button>
	    <a href="/ChangeEmail">Change email</a>
	    

	    <div id="otp_box" style="display: none;">
	    	<label for="OTP"><b>OTP</b></label>
		    <input type="text" placeholder="Enter OTP" name="OTP" id="OTP" required>
		    <div id="notify_password"></div>
		    <button type="submit" name="btnSubmit" class="registerBtn">Confirm</button>
	    </div>
		    
	  </div>

	  
	</form>

</div>
<script type="text/javascript">
	$('#send_otp').on('click',function(){
		var email = $('#email').val();
		if(!email)
		{
			Swal.fire({

              title: "Error",
              text: `Enter your email, Please !`,
              icon: 'error'
            });
			return;
		}
		Swal.fire({
          title: "Sending OTP...",
          text: "Please wait",
          imageUrl: "/img/loading.gif",
          showConfirmButton: false,
          allowOutsideClick: false
        });
        $.ajax({
        	url:"/ajax/Auth.php",
        	method:"POST",
        	data:{type:"SendOTP",email:email},
        	success:function(res)
        	{
        		Swal.close();
        		$('#notify').html(res);
        		if(res.includes("Error") == false)
        		{
        			document.getElementById('otp_box').style.display = "block";
        		}
        	}
        });
	});
	$('#form').submit(function(event){
		event.preventDefault();
		var email = $('#email').val();
		var otp = $('#OTP').val();
		Swal.fire({
          title: "Checking...",
          text: "Please wait",
          imageUrl: "/img/loading.gif",
          showConfirmButton: false,
          allowOutsideClick: false
        });
        $.ajax({
        	url:"/ajax/Auth.php",
        	method:"POST",
        	data:{type:"ConfirmOTP",email:email,OTP:otp},
        	success:function(res)
        	{
        		Swal.close();
        		$('body').append(res);
        	}
        });
	});
</script>
