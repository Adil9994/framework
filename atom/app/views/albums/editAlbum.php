<?php
use Core\FormHelper;
?>
<?php $this->setSiteTitle('Add post')?>
<?php $this->start('body')?>
<h2>Add Album</h2>
<form class="form" action="<?=PROOT?>albums/editAlbum/<?=$this->albums->id?>" method="post">
    <?= FormHelper::inputBlock('text','AlbumName','AlbumName',$this->albums->AlbumName,['class'=>'form-control'],['class'=>'form-group col-md-6']);?>
    <?= FormHelper::inputBlock('text','DateReleased','DateReleased',$this->albums->DateReleased,['class'=>'form-control'],['class'=>'form-group col-md-6']);?>
    <div class="form-group col-md-6">
        <label for="GenreID">Select GenreID:</label>
        <select class="form-control" name="GenreID" id="<?=$this->albums->GenreID?>">
            <?php foreach ($this->genres as $genre): ?>
                <option><?= $genre->id ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label for="ArtistID">Select ArtistID:</label>
        <select class="form-control" name="ArtistID" id="<?=$this->albums->ArtistID?>">
            <?php foreach ($this->artists as $artist): ?>
                <option><?= $artist->id ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-12 text-right">
        <a href="<?=PROOT?>albums" class ="btn btn-default">Cancel</a>
        <?= FormHelper::submitTag('Save',['class'=>'btn btn-primary']);?>
    </div>

</form>
<?php $this->end()?>
