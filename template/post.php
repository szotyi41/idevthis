<?php use Engine\Temp; ?>

<?php include TEMPLATE . "header.php"; ?>

<div class="container">

    <?php include TEMPLATE . "searchbar.php"; ?>

    <h1><?=Temp::get('postTitle')?></h1>
    <p>Létrehozva <?=Temp::get('postCreated')?></p>

    <?php foreach(Temp::get('postTags') as $tag):?>
        <a class="tag" href="?search=<?=$tag?>"><?=$tag?></a>
    <?php endforeach;?>

    <?php include TEMPLATE . "posts" . DIR . Temp::get('postContent'); ?>


    <?php if(is_array(Temp::get('commentId'))): ?>

        <h1>Comments</h1>

    <?php for($i = count(Temp::get('commentId'))-1; $i >= 0; $i--): ?>

        <div class="comment">
            <img class="commentAvatar" src="template/images/avatars/<?=Temp::getItem('commentUserAvatar', $i)?>">
            <p class="commentUser"><?=Temp::getItem('commentUserName', $i)?></p>
            <p class="commentCreated"><?=Temp::getItem('commentCreated', $i)?></p>
            <p class="commentContent"><?=Temp::getItem('commentContent', $i)?></p>
        </div>

    <?php endfor; ?>
    <?php else: ?>

        <h1>There is no comment yet</h1>

    <?php endif; ?>

    <form method="post">
        <textarea name="comment"></textarea>
        <input type="submit" value="Post">
    </form>

</div>

<?php include TEMPLATE . "footer.php"; ?>