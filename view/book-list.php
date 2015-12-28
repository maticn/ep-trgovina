<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Library</title>

<h1>All books</h1>

<p>[
<a href="<?= BASE_URL . "books" ?>">All books</a> |
<a href="<?= BASE_URL . "books/add" ?>">Add new</a>
]</p>

<ul>

    <?php foreach ($books as $book): ?>
        <li><a href="<?= BASE_URL . "books?id=" . $book["id"] ?>"><?= $book["author"] ?>: 
        	<?= $book["title"] ?> (<?= $book["year"] ?>)</a></li>
    <?php endforeach; ?>

</ul>
