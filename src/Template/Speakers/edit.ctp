<header class="page-header">
  <h2>Speakers</h2>
</header>

<div class="row">
  <div class="col-lg-12">
    <section class="panel">
      <header class="panel-heading">
        <h2 class="panel-title">Edit speaker</h2>
      </header>
      <div class="panel-body">
          <?= $this->Flash->render() ?>
          <?= $this->Form->create($speaker, ['class' => 'form-horizontal form-bordered', 'type' => 'file']) ?>
          <?= $this->Form->input('first_name', ['type' => 'text']) ?>
          <?= $this->Form->input('last_name', ['type' => 'text']) ?>
          <?= $this->Form->input('position') ?>
          <?= $this->Form->input('twitter_link', ['type' => 'text']) ?>
          <?= $this->Form->input('facebook_link', ['type' => 'text']) ?>
          <?= $this->Form->input('linkedin_link', ['type' => 'text']) ?>
          <?= $this->Form->input('google_link', ['type' => 'text']) ?>
          <?= $this->Form->input('offer_id', ['options' => $offers, 'label' => 'Speaker subpage']) ?>
          <?= $this->Form->input('edition_id', ['options' => $editions]) ?>
          <?= $this->Form->input('photo', ['type' => 'file']) ?>
          <?= $this->Html->image('../files/Speakers/photo/' . $speaker->photo, ['style' => 'max-width: 100%;max-height: 100px;']) ?>
        <br />
        <br />

        <div class="form-group">
          <label class="col-sm-3 control-label"><?= __('Is active') ?></label>
          <div class="col-sm-9">
            <div class="checkbox-custom chekbox-primary">
                <?= $this->Form->checkbox('is_active', ['label' => false, 'id' => 'active-checkbox']) ?>
              <label for="active-checkbox"></label>
            </div>
          </div>
        </div>

          <?= $this->Form->button(__('Submit'), ['class' => 'pull-right']) ?>
          <?= $this->Form->end() ?>
      </div>
    </section>

  </div>
</div>