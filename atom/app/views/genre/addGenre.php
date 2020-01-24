<?php
use Core\FormHelper;
?>
<?php $this->setSiteTitle('Add genre')?>
<?php $this->start('body')?>
<h2>Add Genre</h2>
<form class="form" action="<?=PROOT?>genre/addGenre" method="post">
    <?= FormHelper::inputBlock('text','Genre','Genre',$this->genres->Genre,['class'=>'form-control'],['class'=>'form-group col-md-6']);?>
    <div class="col-md-12 text-left">
        <a href="<?=PROOT?>genre" class ="btn btn-default">Cancel</a>
        <?= FormHelper::submitTag('Save',['class'=>'btn btn-primary']);?>
    </div>

</form>
<?php $this->end()?>
