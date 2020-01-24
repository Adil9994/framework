<?php $this->setSiteTitle('Blog') ?>
<?php $this->start('body') ?>
<div class="container-fluid">
    <div class="jumbotron">
    <h1>Blog</h1>
    <?php foreach ($this->posts as $post) : ?>
        <h2><?=$post->postTitle ?></h2>
        <p><?= $post->postDesc ?></p>
        <p><?= $post->postCont ?></p>
        <p class="text-right"><?= $post->postDate ?></p>
        <div class="customline"></div>
    <?php endforeach; ?>
    </div>
</div>
<?php $this->end(); ?>
