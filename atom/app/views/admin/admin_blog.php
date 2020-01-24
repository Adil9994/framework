<?php use Core\FormHelper; ?>
<?php $this->setSiteTitle('Home admin') ?>
<?php $this->start('body') ?>
<table class="table table-striped table-condensed table-bordered table-hover">
    <thead>
    <th>Title</th>
    <th>Date</th>
    <th>Action</th>
    </thead>
    <tbody>
    <?php foreach ($this->posts as $post) : ?>
        <tr>
            <td><?= $post->postTitle ?></td>
            <td><?= $post->postDate ?></td>
            <td>
                <a href="<?=PROOT?>admin/editpost/<?=$post->id?>" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-pencil"></i>Edit</a>
                <a href="<?=PROOT?>admin/deletepost/<?=$post->id?>" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i> Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<form class="form" action="<?=PROOT?>admin/addpost" method="post">
<?= FormHelper::submitBlock('Add post',['class' => 'btn btn-large btn-primary pull-right'],[])?>
</form>
<?php $this->end() ?>
