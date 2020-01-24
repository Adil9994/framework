<?php $this->start('body'); ?>
<h2 class="text-center">Artists</h2>
<table class="table table-striped table-condensed table-bordered table-hover">
    <thead>
    <th>ArtistID</th>
    <th>ArtistName</th>
    </thead>
    <tbody>
    <?php foreach ($this->artists as $artist): ?>
        <tr>
            <td><?= $artist->id ;?></td>
            <td><?= $artist->ArtistName; ?></td>
            <td>
                <a href="<?= PROOT ?>artists/editArtist/<?= $artist->id ?>" class="btn btn-xs btn-info">
                    <i class="glyphicon glyphicon-pencil"></i>Edit
                </a>
                <a href="<?= PROOT ?>artists/deleteArtist/<?= $artist->id ?>" class="btn btn-danger btn-xs"
                   onclick="if(!confirm('Are you sure?')){return false;}">
                    <i class="glyphicon glyphicon-remove"></i>Delete
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php $this->end(); ?>
