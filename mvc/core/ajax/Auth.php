<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/mvc/core/DB.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/mvc/core/App.php');
	$DB = new DB();
	if(isset($_POST['type']))
	{

		if( "Signin" == $_POST['type'] && isset($_POST['email']) && isset($_POST['password']))
		{
			$email = check_string($_POST['email']);
			$password = check_string($_POST['password']);
			$refPage = '/'; // aftter login finished will navigate to this page
			//Check username
			$result = mysqli_query($DB->con,"SELECT * FROM users WHERE Email = '".$email."'");
			if(mysqli_num_rows($result) == 0)
			{
				alertError('Username not exist');
			}
			// $salt = mysqli_fetch_array($result)['salt'];
			$salt = '';
			//Login
			$result = mysqli_query($DB->con,"SELECT * FROM users WHERE Email = '".$email."' AND password = '".EncodePassword($password . $salt)."'");
			if($result)
			{
				$return = mysqli_fetch_array($result);
		       	if(!$return)
		       	{
		       		alertError('User not exist or wrong password');
		       	}
				$_SESSION['email'] = $email;
		        $_SESSION['password'] = $password;
		        $_SESSION['level'] = $return['level'];
		        $_SESSION['ID_User'] = $return['ID_User'];

		        //Remember password
				if(isset($_POST['remember']))
				{
					if($_POST['remember'])
					{
						setcookie($ck_email,$email,$time_save_cookie,"/",null,null,true);
						setcookie($ck_hash,$password,$time_save_cookie,"/",null,null,true);
					}
				}
				if(isset($_SESSION['refPage']))
				{
					if(!empty($_SESSION['refPage']))
						$refPage = $_SESSION['refPage'];
				}
			
		        if($return['level'] == 'admin')
					alertSuccess('Login successful', '/admin');
				// else if($return['verify'] === NULL)
				// {
				// 	alertSuccess('Login successful', '/Auth/Verify');
				// }
				else
					alertSuccess('Login successful', $refPage);
				

			}
			else
			{
				alertError('Query error');
			}
		}
		else if( "Signup" == $_POST['type'] && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['email']))
		{
			$password = check_string($_POST['password']);
			$password2 = check_string($_POST['password2']);
			$email = check_string($_POST['email']);
			if($password != $password2)
			{
				alertError("Both passwords are not matching");
			}
		
			if(empty($password))
			{
				alertError("Password is empty");
			}
			if(empty($email))
			{
				alertError("Email is empty");
			}
			//Check email is exist ?
			$result =mysqli_query($DB->con,"SELECT * FROM users WHERE Email = '".$email."'");
			if(mysqli_num_rows($result)>0)
			{
				alertError("Your email ".$email." have a other account used");
			}
			// $salt = random('0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM', 32);
			$salt = '';
	        $password = $password . $salt;
	        $password = EncodePassword($password);
			$result = mysqli_query($DB->con,"INSERT INTO users (password,salt,email,regtime) VALUES ('".$password."','".$salt."','".$email."','".time()."')");
			if($result)
			{
				alertSuccess('Sign up successful', '/Auth/Login');

			}
			else
			{
				alertError('Sign up failed');
			}
		}
		else if("SendOTP" == $_POST['type'] && isset($_POST['email']))
		{
			$webSiteName = "LazyCodet.com";
			$email = check_string($_POST['email']);
			if(empty($email))
			{
				alertError("Enter your email, Please !");
			}
			$email_smtp = $TAI->GetProperty('email_smtp');
			$passmail_smtp = $TAI->GetProperty('passmail_smtp');

			$row = $TAI->get_row("SELECT * FROM users WHERE email = '".$email."'");
			if(!$row)
			{
				alertError("Email not exist !");
			}
			$content = '';
			$subject = '';
			//Case 1: User want Verify account
			if($row['verify'] == NULL)
			{
				$subject = "VERIFY YOUR ACCOUNT";
				$content = 'We send you a code to verify your account';
			}
			//Case 2: User want change pass
			else
			{
				$subject = "CONFIRMED PASSWORD RECOVERY";
				$content = 'Someone has just requested to recover password by this email, if you are, please enter the verification code below to verify the account.';
			}	
			$otp = random('0123456789', '6');
	        $TAI->update("users", array(
	            'otp' => $otp
	        ), " `id` = '".$row['id']."' " );
	        $guitoi = $email;   
	        
	        $bcc = $webSiteName;
	        $hoten ='Client';
	        $noi_dung = '<h3>'.$content.'</h3>
	        <table>
	        <tbody>
	        <tr>
	        <td style="font-size:20px;">OTP:</td>
	        <td><b style="color:blue;font-size:30px;">'.$otp.'</b></td>
	        </tr>
	        </tbody>
	        </table>';
	        sendCSM($email_smtp,$passmail_smtp,$guitoi, $hoten, $subject, $noi_dung, $bcc); 
			alertSuccess("We sent otp to your email !");
		}
		else if("ConfirmOTP" == $_POST['type'] && isset($_POST['email'])&& isset($_POST['OTP']))
		{
			$email = check_string($_POST['email']);
			$OTP = check_string($_POST['OTP']);
			if(empty($email))
			{
				alertError("Enter your email, Please !");
			}
			if(empty($OTP))
			{
				alertError("Enter your OTP, Please !");
			}
			$row = $TAI->get_row("SELECT * FROM users WHERE email = '".$email."'");
			if(!$row)
			{
				alertError("Email not exist !");
			}
			
			if($row['otp'] == $OTP)
			{
				//Case 1: User want Verify account
				if($row['verify'] === NULL)
				{
					$result = $TAI->update("users",array(
						"verify" => ''
					), " id='".$row['id']."'");
					if(!$result)
						alertError("Error when verify");
					alertSuccess("Verify successful !","/WPF");	
				}
				//Case 2: User want change pass
				else 
				{
					$_SESSION['email_changepass'] = $row['email']; 
					alertSuccess("Well, Set new password !","/ChangePassword");	
				}
				
			}
			else
			{
				alertError("OTP's not match");
			}

		}
		else if("ChangeEmail" == $_POST['type'] && isset($_POST['newEmail']))
		{
			if(!isset($_SESSION['username']))
			{
				alertError("Session expired, please login again");
			}
			$newEmail = check_string($_POST['newEmail']);
			if(empty($newEmail))
			{
				alertError("Enter your New email, Please !");
			}
			
			

			$row = $TAI->get_row("SELECT * FROM users WHERE username = '".$_SESSION['username']."'");
			if(!$row)
			{
				alertError("Username not exist !","/login");
			}
			if($row['email'] == $newEmail)
			{
				alertError("The new email must be different from the current one !");
			}
			//Check email is exist ?
			if($TAI->get_row("SELECT * FROM users WHERE email = '".$newEmail."'"))
			{
				alertError("Your email have a other account used");
			}

			$result = $TAI->update("users", array(
				"email" => $newEmail
			), " id= '".$row['id']."'");

			if(!$result)
			{
				alertError("Error !");
			}
			alertSuccess("Set new email successful !","/Verify");
		}
		else if("ChangePassword" == $_POST['type'] && isset($_POST['password2'])&& isset($_POST['password']))
		{
			$password = check_string($_POST['password']);
			$password2 = check_string($_POST['password2']);
			if(empty($password))
			{
				alertError("Enter your password, Please !");
			}
			if(empty($password2))
			{
				alertError("Enter your password again, Please !");
			}
			if($password != $password2)
			{
				alertError("Two passwords not match, Try again !");
			}

			$row = $TAI->get_row("SELECT * FROM users WHERE email = '".$_SESSION['email_changepass']."'");
			if(!$row)
			{
				alertError("Email not exist !");
			}

			$salt = random('0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM', 32);
	        $password = $password . $salt;
	        $password = EncodePassword($password);

			$result = $TAI->update("users", array(
				"password" => $password,
				"salt" => $salt,
				"otp" => NULL
			), " email= '".$row['email']."'");

			if(!$result)
			{
				alertError("Error !");
			}
			unset($_SESSION['email_changepass']);
			alertSuccess("Set new password successful !","/login");
		}
		else{
			alertError("Enter your username & password, Please !");
		}
	}
	else{
		alertError("Error ! Contact with admin");

	}
		
	

?>