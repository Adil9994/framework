<?php

use Core\FormHelper;

?>
<?php $this->start('head'); ?>
<?php $this->end(); ?>
<?php $this->start('body'); ?>
<div class="col-md-6 col-md-offset-3 well">
    <h3 class="text-center">Register Here!</h3>
    <hr>
    <form class="form" action="" method="post">
        <?= FormHelper::csrfInput() ?>
        <?= FormHelper::displayErrors($this->displayErrors) ?>
        <?= FormHelper::inputBlock('text', 'First name', 'fname', $this->newUser->fname, ['class' => 'form-control input-sm'], ['class' => 'form-group']) ?>
        <?= FormHelper::inputBlock('text', 'Last name', 'lname', $this->newUser->lname, ['class' => 'form-control input-sm'], ['class' => 'form-group']) ?>
        <?= FormHelper::inputBlock('text', 'Email', 'email', $this->newUser->email, ['class' => 'form-control input-sm'], ['class' => 'form-group']) ?>
        <?= FormHelper::inputBlock('text', 'Username', 'username', $this->newUser->username, ['class' => 'form-control input-sm'], ['class' => 'form-group']) ?>
        <?= FormHelper::inputBlock('password', 'Password', 'password', $this->newUser->password, ['class' => 'form-control input-sm'], ['class' => 'form-group']) ?>
        <?= FormHelper::inputBlock('password', 'Confirm password', 'confirm', $this->newUser->getConfirm(), ['class' => 'form-control input-sm'], ['class' => 'form-group']) ?>
        <?= FormHelper::submitBlock('Register', ['class' => 'btn btn-primary btn-large'], ['class' => 'text-right']) ?>
    </form>
</div>
<?php $this->end(); ?>
