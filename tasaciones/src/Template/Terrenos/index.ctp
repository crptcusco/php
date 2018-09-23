<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Terreno'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="terrenos index large-9 medium-8 columns content">
    <h3><?= __('Terrenos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('coordinacion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('area') ?></th>
                <th scope="col"><?= $this->Paginator->sort('valorunitario') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total') ?></th>
                <th scope="col"><?= $this->Paginator->sort('longitud') ?></th>
                <th scope="col"><?= $this->Paginator->sort('latitud') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($terrenos as $terreno): ?>
            <tr>
                <td><?= $this->Number->format($terreno->id) ?></td>
                <td><?= h($terreno->coordinacion) ?></td>
                <td><?= $this->Number->format($terreno->area) ?></td>
                <td><?= $this->Number->format($terreno->valorunitario) ?></td>
                <td><?= $this->Number->format($terreno->total) ?></td>
                <td><?= $this->Number->format($terreno->longitud) ?></td>
                <td><?= $this->Number->format($terreno->latitud) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $terreno->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $terreno->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $terreno->id], ['confirm' => __('Are you sure you want to delete # {0}?', $terreno->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
