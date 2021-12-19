const US_STATES = {
  "AL": "Alabama",
  "AK": "Alaska",
  "AZ": "Arizona",
  "AR": "Arkansas",
  "CA": "California",
  "CO": "Colorado",
  "CT": "Connecticut",
  "DC": "District of Columbia",
  "DE": "Delaware",
  "FL": "Florida",
  "GA": "Georgia",
  "HI": "Hawaii",
  "ID": "Idaho",
  "IL": "Illinois",
  "IN": "Indiana",
  "IA": "Iowa",
  "KS": "Kansas",
  "KY": "Kentucky",
  "LA": "Louisiana",
  "ME": "Maine",
  "MD": "Maryland",
  "MA": "Massachusetts",
  "MI": "Michigan",
  "MN": "Minnesota",
  "MS": "Mississippi",
  "MO": "Missouri",
  "MT": "Montana",
  "NE": "Nebraska",
  "NV": "Nevada",
  "NH": "New Hampshire",
  "NJ": "New Jersey",
  "NM": "New Mexico",
  "NY": "New York",
  "NC": "North Carolina",
  "ND": "North Dakota",
  "OH": "Ohio",
  "OK": "Oklahoma",
  "OR": "Oregon",
  "PA": "Pennsylvania",
  "RI": "Rhode Island",
  "SC": "South Carolina",
  "SD": "South Dakota",
  "TN": "Tennessee",
  "TX": "Texas",
  "UT": "Utah",
  "VT": "Vermont",
  "VA": "Virginia",
  "WA": "Washington",
  "WV": "West Virginia",
  "WI": "Wisconsin",
  "WY": "Wyoming"
};
const CA_STATES = {
  "AB": "Alberta",
  "BC": "British Columbia",
  "MB": "Manitoba",
  "NB": "New Brunswick",
  "NL": "Newfoundland and Labrador",
  "NT": "Northwest Territories",
  "NS": "Nova Scotia",
  "NU": "Nunavut",
  "ON": "Ontario",
  "PE": "Prince Edward Island",
  "QC": "Quebec",
  "SK": "Saskatchewan",
  "YT": "Yukon"
};
var ajaxLoader = ajaxLoaderHTML();
var orderForm = $('#orderForm');

var orderModalElem = $('#orderModal');
var orderModal = new bootstrap.Modal(orderModalElem, {keyboard: false});

var stepShippingInfo = $('#stepShippingInfo');
var stepPaymentOption = $('#stepPaymentOption');
var stepCheckout = $('#stepCheckout');

var shippingCountry = $('#shippingCountry');
var shippingCountryValue = shippingCountry.val();
var shippingStateContainer = $('#shippingStateContainer');
var shippingInfo;

var btnSubmitStepOne = $('#btnSubmitStepOne');

var productId = $('input[name=product_id]');
var productIdValue = productId.val();
var termsContainer = $('#termsContainer');

