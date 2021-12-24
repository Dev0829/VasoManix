<?php
use app\helpers\UtilityHelper;
use yii\bootstrap4\ActiveForm;
$this->params['data'] = ['page' => 'upsell', 'title' => 'Upsell'];

$previousOrder = FALSE;
$paymentProcessor = 'credit_card';
$previousOrderID = 0;
$selectedProduct = '';

// DEFAULT: Ultra Erection Booster 1 Month
$upsellProduct = UtilityHelper::getCustomParameters('ueb_1_month');
$upsellProduct['product'] = 'ueb_1_month';

if(isset($_SESSION['previous_order'])){
  $previousOrder = $_SESSION['previous_order'];

  if(isset($previousOrder['payment_processor']) && $previousOrder['payment_processor'] == 'paypal'){
    $paymentProcessor = $previousOrder['payment_processor'];
  }
  $previousOrderID =  isset($previousOrder['id']) ? $previousOrder['id'] : '';
  $selectedProduct = isset($previousOrder['pro_id']) ? $previousOrder['pro_id'] : '';
  
  if($selectedProduct == 'pmx_1_month') {
    // Ultra Erection Booster 1 Month
    $upsellProduct = UtilityHelper::getCustomParameters('ueb_1_month');
    $upsellProduct['product'] = 'ueb_1_month';
  } elseif($selectedProduct == 'pmx_3_month') { 
    // Ultra Erection Booster 3 Month
    $upsellProduct = UtilityHelper::getCustomParameters('ueb_3_month');
    $upsellProduct['product'] = 'ueb_3_month';
  } elseif($selectedProduct == 'pmx_6_month') {
    // Ultra Erection Booster 6 Month
    $upsellProduct = UtilityHelper::getCustomParameters('ueb_6_month');
    $upsellProduct['product'] = 'ueb_6_month';
  }
}
?>
<link href="/products/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/products/css/order.css">
<!-- Intro Section -->
<section class="intro-section">
  <div class="container text-center">
    <div class="content text-center">
      <h1 class="RiftDemiItalic">Congratulations!</h1>
      <h3 class="RiftDemiItalic">You just purchased one of the most powerful Male Enhancement Products in the world.</h3>
      <h4 class="RiftMedium">And now there is a Breakthrough Formula that works with VasoManix that is proven to </h4>
      <h2 class="RiftMediumItalic">Double the Results in Half the Time.</h2>
      <h5 class="RiftDemi">Risk-Free &amp; Guaranteed PLUS FREE SHIPPING</h5>
    </div>
  </div>
</section>
<!-- Form Section -->
<section class="form-section">
  <div class="container">
    <div class="row">
      <div class="col-xl-6 text-center left mb-3 mb-xl-0">
        <div class="d-flex flex-column flex-lg-row align-items-center flex-xl-column">
          <div class="image">
            <img src="/products/images/order/bottle.png" class="img-fluid" alt="VasoManix">
          </div>
          <div class="text">
            <h5 class="RiftMediumItalic">Clinically tested to increase testosterone</h5>
            <h4 class="RiftDemiItalic">Using with VasoManix will increase the effects</h4>
            <h3 class="RiftDemiItalic">and drastically reduce the time</h3>
          </div>
        </div>
      </div>
      <div class="col-xl-6 text-center right">
        <div class="content mb-4 mb-lg-0">
          <p>With your purchase of VasoManix you are able to purchase Superior Boost for 50% off.</p>
          <p>Superior Boost will raise free testosterone allowing you to reach the most optimal results of penis growth.</p>
          <p class="mb-4">Superior Boost will also give you the hardest and most massive erections possible.</p>
        </div>
        <form action="/products/upsell/upsell-process" data-toggle="validator" method="POST" id="upsellForm">
          <input type="hidden" name="UpsellForm[previous_order_id]" value="<?= $previousOrderID; ?>">
          <input type="hidden" name="UpsellForm[selected_product]" value="<?= $selectedProduct; ?>">
          <input type="hidden" name="UpsellForm[upsell_product]" value="<?= $upsellProduct['product']; ?>">
          
          <h2 class="mb-0">Yes, I want to accelerate my results by <span>$<?= $upsellProduct['amount']; ?></span></h2>
          <p class="h2-sub mt-2 mb-3 text-muted font-weight-bold"><?= $upsellProduct['name']; ?> Supply</p>
          <?php if($paymentProcessor == 'credit_card') : ?>
            <button type="button" class="pmx-button" id="btnSubmitUpsell">COMPLETE MY ORDER</button>
          <?php else: ?>
            <div id="paypalContainer"></div>
          <?php endif; ?>
          <div class="form-group">
            <div class="form-check mb-3">
              <input type="checkbox" name="UpsellForm[terms]" id="checkboxesTerms" value="1" required checked>
              <label class="form-check-label" for="checkboxesTerms">
                <i class="custom-check"></i>
                <span>Click the checkbox to agree to the&nbsp; <a href="/products/terms"> Subscription Terms and Conditions.</a></span>
              </label>
            </div>
            <div class="help-block with-errors"></div>
          </div>
          <a href="/products/order/thankyou" class="no-thanks mt-3">No thanks, I decline my order. </a>
        </form>
      </div>
    </div>
    <div class="upsell_disclaim pt-30">
      <p class="MontserratRegular text-center">The statements contained herein have not been evaluated or analyzed by the Food and Drug Administration, and are therefore for information purposes only. Superior Boost is not intended to treat, cure, prevent, or otherwise aid in the cure of any disease or sickness. The information present should not be used in place of a physician's advice. Always consult a physician for medical advice and prior to taking Superior Boost.</p>
    </div>
  </div>
