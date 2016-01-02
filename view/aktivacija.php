<?php
/**
 * Created by PhpStorm.
 * User: ep
 * Date: 2.1.2016
 * Time: 21:03
 */

if (!isset($_SESSION["idUporabnik"])) {
    header("Location:" . $_SERVER["SCRIPT_NAME"] . "/login");
    echo "Uporabnik ni prijavljen.";
}

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li><a href="#">Pregled</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li><a href="editadmin.php">Upravljaj račun</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li><a href="editadmin.php?id=-1">Ustvari prodajalca</a></li>
                <li class="active"><a href="sellerActivation.php">Upravljaj s prodajalci</a></li>

            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Upravljaj s prodajalci</h1>

            <div class="col-md-8">
                <?php
                echo "<table>";
                echo "<tr><th>Ime</th><th>Priimek</th><th>email</th><th>Aktivno</th><th></th></tr>";

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

                $result = UporabnikDB::getSeller();

                foreach (new TableRows(new RecursiveArrayIterator($result)) as $k => $v) {
                    if (is_numeric($k)) {
                        continue;
                    }

                    if ($k == "id") {
                        echo "<td><a class='btn btn-default' href='adminpanel.php?id=$v'>Uredi</a></td>";
                    } else
                        echo "<td>$v</td>";

                }

                echo "</table>";
                ?>

            </div>
        </div>

    </div>
</div>

<script>
    function checkpassword() {
        var pass1 = $('input[name=password]').val();
        var pass2 = $('input[name=confirm]').val();
        if (pass1 != '' && pass1 != pass2) {
            alert("Gesli se ne ujemata.");
            $('input[name=password]').val("");
            $('input[name=confirm]').val("");
            return false;
        }
        return true;
    }
</script>
