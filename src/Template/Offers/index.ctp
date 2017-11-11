<header class="page-header">
  <h2><?= __('Speakers subpage') ?></h2>
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
              <th><?= __('Title') ?></th>
              <th><?= __('Description') ?></th>
              <th><?= __('Bio') ?></th>
              <th><?= __('Vimeo') ?></th>
              <th><?= __('Sponsor') ?></th>
              <th><?= __('Edition') ?></th>
              <th><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($offers as $offer): ?>
              <tr>
                <td><?= $this->Number->format($offer->id) ?></td>
                <td><?= h($offer->title) ?></td>
                <td><?= h($offer->description) ?></td>
                <td><?= h($offer->bio) ?></td>
                <td><?= h($offer->vimeo) ?></td>
                <td><?= $offer->has('sponsor') ? $offer->sponsor->name : '' ?></td>
                <td><?= $offer->has('edition') ? $offer->edition->name : '' ?></td>
                <td class="icon-links">
                    <?= $this->Html->link('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', ['action' => 'edit', $offer->id], ['escape' => false]) ?>
                    <?= $this->Form->postLink(
                        '<i class="fa fa-trash-o" aria-hidden="true"></i>',
                        ['action' => 'delete', $offer->id],
                        ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $offer->id)]
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