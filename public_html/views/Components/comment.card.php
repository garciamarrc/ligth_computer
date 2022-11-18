<div class='card p-3 m-2'>
    <h5 class='d-flex align-items-center gap-1'><?= $user_photo ?> <?= $comment->getName() ?></h5>
    <p><?= $stars ?></p>
    <p><?= date('Y-m-d H:i', strtotime($comment->getCreatedAt())) ?></p>
    <p><?= $comment->getText() ?></p>
</div>