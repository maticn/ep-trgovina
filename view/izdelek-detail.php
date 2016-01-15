<!DOCTYPE html>
<html lang="en">

<head>

    <?php include 'includes/head.php'; ?>
    <link href="static/css/shop-item.css" rel="stylesheet">


</head>

<body>

<!-- Navigation -->
<?php include 'includes/nav.php' ?>

<!-- Page Content -->
<div id="page-wrapper" style="padding-top: 25px">

    <div class="row">

        <div class="col-md-6">

            <div class="thumbnail">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <?php foreach ($izdelek["slike"] as $idx => $slika): ?>
                                    <?php if ($idx == 0): ?>
                                        <li data-target="#carousel-example-generic" data-slide-to="0"
                                            class="active"></li>
                                    <?php else: ?>
                                        <li data-target="#carousel-example-generic" data-slide-to="0"></li>
                                    <?php endif; ?>
                                <?php endforeach ?>
                            </ol>
                            <div class="carousel-inner">
                                <?php if (empty($izdelek["slike"])): ?>
                                    <div class="item active" style="height: 300px">
                                        <i class="fa fa-file-image-o fa-3x"
                                              style="top: 129px; left:572px; position: relative"></i>
                                    </div>
                                <?php endif; ?>
                                <?php foreach ($izdelek["slike"] as $idx => $slika): ?>
                                <?php if ($idx == 0): ?>
                                <div class="item active">
                                    <?php else: ?>
                                    <div class="item">
                                        <?php endif; ?>
                                        <img class="slide-image" style="height: 300px; width: 800px;"
                                             src="<?= IMAGES_URL . $slika["slika"] ?>" alt="">
                                    </div>
                                <?php endforeach ?>
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
                    <div class="caption-full">
                        <div class="btn-group pull-right" role="group">
                            <a class="btn btn-default disabled"><?= $izdelek["cena"] ?> €</a>
                            <button type="button" class="btn btn-success"
                                    <?= isset($_SESSION["idUporabnik"])?"":"disabled"?>
                                    onclick="dodajVKosarico('<?= BASE_URL."cart/ajax" ?>',<?= $izdelek["idIzdelek"]?>)">Dodaj v košarico</button>
                        </div>
                        <h2><?= $izdelek["ime"] ?>
                        </h2>
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
                <div class="well" style="min-height: 150px">
                    <div class="col-md-9 col-lg-9 col-sm-9">
                        <strong>Ocene</strong>
                    </div>

                    <div class="pull-right col-md-3 col-lg-3 col-sm-3">
                        <form action="<?= BASE_URL . "store/oceni" ?>" class="form" method="POST">
                            <div class="input-group">
                                <select name="ocena" id="ocena-select" class="form-control">
                                    <option value="-1">----</option>
                                    <?php foreach (range(1, 5) as $i): ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endforeach ?>
                                </select>
                                <input type="hidden" name="id" value="<?= $izdelek["idIzdelek"] ?>">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">Oceni</button>
                              </span>
                            </div>
                        </form>
                    </div>
                    <?php foreach ($ocene as $ocena): ?>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <?php for ($i = 0; $i < $ocena["ocena"]; $i++): ?>
                                    <i class="fa fa-star"></i>
                                <?php endfor ?>
                                <?php for ($i = 0; $i < 5 - $ocena["ocena"]; $i++): ?>
                                    <i class="fa fa-star-o"></i>
                                <?php endfor ?>
                                <?= $ocena["ime"] ?>
                            </div>
                        </div>
                    <?php endforeach ?>


                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->

    <?php include 'includes/footer.php' ?>

</body>

</html>
