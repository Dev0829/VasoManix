<?php
use app\helpers\UtilityHelper;
$this->params['data'] = ['page' => 'faq', 'title' => 'FAQ'];
?>
<!-- Hero Section -->
<section class="hero-section">
  <div class="container">
    <h1>GOT QUESTIONS? <br>WE'RE HERE TO HELP</h1>
    <div class="image">
      <img src="/images/bottles6.png" alt="Primanix Bottle" class="img-fluid">
    </div>
  </div>
</section>
<!-- Section 1 -->
<section class="section-1">
  <div class="container">
    <div class="content text-center">
      <h2>Got a question for us? <br>We have the answers right here.</h2>
      <p class="mb-0">Browse through our Frequently Asked Questions page to see if we have the answer to your question posted. If not, feel free to contact us to get answers to your questions!</p>
    </div>
    <?php
      $faqs = [
        ['title' => 'IS PRIMANIX EFFECTIVE?', 'description' => 'Absolutely. PRIMANIX is the only clinically-tested penis enlargement pill in the market today. In its 30 months in development, PRIMANIX was vetted by critics, experts, and consumers. The effectiveness of PRIMANIX is attributed to its ADVANCED SYNER-BOOST formula, which focuses on ingredient synergy to create results never before seen in male enhancement supplements. Don’t just take our word for it. See the dozens of customer reviews online to know what real customers have to say about PRIMANIX!<br><br>*Individual Results May Vary'],
        ['title' => 'Is PRIMANIX the BEST MALE ENHANCEMENT pill?', 'description' => 'PRIMANIX is the top-rated male enhancement pill by supplement review aggregates, critics, and users alike. As PRIMANIX is the first-ever clinically-tested penis enlargement pill, with a detailed account of results, effectiveness, and proven results, it’s safe to say that PRIMANIX is the world’s leading male enhancement pill and penis enlargement solution. PRIMANIX’s effectiveness is attributed to its breakthrough ADVANCED SYNER-BOOST formula.'],
        ['title' => 'How long do I have to wait before I see results?', 'description' => 'PRIMANIX can be taken in a number of ways. Its core purpose is to provide users with a real and measurable solutions for penis enlargement. As penis enlargement is a complex process, users are advised to take PRIMANIX consistently for a period of time (2 weeks to 6 months) to create a significant increase in penis size. PRIMANIX can also be taken on an as-needed basis a fast-acting aphrodisiac and sexual endurance booster. PRIMANIX is absorbed by the body in as quickly as 30 minutes after the first dose, which makes it a viable alternative for mainstream poor erection quality drugs and sexual performance enhancers.'],
        ['title' => 'How big can I get with PRIMANIX?', 'description' => 'The increase in penis size depends on a lot of factors, including race, age, lifestyle, diet, and hormonal balance. PRIMANIX is specifically designed to be effective for anyone, regardless of the factors. The median increase in penis size after one month of consistent use is two inches added to length, and an inch added to girth. Much larger increases are tallied after taking the product consistently over a period of 3-6 months.<br><br>*Individual Results May Vary'],
        ['title' => 'How does PRIMANIX work?', 'description' => 'PRIMANIX is powered by its ADVANCED SYNER-BOOST formula, which focuses on ingredient synergy to create results never before seen in male enhancement supplements. The concept is to combine ingredients that work synergistically with each other to create an enhanced outcome. PRIMANIX contains vasodilators, aphrodisiacs, and hormone stabilizing ingredients. Vasodilators deliver the primary boost to blood flow, which influences penis enlargement. Vasodilators are further enhanced by aphrodisiacs that double as PDE-5 inhibitors. Aphrodisiacs enhance the quality and regularity of erections, while hormone stabilizing ingredients work synergistically with aphrodisiacs to prolong erections and enhance the quality of erections.<br><br>*Individual Results May Vary'],
        ['title' => 'How should I take PRIMANIX?', 'description' => 'There are two ways to take PRIMANIX. The simplest way is to take PRIMANIX on an as-need basis to rapidly increase sex drive and sexual stamina. Simply take PRIMANIX about 30 minutes before sex to experience the increase in libido and endurance. To experience the full benefits of PRIMANIX, including penis enlargement, it is recommended to take one dose (two capsules) of PRIMANIX every morning, on an empty stomach, for 3-6 months, or until you are satisfied with the results. Users can still take another capsule of PRIMANIX about 30 minutes before sex to get an intense boost in sex drive and stamina.'],
        ['title' => 'Is PRIMANIX safe to take?', 'description' => 'PRIMANIX is specifically formulated to be safe to take for healthy individuals. Its ADVANCED SYNER-BOOST formula relies on ingredient synergy rather than on ingredient dosing, which keeps the dosage low, while creating never-before-seen results in male enhancement supplements. The high-potency, low-dosage matrix reduces the risk of side effects, which are far too common with male enhancement supplements. As no supplement is 100% free from side effects, we advise customers with cardiovascular diseases such as hypertension and angina, as well as diabetes patients, to seek the advice of their physician before taking PRIMANIX or any other supplement.<br><br>*Individual Results May Vary'],
        ['title' => 'Is PRIMANIX a scam?', 'description' => 'No. We have established a reputation for providing the highest levels of quality for male enhancement supplements. We honor and recognize the trust given to us by our customers by ensuring that all aspects of our product, from ordering to fulfillment is met with absolute honesty. Our team has invested more than a decade in research and development to come up with products that men can trust and rely on, and while earning a few dollars off of scams are common in the industry, we prefer to earn every penny the clean and honest way.'],
        ['title' => 'Is PRIMANIX shipped discreetly?', 'description' => 'Given the sensitive nature of our business, we believe that it is in our customers’ best interests that we ship PRIMANIX discreetly. PRIMANIX is packed and sent in an unmarked box, without any discernable hint as to what kind of product is in the box. We respect our clients’ privacy, and we believe that this is the best way to deliver our products to our customers without risking anything in the process.'],
        ['title' => 'Does PRIMANIX offer guarantees?', 'description' => 'The best thing about PRIMANIX is our ironclad money-back guarantee. Only the best products in the market are bold enough to guarantee results, and PRIMANIX is one of those products. PRIMANIX offers customers a money-back guarantee to allow them to purchase with confidence. Our guarantee is simple, get a bigger penis, or get your money back. It’s that simple. Unlike other companies that make it difficult for their customers to process their refund, we promise our customers that the refund process would be swift and smooth. If ever you decide that PRIMANIX failed to live up to your expectations, simply contact us and our customer care representatives would help you through the refund process.'],
      ];
    ?>
    <div class="accordion mb-5" id="accordionFAQs">
      <?php foreach($faqs as $key => $faq) { ?>
        <div class="accordion-item">
          <h2 class="accordion-header" id="heading<?= $key; ?>">
            <button class="accordion-button <?= ($key == 0) ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $key; ?>" aria-expanded="false" aria-controls="collapse<?= $key; ?>"><?= $faq['title']; ?></button>
          </h2>
          <div id="collapse<?= $key; ?>" class="accordion-collapse collapse <?= ($key == 0) ? 'show' : '';?>" aria-labelledby="heading<?= $key; ?>" data-bs-parent="#accordionFAQs">
            <div class="accordion-body"><?= $faq['description']; ?></div>
          </div>
        </div>
      <?php } ?>
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