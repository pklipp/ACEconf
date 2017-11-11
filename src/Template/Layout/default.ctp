<!DOCTYPE html>
<html class="fixed">
<head>
    <?= $this->Html->charset() ?>

  <title><?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <?= $this->Html->css([
        'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light',
        //styles
        '/vendor/bootstrap/css/bootstrap.css',
        '/vendor/font-awesome/css/font-awesome.css',
        '/vendor/magnific-popup/magnific-popup.css',
        '/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css',
        '/stylesheets/theme.css',
        '/stylesheets/skins/default.css',
        '/stylesheets/theme-custom.css',
        '/css/custom.css',
    ]) ?>

    <?= $this->Html->script([
        '/vendor/modernizr/modernizr.js',
    ]) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<section class="body">
    <?= $this->Element('header') ?>

  <div class="inner-wrapper">
      <?= $this->Element('sidebar', ['items' => $sidebarItems]) ?>

    <section role="main" class="content-body">
        <?= $this->fetch('content') ?>
    </section>
  </div>

    <?= $this->Element('right_collapse_panel') ?>
</section>

<?= $this->Html->script([
    '/vendor/jquery/jquery.js',
    '/vendor/jquery-browser-mobile/jquery.browser.mobile.js',
    '/vendor/bootstrap/js/bootstrap.js',
    '/vendor/nanoscroller/nanoscroller.js',
    '/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js',
    '/vendor/magnific-popup/jquery.magnific-popup.js',
    '/vendor/jquery-placeholder/jquery-placeholder.js',
    //Theme Base, Components and Settings
    'theme.js',
    //Theme Custom
    'theme.custom.js',
    //Theme Initialization Files
    'theme.init.js',
]) ?>

<?= $this->fetch('script') ?>
</body>
</html>