</section>
<!-- <section class="footer">
  <div class="bg-black section-space">
    <div class="container d-flex flex-direction-column">
      <div class="footer-top d-flex justify-content-between align-center">
        <div class="d-flex flex-direction-column">
          <a href="/products">
            <img class="logo pt-60" src="/products/images/logo_reverse.png">
          </a>
          <div class="footer-nav pb-30">
            <span class="white"><a href="/products/dmca">DMCA</a></span>
            <span class="white"><a href="/products/terms">Terms & Conditions</a></span>
            <span class="white"><a href="/products/privacy">Privacy Policy</a></span>
            <span class="white last"><a href="/products/sitemap">sitemap</a></span>
          </div>
        </div>
        <div class="footer-nav pt-60">
          <span class="white"><a href="/products/">HOME</a></span>
          <span class="white"><a href="/products/howitworks">HOW IT WORKS</a></span>
          <span class="white"><a href="/products/faq">FAQ</a></span>
          <span class="white"><a href="/products/guarantee">GUARANTEE</a></span>
          <span class="white last"><a href="/products/order">ORDER</a></span>
        </div>
      </div>
      <div class="footer-bottom d-flex justify-content-between">
        <span>VasoManix © 2021. All Rights Reserved</span>
        <img src="/products/images/upsell/upsell-payment.png" class="img-fluid">
      </div>
  </div>
</section> -->
<!-- Modal -->
<div class="modal fade" id="upsellModal" tabindex="-1" role="dialog" data-bs-backdrop="static" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div id="upsellModalBody" class="p-4"></div>         
      </div>
    </div>
  </div>
</div>
<?php
$this->params['data']['script'] = <<<EOT
<script>
var paymentProcessor = '$paymentProcessor';
var ajaxLoader = ajaxLoaderHTML();
var upsellForm = $('#upsellForm');

var upsellModalElem = $('#upsellModal');
var upsellModal = new bootstrap.Modal(upsellModalElem, {keyboard: false});

$(document).ready(function(){
  if(paymentProcessor == 'credit_card') {
    // Submit Upsell Form ------------------
    $('#btnSubmitUpsell').on('click', function (e) {
      e.preventDefault();
      upsellForm.validator('update');

      if (upsellForm.validator('validate').has('.has-error').length === 0) {
        $.ajax({
          type: 'post',
          url: upsellForm.prop('action'),
          data: upsellForm.serialize(),
          beforeSend: function () {
            $('html').addClass('loading');
            upsellModalElem.find('#upsellModalBody').removeClass('error success').html('');
            $('body').append(ajaxLoader);
          },
          success: function (response) {
            var res = tryParseJSON(response);

            $('html').removeClass('loading');
            $('.ajax-loader').remove();
            
            if (res.status == 100) {
              upsellModal.show();
              upsellModalElem.find('#upsellModalBody').addClass('success')
                .html(orderModalHTML('Order has been successfully made.', 'success', false));

                setTimeout(function () {
                  window.location.href = res.redirect_to;
                }, 2000);
            } else {
              upsellModal.show();
              upsellModalElem.find('#upsellModalBody').addClass('error')
                .html(orderModalHTML(res, 'error', true));
            }
            return ;
          },
          error: function () {
            upsellModal.show();
            upsellModalElem.find('#upsellModalBody').addClass('error').html(orderModalHTML('Internal Error', 'error', true));
          }
        });
      }
      return false;
    });
  }
  if(paymentProcessor == 'paypal') {
    // Upsell Paypal Button Submit ------------------
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
        //actions.disable();

        upsellForm.on('change', function (e) {
          if ($('#checkboxesTerms:checked').val() == 1) {
            actions.enable();
          }else{
            upsellForm.validator('update');
            actions.disable();
          }
        });
      },
      createSubscription: function (data, actions) {
        var subscription = actions.subscription.create({
          'plan_id': '$upsellProduct[pp_code]'
        });

        var capture_order = subscription.then(function (res) {
          sub_id = res;
          paypalUpsellSubmit(upsellForm, res);
        });
        
        return subscription;
      },
      onApprove: function (data, actions) {
        paypalConfirm(data.subscriptionID, "/products/order/thankyou");
      },
      onError: function (err) {
        upsellModal.show();
        upsellModalElem.find('#upsellModalBody').addClass('error').html(orderModalHTML(err, 'error', true));
        paypalError(sub_id, err);
      },
      onCancel: function (data) {
        paypalCancel(sub_id);
      }
    }).render('#paypalContainer');
  }
});
</script>
EOT;
?>