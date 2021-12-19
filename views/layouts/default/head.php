<?php
$page            = isset($data['page']) ? $data['page'] : '';
$pageId          = $page !== '' ? $data['page'] . '_page_body' : '';
$pageTitle       = (isset($data['title']) && $data['title'] !== '') ? $data['title'] : ucfirst($page);
$pageDescription = isset($data['description']) ? $data['description'] : '';
$canonicalUrl    = isset($data['canonical']) ? $data['canonical'] : '';
$language        = isset($data['language']) ? $data['language'] . '/' : '';
$head_scripts    = isset($data['head_script']) ? $data['head_script'] : '';

function getAddress() {
  $protocol = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
  return $protocol.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="<?= Yii::$app->charset; ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?= $pageDescription ?>">
  <meta name="robots" content="noimageindex, nofollow, nosnippet">
  <link rel="stylesheet" href="/products/css/style.css">
  <?= $head_scripts ?>
  <?php $this->registerCsrfMetaTags() ?>

  <title><?= $pageTitle.' | VasoManix' ?></title>
</head>
<body class="<?= $page; ?>" id="<?= $pageId; ?>">
