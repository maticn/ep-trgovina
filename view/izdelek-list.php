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

            <div class="row carousel-holder">

                <div class="col-md-12">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="item active">
                                <img class="slide-image" src="http://placehold.it/800x300" alt="">
                            </div>
                            <div class="item">
                                <img class="slide-image" src="http://placehold.it/800x300" alt="">
                            </div>
                            <div class="item">
                                <img class="slide-image" src="http://placehold.it/800x300" alt="">
                            </div>
                        </div>
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                </div>

            </div>

            <div class="row">
                <?php foreach ($izdelki as $izdelek): ?>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="http://placehold.it/320x150" alt="">
                            <div class="caption">
                                <h4 class="pull-right"><?= $izdelek["cena"] ?> €</h4>
                                <h4><a href="?id=<?= $izdelek["idIzdelek"] ?>"><?= $izdelek["ime"] ?></a>
                                </h4>
                                <p><?= $izdelek["opis"] ?></p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right"><?= $izdelek["count_ocena"]?> ocen</p>
                                <p>
                                    <?php for ($i=0;$i<round($izdelek["avg_ocena"]);$i++): ?>
                                    <i class="fa fa-star"></i>
                                    <?php endfor ?>
                                    <?php for ($i=0;$i<5-round($izdelek["avg_ocena"]);$i++): ?>
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
