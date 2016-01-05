<!DOCTYPE html>
<head>
    <?php include 'includes/head.php' ?>
    <title>Upravljaj z izdelki - eTrgovina</title>
</head>

<body>
<?php include 'includes/nav.php' ?>
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Urejaj izdelke</h1>
            <?php foreach ($izdelki as $izdelek): ?>
                <div class="col-lg-4 col-md-4 col-sm-4">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?= $izdelek["ime"] ?>
                            <strong class="pull-right"><?= $izdelek["cena"] ?> €</strong>
                        </div>
                        <div class="panel-body">
                            <?= $izdelek["opis"] ?>
                            <hr>
                            <form action="<?= BASE_URL."slike" ?>" class="form" method="post" enctype="multipart/form-data">
                                <div class="input-group">
                                      <span class="input-group-btn">
                                        <span class="btn btn-default btn-file">
                                            Izberi sliko <input type="file" name="slika" id="slika">
                                        </span>
                                      </span>
                                    <input type="text" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="btn btn-success" type="submit">
                                            Dodaj sliko
                                        </button>
                                    </span>
                                    <input type="hidden" name="do" value="add">
                                    <input type="hidden" name="id" value="<?=$izdelek["idIzdelek"] ?>">
                                </div><!-- /input-group -->

                            </form>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

</div>
<!-- /#page-wrapper -->

<?php include 'includes/footer.php' ?>
<script type="text/javascript">
    $(document).on('change', '.btn-file :file', function () {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });
    $(document).ready(function () {
        $('.btn-file :file').on('fileselect', function (event, numFiles, label) {
            console.log(numFiles);
            console.log(label);
            $(this).closest('form').find('input[type="text"]').val(label);
        });
    });
</script>
</body>