<?php use Engine\Variable; ?>

<?php include TEMPLATE . "header.php"; ?>

<div class="container">
<h1><?=Variable::get('title')?></h1>
<p>Létrehozva <?=Variable::get('created')?></p>

<?php foreach(Variable::get('tags') as $tag):?>
    <p class="tag"><?=$tag?></p>
<?php endforeach;?>

<?php include TEMPLATE . "posts" . DIR . Variable::get('post'); ?>
</div>

<?php include TEMPLATE . "footer.php"; ?>