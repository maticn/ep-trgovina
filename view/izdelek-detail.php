<!DOCTYPE html>
<html lang="en">

<head>

    <?php include 'includes/head.php'; ?>
    <link href="static/css/shop-item.css" rel="stylesheet">


</head>

<body>

<!-- Navigation -->
<?php include 'includes/nav-store.php' ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-md-3">
            <a class="btn btn-block btn-info btn-lg" href="<?= BASE_URL . "store" ?>">
                <i class="fa fa-arrow-left"></i> Nazaj na seznam izdelkov
            </a>
        </div>

        <div class="col-md-9">

            <div class="thumbnail">
                <img class="img-responsive" src="http://placehold.it/800x300" alt="">
                <div class="caption-full">
                    <h4 class="pull-right"><?= $izdelek["cena"] ?> €</h4>
                    <h2><?= $izdelek["ime"] ?>
                    </h2>
                    <p><?= $izdelek["opis"] ?></p>

                </div>
            </div>
            <div>
                <button class="btn btn-success pull-right">Dodaj v košarico</button>
            </div>

        </div>

    </div>

</div>
<!-- /.container -->

<div class="container">

    <hr>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Your Website 2014</p>
            </div>
        </div>
    </footer>

</div>
<!-- /.container -->
<?php include 'includes/footer.php' ?>

</body>

</html>
