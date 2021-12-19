<?php
use app\helpers\UtilityHelper;
$this->params['data'] = ['page' => 'how', 'title' => 'How It Works'];

function ctaPanel($title) {
  return '
  <div class="panel cta">
    <div class="head">
      <h3>'. $title .'</h3>
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
              <a onclick="return false;" class="button">SEE WHAT OTHERS CRITICS HAVE TO SAY</a>
              <p class="my-1">OR</p>
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
}
?>
<!-- Section 1 -->
<section class="section-1">
  <div class="container text-center">
    <div class="content mb-5">
      <h1>SIZE MATTERS</h1>
      <p class="h1-sub">You'll be SHOCKED at how big you can get using Primanix</p>
      <button id="btnWatchVideo" class="d-none">WATCH VIDEO NOW</button>
    </div>
  </div>
  <div class="video d-none">
    <div class="container">
      <div class="ratio ratio-16x9">
        <iframe src="https://www.youtube.com/embed/zpOULjsdfdyy-n8?rel=0" title="YouTube video" allowfullscreen></iframe>
      </div>
    </div>
  </div>
  <div class="bottom-row text-center">
    <div class="container">
      <h2 class="red">**Save 60% TODAY only and While Supplies Last**</h2>
      <p class="h2-sub">Supplies are extremely limited <br class="d-none d-lg-block"> Prices are set to increase any day</p>
      <h3 class="red">Have your product delivered to you by <?= date('l, F d', strtotime('+5 day', strtotime(date('Y-m-d')))); ?> <br class="d-none d-lg-block">if you ORDER NOW ONLY</h3>
      <p class="h3-sub">Our Customers Know what it feels like <br class="d-none d-lg-block">to have their girl BEG and SCREAM that she just had the BEST SEX of her LIFE</p>
      <h4 class="mb-0">Because SEX without Primanix simply SUCKS</h4>
    </div>
  </div>
</section>
<!-- Section 2 -->
<section class="section-2">
  <div class="container">
    <h3>For Better Sex... SIZE MATTERS.</h3>
    <h2>Scroll Down To Order Now</h2>
    <div class="banner-image text-center mb-4">
      <img src="/images/banner-image.jpg" alt="" class="img-fluid">
    </div>
    <h4>Primanix's Scientific Formula is Clinically Tested to Dramatically Transform Your Penis and Brings a Whole New Meaning to Male Enhancement</h4>
    <p class="note text-center my-4">*Individual Results May Vary</p>
    <div class="text mb-5">
      <p><strong>PRIMANIX’S ADVANCED SYNER-BOOST FORMULA</strong> demonstrates how far technology has come with male enhancement. Primanix’s Ingredient Synergy works in stages to rapidly increase the size of your penis. With a formulated blend of ingredients that are proven to increase the volume of blood to flow to the cavernous spaces in the penis and work together to expand and vasodilate blood vessels in the penis, therefore giving you a larger, thicker, fuller, harder penis.</p>
      <p><strong>PRIMANIX’S ACCELERATED EXPANSION TECHNOLOGY</strong> is proven to be a highly-effective formula that accurately targets the sexual health problems that men have – size, stamina, and sex drive, and Primanix deals with these sexual health problems through vasodilation, libido enhancement, and hormone stabilization.</p>
      <p><strong>PENIS ENLARGEMENT</strong> is a complex process that involves blood circulation and vasodilation. To make the penis bigger, a consistent increase in blood flow is required to influence the permanent expansion of the cavernous spaces in the penis.</p>
      <p><strong>PRIMANIX WILL DRAMATICALLY INCREASE THE SIZE OF YOUR PENIS BY</strong> rapidly boosting blood flow to the penis with the use of vasodilators. Vasodilators work by increasing nitric oxide in the blood, which forms cGMP, the compound which makes the blood vessels dilate. Dilated blood vessels allow an increased volume of blood to flow to the penis. Primanix synergizes vasodilators with testosterone boosters, which not only reinforces the increase of cGMP through PDE-5 inhibitors; it also rapidly increases the libido of the user, which helps to promote an increased occurrence of erections for the user. This is further synergized with the use of hormone stabilizers which increases the user’s sexual stamina to prolong the erection of the user, which contributes to the penis enlargement process.</p>
      <p class="mb-0"><strong>AS A RESULT, THE USER EXPERIENCES A RAPID EXPANSION</strong> of the cavernous spaces in the penis, while increasing libido and sexual endurance in the process.</p>
    </div>
    <div class="stages">
      <div class="row justify-content-center text-center">
        <div class="col-sm-6 col-md-4 col-lg mb-3 mb-lg-0">
          <div class="images">
            <img src="/images/how/s2-image1.jpg" alt="" class="img-fluid">
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg mb-3 mb-lg-0">
          <div class="images">
            <img src="/images/how/s2-image2.jpg" alt="" class="img-fluid">
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg mb-3 mb-lg-0">
          <div class="images">
            <img src="/images/how/s2-image3.jpg" alt="" class="img-fluid">
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg mb-3 mb-lg-0">
          <div class="images">
            <img src="/images/how/s2-image4.jpg" alt="" class="img-fluid">
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg">
          <div class="images">
            <img src="/images/how/s2-image5.jpg" alt="" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
    <p class="note text-center mt-5 mb-0">*Individual Results May Vary</p>
  </div>
