 // Custom JavaScript //

function remove_cart_show(c_id){
  $("#cart_modal").modal();
  document.getElementById('id_remove').value = c_id;
}

function updateCartCounter()
{ 
$("#nav-id").load(window.location.href + " #nav-id" );
}

function returnIndex(){
  window.location = "index.php";
}
 // DOCUMENT READY //

$(document).ready(function(){

  displayCartTable();

  $('#edit-item-form').on("submit", function(e){
    e.preventDefault();
    $("#btn-delete-item").prop("disabled", true);
    $("#btn-save-edit-item").prop("disabled", true);
    var formData = new FormData(this);

    $.ajax({
      url: 'modules/cpanel/itemview_edit.php',
      type: 'POST',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(data){
        if(data == "update_success"){
          $("#btn-save-edit-item").prop("disabled", false);
          $("#btn-delete-item").prop("disabled", false);
          location.reload();
        }
      }
    });
  });

  $('body').on("click",".item-select", function(e){
    var item_id = $(this).attr("id");
    window.location = "index.php?mod=cpanel&t=items&q="+item_id;
  });
  $('body').on("click", "#btn-order", function(e){
    $.ajax({
      url: 'modules/cart/order.php',
      method: 'POST',
      data:{
        "submit_order": 1
      },
      success: function(data){
        if(data == "order_success"){
          $("#cart_success").modal();
          displayCartTable();
        }
      }
    });
  });
  
  $("#remove_btn").click(function(){
    $("#remove_btn").prop('disabled',true);
    var r_id = $("#id_remove").val();
    
    $.ajax({
      url: 'modules/cart/ajax.php',
      method: 'POST',
      data:{
        "remove_cart": 1,
        "remove_id": r_id
      },
      success: function(data){
        if(data == "check_error" || data == "remove_failed"){
          alert("An error occurred. Please try again.");
          $("#cart_modal").modal('hide');
          window.location = "index.php?mod=cart";
        }else if(data == "remove_success"){
          displayCartTable();
          updateCartCounter();
          $("#cart_modal").modal('hide');
        }
        $("#remove_btn").prop('disabled',false);
      }
    });
  });

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
    e.preventDefault();
    $.ajax({
      url: 'modules/item/ajax.php',
      type: 'POST',
      data: $(this).serialize(),
      success: function(d){
        if(d=="cart_inserted"){
          $("#modal_inserted").modal();
          updateCartCounter();
        }
        if(d=="cart_updated"){
          $("#modal_updated").modal();
          updateCartCounter();
        }
        if(d=="no_session"){
          $("#modal_session").modal();
        }
        if(d=="session_brand"){
          alert("You are not eligible to process this transaction.");
        }
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
          if(d == "non_match_password"){
            e_pwd.classList.add("has-error");
            e_cpwd.classList.add("has-error");
            document.getElementById("pwd-reg-help").innerHTML = "Passwords do not match";
          }
          if(d == "email_exists"){
            e_email.classList.add("has-error");
            document.getElementById("email-reg-help").innerHTML = "Email already exists";
          }
          if(d=="brand_registered"){
            $("#brand-registered").modal();
          }
          if(d=="user_registered"){
            $("#user-registered").modal();
          }
          $('#submit-register').prop('disabled', false);
        },0);
      }
    });
  });
  //-- End Register Ajax --//
});