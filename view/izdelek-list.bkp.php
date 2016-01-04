<!DOCTYPE html>
<head>
<?php include 'includes/head.php' ?>
<title>Izdelki</title>
</head>
<meta charset="UTF-8" />
<title>Library</title>

<h1>All izdelki</h1>

<p>[
    <a href="<?= BASE_URL . "books" ?>">All books</a> |
    <a href="<?= BASE_URL . "books/add" ?>">Add new</a>
    ]</p>

<ul>

    <?php foreach ($izdelki as $izdelek): ?>
        <li><a href="<?= BASE_URL . "books?id=" . $izdelek["idIzdelek"] ?>"><?= $izdelek["ime"] ?>:
                <?= $izdelek["opis"] ?> (<?= $izdelek["cena"] ?>)</a></li>
    <?php endforeach; ?>

</ul>
