<?php
/**
 * Created by PhpStorm.
 * User: ep
 * Date: 2.1.2016
 * Time: 19:53
 */

function getRandomWord($len = 5)
{
    $word = array_merge(range('0', '9'), range('A', 'Z'));
    shuffle($word);
    return substr(implode($word), 0, $len);
}

$registracija = 0;
if (!(!isset($_SESSION["idUporabnik"]) && isset($_GET["id"]) && $_GET["id"] != null && $_GET["id"] == -1)) {
    if (!isset($_SESSION["idUporabnik"])) {
        header("Location:login");
        exit;
    }
} else {
    $registracija = 1;
    $_SESSION["mojaVarnost"] = getRandomWord();
}
if (isset($_SESSION["idVloga"]) && $_SESSION["idVloga"] == 3) {
    if (!(isset($_GET["id"]) && $_GET["id"] != null && $_GET["id"] == $_SESSION["idUporabnik"])) {
        header("Location:store");
        exit;
    }
}
?>

<!DOCTYPE html>
<head>
    <?php include 'includes/head.php' ?>
    <title>SellerPanel - eTrgovina</title>
</head>

<?php
$mode = "urediAcc";
$velikost = 6;
if (isset($_GET["id"]) && $_GET["id"] != null && $_GET["id"] != -1) {
    $mode = "edit";
    $velikost = 6;
}
if (isset($_GET["id"]) && $_GET["id"] != null && $_GET["id"] == -1) {
    $mode = "create";
    $velikost = 6;
}
if (isset($_GET["manage"])) {
    $mode = "seznamStrank";
    $velikost = 12;
}

?>

