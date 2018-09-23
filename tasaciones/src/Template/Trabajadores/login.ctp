<!-- File: src/Template/Users/login.ctp -->

<div class="trabajadores form">
<?= $this->Flash->render('auth') ?>
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your username and password') ?></legend>
        <?= $this->Form->input('usuario') ?>
        <?= $this->Form->input('password') ?>
    </fieldset>
<?= $this->Form->button(__('Ingreso')); ?>
<?= $this->Form->end() ?>
</div>