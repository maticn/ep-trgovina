<!DOCTYPE html>
<head>
    <?php include 'includes/head.php' ?>
    <title>Naročila - eTrgovina</title>
</head>

<body>
<?php include 'includes/nav.php' ?>
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-8">
            <h1 class="page-header">Naročila</h1>
            <table class="table">
                <thead>
                <tr>
                    <th>ID naročila</th>
                    <th>Stranka</th>
                    <th>Skupna cena</th>
                    <th>Datum oddaje</th>
                    <th>Status</th>
                    <th>Akcije</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($narocila as $narocilo): ?>
                    <tr>
                        <td><?= $narocilo["idNarocilo"] ?></td>
                        <td><?= $narocilo["stranka"]["ime"]." ".$narocilo["stranka"]["priimek"] ?></td>
                        <td><?= $narocilo["cenaSkupaj"] ?> €</td>
                        <td><?= $narocilo["datumOddaje"] ?></td>
                        <td><?= $narocilo["statusDisplay"] ?></td>
                        <td>
                            <?php if ($narocilo["status"] == 1 && $_SESSION["idVloga"] != 3): ?>
                                <form action="<?= BASE_URL . "narocila/akcije" ?>" method="post"
                                      style="display: inline-block">
                                    <input type="hidden" name="id" value="<?= $narocilo["idNarocilo"] ?>">
                                    <input type="hidden" name="do" value="potrdi">
                                    <button class="btn btn-success btn-outline btn-sm" type="submit">Potrdi</button>
                                </form>
                                <form action="<?= BASE_URL . "narocila/akcije" ?>" method="post"
                                      style="display:inline-block;">
                                    <input type="hidden" name="id" value="<?= $narocilo["idNarocilo"] ?>">
                                    <input type="hidden" name="do" value="storniraj">
                                    <button class="btn btn-danger btn-outline btn-sm" type="submit">Storniraj</button>
                                </form>
                            <?php elseif ($narocilo["status"] == 1): ?>
                                <form action="<?= BASE_URL . "narocila/akcije" ?>" method="post"
                                      style="display:inline-block;">
                                    <input type="hidden" name="id" value="<?= $narocilo["idNarocilo"] ?>">
                                    <input type="hidden" name="do" value="storniraj">
                                    <button class="btn btn-danger btn-outline btn-sm" type="submit">Storniraj</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

</div>
<!-- /#page-wrapper -->

<?php include 'includes/footer.php' ?>
<
</body>