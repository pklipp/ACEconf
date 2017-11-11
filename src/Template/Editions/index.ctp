<header class="page-header">
  <h2><?= __('Editions') ?></h2>
</header>

<div class="row">
  <div class="col-md-12">
    <section class="panel">
      <header class="panel-heading">
        <h2 class="panel-title"><?= __('List') ?></h2>
      </header>
      <div class="panel-body">
          <?= $this->Flash->render() ?>
        <div class="table-responsive">
          <table class="table table-condensed mb-none">
            <thead>
            <tr>
              <th><?= __('#') ?></th>
              <th><?= __('Name') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($editions as $edition): ?>
              <tr>
                <td><?= $edition->id ?></td>
                <td><?= $edition->name ?></td>
                <td class="icon-links">
                    <?= $this->Html->link('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', ['action' => 'edit', $edition->id], ['escape' => false]) ?>
                    <?= $this->Form->postLink(
                        '<i class="fa fa-trash-o" aria-hidden="true"></i>',
                        ['action' => 'delete', $edition->id],
                        ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $edition->id)]
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