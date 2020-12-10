<?php
require_once('function.php');
require_once('crud.php');
$data = new Crud();
$contacts = $data->selectAll();
?>

<?= templateHeader('Read') ?>

<div class="content read">
    <h2>一覧</h2>
    <table>
        <thead>
            <tr>
                <td>#</td>
                <td>Name</td>
                <td>Email</td>
                <td>Phone</td>
                <td>Title</td>
                <td>Created</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact) { ?>
                <tr>
                    <td><?= $contact['id'] ?></td>
                    <td><?= $contact['name'] ?></td>
                    <td><?= $contact['email'] ?></td>
                    <td><?= $contact['phone'] ?></td>
                    <td><?= $contact['title'] ?></td>
                    <td><?= $contact['created'] ?></td>
                    <td class="actions">
                        <a href="update.php?id=<?= $contact['id'] ?>" class="edit">
                            <i class="fas fa-pen fa-xs"></i>
                        </a>
                        <a href="delete.php?id=<?= $contact['id'] ?>" class="trash">
                            <i class="fas fa-pen fa-xs"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?= templateFooter() ?>