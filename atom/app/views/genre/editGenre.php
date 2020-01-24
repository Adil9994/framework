<?php
use Core\FormHelper;
?>
<?php $this->setSiteTitle('Edit genre')?>
<?php $this->start('body')?>
<h2>Edit Genre</h2>
<form class="form" action="<?=PROOT?>genre/editGenre/<?= $this->genres->id ?>" method="post">
    <?= FormHelper::inputBlock('text','Genre','Genre',$this->genres->Genre,['class'=>'form-control'],['class'=>'form-group col-md-6']);?>
    <div class="col-md-12 text-left">
        <a href="<?=PROOT?>genre" class ="btn btn-default">Cancel</a>
        <?= FormHelper::submitTag('Save',['class'=>'btn btn-primary']);?>
    </div>

</form>
<?php $this->end()?>
