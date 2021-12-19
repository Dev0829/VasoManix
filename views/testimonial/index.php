<?php
use app\helpers\UtilityHelper;
$this->params['data'] = ['page' => 'testimonial', 'title' => 'Testimonial'];

?>
<!-- Hero Section -->
<section class="hero-section">
  <div class="container">
    <div class="content">
      <h1>LEARN MORE ABOUT PRIMANIX FROM OUR CUSTOMERS!</h1>
      <div class="image">
        <img src="/images/bottles6.png" alt="Primanix Bottle" class="img-fluid">
      </div>
    </div>
  </div>
</section>
<!-- Section 1 -->
<section class="section-1">
  <div class="container">
    <div class="testimonials">
      <?php 
        $testimonials = [
          ['subject' => '“Finally, something that works!”', 'author' => 'Bobby K. Atlanta, GA',
          'message' => 'Primanix was exactly how I wanted my male enhancement supplement to be. I’ve had jitters with the pills I’ve taken before, and nothing really worked. I’ve only had Primanix for the last month, and I can feel that it definitely works. I can function better now in bed, and I’ve been having the best sex of my life. I’m not entirely sure how Primanix did what it did, but it definitely improved my sexual health.'],
          ['subject' => '“My first and last male enhancement pill”', 'author' => 'Phil C. Los Angeles, CA',
          'message' => 'I’ve read plenty of stories about men buying male enhancement pills online, and most of them are either complaints or warnings for others not to take a certain brand of male enhancement. Fortunately for me, my first male enhancement supplement was amazing. I’ve been taking Primanix for the last 2 months, and I can’t be any happier. Primanix  was exactly how I imagined my male enhancement supplement to be, and I’m just lucky enough to get it right on the first try.'],
          ['subject' => '“My wife loves it so much!”', 'author' => 'Harvey S. Newark, NJ',
          'message' => 'I’ve been taking Primanix for the last 2 months and I’ve been steadily making progress. I didn’t tell my wife I was taking Primanix, and I was hoping that she’d notice something. True enough, she definitely knew something was up by the time I was halfway done with my first bottle. She knew I was taking something, and although I tried my best to hide it, she knew that there’s no way that it would just start happening without taking anything. I initially purchased one bottle, but she was happy enough to charge her account with a 3-month supply of Primanix after I told her about the pill.'],
          ['subject' => '“I’m still going at it at 60!”', 'author' => 'Pete W. Miami, FL',
          'message' => 'Half of the men at my age do not even think about sex. It’s an achievement for me to remain sexually active at 60 years of age. I’ve never been married, and I’m enjoying the dating game. The young ones definitely like going at it with someone who has experience. Thanks to Primanix , I can keep my sex life healthy, just like when I was in my 30s. I guess it was the right decision not to get married after all!'],
          ['subject' => '“Thanks for the best sex of my life!”', 'author' => 'Ivan K. Phoenix, AZ',
          'message' => 'Thanks to Primanix, I now have the best sex of my life every time I get to have sex. It’s an insane feeling knowing that the sex I’ve had before pale in comparison to the sex I’m having now. I never knew sex could be so good. I started using Primanix last month, and I can say I’m impressed. I’ve never had anything this good. If you’re getting bored with sex, Primanix will definitely change your mind.'],
          ['subject' => '“No more boring sex!”', 'author' => 'James W. Denver, CO',
          'message' => 'The young men wouldn’t believe it, but there would come a time in your life when sex would be boring as hell. I’m only in my 40s, and I’ve lived most of my adult life thinking that sex would always be boring once you get past the excitement and romance. I was wrong. I was introduced to Primanix by a buddy and discovered how good life is. Life without amazing sex could be really boring, and Primanix definitely changed the way I think about sex.'],
          ['subject' => '“I bought Primanix for my husband!”', 'author' => 'Anna C. Seattle, WA',
          'message' => 'My husband and I have had intimacy problems for years. We’d have sex probably twice a month, and it came to a point where sex feels unnatural and weird. I knew I had to do something. I did a little bit of digging and found out about Primanix . I was impressed by it since many other guys said that it worked. I purchased a bottle for my husband to try, and sure enough, we were back at it in just a week. It’s like we were back in college! My husband definitely loved it – and I loved it too! We’re going to purchase a 3-month pack and see what will happen.'],
          ['subject' => '“Can’t go wrong with Primanix!”', 'author' => 'Matt W. Houston, TX',
          'message' => 'If you’re like me who spends hours and hours every day researching online, then buying anything off of the internet would be a long, tedious process. It became problematic for me when I started looking for male enhancement pills. Every product says they are the best! But when I got to research about Primanix, I was definitely impressed. Its customers said that Primanix was the best they had, so I figured, this is worth a shot. I took Primanix for about a month and felt better than I’ve ever had. My libido was awesome, my stamina was amazing – it’s like I turned back the clock 15 years. If you’re looking for a male enhancement pill, do what I did and go with Primanix! You simply can’t go wrong with it!'],
          ['subject' => '“Awkward geek no more! ”', 'author' => 'Clint K. Sacramento, CA',
          'message' => 'I’ve been a geek all my life. I’m actually proud of it. I pride myself in being the smartest guy in the room, but in high school I quickly found out that not everyone enjoys someone being smarter than them. I got punked a lot in school and I started staying away from women. That’s why I never got into dating. All those years of bullying in school screwed up my confidence big time. I now have a great job, and the lifestyle to go with it. Thanks to Primanix I was able to build up my confidence with women and changed my sex life for good. Who would’ve thought that a simple pill would do that much?'],
          ['subject' => '“Best thing I bought online! ”', 'author' => 'Bill Q. Phoenix, AZ',
          'message' => 'I took a shot in the dark and purchased Primanix just because I read a good review about it. I wasn’t even looking for male enhancement, but I thought it was worth a shot. It turned out to be the best purchase I made online. Primanix greatly improved my sex life – and it could improve yours too. Try it out and you’ll see what I mean.'],
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