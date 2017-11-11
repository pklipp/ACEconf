<header class="page-header">
  <h2><?= __($title) ?></h2>

  <div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
      <li>
          <?= $this->Html->link('<i class="fa fa-home"></i>', ['controller' => 'Pages', 'action' => 'home'], ['escape' => false]) ?>
      </li>
      <li><span><?= __($title) ?></span></li>
    </ol>

    <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
  </div>
</header>