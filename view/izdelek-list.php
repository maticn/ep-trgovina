<!DOCTYPE html>
<html lang="en">

<head>

    <?php include 'includes/head.php' ?>

    <link href="static/css/shop-homepage.css" rel="stylesheet">

</head>

<body>

<!-- Navigation -->
<?php include 'includes/nav.php' ?>

<!-- Page Content -->
<div id="page-wrapper">

    <div class="row" style="padding-top: 25px;">
        <h1>Trgovina</h1>
        <div class="col-md-2 pull-right">
            <form action="" class="form" method="post">
                <label for="iskanje">
                    Iskanje izdelkov
                </label>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Poišči..." name="iskanje" id="iskanje">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                      </span>
                </div><!-- /input-group -->
            </form>
        </div>

        <div class="row">
            <?php foreach ($izdelki as $izdelek): ?>
                <div class="col-sm-2 col-lg-2 col-md-2">
                    <div class="thumbnail">
                        <?php if (!empty($izdelek["slike"])): ?>
                            <img src="<?= IMAGES_URL . $izdelek["slike"][0]["slika"] ?>" alt="slike"
                                 style="width: 320px;height: 150px;">
                        <?php else: ?>
                            <div style="width: 320px;height: 150px">
                                <i class="fa fa-file-image-o fa-3x"
                                   style="top: 54px; position: relative; left:103px"></i>
                            </div>
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
<!-- /.container -->

<?php include 'includes/footer.php' ?>
</body>

</html>
