<header class="page-header">
  <h2>Speakers</h2>
</header>

<div class="row">
  <div class="col-md-12">
    <section class="panel">
      <header class="panel-heading">
        <h2 class="panel-title">Speakers</h2>
      </header>
      <div class="panel-body">
          <?= $this->Flash->render() ?>
        <div class="table-responsive">
          <table class="table table-condensed mb-none">
            <thead>
            <tr>
              <th><?= __('#') ?></th>
              <th><?= __('First Name') ?></th>
              <th><?= __('Last Name') ?></th>
              <th><?= __('Position') ?></th>
              <th><?= __('Photo') ?></th>
              <th><?= __('Social media') ?></th>
              <th><?= __('Speaker subpage') ?></th>
              <th><?= __('Is active') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($speakers as $speaker): ?>
              <tr>
                <td><?= $speaker->id ?></td>
                <td><?= $speaker->first_name ?></td>
                <td><?= $speaker->last_name ?></td>
                <td><?= $speaker->position ?></td>
                <td><?= $this->Html->image('../files/Speakers/photo/' . $speaker->photo, ['width' => 80]) ?></td>
                <td class="icon-links">
                    <?= $this->Html->link('<i class="fa fa-twitter-square" aria-hidden="true"></i>', $speaker->twitter_link, ['escape' => false]) ?>
                    <?= $this->Html->link('<i class="fa fa-facebook-square" aria-hidden="true"></i>', $speaker->facebook_link, ['escape' => false]) ?>
                    <?= $this->Html->link('<i class="fa fa-linkedin-square" aria-hidden="true"></i>', $speaker->linkedin_link, ['escape' => false]) ?>
                    <?= $this->Html->link('<i class="fa fa-google-plus-square" aria-hidden="true"></i>', $speaker->google_link, ['escape' => false]) ?>
                </td>
                <td><?= $speaker->offer->title ?></td>
                <td><?= $speaker->is_active ? 'YES' : 'NO' ?></td>
                <td class="icon-links">
                    <?= $this->Html->link('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', ['action' => 'edit', $speaker->id], ['escape' => false]) ?>
                    <?= $this->Form->postLink(
                        '<i class="fa fa-trash-o" aria-hidden="true"></i>',
                        ['action' => 'delete', $speaker->id],
                        ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $speaker->id)]
                    )
                    ?>
                </td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </div>
</div>