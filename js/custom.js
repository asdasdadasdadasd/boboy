/* Custom JavaScript */

$(document).ready(function(){

  $("#register-form").on("submit", function(e){
    e.preventDefault();

    $.ajax({
      url: 'modules/register/ajax.php',
      type: 'POST',
      data: $(this).serialize(),
      success: function (d) {
        var e_pwd = document.getElementById("pwd-reg");
        var e_cpwd = document.getElementById("cpwd-reg");
        if(d == "non_match_password"){
          e_pwd.classList.add("has-error");
          e_cpwd.classList.add("has-error");
          document.getElementById("pwd-reg-help").innerHTML = "Passwords do not match";
        }
      }
    });
  });
});