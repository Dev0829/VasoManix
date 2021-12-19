<?php
use app\helpers\UtilityHelper;
$this->params['data'] = ['page' => 'privacy', 'title' => 'Return Policy'];
?>
<section class="privacy pmx-content">
  <div class="container">
    <h1 class="text-center">Return POLICY</h1>

    <h2>Return Policy & Refunds</h2>
    <p>If you are not 100% satisfied with your purchase, you can return the product and get a full refund, less the cost of shipping. You can return a product for up to 90 days from the date you purchased it.</p>
    <p>Simply contact us then send the remaining product to the return address provided. You are responsible for the cost of shipping the unused product back to us.</p>
    <p class="mb-5">All information that is entered is the sole ownership of <?= UtilityHelper::getCustomParameters('SiteName'); ?>, and will not be sold or distributed, and is only used to process orders and to follow up with customers.</p>

    <h2>Contact Us</h2>
    <p>If you have any questions or concerns regarding the website, this privacy policy, or any products that are offered, please contact us using the provided contact form on this website.</p>
    
    <p class="mb-0">Contact: <a href="<?= UtilityHelper::getCustomParameters('SiteUrl'); ?>"><?= UtilityHelper::getCustomParameters('SiteUrl'); ?></a></p>
    <p class="mb-0">Call Us at: <a href="tel:<?= UtilityHelper::getCustomParameters('SitePhone'); ?>"><?= UtilityHelper::getCustomParameters('SitePhone'); ?></a></p>
    <p class="mb-0">Email Address: <a href="mailto:<?= UtilityHelper::getCustomParameters('SiteEmail'); ?>"><?= UtilityHelper::getCustomParameters('SiteEmail'); ?></a></p>
  </div>
</section>