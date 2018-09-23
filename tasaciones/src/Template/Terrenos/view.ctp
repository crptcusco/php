<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Terreno'), ['action' => 'edit', $terreno->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Terreno'), ['action' => 'delete', $terreno->id], ['confirm' => __('Are you sure you want to delete # {0}?', $terreno->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Terrenos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Terreno'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="terrenos view large-9 medium-8 columns content">
    <h3><?= h($terreno->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Coordinacion') ?></th>
            <td><?= h($terreno->coordinacion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($terreno->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Area') ?></th>
            <td><?= $this->Number->format($terreno->area) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Valorunitario') ?></th>
            <td><?= $this->Number->format($terreno->valorunitario) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total') ?></th>
            <td><?= $this->Number->format($terreno->total) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Longitud') ?></th>
            <td><?= $this->Number->format($terreno->longitud) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Latitud') ?></th>
            <td><?= $this->Number->format($terreno->latitud) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Observacion') ?></h4>
        <?= $this->Text->autoParagraph(h($terreno->observacion)); ?>
    </div>
    <div class="row">
        <h4><?= __('Ruta') ?></h4>
        <?= $this->Text->autoParagraph(h($terreno->ruta)); ?>
    </div>
</div>