<body>
<?php include 'includes/nav.php' ?>

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-<?php echo $velikost ?>">
            <h1 class="page-header">
                <?php
                if ($mode === "edit") {
                    echo "Uredi stranko";
                } elseif ($mode === "urediAcc") {
                    echo "Upravljaj račun";
                } elseif ($mode === "create") {
                    echo "Ustvari stranko";
                } elseif ($mode === "seznamStrank") {
                    echo "Upravljaj s strankami";
                }
                ?>
            </h1>

            <div class="panel panel-default">
                <div class="panel-body">
                    <?php if ($mode === "seznamStrank") {    // izpisi seznam strank
                        echo "<table class=\"table table-striped table-bordered table-hover\">";
                        echo "<tr><th>ID</th><th>Ime</th><th>Priimek</th><th>email</th><th>Telefon</th><th>Naslov</th><th>Pošta</th><th>Aktivno</th><th>Upravljaj</th></tr>";

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

                        $result = UporabnikDB::getCustomers();

                        foreach (new TableRows(new RecursiveArrayIterator($result)) as $k => $v) {
                            if (is_numeric($k)) {
                                continue;
                            }

                            if ($k == "idUporabnik")
                                $idUporabnika = $v;

                            if ($k == "idPosta") {
                                if ($v != null) {
                                    $posta = PostaDB::get(["postnaSt" => $v]);
                                    echo "<td>$v " . $posta["imePoste"] . "</td>";
                                } else
                                    echo "<td>$v</td>";
                            } else {
                                echo "<td>$v</td>";
                            }

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
                                        <a class='btn btn-default btn-sm' href='sellerpanel?id=$idUporabnika'>Uredi</a> \t
                                        <a class='$class' href='userpanel?aktivno=$aktivno&id=$idUporabnika&f=c'>$value</a>
                                     </td>";
                            }
                        }
                        echo "</table>";

                    } elseif ($mode === "urediAcc") {           // uredi stvoj profil
                        $id = $_SESSION["idUporabnik"];
                        $result = UporabnikDB::get(["id" => $id]);

                    } elseif ($mode === "edit") {               // uredi uporabnika z dolocenim id-jem
                        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
                        $result = UporabnikDB::get(["id" => $id]);
                    }


                    $poste = PostaDB::getAll();

                    if ($mode !== "seznamStrank") {             // urejamo stranko ?>
                        <form action="userpanel" method="post">
                            <?php if ($mode === "urediAcc" || $mode === "edit" || $mode === "create") { ?>

                                <div class="form-group">
                                    <label>Ime</label>
                                    <input
                                        class="form-control" <?php if ($mode != "create" && isset($result["ime"])) echo "value='" . $result["ime"] . "'"; ?>
                                        type="text" pattern="[A-zčžšČŽŠ]*" name="ime" required>
                                </div>
                                <div class="form-group">
                                    <label>Priimek</label>
                                    <input
                                        class="form-control" <?php if ($mode != "create" && isset($result["priimek"])) echo "value='" . $result["priimek"] . "'"; ?>
                                        type="text" pattern="[A-zčžšČŽŠ]*" name="priimek" required>
                                </div>

                                <?php if ($mode === "edit" || $mode === "create") { ?>
                                    <div class="form-group">
                                        <label>Telefon</label>
                                        <input
                                            class="form-control" <?php if ($mode != "create" && isset($result["telefon"])) echo "value='" . $result["telefon"] . "'"; ?>
                                            type="text" pattern="\d{3} \d{3} \d{3}" name="telefon" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Naslov</label>
                                        <input
                                            class="form-control" <?php if ($mode != "create" && isset($result["naslov"])) echo "value='" . $result["naslov"] . "'"; ?>
                                            type="text" name="naslov" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Pošta</label>
                                        <select class="form-control" id="idPosta" name="idPosta" required>
                                            <?php
                                            $trenPosta = 0;
                                            if ($mode != "create" && isset($result["idPosta"])) {
                                                $trenPosta = $result["idPosta"];
                                            }

                                            foreach ($poste as $v) {
                                                $postnaSt = $v["postnaSt"];
                                                $izpis = $v["postnaSt"] . " " . $v["imePoste"];

                                                if ($trenPosta != 0) {
                                                    if ($postnaSt == $trenPosta) {
                                                        echo "<option value=\"$postnaSt\" selected>$izpis</option>";
                                                    } else {
                                                        echo "<option value=\"$postnaSt\">$izpis</option>";
                                                    }
                                                } else {
                                                    echo "<option value=\"$postnaSt\">$izpis</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <input type="hidden" name="editing" value="customer"/>
                                    <input type="hidden" name="idVloga" value="3"/>
                                    <input type="hidden" name="registracija"
                                           value="<?php if ($registracija == 1) echo "1"; else echo "0"; ?>"/>
                                <?php }
                            } // konec urejanja ali dodajanja stranke?>

                            <hr>
                            <div class="form-group">
                                <label>e-mail</label>
                                <input
                                    class="form-control" <?php if ($mode != "create" && isset($result["email"])) echo "value='" . $result["email"] . "'"; ?>
                                    type="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label>Novo geslo</label>
                                <input class="form-control" type="password" name="password">
                            </div>
                            <div class="form-group">
                                <label>Potrdi geslo</label>
                                <input class="form-control" type="password" name="confirm">
                            </div>
                            <input type="hidden" name="idVloga" value="3"/>


                            <?php if ($registracija == 1) { ?>
                                <hr>
                                <div class="form-group">
                                    <label>Varnostno preverjanje </label>
                                    <img src="captcha"/>
                                    <input class="form-control" type="text" name="captcha"
                                           placeholder="varnostno preverjanje" required>
                                </div>
                            <?php } ?>

                            <?php
                            if ($mode === "create") {
                                echo '  <input type="hidden" name="id" value=-1>
                                        <div class="form-group">
                                            <input type="submit" value="Ustvari novo stranko" class="btn btn-danger btn-block" name="submit" style="width: 50%; margin-left: auto; margin-right: auto;" onclick="return checkpassword()">
                                        </div>
                                     ';
                            } elseif ($mode === "urediAcc" || $mode === "edit") {
                                echo '	<input type="hidden" name="id" value=' . $id . '>
									    <div class="form-group">
                                            <input type="submit" value="Shrani" class="btn btn-danger btn-block" name="submit" style="width: 50%; margin-left: auto; margin-right: auto;" onclick="return checkpassword()">
                                        </div>
                                     ';
                            } ?>
                        </form>
                    <?php } ?>

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

<?php include 'includes/footer.php' ?>
</body>
