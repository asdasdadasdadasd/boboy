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

function reloadPage(){
  location.reload();
}

$("#item-unavailable").on("hidden.bs.modal", function () {
  reloadPage();
});

$("#update-complete-modal").on("hidden.bs.modal", function () {
  reloadPage();
});

$("#insert-complete-modal").on("hidden.bs.modal", function () {
  window.location = "index.php?mod=cpanel&t=items";
});

$('#edit-item-price').on('keypress', function(e){
  return e.metaKey || // cmd/ctrl
    e.which <= 0 || // arrow keys
    e.which == 8 || // delete key
    /[0-9]/.test(String.fromCharCode(e.which)); // numbers
});

$('#add-item-price').on('keypress', function(e){
  return e.metaKey || // cmd/ctrl
    e.which <= 0 || // arrow keys
    e.which == 8 || // delete key
    /[0-9]/.test(String.fromCharCode(e.which)); // numbers
});

function removeURLParameter(url, parameter) {
  //prefer to use l.search if you have a location/link object
  var urlparts= url.split('?');   
  if (urlparts.length>=2) {

      var prefix= encodeURIComponent(parameter)+'=';
      var pars= urlparts[1].split(/[&;]/g);

      //reverse iteration as may be destructive
      for (var i= pars.length; i-- > 0;) {    
          //idiom for string.startsWith
          if (pars[i].lastIndexOf(prefix, 0) !== -1) {  
              pars.splice(i, 1);
          }
      }

      url= urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : "");
      return url;
  } else {
      return url;
  }
}

function insertParam(key, value){

    key = encodeURI(key); value = encodeURI(value);

    var kvp = document.location.search.substr(1).split('&');

    var i=kvp.length; var x; while(i--) 
    {
        x = kvp[i].split('=');

        if (x[0]==key)
        {
            x[1] = value;
            kvp[i] = x.join('=');
            break;
        }
    }

    if(i<0) {kvp[kvp.length] = [key,value].join('=');}

    //this will reload the page, it's likely better to store this until finished
    document.location.search = kvp.join('&');  
}

var getUrlParameter = function getUrlParameter(sParam) {
  var sPageURL = decodeURIComponent(window.location.search.substring(1)),
      sURLVariables = sPageURL.split('&'),
      sParameterName,
      i;

  for (i = 0; i < sURLVariables.length; i++) {
      sParameterName = sURLVariables[i].split('=');

      if (sParameterName[0] === sParam) {
          return sParameterName[1] === undefined ? true : sParameterName[1];
      }
  }
};

 // DOCUMENT READY //

$(document).ready(function(){

  displayShopItems(getUrlParameter('brand'),getUrlParameter('search'));
  displayCartTable();

  function displayShopItems(bid,search){
    $.ajax({
        url: "modules/shop/ajax.php",
        method: "POST",
        data:{
          "display_shop": 1,
          "brand_id": bid,
          "search_val": search
        },
        success: function(data){
          setTimeout(function() {
            $("#shop-ajax-content").html(data);
          }, 0);
        }
    });
  };

  $("#shop-search-item").on("submit",function(e){
    e.preventDefault();
    var search_value = $("#shop-search-value").val();
    if(search_value == ""){
      var originalURL = window.location.href;
      window.location = removeURLParameter(originalURL,"search");
    }else{
      insertParam("search",search_value);
    }
  });

  $('#shop-filter-by').bind('change', function (e) { // bind change event to select
    var brand_id = $(this).val(); // get selected value
    e.preventDefault();
    if(brand_id == 0){
      var originalURL = window.location.href;
      window.location = removeURLParameter(originalURL,"brand");
    }else{
      insertParam("brand",brand_id);
    }
  });

  $('#search-form').on("submit", function(e){
    e.preventDefault();
    var search_value = document.getElementById('cpanel-search-item').value;
    if(search_value == ""){
      window.location = "index.php?mod=cpanel&t=items";
    }else{
      window.location = "index.php?mod=cpanel&t=items&search="+search_value;
    }
  });

  $("#btn-delete-item").click(function(){
    var item_id = $(this).attr("value");
    $("#delete-item-confirm").modal();
    $("#btn-delete-item-true").val(item_id);
  });

  $("#btn-delete-item-true").click(function(){
    var item_id = $(this).attr("value");
    $.ajax({
      url: 'modules/cpanel/itemview_delete.php',
      method: 'POST',
      data:{
        "delete_id": item_id,
      },
      success: function(data){
        if(data == "delete_success"){
          window.location = "index.php?mod=cpanel&t=items";
        }
      }
    });
  });

  $('#add-item-form').on("submit", function(e){
    e.preventDefault();
    $('#loading-modal').modal({backdrop: 'static', keyboard: false});
    $("#btn-add-item").prop("disabled", true);
    var formData = new FormData(this);

    $.ajax({
      url: 'modules/cpanel/itemview_add.php',
      type: 'POST',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(data){
        setTimeout(function(){
          if(data == "insert_success"){
            $("#btn-add-item").prop("disabled", false);
            $('#loading-modal').modal('hide');
            $("#insert-complete-modal").modal();
          }
        },0);
      }
    });
  });

  $('#edit-item-form').on("submit", function(e){
    e.preventDefault();
    $('#loading-modal').modal({backdrop: 'static', keyboard: false});
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
        setTimeout(function(){
          if(data == "update_success"){
            $("#btn-save-edit-item").prop("disabled", false);
            $("#btn-delete-item").prop("disabled", false);
            $('#loading-modal').modal('hide');
            $("#update-complete-modal").modal();
          }
        },0);
        
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
        if(d=="item_unavailable"){
          $("#item-unavailable").modal();
        }
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
          location.reload();
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