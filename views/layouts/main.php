<?php
$data = isset($this->params['data']) ? $this->params['data'] : '';

$this->beginPage();

require_once 'default/head.php';
require_once 'default/menu.php';
require_once 'default/top.php';

$this->beginBody();
?>
<div class="page-wrapper">
  <?= $content; ?>
</div>

<?php
require_once 'default/bottom.php';
$this->endBody();

require_once 'default/footer.php';
$this->endPage();
?>
        
