<?php use Engine\Variable; ?>

<?php include TEMPLATE . "header.php"; ?>

<div class="container">

    <?php include TEMPLATE . "searchbar.php"; ?>

    <?php if(is_array(Variable::get('postId'))): ?>
    <?php for($i = 0; $i < count(Variable::get('postId')); $i++): ?>

        <h1><a href="?post=<?=Variable::getItem('postId', $i)?>"><?=Variable::getItem('postTitle', $i)?></a></h1>
        <p>Létrehozva <?=Variable::getItem('postCreated', $i)?></p>

        <?php foreach(Variable::getItem('postTags', $i) as $tag):?>
            <a class="tag" href="?search=<?=$tag?>"><?=$tag?></a>
        <?php endforeach;?>

        <?php if(is_file("template/images/" . Variable::getItem('postHeader', $i))): ?>
            <img class="postHeader" src="template/images/<?=Variable::getItem('postHeader', $i)?>">
        <?php endif; ?>

        <p><?=Variable::getItem('postDescription', $i)?></p>

    <?php endfor; ?>
    <?php else: ?>

        <h2>Not found in <?=Variable::get('search')?> keyword</h2>

    <?php endif; ?>

    <div class="pageselect" id="prev"><a href="">Previous</a></div>
    <?php for($i = 0; $i < 5; $i++): ?>
        <div class="pageselect"><a href="?page=<?=$i+1?>"><?=$i+1?></a></div>
    <?php endfor; ?>
    <div class="pageselect" id="next"><a href="">Next</a></div>

</div>

<?php include TEMPLATE . "footer.php"; ?>