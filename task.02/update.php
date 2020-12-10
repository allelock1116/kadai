<?php
require_once('function.php');
require_once('crud.php');
$update = new Crud();
$upd_res = $update->updateContact();
var_dump($upd_res);
?>

<?= templateHeader('update') ?>

<div class="content update">
    <h2>変更</h2>
    <form action="update.php?id=<?= $upd_res['id'] ?>" method="post">
        <input type="text" name="id" id="id" placeholder="<?= $upd_res['id'] ?>">
        <input type="text" name="name" id="name" placeholder="<?= $upd_res['name'] ?>">
        <input type="text" name="email" id="email" placeholder="<?= $upd_res['email'] ?>">
        <input type="text" name="phone" id="phone" placeholder="<?= $upd_res['phone'] ?>">
        <input type="text" name="title" id="title" placeholder="<?= $upd_res['title'] ?>">
        <input type="datetime-local" name="created" id="created">
        <input type="submit" value="登録">
    </form>
    <?=$upd_res['msg']?>
</div>

<?= templateFooter() ?>