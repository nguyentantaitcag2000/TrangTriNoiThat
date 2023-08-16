
class TAI{
  static SetTitle(title)
  {
    if (history.pushState) {
      window.history.pushState(null, "title", title.replace(' ','%20'));
    } 
    else {
      window.history.replaceState(null, "title**", title.replace(' ','%20'));
      // ** It seems that current browsers other than Safari don't support pushState
      // title attribute. We can achieve the same thing by setting it in JS.
      document.title = "Title";
    }
  }
  static CountCharacter(string,character)
  {
     return (string.match(new RegExp(character, "gm")) || []).length;
  }
  static AppendTitle(title)
  {
    var currentURL = window.location.href;
    if (history.pushState) {
      window.history.pushState(null, "title",currentURL + title.replace(' ','%20'));
    } 
    else {
      window.history.replaceState(null, "title**",currentURL + title.replace(' ','%20'));
      // ** It seems that current browsers other than Safari don't support pushState
      // title attribute. We can achieve the same thing by setting it in JS.
      document.title = "Title";
    }
  }
  static OpenPopup({
    id,width="80%"
  })
  {
    var div = document.getElementById(id);
    div.style.display = "block";
    div.getElementsByClassName('modal-content')[0].style.width = width;

  }
  static ClosePopup(id)
  {
     document.getElementById(id).style.display = "none";
  }
  static InitPopup({id,function_cancel = null})
  {
    var modal = document.getElementById(id);
    //Event close popup for button
    
    var btnClose = modal.getElementsByClassName('btn-close')[0];
    if(btnClose!= undefined)
    {
      btnClose.addEventListener("click",function(){
          document.getElementById(id).style.display = "none";
          if(function_cancel != null)
            function_cancel();
      });

    } 
    // Get the <span> element that closes the modal
    var span = modal.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  }
  static PreventSelect() // Ngăn chặn select text, chẳng hạn như khi double click
  {
    if(document.selection && document.selection.empty) {
        document.selection.empty();
    } else if(window.getSelection) {
        var sel = window.getSelection();
        sel.removeAllRanges();
    }
  }
  static Check = class {
    static ValidUsername(username)
    {
      var isValid = true;
      var notify_username = document.getElementById('notify_username');
      notify_username.innerHTML=''; 
      var p = document.createElement('p');

      if(username.length<6)
      {
        isValid = false;
        p.innerHTML = "Username must be equal to or more than 6 characters";
        p.classList.remove('valid');
        p.classList.add('not-valid');
      }
      notify_username.appendChild(p);
      return isValid;
    }
    static ValidEmail(email,language='eng'){
      let emailValidityMessage = "Email's valid.";

      let translatedEmailValidityMessage = "";
      let _translatedEmailValidityMessage = "";

      if (language === "vie") {
        translatedEmailValidityMessage = "Email hợp lệ.";
        _translatedEmailValidityMessage = "Email không hợp lệ.";
      } else {
        translatedEmailValidityMessage = emailValidityMessage;
        _translatedEmailValidityMessage = "Email's not valid.";
      }
          var isValid = email.match(
        /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
      );
          var notify_email = document.getElementById('notify_email');
          notify_email.innerHTML=''; 
          var p = document.createElement('p');
          if(isValid){
            p.innerHTML = translatedEmailValidityMessage;
            p.classList.remove('npt-valid');
            p.classList.add('valid');
          }
          else
          {
            p.innerHTML = _translatedEmailValidityMessage;
            p.classList.remove('valid');
            p.classList.add('not-valid');
          }
          notify_email.appendChild(p);
          return isValid;
    }
    static PasswordSecure(password,language='eng')
    {
      let passwordRequirements = {
        containsNumber: "The password must contain at least one number [0-9]",
        containsUppercase: "The password must contain at least one uppercase character [A-Z]",
        containsLowercase: "The password must contain at least one lowercase character [a-z]",
        minLength: "The password must be 8 characters or longer",
        containsSpecialChar: "The password must contain at least one special character [!@#$%^&*]"
      };

      let translatedPasswordRequirements = {};

      if (language === "vie") {
        translatedPasswordRequirements = {
          containsNumber: "Mật khẩu phải chứa ít nhất một chữ số [0-9]",
          containsUppercase: "Mật khẩu phải chứa ít nhất một ký tự hoa [A-Z]",
          containsLowercase: "Mật khẩu phải chứa ít nhất một ký tự thường [a-z]",
          minLength: "Mật khẩu phải có ít nhất 8 ký tự",
          containsSpecialChar: "Mật khẩu phải chứa ít nhất một ký tự đặc biệt [!@#$%^&*]"
        };
      } else {
        translatedPasswordRequirements = passwordRequirements;
      }
      var isValid = true;
      var el = document.getElementById('notify_password');
      el.innerHTML = '';
      var p = document.createElement('p');
      if(!/(?=.*[0-9])/gm.test(password))
      { 
          isValid = false;
          p.innerHTML = translatedPasswordRequirements.containsNumber;
          p.classList.remove('valid');
          p.classList.add('not-valid');
      }
      else
      {
          p.innerHTML =  translatedPasswordRequirements.containsNumber;
          p.classList.remove('not-valid');
          p.classList.add('valid');
      }
      el.appendChild(p);
      p = document.createElement('p');
      if(!/(?=.*[A-Z])/gm.test(password))
      {
          isValid = false;

          p.innerHTML =  translatedPasswordRequirements.containsUppercase;
          p.classList.remove('valid');
          p.classList.add('not-valid');
      }
      else
      {
          p.innerHTML =  translatedPasswordRequirements.containsUppercase;
          p.classList.remove('not-valid');
          p.classList.add('valid');
      }
      el.appendChild(p);
      p = document.createElement('p');
      if(!/(?=.*[a-z])/gm.test(password))
      {
          isValid = false;

          p.innerHTML =  translatedPasswordRequirements.containsLowercase;
          p.classList.remove('valid');
          p.classList.add('not-valid');
      }
      else
      {

          p.innerHTML = translatedPasswordRequirements.containsLowercase;
          p.classList.remove('not-valid');
          p.classList.add('valid');
      }
      el.appendChild(p);
      p = document.createElement('p');
      if(!/(?=.{8,})/gm.test(password))
      {
          isValid = false;

          p.innerHTML = translatedPasswordRequirements.minLength;
          p.classList.remove('valid');
          p.classList.add('not-valid');
      }
      else
      {

          p.innerHTML = translatedPasswordRequirements.minLength;
          p.classList.remove('not-valid');
          p.classList.add('valid');
      }
      el.appendChild(p);
      p = document.createElement('p');
      if(!/(?=.*[!@#\$%\^&\*])/gm.test(password))
      {
          p.innerHTML = translatedPasswordRequirements.containsSpecialChar;
          p.classList.remove('valid');
          p.classList.add('not-valid');
      }
      else
      {
          p.innerHTML = translatedPasswordRequirements.containsSpecialChar;
          p.classList.remove('not-valid');
          p.classList.add('valid');
      }
      el.appendChild(p);
      return isValid;
      // Password RegEx  Meaning
      // ^ The password starts
      // (?=.*[a-z]) The password must contain at least one lowercase character
      // (?=.*[A-Z]) The password must contain at least one uppercase character
      // (?=.*[0-9]) The password must contain at least one number
      // (?=.*[!@#$%^&*])  The password must contain at least one special character.
      // (?=.{8,}) The password must be eight characters or longer
    } 
  }
  static RandomString(length) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}

}
function OK_VariableName_KeyDown(event)
{
  //Ngăn chặn user nhấn phím cách
  if(!event.key.match(/[A-Za-z0-9_]+/gm)) {  
    event.preventDefault();
    return false;
  }
}
function IsNumeric(str) {
  return !isNaN(Number(str)) && isFinite(str);
}