<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Book detail</title>

<h1>Details of: <?= $book["title"] ?></h1>

<p>[
<a href="<?= BASE_URL . "books" ?>">All books</a> |
<a href="<?= BASE_URL . "books/add" ?>">Add new</a>
]</p>

<ul>
    <li>Author: <b><?= $book["author"] ?></b></li>
    <li>Title: <b><?= $book["title"] ?></b></li>
    <li>Price: <b><?= $book["price"] ?> EUR</b></li>
    <li>Year: <b><?= $book["year"] ?></b></li>
    <li>Description: <i><?= $book["description"] ?></i></li>
</ul>

<p>[ <a href="<?= BASE_URL . "books/edit?id=" . $book["id"] ?>">Edit</a> |
<a href="<?= BASE_URL . "book" ?>">Book index</a> ]</p>
