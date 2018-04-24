<?php use Engine\Variable; ?>

<?php include TEMPLATE . "header.php"; ?>

<div class="container">

    <?php include TEMPLATE . "searchbar.php"; ?>

    <h1><?=Variable::get('postTitle')?></h1>
    <p>Létrehozva <?=Variable::get('postCreated')?></p>

    <?php foreach(Variable::get('postTags') as $tag):?>
        <a class="tag" href="?search=<?=$tag?>"><?=$tag?></a>
    <?php endforeach;?>

    <?php include TEMPLATE . "posts" . DIR . Variable::get('postContent'); ?>


    <?php if(is_array(Variable::get('commentId'))): ?>

        <h1>Comments</h1>

    <?php for($i = 0; $i < count(Variable::get('commentId')); $i++): ?>

        <div class="comment">
            <img class="commentAvatar" src="template/images/avatar.png">
            <p class="commentUser"><?=Variable::getItem('commentUserName', $i)?></p>
            <p class="commentCreated"><?=Variable::getItem('commentCreated', $i)?></p>
            <p class="commentContent"><?=Variable::getItem('commentContent', $i)?></p>
        </div>

    <?php endfor; ?>
    <?php else: ?>

        <h1>There is no comment yet</h1>

    <?php endif; ?>

    <form method="post">
        <textarea name="content"></textarea>
        <input type="submit" value="Post">
    </form>

</div>

<?php include TEMPLATE . "footer.php"; ?>