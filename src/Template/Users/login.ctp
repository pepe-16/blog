<!--File: src/Template/Users/login.ctp-->
<div class = "users form">
<?= $this->Flash->render('auth') ?>
<?= $this->Form->create() ?>
    <fieldset>
        <legend>
        <?= __('Porfavor introduzca su nombre de usuario y contraseña') ?>
        </legend>
        <?= $this->Form->input('username') ?>
        <?= $this->Form->input('password') ?>
    </fieldset>
    <?= $this->Form->button(_('Login')); ?>
    <?= $this->Form->end(); ?>
</div>
