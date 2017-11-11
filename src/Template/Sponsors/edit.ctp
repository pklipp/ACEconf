<header class="page-header">
  <h2>Sponsors</h2>
</header>

<div class="row">
  <div class="col-lg-12">
    <section class="panel">
      <header class="panel-heading">
        <h2 class="panel-title">Edit sponsor</h2>
      </header>
      <div class="panel-body">
          <?= $this->Flash->render() ?>
          <?= $this->Form->create($sponsor, ['class' => 'form-horizontal form-bordered', 'type' => 'file']) ?>
          <?= $this->Form->input('name', ['type' => 'text']) ?>
          <?= $this->Form->input('link', ['type' => 'text']) ?>
          <?= $this->Form->input('sponsor_group', ['options' => $groups]) ?>
        <div class="form-group">
          <label class="col-sm-3 control-label"><?= __('Active') ?></label>
          <div class="col-sm-9">
            <div class="checkbox-custom chekbox-primary">
                <?= $this->Form->checkbox('active', ['label' => false, 'id' => 'active-checkbox']) ?>
              <label for="active-checkbox"></label>
            </div>
          </div>
        </div>
          <?php echo $this->Form->input('photo', ['type' => 'file']); ?>
          <?= $this->Html->image('../files/Sponsors/photo/' . $sponsor->photo, ['style' => 'max-width: 100%;max-height: 100px;']) ?>
        <br />
        <br />

          <?= $this->Form->button(__('Submit'), ['class' => 'pull-right']) ?>
          <?= $this->Form->end() ?>
      </div>
    </section>

  </div>
</div>