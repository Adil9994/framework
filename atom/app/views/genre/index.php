<?php $this->start('body'); ?>
<h2 class="text-center">Genres</h2>
<table class="table table-striped table-condensed table-bordered table-hover">
    <thead>
    <th>GenreID</th>
    <th>Genre</th>
    </thead>
    <tbody>
    <?php foreach ($this->genres as $genre): ?>
        <tr>
            <td><?= $genre->id ;?></td>
            <td><?= $genre->Genre; ?></td>
            <td>
                <a href="<?= PROOT ?>genre/editGenre/<?= $genre->id ?>" class="btn btn-xs btn-info">
                    <i class="glyphicon glyphicon-pencil"></i>Edit
                </a>
                <a href="<?= PROOT ?>genre/deleteGenre/<?= $genre->id ?>" class="btn btn-danger btn-xs"
                   onclick="if(!confirm('Are you sure?')){return false;}">
                    <i class="glyphicon glyphicon-remove"></i>Delete
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php $this->end(); ?>
