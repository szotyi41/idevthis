<?php use Engine\Temp; ?>

<?php include TEMPLATE . "header.php"; ?>

<div class="container">

    <?php include TEMPLATE . "searchbar.php"; ?>

    <?php if(is_array(Temp::get('postsId'))): ?>
    <?php for($i = 0; $i < count(Temp::get('postsId')); $i++): ?>

        <h1><a href="?post=<?=Temp::getItem('postsId', $i)?>"><?=Temp::getItem('postsTitle', $i)?></a></h1>
        <p>Létrehozva <?=Temp::getItem('postsCreated', $i)?></p>

        <?php foreach(Temp::getItem('postsTags', $i) as $tag):?>
            <a class="tag" href="?search=<?=$tag?>"><?=$tag?></a>
        <?php endforeach;?>

        <?php if(is_file("template/images/" . Temp::getItem('postsHeader', $i))): ?>
            <img class="postHeader" src="template/images/<?=Temp::getItem('postsHeader', $i)?>">
        <?php endif; ?>

        <p><?=Temp::getItem('postsDescription', $i)?></p>

    <?php endfor; ?>
    <?php else: ?>

        <h2>Not found in <?=Temp::get('search')?> keyword</h2>

    <?php endif; ?>

    <div class="pageselect" id="prev"><a href="">Previous</a></div>
    <?php for($i = 0; $i < 5; $i++): ?>
        <div class="pageselect"><a href="?page=<?=$i+1?>"><?=$i+1?></a></div>
    <?php endfor; ?>
    <div class="pageselect" id="next"><a href="">Next</a></div>

</div>

<?php include TEMPLATE . "footer.php"; ?>