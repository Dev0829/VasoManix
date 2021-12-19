<?php
use app\helpers\UtilityHelper;
use yii\helpers\Url;
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="/products/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/products/owlcarousel/owl.carousel.min.js"></script>
<?php 
if(isset($data['page']) && in_array($data['page'], ['home', 'order', 'upsell'])) : ?>
  <script src="https://www.paypal.com/sdk/js?client-id=<?=UtilityHelper::getCustomParameters('paypal_client_id');?>&vault=true&disable-funding=credit,card,bancontact,blik,eps,giropay,mybank,ideal,p24,sepa,sofort,venmo" data-sdk-integration-source="button-factory"></script>
  <script src="/products/js/cleave.min.js"></script>
  <script src="/products/js/validator.js"></script>
<?php endif; ?>
<script src="/products/js/common.js"></script>
<?= (isset($data['script'])) ? $data['script'] : ''; ?>
</body>
</html>