</section>
<!-- Section 3 -->
<section class="section-3">
  <div class="container">
    <div class="head-row mb-5">
      <p class="h2-sub mb-4">Primanix’s formula is precisely assembled through a thorough review of published scientific studies and clinical tests. Primanix offers the most comprehensive male enhancement solution made possible by combined scientific breakthroughs and innovation that led to a TRUE penis enlargement formula.</p>
      <h2>Primanix GUARANTEED BY SCIENCE</h2>
    </div>
    <?= ctaPanel('"Primanix is one of the most complete products we have ever come across"'); ?>
    <div class="bottom-row">
      <dib class="head d-flex align-items-center justify-content-center flex-column flex-lg-row justify-content-lg-between">
        <div class="logo">
          <img src="/images/logo.png" alt="Primanix Logo" class="img-fluid">
        </div>
        <div class="title">
          <h4>CLINICALLY TESTED TO INCREASE SIZE</h4>
        </div>
      </dib>
      <div class="image mb-3">
        <img src="/images/how/s3-image1.jpg" alt="" class="img-fluid">
      </div>
      <p class="mb-0">"Primanix Is The Strongest Formulation <br class="d-none d-lg-block">For Increasing Size On The Market Today"</p>
    </div>
  </div>
</section>
<!-- Section 4 -->
<section class="section-4">
  <div class="container">
    <h2>PRIMANIX INGREDIENTS</h2>
    <div class="ingredients">
      <div class="item mb-3">
        <h4>L-ARGININE</h4>
        <p class="mb-0">L-Arginine acts as a precursor to Nitric Oxide, which causes the dilation of blood vessels. Nitric Oxide combines with GMP to create cGMP, which relaxes the smooth muscles and allows an increased volume of blood to flow to the cavernous spaces in the penis. L-Arginine is the key ingredient that sets the conditions for penis enlargement to occur.</p>
      </div>
      <div class="item mb-3">
        <h4>TONGKAT ALI</h4>
        <p class="mb-0">Tongkat Ali performs three critical tasks in the formula as it provides support for vasodilation, improves libido and testosterone, and improves the quality of erections. Tongkat Ali is absorbed in a delayed-release manner that allows it to remain active for at least 24 hours.</p>
      </div>
      <div class="item mb-3">
        <h4>HORNY GOAT WEED</h4>
        <p class="mb-0">Horny Goat Weed, also known as Epimedium, improves libido and maximizes the vasodilation effects of the formula by acting as a PDE-5 inhibitor. Horny Goat Weed contains Icariin, which increases testosterone, penis size, sex drive, and sexual performance.</p>
      </div>
      <div class="item mb-3">
        <h4>TRIBULUS TERRESTRIS</h4>
        <p class="mb-0">Tribulus Terrestris acts as a libido enhancer and testosterone booster. The role of Tribulus Terrestris is to synergize its testosterone-boosting capabilities with the other testosterone boosters in the formula.</p>
      </div>
      <div class="item mb-3">
        <h4>MACA ROOT</h4>
        <p class="mb-0">Maca root helps to stabilize hormones and allows the user to experience more frequent, more intense erections. Maca root reduces the effects of the refractory period, which greatly diminishes the ability of the user to experience sexual arousal following an orgasm.</p>
      </div>
      <div class="item mb-3">
        <h4>MUIRA PUAMA</h4>
        <p class="mb-0">Muira Puama allows to rapidly enhance the user’s libido in just minutes after taking the first dose. Muira Puama acts as the fast-acting component of Primanix that allows the formula to act as a fast-release formula.</p>
      </div>
      <div class="item mb-3">
        <h4>DAMIANA EXTRACT</h4>
        <p class="mb-0">Damiana acts as a natural aphrodisiac that rapidly increases free testosterone, which subsequently affects libido, sexual endurance, and sexual performance. Damiana works hand in hand with the other testosterone boosters in the formula to create a long-lasting libido-boosting effect.</p>
      </div>
      <div class="item mb-3">
        <h4>XANTHOPARMELIA SCABROSA</h4>
        <p class="mb-0">Xanthoparmelia Scabrosa acts as a support PDE-5 inhibitor to maximize the effect of vasodilation. Xanthoparmelia Scabrosa is traditionally used as an herb to prevent poor erection quality. Its role in the formula is to prolong the increased flow of blood to the cavernous spaces in the penis.</p>
      </div>
      <div class="item">
        <h4>BUTEA SUPERBA</h4>
        <p class="mb-0">Butea Superba works as an androgen that rapidly increases testosterone levels in the formula to increase libido, size, performance, and stamina. Butea superba ensures that the body has maximum levels of testosterone at all times to prepare for sexual activity any time during the effective period of the formula.</p>
      </div>
    </div>
    <h3>THE SCIENCE OF Primanix EXPLAINED</h3>
    <ul>
      <li>
        <h5>CLINICALLY TESTED</h5>
        <p class="mb-0">Primanix is extensively tested by experts to ensure its penis enlargement capabilities</p>
      </li>
      <li>
        <h5>OPTIMAL RELEASE FORMULA</h5>
        <p class="mb-0">Primanix’s SYNER-BOOST FORMULA contains both fast-release and delayed-release ingredients to maximize its effectiveness during the day</p>
      </li>
      <li>
        <h5>TESTOSTERONE BOOST</h5>
        <p class="mb-0">Primanix contains the most potent androgens that help increase size, libido, endurance, and performance</p>
      </li>
      <li>
        <h5>HORMONE STABILIZATION</h5>
        <p class="mb-0">Primanix balances hormones to increase sexual endurance and maximize the penis enlargement benefits of the formula</p>
      </li>
    </ul>
    <p class="note text-center mt-4 mb-0">*Individual Results May Vary</p>
  </div>
