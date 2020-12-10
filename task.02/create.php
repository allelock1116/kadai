<?php
require_once('function.php');
require_once('crud.php');
$create = new Crud();
?>

<?= templateHeader('create') ?>

<div class="content update">
    <h2>登録</h2>
    <form action="create.php" method="post">
        <input type="text" name="id" id="id" placeholder="ID">
        <input type="text" name="name" id="name" placeholder="山田太郎">
        <input type="text" name="email" id="email" placeholder="aaa@gmail.com">
        <input type="text" name="phone" id="phone" placeholder="090-1234-5678">
        <input type="text" name="title" id="title" placeholder="employee">
        <input type="datetime-local" name="created" id="created">
        <input type="submit" value="登録">
    </form>
    <?php $msg = $create->insertContact();?>
    <?=$msg?> 


</div>

<?= templateFooter() ?>