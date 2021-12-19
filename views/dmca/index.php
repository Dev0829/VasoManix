<?php
use app\helpers\UtilityHelper;
$this->params['data'] = ['page' => 'dmca', 'title' => 'DMCA Policy'];
?>
<section class="dmca pmx-content">
  <div class="container">
    <h1 class="text-center">DMCA</h1>

    <h2>Digital Millennium Copyright Act (DMCA) Policy</h2>
    <p>If you find or believe any information, content, or images on our website infringe on your copyrights, please do not hesitate to notify our customer support about the issue via email, physical mail, or fax. A copy of your message will be forwarded to the necessary personal responsibility for complying with the law set forth by the Digital Millennium Copyright Act (DMCA 17 U.S.C. § 512(c)(3).). Be advised that unlawful misrepresentations or frivolous claims of copyright infringement are taken very seriously, and are illegal according to federal law. In addition, if you are found to be guilty of such claims, you will be held liable for damages resulting from said false claims.</p>
    <p>All content is used for illustrative purposes only. Any person depicted in the content of this site is a model.</p>
    <p>All correspondence regarding copyright infringement should include the following:</p>
    <p>Identification of the property that is in question on copyright infringement</p>
    <p>A statement from the copyright owner or acting agent that the material in question was not authorized to be used by our website.</p>
    <p>Proof that the property in question is owned by the copyright owner</p>
    <p>Signatures by all parties involved in the copyright infringement preceding</p>
    <p>Copyright Agent</p>
    <p class="mb-0"><?= UtilityHelper::getCustomParameters('SiteName'); ?></p>
    <p class="mb-5">Email Address: <a href="mailto:<?= UtilityHelper::getCustomParameters('SiteEmail'); ?>"><?= UtilityHelper::getCustomParameters('SiteEmail'); ?></a></p>

    <h2>Counter Notification</h2>
    <p>If you have found that your copyrighted material has been removed by mistake from our website due to a mistake on our end, you may send us a counter notification, in great detail, about the mistake and why we should not have removed it. We do not guarantee that any material will be placed back on our website, but in order for your notification to be effective, it should include the following:</p>
    <p>Your name, address, and telephone number</p>
    <p>A statement under penalty of perjury that your statement is in good faith and is not in question.</p>
    <p>A statement that you will allow a federal court jurisdiction in the preceding and accept process of service from the aforementioned party.</p>
    <p class="mb-0">If we find your counter notification to be valid, and under our discretion, your copyrighted material that was removed will be reinstated within 14 business days. In the event that your counter notification is denied, you may submit again at your expense. Please note that any misrepresentation or materially false statements regarding the copyrighted material in question may result in liability for damages, including those incurred from attorney fees, missed business opportunities, and/or court costs. Filing false counter notifications also constitutes as perjury in the United State justice system.</p>
  </div>
</section>