$(document).ready(function(){
  // Select Product Event
  productId.on('change',function(){
    productIdValue = $(this).val();

    updateAgreeText(termsContainer, productIdValue);
  });

  // Select Country Event
  shippingCountry.on('change', function(){
    shippingCountryValue = $(this).val();
    shippingStateContainer.html(shippingStateHTML(shippingCountryValue));
    
    var type = (shippingCountryValue == 'CA') ? 'standard' : 'free';
    shippingInfo = SHIPPING[shippingCountryValue][type];
  });

  // Order Step 1 Submit Event
  btnSubmitStepOne.on('click', function(e){
    e.preventDefault();
    orderForm.validator('update');

    if (stepShippingInfo.validator('validate').has('.has-error').length === 0) {
      $.post('/products/order/step-one', orderForm.serialize());

      stepPaymentOption.removeClass('d-none');
      // stepCheckout.removeClass('d-none');
      $('html, body').animate({
        scrollTop: stepPaymentOption.offset().top
      }, 100);
    }
  });

  // Payment Method Event
  $('input[name="OrderForm[payment_processor]"]').on('change', function(e){
    stepCheckout.removeClass('d-none');
    
    if($(this).val() == 'credit_card') {
      $('#creditCardInfo').show();
      $('#btnSubmitOrder').show();
      $('#paypalContainer').hide();
      stepCheckout.find('#stepCheckout .header_title').text('Enter credit card information');
    } else {
      $('#paypalContainer').show();
      $('#creditCardInfo').hide();
      $('#btnSubmitOrder').hide();
      stepCheckout.find('#stepCheckout .header_title').text('Login to your paypal account');
    }
    
    $('html, body').animate({
      scrollTop: stepCheckout.offset().top
    }, 100);
  });

  // Credit Card Expiration Date 
  $('#creditCardExpireMonth, #creditCardExpireYear').change(function () {
    $('#expirationDate').val($('#creditCardExpireMonth').val() + $('#creditCardExpireYear').val());
  });

  // Format Credit Card and show CC Image
  var cleave = new Cleave('#creditCardNumber', {
    delimiter: '-',
    creditCard: true,
    onCreditCardTypeChanged: function (type) {
      type = type.split("15")[0];
      $('#creditCardNumber').removeClass('amex visa mastercard discover').addClass(type);

      $('#creditCardType').val('');
      if (type != 'unknown') {
        //type = (type == 'mastercard') ? 'master' : type;
        $('#creditCardType').val(type);
      }
    }
  });

  // Submit Order Form ------------------
  $('#btnSubmitOrder').on('click', function (e) {
    e.preventDefault();
    orderForm.validator('update');

    if (orderForm.validator('validate').has('.has-error').length === 0) {
      $.ajax({
        type: 'post',
        url: orderForm.prop('action'),
        data: orderForm.serialize(),
        beforeSend: function () {
          $('html').addClass('loading');
          console.log(orderForm);
          orderModalElem.find('#orderModalBody').removeClass('error success').html('');
          $('body').append(ajaxLoader);
        },
        success: function (response) {
          var res = tryParseJSON(response);

          $('html').removeClass('loading');
          $('.ajax-loader').remove();
          
          if (res.status == 100) {
            orderModal.show();
            orderModalElem.find('#orderModalBody').addClass('success')
              .html(orderModalHTML('Order has been successfully made.', 'success', false));

              setTimeout(function () {
                window.location.href = res.redirect_to;
              }, 2000);
          } else {
            orderModal.show();
            orderModalElem.find('#orderModalBody').addClass('error').html(orderModalHTML(res, 'error', true));
          }
          return ;
        },
        error: function () {
          orderModal.show();
          orderModalElem.find('#orderModalBody').addClass('error').html(orderModalHTML('Internal Error', 'error', true));
        }
      });
    }
    return false;
  });

  // Paypal Button Submit ------------------
  var sub_id = '';
  paypal.Buttons({
    style: {
      shape: 'rect',
      color: 'gold',
      layout: 'horizontal',
      tagline: false,
    },
    funding: {
      disallowed: [paypal.FUNDING.CREDIT, paypal.FUNDING.CARD, paypal.FUNDING.VENMO, paypal.FUNDING.ELV],
    },
    onInit: function(data, actions) {
      actions.disable();

      orderForm.on('change', function (e) {
        if ($('#checkboxesTerms:checked').val() == 1) {
          actions.enable();
        }else{
          orderForm.validator('update');
          actions.disable();
        }
      });
    },
    createSubscription: function (data, actions) {
      var subscription = actions.subscription.create({
        'plan_id': PRODUCTS[productIdValue]['pp_code'],
        'shipping_amount': {
          'currency_code': 'USD',
          'value': shippingInfo.amount
        }
      });
      
      var capture_order = subscription.then(function (res) {
        sub_id = res;
        paypalSubmit(orderForm, res);
      });
      
      return subscription;
    },
    onApprove: function (data, actions) {
      paypalConfirm(data.subscriptionID, "/products/order/upsell");
    },
    onError: function (err) {
      orderModal.show();
      orderModalElem.find('#orderModalBody').addClass('error').html(err);
      paypalFail(sub_id, err);
    },
    onCancel: function (data) {
      paypalCancel(sub_id);
    }
  }).render('#paypalContainer');

  // Display Select State by Default
  shippingCountry.trigger('change');

  updateAgreeText(termsContainer, productIdValue);
});

$(".cta_btn").click(function(e) {
  e.preventDefault();
  $('html, body').animate({
    scrollTop: $(".wrapper-6").offset().top
  }, 1000);
})