</section>
<!-- Section 5 -->
<section class="section-5">
  <div class="container">
    <div class="panel mb-5">
      <div class="head text-center text-lg-start">
        <h3>Let's Break Down The Science</h3>
      </div>
      <div class="body" style="background:#fff;">
        <div class="d-flex flex-column flex-md-row">
          <div class="col-md-4">
            <img src="/images/bottle.jpg" alt="" class="img-fluid">
          </div>
          <div>
            <img src="/images/how/s5-image12.jpg" alt="" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
    <div class="top-row">
      <div class="row align-items-center">
        <div class="col-md-4">
          <div class="image1">
            <img src="/images/how/s5-image2.jpg" alt="" class="img-fluid">
          </div>
        </div>
        <div class="col-md-8">
          <div class="content">
            <h4>THE SCIENCE</h4>  
            <p class="mb-0">Let’s stop fooling ourselves for one minute and admit that size matters. Men with small to average-sized penises have believed that penis size is just a number to boost your ego. Well, it’s not. There’s a reason why they only get men with large penises to star in an adult video. It’s hard to convince ANYONE that you can satisfy a woman sexually with a small penis. You won’t get anywhere close to satisfying a woman sexually with an average-sized penis. Thanks to pornography, men and women are now aware that you can get a big penis, and you don’t have to be born with it. Now, with the advancement in science and nutrition, men can turn their fantasy into reality by turning their average-sized penis into porn star material. Primanix works – and you can bet on it.</p>
          </div>
        </div>
      </div>
      <div class="image2 text-center">
        <img src="/images/how/s5-image3.jpg" alt="" class="img-fluid">
      </div>
    </div>
    <div class="bottom-row">
      <h2>WHAT YOU CAN EXPECT FROM Primanix</h2>
      <ul>
        <li>
          <h5>1. SYNER-BOOST FORMULA</h5>
          <p class="mb-0">Primanix’s SYNER-BOOST formula is a group of meticulously-selected ingredients that have been studied for their expressed synergistic capabilities. The effectiveness of each ingredient in the formula is maximized by another ingredient in the formula, which creates an entire system of ingredients that will surpass its standard effectiveness. The SYNER-BOOST formula makes it possible to achieve results that no other male enhancement supplement has been able to provide.</p>
        </li>
        <li>
          <h5>2. INCREASED LENGTH AND GIRTH</h5>
          <p class="mb-0">The intense expansion of penile tissue is made possible by the increased blood flow to the cavernous spaces in the penis. With Primanix, you can expect a significant increase in penis length and girth in just 2-3 weeks.</p>
        </li>
        <li>
          <h5>3. IMPROVED ERECTILE QUALITY</h5>
          <p class="mb-0">Primanix combines PDE-5 inhibitors with vasodilators to provide a wider, unobstructed pathway of blood to the penis to improve the quality of erections. This is further intensified by the increase in libido and testosterone, which further increases the pressure of blood that flows to the penis.</p>
        </li>
        <li>
          <h5>4. DECREASED SEXUAL DOWNTIME</h5>
          <p class="mb-0">The refractory period is a period after having an orgasm when the individual no longer feels the sexual urge. This is caused by a sharp decline in testosterone. With Primanix, the effects of the refractory period are reduced, enabling the user to experience as many orgasms as he wants.</p>
        </li>
        <li>
          <h5>5. INCREASED SEXUAL PERFORMANCE</h5>
          <p class="mb-0">With a larger penis size, improved libido, and a lasting sexual endurance, Primanix users would have everything they need to share pleasure with their partners. No other male enhancement supplement would give you the advantage of being able to attain pleasure and share it with your partner.</p>
        </li>
      </ul>
      <p class="note text-center mt-4 mb-0">*Individual Results May Vary</p>
    </div>
  </div>
