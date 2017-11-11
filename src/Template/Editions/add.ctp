<header class="page-header">
  <h2><?= __('Editions') ?></h2>
</header>

<div class="row">
  <div class="col-lg-12">
    <section class="panel">
      <header class="panel-heading">
        <h2 class="panel-title">Add new edition</h2>
      </header>
      <div class="panel-body">
          <?= $this->Flash->render() ?>
          <?= $this->Form->create($edition, ['class' => 'form-horizontal form-bordered']) ?>
          <?= $this->Form->input('name', ['type' => 'text']) ?>
        <div class="form-group">
          <label class="col-sm-3 control-label"><?= __('Is past') ?></label>
          <div class="col-sm-9">
            <div class="checkbox-custom chekbox-primary">
                <?= $this->Form->checkbox('is_past', ['label' => false, 'id' => 'active-checkbox']) ?>
              <label for="active-checkbox"></label>
            </div>
          </div>
        </div>
          <?= $this->Form->input('vimeo_album_id', ['type' => 'text']) ?>
          <?= $this->Form->input('speakers_list', ['type' => 'textarea']) ?>

          <?= $this->Form->button(__('Submit'), ['class' => 'pull-right']) ?>
          <?= $this->Form->end() ?>
      </div>
    </section>

  </div>
</div>