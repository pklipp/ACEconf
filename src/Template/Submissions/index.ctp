<?= $this->Element('header_page', ['title' => 'Submissions']) ?>

<div>
  <div class="tabs">
    <ul class="nav nav-tabs nav-justified">
      <li class="active">
        <a href="#tab-all" data-toggle="tab" class="text-center"><span class="bold"><i
                class="fa fa-star"></i> <?= __('All speakers') ?></span></a>
      </li>
      <li>
        <a href="#tab-ux" data-toggle="tab" class="text-center"><i class="fa fa-cubes"></i> <?= __('UX speakers') ?></a>
      </li>
      <li>
        <a href="#tab-agile" data-toggle="tab" class="text-center"><i
              class="fa fa-cogs"></i> <?= __('Agile speakers') ?></a>
      </li>
      <li>
        <a href="#tab-workshops" data-toggle="tab" class="text-center"><i
              class="fa fa-magic"></i> <?= __('Workshops speakers') ?></a>
      </li>
    </ul>
    <div class="tab-content">
      <div id="tab-all" class="tab-pane active">
          <?php if ($summary['all']['count']): ?>
              <?= $this->Html->link('<i class="fa fa-file-pdf-o" aria-hidden="true"></i> <span>' . __('Download list') . '</span>', ['controller' => 'Submissions', 'action' => 'export', 'all'], ['escape' => false, 'class' => 'btn btn-primary submission-download-bt']) ?>
            <table class="table table-condensed mb-none">
              <thead>
              <tr>
                <th><?= __('#') ?></th>
                <th><?= __('First Name') ?></th>
                <th><?= __('Last Name') ?></th>
                <th><?= __('Email') ?></th>
                <th><?= __('Type') ?></th>
                <th><?= __('Topic') ?></th>
                <th><?= __('Country') ?></th>
              </tr>
              </thead>
              <tbody>
              <?php foreach ($submissions as $submission): ?>
                <tr>
                  <td><?= $submission->id ?></td>
                  <td><?= $submission->first_name ?></td>
                  <td><?= $submission->last_name ?></td>
                  <td><?= $submission->email ?></td>
                  <td><?= $submission->talktype->name ?></td>
                  <td><?= $submission->topic ?></td>
                  <td><?= $submission->country ?></td>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
          <?php else: ?>
              <?= $this->Flash->render('ux') ?>
          <?php endif; ?>
      </div>
      <div id="tab-ux" class="tab-pane">
          <?php if ($summary['ux']['count']): ?>
              <?= $this->Html->link('<i class="fa fa-file-pdf-o" aria-hidden="true"></i> <span>' . __('Download list') . '</span>', ['controller' => 'Submissions', 'action' => 'export', 'ux'], ['escape' => false, 'class' => 'btn btn-primary submission-download-bt']) ?>
            <table class="table table-condensed mb-none">
              <thead>
              <tr>
                <th><?= __('#') ?></th>
                <th><?= __('First Name') ?></th>
                <th><?= __('Last Name') ?></th>
                <th><?= __('Email') ?></th>
                <th><?= __('Type') ?></th>
                <th><?= __('Topic') ?></th>
                <th><?= __('Country') ?></th>
              </tr>
              </thead>
              <tbody>
              <?php foreach ($submissions as $submission): ?>
                  <?php if ($submission->talktype->name === 'UX'): ?>
                  <tr>
                    <td><?= $submission->id ?></td>
                    <td><?= $submission->first_name ?></td>
                    <td><?= $submission->last_name ?></td>
                    <td><?= $submission->email ?></td>
                    <td><?= $submission->talktype->name ?></td>
                    <td><?= $submission->topic ?></td>
                    <td><?= $submission->country ?></td>
                  </tr>
                  <?php endif; ?>
              <?php endforeach; ?>
              </tbody>
            </table>
          <?php else: ?>
              <?= $this->Flash->render('ux') ?>
          <?php endif; ?>
      </div>
      <div id="tab-agile" class="tab-pane">
          <?php if ($summary['agile']['count']): ?>
              <?= $this->Html->link('<i class="fa fa-file-pdf-o" aria-hidden="true"></i> <span>' . __('Download list') . '</span>', ['controller' => 'Submissions', 'action' => 'export', 'agile'], ['escape' => false, 'class' => 'btn btn-primary submission-download-bt']) ?>
            <table class="table table-condensed mb-none">
              <thead>
              <tr>
                <th><?= __('#') ?></th>
                <th><?= __('First Name') ?></th>
                <th><?= __('Last Name') ?></th>
                <th><?= __('Email') ?></th>
                <th><?= __('Type') ?></th>
                <th><?= __('Topic') ?></th>
                <th><?= __('Country') ?></th>
              </tr>
              </thead>
              <tbody>
              <?php foreach ($submissions as $submission): ?>
                  <?php if ($submission->talktype->name === 'AGILE'): ?>
                  <tr>
                    <td><?= $submission->id ?></td>
                    <td><?= $submission->first_name ?></td>
                    <td><?= $submission->last_name ?></td>
                    <td><?= $submission->email ?></td>
                    <td><?= $submission->talktype->name ?></td>
                    <td><?= $submission->topic ?></td>
                    <td><?= $submission->country ?></td>
                  </tr>
                  <?php endif; ?>
              <?php endforeach; ?>
              </tbody>
            </table>
          <?php else: ?>
              <?= $this->Flash->render('agile') ?>
          <?php endif; ?>
      </div>
      <div id="tab-workshops" class="tab-pane">
          <?php if ($summary['workshops']['count']): ?>
              <?= $this->Html->link('<i class="fa fa-file-pdf-o" aria-hidden="true"></i> <span>' . __('Download list') . '</span>', ['controller' => 'Submissions', 'action' => 'export', 'workshops'], ['escape' => false, 'class' => 'btn btn-primary submission-download-bt']) ?>
            <table class="table table-condensed mb-none">
              <thead>
              <tr>
                <th><?= __('#') ?></th>
                <th><?= __('First Name') ?></th>
                <th><?= __('Last Name') ?></th>
                <th><?= __('Email') ?></th>
                <th><?= __('Type') ?></th>
                <th><?= __('Topic') ?></th>
                <th><?= __('Country') ?></th>
              </tr>
              </thead>
              <tbody>
              <?php foreach ($submissions as $submission): ?>
                  <?php if ($submission->talktype->name === 'WORKSHOPS'): ?>
                  <tr>
                    <td><?= $submission->id ?></td>
                    <td><?= $submission->first_name ?></td>
                    <td><?= $submission->last_name ?></td>
                    <td><?= $submission->email ?></td>
                    <td><?= $submission->talktype->name ?></td>
                    <td><?= $submission->topic ?></td>
                    <td><?= $submission->country ?></td>
                  </tr>
                  <?php endif; ?>
              <?php endforeach; ?>
              </tbody>
            </table>
          <?php else: ?>
              <?= $this->Flash->render('workshops') ?>
          <?php endif; ?>
      </div>
    </div>
  </div>
</div>