<?php $this->start('body'); ?>
<h2 class="text-center">Albums</h2>
<table class="table table-striped table-condensed table-bordered table-hover">
    <thead>
    <th>AlbumID</th>
    <th>AlbumName</th>
    <th>DateReleased</th>
    <th>ArtistID</th>
    <th>GenreID</th>
    </thead>
    <tbody>
    <?php foreach ($this->albums as $album): ?>
        <tr>
            <td><?= $album->id ;?></td>
            <td><?= $album->AlbumName; ?></td>
            <td><?= $album->DateReleased; ?></td>
            <td><?= $album->ArtistID; ?></td>
            <td><?= $album->GenreID; ?></td>
            <td>
                <a href="<?= PROOT ?>albums/editAlbum/<?= $album->id ?>" class="btn btn-xs btn-info">
                    <i class="glyphicon glyphicon-pencil"></i>Edit
                </a>
                <a href="<?= PROOT ?>albums/deleteAlbum/<?= $album->id ?>" class="btn btn-danger btn-xs"
                   onclick="if(!confirm('Are you sure?')){return false;}">
                    <i class="glyphicon glyphicon-remove"></i>Delete
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php $this->end(); ?>
