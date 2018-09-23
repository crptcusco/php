<!-- src/Template/Users/add.ctp -->

<div class="trabajadores form">
<?= $this->Form->create($trabajador) ?>
    <fieldset>
        <legend><?= __('Adiccionar Trabajador') ?></legend>
        <?= $this->Form->input('usuario') ?>
        <?= $this->Form->input('password') ?>
   </fieldset>
<?= $this->Form->button(__('Registrar')); ?>
<?= $this->Form->end() ?>
</div>