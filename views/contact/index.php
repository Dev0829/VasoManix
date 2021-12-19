<?php
use app\helpers\UtilityHelper;
$this->params['data'] = ['page' => 'contact', 'title' => 'Contact Us'];

?>
<!-- Hero Section -->
<section class="hero-section">
  <div class="container">
    <div class="content">
      <h1>we are always here to help 24/7/365</h1>
    </div>
  </div>
</section>
<!-- Section 1 -->
<section class="section-1">
  <div class="container">
    <h2>Contact Us</h2>
    <div class="form">
      <form action="/contact/contact-process" data-toggle="validator" method="POST" id="contactForm">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="form-group">
              <label for="name">Name: *</label>
              <input type="text" id="name" name="name" class="form-control" pattern="^[a-zA-Z \s]*$" data-error="Please use only letters" required>
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
             <label for="email">Email: *</label>
              <input type="email" name="email" id="email" class="form-control" data-error="Email address is invalid" required>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="message">Message: *</label>
              <textarea name="message" id="message" class="form-control" required></textarea>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="col-12">
            <p class="note my-4">Fields marked with * are required.</p>
            <div class="text-center">
              <button type="button" id="btnSubmitContact">Submit</button>
            </div>
          </div>
        </div>
      </form>
    </div>
    <br>
    <div class="panel cta">
      <div class="head">
        <h3>RUSH MY ORDER OF PRIMANIX NOW!</h3>
        <img src="/images/money-back2.png" alt="" class="img-fluid d-none d-lg-inline money-back">
      </div>
      <div class="body">
        <div class="secure text-center mb-3 text-lg-end pe-4">
          <img src="/images/secure.jpg" alt="" class="img-fluid">
        </div>
        <div class="row align-items-center">
          <div class="col-lg-6 mb-3 mb-lg-0">
            <div class="image">
              <img src="/images/bottles3.png" alt="" class="img-fluid">
              <img src="/images/money-back2.png" alt="" class="img-fluid d-lg-none money-back">
            </div>            
          </div>
          <div class="col-lg-6 ps-xl-0">
            <div class="text">
              <ul>
                <li>Immediate Results</li>
                <li>Free Shipping</li>
                <li>Rush Delivery</li>
                <li>Money Back Guarantee</li>
              </ul>
              <div class="text-center">
                <a href="/order" class="button">Order Now</a>
                <div class="secure2 my-3">
                  <img src="/images/secure2.jpg" alt="" class="img-fluid">
                </div>
                <h6>SAVE 60 % <span class="red">INSTANTLY</span></h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" data-bs-backdrop="static" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div id="contactModalBody" class="p-4"></div>         
      </div>
    </div>
  </div>
</div>
<?php
$this->params['data']['script'] = <<<EOT
<script src="/js/validator.js"></script>
<script src="/js/common.js"></script>
<script>
var ajaxLoader = ajaxLoaderHTML('Please wait', 'Sending your message...');
var contactForm = $('#contactForm');
var contactModalElem = $('#contactModal');
var contactModal = new bootstrap.Modal(contactModalElem, {keyboard: false});

$(document).ready(function(){
  // Submit Contact Form
  $('#btnSubmitContact').on('click', function (e) {
    e.preventDefault();
    contactForm.validator('update');

    if (contactForm.validator('validate').has('.has-error').length === 0) {
      $.ajax({
        type: 'post',
        url: contactForm.prop('action'),
        data: contactForm.serialize(),
        beforeSend: function () {
          $('html').addClass('loading');
          contactModalElem.find('#contactModalBody').removeClass('error success').html('');
          $('body').append(ajaxLoader);
        },
        success: function (response) {
          var res = tryParseJSON(response);

          $('html').removeClass('loading');
          $('.ajax-loader').remove();
          
          if (res.status == 200) {
            contactModal.show();
            contactModalElem.find('#contactModalBody').addClass('success')
              .html(orderModalHTML(res.message, 'success', false));

            setTimeout(function () {
              contactForm[0].reset();
              contactModal.hide();
            }, 2000);
          } else {
            contactModal.show();
            contactModalElem.find('#contactModalBody').addClass('error')
              .html(orderModalHTML(res.message, 'error', true));
          }
          return ;
        },
        error: function (response) {
          var res = tryParseJSON(response);

          contactModal.show();
          contactModalElem.find('#contactModalBody').addClass('error').html(orderModalHTML(res.message, 'error', true));
        }
      });
    }
    return false;
  });
});
</script>
EOT;
?>