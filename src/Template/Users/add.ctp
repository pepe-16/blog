<div class = "users form">
<?= $this->Html->link('Iniciar Cesion',['controller' => 'Users', 'action' => 'login'] )?>
<?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('AddUser') ?></legend>
        <?= $this->Form->input('username') ?>
        <?= $this->Form->input('password') ?>
        <?= $this->Form->input('role',[
                'options' => ['admin' => 'Admin', 'author' => 'Author']
            ]) ?> 
    </fieldset>
    <?= $this->Form->button(__('Submit')); ?>
    <?= $this->Form->end() ?>
</div>
