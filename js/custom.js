/* Custom JavaScript */

$(document).ready(function(){
  displayCartTable();

  function displayCartTable(){
    $.ajax({
        url: "modules/cart/display.php",
        method: "POST",
        data:{
          "display_cart": 1
        },
        success: function(data){
          setTimeout(function() {
            $("#cart-content").html(data);
          }, 0);
        }
    });
  };

  $("#atc-form").on("submit", function(e){
    $.ajax({
      url: 'modules/item/ajax.php',
      type: 'POST',
      data: $(this).serialize(),
      success: function(d){
        alert(d);/*
        if(d=="cart_success"){
          alert("Added to cart successfully!");
        }*/
      }
    });
  });
  //-- Logout Ajax --//
  $('#btn-logout').click(function(){
    $.ajax({
      url: 'logout.php',
      success: function(d){
        window.location = "index.php";
        location.reload();
      }
    });
  });
  //-- End Logout Ajax --//
  //-- Login Ajax --//
  $("#login-form").on("submit", function(e){
    e.preventDefault();
    $('#submit-login').prop('disabled', true);
    var e_email = document.getElementById("email-log");
    var e_pwd = document.getElementById("pwd-log");

    
    $.ajax({
      url: 'modules/login/ajax.php',
      type: 'POST',
      data: $(this).serialize(),
      success: function(d){
        if(d=="login_success"){
          window.location = "index.php";
          $('#submit-login').prop('disabled', false);
          location.reload();
        }
        if(d=="login_failed"){
          e_email.classList.add("has-error");
          e_pwd.classList.add("has-error");
          document.getElementById("pwd-login-help").innerHTML = "Username or password does not exists";
          $('#submit-login').prop('disabled', false);
        }
      }
    });
  });
  //-- End Login Ajax --//

  //-- Register Ajax Function --//
  $("#register-form").on("submit", function(e){
    e.preventDefault();
    $('#submit-register').prop('disabled', true);
    var e_pwd = document.getElementById("pwd-reg");
    var e_cpwd = document.getElementById("cpwd-reg");

    var e_email = document.getElementById("email-reg");
    $.ajax({
      url: 'modules/register/ajax.php',
      type: 'POST',
      data: $(this).serialize(),
      success: function (d) {
        setTimeout(function(){
          alert(d);
          if(d == "non_match_password"){
            e_pwd.classList.add("has-error");
            e_cpwd.classList.add("has-error");
            document.getElementById("pwd-reg-help").innerHTML = "Passwords do not match";
          }
          if(d == "email_exists"){
            e_email.classList.add("has-error");
            document.getElementById("email-reg-help").innerHTML = "Email already exists";
          }
          if(d=="register_success"){
            window.location = "index.php";
          }
          $('#submit-register').prop('disabled', false);
        },0);
      }
    });
  });
  //-- End Register Ajax --//
});