<!DOCTYPE html>
<html lang="en">

<head>

    <?php include 'includes/head.php' ?>

    <link href="static/css/shop-homepage.css" rel="stylesheet">

</head>

<body>

<!-- Navigation -->
<?php include 'includes/nav-store.php' ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-md-3">
            <p class="lead">Shop Name</p>
            <div class="list-group">
                <a href="#" class="list-group-item">Category 1</a>
                <a href="#" class="list-group-item">Category 2</a>
                <a href="#" class="list-group-item">Category 3</a>
            </div>
        </div>

        <div class="col-md-9">


            <div class="row">
                <?php foreach ($izdelki as $izdelek): ?>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <?php if(!empty($izdelek["slike"])): ?>
                            <img src="<?= IMAGES_URL . $izdelek["slike"][0]["slika"] ?>" alt="slike"
                                 style="width: 320px;height: 150px;">
                            <?php endif; ?>
                            <div class="caption">
                                <h4 class="pull-right"><?= $izdelek["cena"] ?> €</h4>
                                <h4><a href="?id=<?= $izdelek["idIzdelek"] ?>"><?= $izdelek["ime"] ?></a>
                                </h4>
                                <p><?= $izdelek["opis"] ?></p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right"><?= $izdelek["count_ocena"] ?> ocen</p>
                                <p>
                                    <?php for ($i = 0; $i < round($izdelek["avg_ocena"]); $i++): ?>
                                        <i class="fa fa-star"></i>
                                    <?php endfor ?>
                                    <?php for ($i = 0; $i < 5 - round($izdelek["avg_ocena"]); $i++): ?>
                                        <i class="fa fa-star-o"></i>
                                    <?php endfor ?>
                                </p>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    </div>

</div>
<!-- /.container -->

<?php include 'includes/footer.php' ?>
</body>

</html>
