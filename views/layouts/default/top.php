<?php
use app\helpers\UtilityHelper;
?>
<div class="superior-header">
  <div class="header-top">
    <div class="container">
      <div class="nav-wrapper">
        <div class="d-flex mr-30">
          <p class="description white mt-15 mb-15">Call us at <span class="bold"><a class="white" href="tel:<?= UtilityHelper::getCustomParameters('SitePhone'); ?>"><?= UtilityHelper::getCustomParameters('SitePhone'); ?></a></span></p>
        </div>
        <div class="d-flex">
          <img class="security" src="/products/images/order/security.png">
        </div>
      </div>
    </div>
  </div>
  <div class="header-bottom">
    <div class="container d-flex justify-content-between align-center">
      <a class="d-flex" href="/products/">
        <img class="logo" src="/products/images/order/logo.png">
      </a>
      <a class="d-flex cta_pane" href="/products/order/"><button class="cta_btn">Order Now</button></a>
    </div>
  </div>
</div>