</section>
<!-- Section 6 -->
<section class="section-6">
  <div class="container">
    <div class="top-row mb-5">
      <div class="mb-5">
        <h2 class="text-center">Primanix GUARANTEE</h2>
        <p>PRIMANIX is the first-ever male enhancement pill to guarantee penis enlargement results. We’re not simply throwing the guarantee around; we’re absolutely confident that our product will meet and exceed our customers’ expectations by delivering top-quality penis enlargement and male enhancement results. No fine print, no scams, no empty claims. PRIMANIX delivers every single time, and you can count on us to make good on our promise to provide you with top-quality male enhancement supplements.</p>
        <p>With over 50 pages of published scientific research related to PRIMANIX’s ADVANCED SYNER-BOOST formula, standing behind PRIMANIX is a no-brainer. PRIMANIX is a product guaranteed by scientific facts to be effective, every single time. We are absolutely confident that PRIMANIX would be able to meet and exceed your expectations.</p>
        <p class="mb-0">PRIMANIX is the answer to all of your sexual health needs. Our clinically-tested formula will send your sex life into overdrive. Primanix is the last pill you’ll ever need. Experience what real male enhancement should be like when you order PRIMANIX today!</p>
        <p class="note mt-5 mb-0 text-center">*Individual Results May Vary</p>
      </div>

      <?= ctaPanel('"Primanix has radically changed the name of the game in male enhancement supplements"'); ?>
    </div>        
    <div class="middle-row">
      <h2>CLINICAL STUDIES</h2>
      <div class="studies">
        <div class="item px-lg-5">
          <img src="/images/how/s6-image1.jpg" alt="" class="img-fluid d-block mx-auto">
        </div>
        <div class="item px-lg-5">
          <img src="/images/how/s6-image2.jpg" alt="" class="img-fluid d-block mx-auto">
        </div>
        <div class="item px-lg-5">
          <img src="/images/how/s6-image3.jpg" alt="" class="img-fluid d-block mx-auto">
        </div>
        <div class="item px-lg-5">
          <img src="/images/how/s6-image4.jpg" alt="" class="img-fluid d-block mx-auto">
        </div>
      </div>
    </div>
    <div class="bottom-row">
      <h3>Sources:</h3>
      <div class="row mb-5 sources px-lg-4">
        <div class="col-md-6">
          <p><strong>Source 1:</strong> <br>
          <a href="http://www.ncbi.nlm.nih.gov/pmc/articles/PMC3669033/">http://www.ncbi.nlm.nih.gov/pmc/articles/PMC3669033/</a></p>
          <p><strong>Source 2:</strong> <br>
          <a href="http://www.ncbi.nlm.nih.gov/pmc/articles/PMC2835915/">http://www.ncbi.nlm.nih.gov/pmc/articles/PMC2835915/</a></p>
          <p><strong>Source 3:</strong> <br>
          <a href="http://www.ncbi.nlm.nih.gov/pmc/articles/PMC3210006/">http://www.ncbi.nlm.nih.gov/pmc/articles/PMC3210006/</a></p>
          <p><strong>Source 4:</strong> <br>
          <a href="http://www.ncbi.nlm.nih.gov/pubmed/26405615">http://www.ncbi.nlm.nih.gov/pubmed/26405615</a></p>
        </div>
        <div class="col-md-6">
          <p><strong>Source 5:</strong> <br>
          <a href="http://www.ncbi.nlm.nih.gov/pmc/articles/PMC3861174/">http://www.ncbi.nlm.nih.gov/pmc/articles/PMC3861174/</a></p>
          <p><strong>Source 6:</strong> <br>
          <a href="http://www.ncbi.nlm.nih.gov/pubmed/12851125">http://www.ncbi.nlm.nih.gov/pubmed/12851125</a></p>
          <p><strong>Source 7:</strong> <br>
          <a href="http://www.ncbi.nlm.nih.gov/pubmed/18801111">http://www.ncbi.nlm.nih.gov/pubmed/18801111</a></p>
          <p><strong>Source 8:</strong> <br>
          <a href="http://www.ncbi.nlm.nih.gov/pubmed/19260845">http://www.ncbi.nlm.nih.gov/pubmed/19260845</a></p>
        </div>
      </div>

      <?= ctaPanel('"Primanix is one of the most complete products we have ever come across"'); ?>
    </div>
  </div>
</section>