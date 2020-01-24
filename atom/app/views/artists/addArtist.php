<?php
use Core\FormHelper;
?>
<?php $this->setSiteTitle('Add genre')?>
<?php $this->start('body')?>
<h2>Add Artist</h2>
<form class="form" action="<?=PROOT?>artists/addArtist" method="post">
    <?= FormHelper::inputBlock('text','ArtistName','ArtistName',$this->artists->ArtistName,['class'=>'form-control'],['class'=>'form-group col-md-6']);?>
    <div class="col-md-12 text-left">
        <a href="<?=PROOT?>artists" class ="btn btn-default">Cancel</a>
        <?= FormHelper::submitTag('Save',['class'=>'btn btn-primary']);?>
    </div>

</form>
<?php $this->end()?>
