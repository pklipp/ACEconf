<header class="page-header">
  <h2>Sponsors</h2>
</header>

<div class="row">
  <div class="col-md-12">
    <section class="panel">
      <header class="panel-heading">
        <h2 class="panel-title">List</h2>
      </header>
      <div class="panel-body">
          <?= $this->Flash->render() ?>
        <div class="table-responsive">
          <table class="table table-condensed mb-none">
            <thead>
            <tr>
              <th><?= __('#') ?></th>
              <th><?= __('Name') ?></th>
              <th><?= __('Link') ?></th>
              <th><?= __('Active') ?></th>
              <th><?= __('Logo') ?></th>
              <th><?= __('Group') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($sponsors as $sponsor): ?>
              <tr>
                <td><?= $sponsor->id ?></td>
                <td><?= $sponsor->name ?></td>
                <td><?= $this->Html->link($sponsor->link, $sponsor->link) ?></td>
                <td><?= $sponsor->active ? __('Yes') : __('No') ?></td>
                <td><?= $this->Html->image('../files/Sponsors/photo/' . $sponsor->photo, ['width' => 150]) ?></td>
                <td><?= $sponsor->sponsors_group->name ?></td>
                <td class="icon-links">
                    <?= $this->Html->link('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', ['action' => 'edit', $sponsor->id], ['escape' => false]) ?>
                    <?= $this->Form->postLink(
                        '<i class="fa fa-trash-o" aria-hidden="true"></i>',
                        ['action' => 'delete', $sponsor->id],
                        ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $sponsor->id)]
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