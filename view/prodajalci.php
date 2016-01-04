<?php
/**
 * Created by PhpStorm.
 * User: ep
 * Date: 2.1.2016
 * Time: 21:03
 */

if (!isset($_SESSION["idUporabnik"])) {
    header("Location:login");
    echo "Uporabnik ni prijavljen.";
}
if ($_SESSION["idVloga"] != 1) {
    header("Location:store");
}
?>

<!DOCTYPE html>
<head>
    <?php include 'includes/head.php' ?>
    <title>Upravljaj s prodajalci - eTrgovina</title>
</head>

<body>
<?php include 'includes/nav.php' ?>

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Upravljaj s prodajalci</h1>

            <div class="panel panel-default">
                <div class="panel-body">
                    <?php
                    echo "<table class=\"table table-striped table-bordered table-hover\">";
                    echo "<tr><th>ID</th><th>Ime</th><th>Priimek</th><th>e-mail</th><th>Aktivno</th><th>Upravljaj</th></tr>";

                    class TableRows extends RecursiveIteratorIterator
                    {
                        function __construct($it)
                        {
                            parent::__construct($it, self::LEAVES_ONLY);
                        }

                        function current()
                        {
                            return parent::current();
                        }

                        function beginChildren()
                        {
                            echo "<tr>";
                        }

                        function endChildren()
                        {
                            echo "</tr>" . "\n";
                        }
                    }

                    $result = UporabnikDB::getSellers();

                    foreach (new TableRows(new RecursiveArrayIterator($result)) as $k => $v) {
                        if (is_numeric($k)) {
                            continue;
                        }

                        echo "<td>$v</td>";

                        if ($k == "idUporabnik")
                            $idUporabnika = $v;

                        if ($k == "aktivno") {
                            if ($v === '1') {
                                $class = "btn btn-outline btn-danger btn-sm";
                                $value = "Deaktiviraj";
                                $aktivno = 0;
                            } else {
                                $class = "btn btn-outline btn-success btn-sm";
                                $value = "Aktiviraj";
                                $aktivno = 1;
                            }

                            echo "<td>
                                    <a class='btn btn-default btn-sm' href='adminpanel?id=$idUporabnika'>Uredi</a> \t
                                    <a class='$class' href='userpanel?aktivno=$aktivno&id=$idUporabnika&f=p'>$value</a>
                                 </td>";
                        }
                    }
                    echo "</table>";
                    ?>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

</div>
<!-- /#page-wrapper -->

<?php include 'includes/footer.php' ?>
</body>