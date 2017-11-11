<header class="page-header">
  <h2><?= __('Settings') ?></h2>
</header>

<div class="row">
  <div class="col-md-12">
    <section class="panel">
      <header class="panel-heading">
        <h2 class="panel-title">MAIN PAGE settings</h2>
        <p class="panel-subtitle">
          Application settings
        </p>
      </header>
      <div class="panel-body">
          <?= $this->Flash->render() ?>
          <?= $this->Form->create($setting, ['class' => 'form-horizontal form-bordered', 'type' => 'file']) ?>
          <?= $this->Form->input('edition_id', ['options' => $editions]) ?>
          <?= $this->Form->input('title') ?>
          <?= $this->Form->input('place_and_date') ?>
          <?= $this->Form->input('additional_info') ?>
          <?= $this->Form->input('header_primary') ?>
          <?= $this->Form->input('header_secondary') ?>
          <?= $this->Form->input('countdown_end') ?>

        <div class="form-group">
          <label class="col-sm-3 control-label"><?= __('Confetti') ?></label>
          <div class="col-sm-9">
            <div class="checkbox-custom chekbox-primary">
                <?= $this->Form->checkbox('confetti', ['label' => false, 'id' => 'active-checkbox']) ?>
              <label for="active-checkbox"></label>
            </div>
          </div>
        </div>

        <h3 style="text-align:center;"><?= __('SEO') ?></h3><br />
          <?= $this->Form->input('site_title') ?>
          <?= $this->Form->input('site_description') ?>
          <?= $this->Form->input('site_bs_title') ?>
          <?= $this->Form->input('site_bs_description') ?>

        <h3 style="text-align:center;"><?= __('Mailchimp & emails') ?></h3><br />
          <?= $this->Form->input('mailchimp_api_key') ?>
          <?= $this->Form->input('mailchimp_list_id', ['type' => 'text', 'label' => 'Mailchimp list ID']) ?>
          <?= $this->Form->input('email', ['type' => 'text', 'label' => 'Emails for contact form']) ?>

          <?= $this->Form->input('email_after_submission_title', ['type' => 'text', 'label' => 'Email sent after completing submission form title']) ?>
          <?= $this->Form->input('email_after_submission', ['type' => 'textarea', 'label' => 'Email sent after completing submission form content']) ?>
        <div class="form-group">
          <div class="col-md-6 col-md-push-3">
            <p>
              Allowed strings which will be replaced:<br /><br />
              {{NAME}} - name from submission form<br />
              {{EMAIL}} - email from submission form<br />
              {{TITLE}} - title of presentation from submission form<br />
            </p>
          </div>
        </div>

        <h3 style="text-align:center;"><?= __('About icons') ?></h3><br />
          <?= $this->Form->input('icon_type_1') ?>
          <?= $this->Form->input('icon_type_2') ?>
          <?= $this->Form->input('icon_edition') ?>
          <?= $this->Form->input('icon_speakers') ?>
          <?= $this->Form->input('icon_workshops') ?>
          <?= $this->Form->input('icon_attendees') ?>
          <?= $this->Form->input('icon_videos') ?>
          <?= $this->Form->input('icon_talk') ?>

        <h3 style="text-align:center;"><?= __('Site texts') ?></h3><br />
          <?= $this->Form->input('about_description', ['type' => 'textarea']) ?>
          <?= $this->Form->input('speakers_sliders_title') ?>
          <?= $this->Form->input('speakers_description', ['type' => 'textarea']) ?>

        <h3 style="text-align:center;"><?= __('Counter numbers') ?></h3><br />
          <?= $this->Form->input('counter_speakers') ?>
          <?= $this->Form->input('counter_attendees') ?>
          <?= $this->Form->input('counter_lectures') ?>
          <?= $this->Form->input('counter_workshops') ?>

        <h3 style="text-align:center;"><?= __('Timeline') ?></h3><br />
          <?= $this->Form->input('timeline_name_1') ?>
          <?= $this->Form->input('timeline_date_1') ?>
          <?= $this->Form->input('timeline_name_2') ?>
          <?= $this->Form->input('timeline_date_2') ?>
          <?= $this->Form->input('timeline_name_3') ?>
          <?= $this->Form->input('timeline_date_3') ?>
          <?= $this->Form->input('timeline_name_4') ?>
          <?= $this->Form->input('timeline_date_4') ?>

        <h3 style="text-align:center;"><?= __('Become speaker texts') ?></h3><br />
          <?= $this->Form->input('bs_title') ?>
          <?= $this->Form->input('bs_top_text', ['type' => 'textarea']) ?>
          <?= $this->Form->input('bs_list_left', ['type' => 'textarea']) ?>
          <?= $this->Form->input('bs_list_right', ['type' => 'textarea']) ?>
          <?= $this->Form->input('bs_middle_text', ['type' => 'textarea']) ?>
          <?= $this->Form->input('bs_secondary_list', ['type' => 'textarea']) ?>
          <?= $this->Form->input('bs_bottom_text', ['type' => 'textarea']) ?>

        <h3 style="text-align:center;"><?= __('Other') ?></h3><br />
          <?= $this->Form->input('button_text') ?>
          <?= $this->Form->input('header_photo', ['type' => 'file']) ?>
          <?= $this->Html->image('../files/Settings/header_photo/' . $setting->header_photo, ['style' => 'max-width: 100%;']) ?>

        <br /><br />
          <?= $this->Form->input('offer_file_sponsors', ['type' => 'file']) ?>
          <?= $this->Form->input('offer_file_speakers', ['type' => 'file']) ?>
          <?= $this->Form->input('code_of_conduct_file', ['type' => 'file']) ?>

          <?= $this->Form->button(__('Submit'), ['class' => 'pull-right']) ?>
          <?= $this->Form->end() ?>
      </div>
    </section>
  </div>
</div>