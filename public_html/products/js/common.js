$(document).ready(function(){
  if ($(window).width() < 768) {
    $('header .nav-wrapper').addClass('hidden');
  }
  $('.header-topbar').click(function() {
    $(this).toggleClass('change');
    if ($(this).hasClass("change")) {
      $('header .nav-wrapper').removeClass('hidden');
    } else {
      $('header .nav-wrapper').addClass('hidden');
    }
  });
});
// FUNCTIONS
function updateAgreeText(termsContainer, productIdValue) {
  var selectedProduct = PRODUCTS[productIdValue];
  var month = 'six-month';
  var day = 168;

  if(productIdValue == 'pmx_1_month') {
    month = 'one-month';
    day = 28;
  } else if(productIdValue == 'pmx_3_month') {
    month = 'three-month';
    day = 84;
  } else if(productIdValue == 'pmx_6_month') {
    month = 'six-month';
    day = 168;
  }
  
  termsContainer.find('.month').text(month);
  termsContainer.find('.day').text(day);
  termsContainer.find('.amount').text(selectedProduct['amount']);
}
function shippingStateHTML(country) {
  var html = '';
  var stateArray = (country == 'US') ? US_STATES : CA_STATES;
  html += `<select name="OrderForm[shippingState]" id="shippingState" class="form-select" data-error="State/Province Required" required>`;
    $.each(stateArray, function (index, value) {
      html += `<option value='` + index + `'>` + value + `</option>`;
    });
  html += `</select>`
  return html;
}
function tryParseJSON(jsonString) {
  try {
    var o = JSON.parse(jsonString);

    if (o && typeof o === "object") {
        return o;
    }
  } catch (e) {}

  return false;
}
function orderModalHTML(message, status, hasClose = false) {
  var html = '';
  var icon = (status == 'success') ? 'check' : 'error';

  if (hasClose) {
    html += '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
  }
  html += '<img src="/products/images/'+ icon +'.png" class="img-fluid" />';
  html += '<h3 class="text-center mt-2 mb-3">'+ status +'</h3>';
  html += '<p>'+ message +'</p>';
  
  return html;
}
// Paypal Functions
function paypalSubmit(orderForm, sub_id) {
  $.ajax({
    type: 'post',
    url: orderForm.prop('action'),
    data: orderForm.serialize() + '&pp_subscription_id=' + sub_id,
    success: function (response) {
      console.log('sent');
      console.log(response);
    }
  });
}
function paypalConfirm(sub_id, location_href) {
  $.get('/products/order/pp-confirm?id=' + sub_id, function () {
    console.log("Confirmed " + sub_id);
    window.location.href = location_href;
  });
}
function paypalFail(sub_id, error) {
  $.post("/products/order/pp-fail", {id: sub_id, error: error});
}
function paypalCancel(sub_id) {
  $.get('/products/order/pp-cancel?id=' + sub_id, function () {
    console.log(sub_id);
  });
}
function ajaxLoaderHTML(head = 'Please Wait', text = 'Processing your order...') {
  var html = '';
  html += `
  <div class="ajax-loader d-flex align-items-center justify-content-center flex-column">
    <h2>`+ head +`</h2>
    <p>`+ text +`</p>
    <div class="mt-4">
      <img src="/products/images/ajax-loader.gif" alt="AJAX Loader" />
    </div>
  </div>`;
  return html;
}
function paypalUpsellSubmit(upsellForm, sub_id) {
  //console.log('hello');
  var form = upsellForm.serialize() + '&pp_subscription_id=' + sub_id;
  $.ajax({
      type: 'post',
      url: '/products/upsell/upsell-process',
      data: form,
      success: function (response) {
        console.log('sent');
        //console.log(response);
      }
  });
}