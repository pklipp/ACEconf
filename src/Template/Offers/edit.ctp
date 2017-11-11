<header class="page-header">
  <h2><?= __('Speakers subpage') ?></h2>
</header>

<div class="row">
  <div class="col-lg-12">
    <section class="panel">
      <header class="panel-heading">
        <h2 class="panel-title">Edit speaker subpage</h2>
      </header>
      <div class="panel-body">
          <?= $this->Flash->render() ?>
          <?= $this->Form->create($offer, ['class' => 'form-horizontal form-bordered']) ?>
          <?= $this->Form->input('title', ['type' => 'text']) ?>
          <?= $this->Form->input('description', ['type' => 'textarea']) ?>
          <?= $this->Form->input('bio', ['type' => 'textarea']) ?>
          <?= $this->Form->input('sponsor_id', ['options' => $sponsors, 'empty' => true]) ?>
          <?= $this->Form->input('edition_id', ['options' => $editions]) ?>

          <?= $this->Form->button(__('Submit'), ['class' => 'pull-right']) ?>
          <?= $this->Form->end() ?>
      </div>
    </section>

  </div>
</div>