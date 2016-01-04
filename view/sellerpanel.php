<?php
/**
 * Created by PhpStorm.
 * User: ep
 * Date: 2.1.2016
 * Time: 19:53
 */

if (!isset($_SESSION["idUporabnik"])) {
    header("Location:login");
}
if ($_SESSION["idVloga"] != 2) {
    header("Location:store");
}
?>

<!DOCTYPE html>
<head>
    <?php include 'includes/head.php' ?>
    <title>SellerPanel - eTrgovina</title>
</head>

<?php
$mode = "urediAcc";
if (isset($_GET["id"]) && $_GET["id"] != null && $_GET["id"] != -1) {
    $mode = "edit";
}
if (isset($_GET["id"]) && $_GET["id"] != null && $_GET["id"] == -1) {
    $mode = "create";
}
if (isset($_GET["manage"])) {
    $mode = "seznamStrank";    // uredi prodajalca ali stranko
}

?>

<body>
<?php include 'includes/nav.php' ?>

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
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
                    <?php
                    if ($mode === "seznamStrank") {    // izpisi seznam strank
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

                    } elseif ($mode === "urediAcc") {   // uredi stvoj profil
                        $id = $_SESSION["idUporabnik"];
                        $result = UporabnikDB::get(["id" => $id]);

                    } elseif ($mode === "edit") {       // uredi uporabnika z dolocenim id-jem
                        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
                        $result = UporabnikDB::get(["id" => $id]);
                    }


                    if ($mode !== "seznamStrank") {            // urejamo stranko
                        ?>
                        <form action="userpanel" method="post">
                            <table style="width:100%">
                                <?php
                                if ($mode === "urediAcc") {     // urejamo svoj racun, prikaz zgolj relavantnih polj
                                    ?>
                                    <tr>
                                        <td>Ime</td>
                                        <td><input
                                                class="form-control" <?php if ($mode != "create" && isset($result["ime"])) echo "value='" . $result["ime"] . "'"; ?>
                                                type="text" name="ime" required></td>
                                    </tr>
                                    <tr>
                                        <td>Priimek</td>
                                        <td><input
                                                class="form-control" <?php if ($mode != "create" && isset($result["priimek"])) echo "value='" . $result["priimek"] . "'"; ?>
                                                type="text" name="priimek" required></td>
                                    </tr>
                                    <tr>
                                <?php } elseif ($mode === "edit" || $mode === "create") {    // urejamo ali dodajamo stranko, prikaz relavantnih polj ?>
                                    <tr>
                                        <td>Ime</td>
                                        <td><input
                                                class="form-control" <?php if ($mode != "create" && isset($result["ime"])) echo "value='" . $result["ime"] . "'"; ?>
                                                type="text" name="ime" required></td>
                                    </tr>
                                    <tr>
                                        <td>Priimek</td>
                                        <td><input
                                                class="form-control" <?php if ($mode != "create" && isset($result["priimek"])) echo "value='" . $result["priimek"] . "'"; ?>
                                                type="text" name="priimek" required></td>
                                    </tr>
                                    <tr>
                                        <td>E-mail</td>
                                        <td><input
                                                class="form-control" <?php if ($mode != "create" && isset($result["email"])) echo "value='" . $result["email"] . "'"; ?>
                                                type="email" name="email" required></td>
                                    </tr>
                                    <tr>
                                        <td>Telefon</td>
                                        <td><input
                                                class="form-control" <?php if ($mode != "create" && isset($result["telefon"])) echo "value='" . $result["telefon"] . "'"; ?>
                                                type="text" name="telefon" required></td>
                                    </tr>
                                    <tr>
                                        <td>Naslov</td>
                                        <td><input
                                                class="lname form-control" <?php if ($mode != "create" && isset($result["naslov"])) echo "value='" . $result["naslov"] . "'"; ?>
                                                type="text" name="naslov" required></td>
                                    </tr>
                                    <tr>
                                        <td>Pošta</td>
                                        <td><input
                                                class="lname form-control" <?php if ($mode != "create" && isset($result["idPosta"])) echo "value='" . $result["idPosta"] . "'"; ?>
                                                type="text" name="idPosta" required></td>
                                    </tr>
                                    <input type="hidden" value="customer" name="editing"/>
                                    <input type="hidden" value="3" name="idVloga"/>
                                <?php } // konec urejanja ali dodajanja stranke?>
                                <tr>
                                    <td colspan="2">
                                        <hr>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Novo geslo</td>
                                    <td><input class="lname form-control" type="password" name="password"></td>
                                </tr>
                                <tr>
                                    <td>Potrdi geslo</td>
                                    <td><input class="lname form-control" type="password" name="confirm"></td>
                                </tr>
                            </table>
                            <hr>
                            <input type="hidden" value="buyer" name="type"/>
                            <?php
                            // glede na tip dolocimo napis gumba
                            if ($mode === "create") {
                                echo '	<input type="hidden" value=-1 name="id">
									<input value="Ustvari novo stranko" class="fbtn btn-lg btn-primary btn-block" type="submit" name="submit" style="width: 50%; margin-left: auto; margin-right: auto;" onclick="return checkpassword()"/>';
                            } elseif ($mode === "urediAcc" || $mode === "edit") {
                                echo '	<input type="hidden" value=' . $id . ' name="id">
									<input value="Shrani" class="fbtn btn-lg btn-primary btn-block" type="submit" style="width: 50%; margin-left: auto; margin-right: auto;" onclick="return checkpassword()"/>';
                            }
                            ?>
                        </form>
                    <?php }
                    ?>


                    <!--                    <form action="userpanel" method="post">-->
                    <!--                        <div class="form-group">-->
                    <!--                            <label>Ime</label>-->
                    <!--                            <input class="form-control" --><?php //if ($mode != "create") echo "value=" . $user["ime"]; ?>
                    <!--                                   type="text" name="ime" required>-->
                    <!--                        </div>-->
                    <!--                        <div class="form-group">-->
                    <!--                            <label>Priimek</label>-->
                    <!--                            <input-->
                    <!--                                class="form-control" --><?php //if ($mode != "create") echo "value=" . $user["priimek"]; ?>
                    <!--                                type="text" name="priimek" required>-->
                    <!--                        </div>-->
                    <!---->
                    <!--                        --><?php
                    //                        if ($mode === "edit")
                    //                            echo "
                    //                                <div class=\"form-group\">
                    //                                    <label>Aktivno : $active</label> <br />
                    //                                    <a class='$class' href='userpanel?aktivno=$aktivno&id=$id'>$value</a>
                    //                                </div>
                    //                            ";
                    //                        ?>
                    <!---->
                    <!--                        <hr>-->
                    <!---->
                    <!--                        --><?php
                    //                        if ($mode === "create")
                    //                            echo "
                    //                                <div class=\"form-group\">
                    //                                    <label>e-mail</label>
                    //                                    <input class=\"form-control\" type=\"email\" name=\"email\" required>
                    //                                </div>
                    //                            ";
                    //                        ?>
                    <!---->
                    <!--                        <div class="form-group">-->
                    <!--                            <label>Novo geslo</label>-->
                    <!--                            <input class="form-control" type="password" name="password">-->
                    <!--                        </div>-->
                    <!--                        <div class="form-group">-->
                    <!--                            <label>Potrdi geslo</label>-->
                    <!--                            <input class="form-control" type="password" name="confirm">-->
                    <!--                        </div>-->
                    <!---->
                    <!--                        <hr>-->
                    <!---->
                    <!--                        <input type="hidden" name="idVloga" value="2"/>-->
                    <!---->
                    <!--                        --><?php
                    //                        if ($mode === "create") {
                    //                            echo '	<input type="hidden" name="id" value=-1>
                    //				                    <div class="form-group">
                    //                                        <input type="submit" value="Ustvari novega prodajalca" class="btn btn-danger btn-block" name="submit" style="width: 50%; margin-left: auto; margin-right: auto;" onclick="checkpassword()">
                    //                                    </div>
                    //				                 ';
                    //                        } else {
                    //                            echo '	<input type="hidden" name="id" value=' . $id . '>
                    //                                    <input type="hidden" value="manage" name="mode"/>
                    //                                    <div class="form-group">
                    //                                        <input type="submit" value="Shrani" class="btn btn-danger btn-block" name="submit" style="width: 50%; margin-left: auto; margin-right: auto;" onclick=" return checkpassword()">
                    //                                    </div>
                    //                                 ';
                    //                        }
                    //                        ?>
                    <!--                    </form>-->

                    <?php
                    if ($mode === "edit")
                        echo '<a class=\'btn btn-default \' href=\'sellerpanel?manage\'>Nazaj</a>';
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
