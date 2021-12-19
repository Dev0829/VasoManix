<?php
use app\helpers\UtilityHelper;
$this->params['data'] = ['page' => 'guarantee', 'title' => 'Guarantee'];

$ctaPanel = '
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
</div>';
?>
<!-- Hero Section -->
<section class="hero-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 order-lg-2">
        <div class="content">
          <h1>TRY PRIMANIX VIRTUALLY RISK-FREE</h1>
          <div class="money-back">
            <div class="text">100% MONEY BACK GUARANTEE</div>
            <div class="seal"><img src="/images/money-back2.png" alt="" class="img-fluid d-none d-lg-inline money-back"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 order-lg-1">
        <div class="image">
          <img src="/images/bottles3.png" alt="Primanix Bottle" class="img-fluid">
          <img src="/images/money-back2.png" alt="" class="img-fluid d-lg-none money-back">
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section 1 -->
<section class="section-1">
  <div class="container">
    <h2>100% MONEY BACK GUARANTEE</h2>
    <p class="h2-sub">Purchase PRIMANIX with CONFIDENCE. GET REAL RESULTS OR YOUR MONEY BACK! Take the first step to <br class="d-none d-lg-block">changing your sex life by ordering PRIMANIX today!</p>
    <h3>FIRST-EVER GUARANTEED PENIS ENLARGEMENT SOLUTION</h3>
    <p class="h3-sub1 mb-0">PRIMANIX is the first-ever male enhancement pill to guarantee penis enlargement results. We’re not simply throwing the guarantee around; we’re absolutely confident that our product will meet and exceed our customers’ expectations by delivering top-quality penis enlargement and male enhancement results. No fine print, no scams, no empty claims. PRIMANIX delivers every single time, and you can count on us to make good on our promise to provide you with top-quality male enhancement supplements.</p>
    <hr class="my-4">
    <p class="h3-sub2 mb-0">With over 50 pages of published scientific research related to PRIMANIX’s ADVANCED SYNER-BOOST formula, standing behind PRIMANIX is a no-brainer. PRIMANIX is a product guaranteed by scientific facts to be effective, every single time. It’s important for us that our customers purchase with confidence, which is why we have compiled a 5-point promise for you, our customers, to let you know exactly what you need to expect from PRIMANIX. We promise that PRIMANIX will deliver on each of these points, and our purchase guarantee will protect you in the off chance that PRIMANIX fails to meet your expectations.</p>
  </div>
</section>
<!-- Section 2 -->
<section class="section-2">
  <div class="container">
    <h2>Here are the benefits that you should expect from PRIMANIX:</h2>
    <ul>
      <li>Have longer, thicker, and more intense erections</li>
      <li>Intensify your libido starting from the first dose</li>
      <li>Get a surge of sexual endurance starting from the first dose</li>
      <li>Bounce back faster after having an orgasm</li>
      <li>Develop sexual confidence from the male enhancement benefits of Primanix</li>
    </ul>
    <p class="note mb-0 mt-4 text-center">*Individual Results May Vary</p>
  </div>
</section>
<!-- Section 3 -->
<section class="section-3">
  <div class="container">
    <div class="top-row">
      <h2>IRONCLAD MONEY BACK GUARANTEE</h2>
      <p class="h2-sub">PRIMANIX is covered by an ironclad 90-day money back guarantee. Should you feel that PRIMANIX failed to fulfill our promises, you can call us within 90 days of your purchase, and we'll assist you with your refund. You can count on us to make the refund process swift, smooth, and hassle-free. We've processed thousands of orders for PRIMANIX, and we are proud to say that we have fulfilled every order to the satisfaction of our customers. We look forward to processing your order.</p>
      <h3>See how much you can save with our limited-time only offers!</h3>
    </div>
    <br>
    <?= $ctaPanel; ?>
    <div class="testimonials my-5">
      <h2>See what our satisfied customers have to say about PRIMANIX</h2>
      <?php 
        $testimonials = [
          ['subject' => '“Easiest purchase I made online!”', 'author' => 'Allan G. Dallas, TX',
          'message' => 'I’m not the kind of guy who goes into a shopping spree online. I check facts, do a little bit of research, and as much as possible, I want to know I’m getting the right product for its value. When I started looking for male enhancement pills, it was clear that Primanix was the only brand I’ll consider. It has the right elements to it – the science, the reviews, and the reputation. Best of all, it has the guarantee that I’m always looking for in a product. It was easily the easiest purchase I made online.'],
          ['subject' => '“Great quality, great guarantee! ”', 'author' => 'James C. New Orleans, LA',
          'message' => 'You know that it’s a good product when they offer a risk-free guarantee. For me, that was the selling point of Primanix. As long as they can guarantee my purchase, I’m open to trying their product. True enough, the pill did exactly what they said it would, and I never had to return mine. But if it wasn’t for the guarantee, I wouldn’t have discovered this great product. Thanks, Primanix!'],
          ['subject' => '“Amazing customer service”', 'author' => 'Tim S. Austin, T',
          'message' => 'I was considering Primanix as my next male enhancement pill, but I had to talk to them first to know if it was for me. At the time, I was taking pain medication, and I had to know if it was okay for me to take Primanix. I called Primanix’s hotline and spoke with a young man who was more than eager to help me with my situation. Although I was reassured that Primanix is a wonderful product, the young man didn’t push for the sale and told me to talk to my doctor to ensure that it was safe for me to take. I was impressed at the honesty that the young man showed. Only a few companies would tolerate such a thing.'],
          ['subject' => '“Thanks for getting me Primanix!”', 'author' => '~ David R. Fort Lauderdale, FL',
          'message' => 'I heard about Primanix from an old army buddy of mine, and I was really convinced that I had to get one. Sadly, I’m not the computer-savvy type and I’m not sure how to buy stuff online. I called their number and a young lady was more than helpful. She placed an order for me and she offered another product that also did wonders for my sexual health. Our entire exchange was surprisingly professional, which I didn’t expect given the nature of these products. As for the pill itself, I found Primanix to be truly effective, just as it says on the website.'],
        ];
      ?>
      <?php foreach($testimonials as $testimonial) { ?>
        <div class="item">
          <h4><?=$testimonial['subject'];?></h4>
          <p class="mb-0"><?=$testimonial['message'];?></p>
          <div class="author text-end"><?=$testimonial['author'];?></div>
        </div>
      <?php } ?>
    </div>
    <br>
    <?= $ctaPanel; ?>
  </div>
</section>