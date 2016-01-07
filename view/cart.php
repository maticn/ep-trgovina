<!DOCTYPE html>
<html lang="en">

<head>

    <?php include 'includes/head.php' ?>

</head>

<body>

<!-- Navigation -->
<?php include 'includes/nav.php' ?>

<!-- Page Content -->
<div id="page-wrapper">

    <div class="row" style="padding-top: 25px;">

        <div class="row">
            <div class="col-md-6">
                <h1>Nakupovalni voziček <i class="fa fa-shopping-cart"></i></h1>
                <table class="table">
                    <thead>
                    <th>Ime</th>
                    <th>Količina</th>
                    <th>Cena/kos</th>
                    <th>Cena</th>
                    </thead>
                    <tbody>
                    <?php foreach ($izdelki as $izdelek): ?>
                        <tr>
                            <td><?= $izdelek["ime"] ?></td>
                            <td>
                                <?= $izdelek["kolicina"] ?>
                                <button class="btn btn-small btn-default"
                                        onclick="povecajKolicino('<?= BASE_URL . "cart/ajax" ?>',<?= $izdelek["idIzdelek"] ?>)">
                                    <i class="fa fa-plus"></i>
                                </button>
                                <button class="btn btn-small btn-default"
                                        onclick="zmanjsajKolicino('<?= BASE_URL . "cart/ajax" ?>',<?= $izdelek["idIzdelek"] ?>)">
                                    <i class="fa fa-minus"></i></button>
                            </td>
                            <td><?= $izdelek["cena"] ?> €</td>
                            <td><?= $izdelek["cena"] * $izdelek["kolicina"] ?> €</td>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="info">
                        <td colspan="3"><strong>Cena skupaj:</strong></td>
                        <td><?= $skupaj ?> €</td>
                    </tr>
                </table>
                <form action="<?= BASE_URL."cart/oddaj"?>" method="post">

                    <button class="btn pull-right btn-success" type="submit">Oddaj naročilo</button>
                </form>
            </div>

        </div>


    </div>


</div>
<!-- /.container -->

<?php include 'includes/footer.php' ?>
</body>

</html>
