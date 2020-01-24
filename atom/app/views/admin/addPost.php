<?php
use Core\FormHelper;
?>
<?php $this->setSiteTitle('Add post')?>
<?php $this->start('body')?>
<h2>Add post</h2>
<div class = 'col-md-5 well'>
<form class ="form" action = "<?=PROOT?>admin/addpost" method="post">
    <?= FormHelper::displayErrors($this->displayErrors)?>
    <?= FormHelper::csrfInput()?>
    <?= FormHelper::inputBlock('text','Title','postTitle','',['class' => 'form-control'], ['class' => 'form-group'])?>
    <?= FormHelper::textareaBlock('Description','postDesc',['class' => 'form-control rounded-0 vertical','rows'=>'10'], ['class' => 'form-group'])?>
    <?= FormHelper::textareaBlock('Content','postCont',['class' => 'form-control rounded-0 vertical','rows'=>'10'], ['class' => 'form-group'])?>
    <?= FormHelper::inputBlock('text','Tags (comma seperated)','tags','',['class' => 'form-control'], ['class' => 'form-group'])?>
    <?= FormHelper::submitBlock('Submit', ['class' => 'btn btn-large btn-primary pull-right'], ['class' => 'form-group']) ?>
</form>
</div>
<?php $this->end()?>
