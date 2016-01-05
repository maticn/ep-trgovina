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
                    <div class="btn-group pull-right" role="group">
                        <a class="btn btn-default disabled"><?= $izdelek["cena"] ?> €</a>
                        <button type="button" class="btn btn-success">Dodaj v košarico</button>
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
            <div class="well">
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
                            <input type="hidden" name="id" value="<?= $id ?>">
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
