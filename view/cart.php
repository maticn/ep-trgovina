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
                    <th>Cena</th>
                    </thead>
                    <tbody>
                    <?php foreach($izdelki as $izdelek): ?>
                        <tr>
                            <td><?= $izdelek["ime"] ?></td>
                            <td>
                                <?= $izdelek["kolicina"] ?>
                                <button class="btn btn-small btn-default"><i class="fa fa-plus"></i></button>
                                <button class="btn btn-small btn-default"><i class="fa fa-minus"></i></button>
                            </td>
                            <td><?= $izdelek["cena"] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>


    </div>


</div>
<!-- /.container -->

<?php include 'includes/footer.php' ?>
</body>

</html>
