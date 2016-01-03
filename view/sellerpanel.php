<?php
/**
 * Created by PhpStorm.
 * User: ep
 * Date: 2.1.2016
 * Time: 19:53
 */

if (!isset($_SESSION["idUporabnik"])) {
    header("Location:" . $_SERVER["SCRIPT_NAME"] . "/login");
    echo "Uporabnik ni prijavljen.";
}

$mode = "urediAcc";
if (isset($_GET["id"]) && $_GET["id"] != null && $_GET["id"] != -1) {
    $mode = "edit";
}
if (isset($_GET["id"]) && $_GET["id"] != null && $_GET["id"] == -1) {
    $mode = "create";
}
if (isset($_GET["manage"])) {
    $mode = "urediCuSe";    // uredi prodajalca ali stranko
}
echo $mode;
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li><a href="#">Overview</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li <?php /*in urejamo levi meni*/
                if ($mode === "urediAcc") echo 'class="active"'; ?>><a href="sellerpanel.php">Uredi račun</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li <?php if ($mode === "create") echo 'class="active"'; ?>><a href="sellerpanel.php?id=-1">Ustvari
                        stranko</a></li>
                <li <?php if ($mode === "urediCuSe" || $mode === "edit") echo 'class="active"'; ?>><a
                        href="sellerpanel.php?manage">Upravljanje s strankami</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li><a href="orders.php">Naročila</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li><a href="addProduct.php">Dodaj produkt</a></li>
                <li><a href="manageProduct.php">Upravljaj s produkti</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <?php

            // page title
            if ($mode === "edit") {
                echo "<h1 class='page-header'>Uredi stranko</h1><div class='col-md-8'>";
            } elseif ($mode === "urediAcc") {
                echo "<h1 class='page-header'>Upravljaj račun</h1><div class='col-md-8'>";
            } elseif ($mode === "create") {
                echo "<h1 class='page-header'>Ustvari stranko</h1><div class='col-md-8'>";
            } elseif ($mode === "urediCuSe") {
                echo "<h1 class='page-header'>Upravljaj s strankami</h1><div class='col-md-8'>";
            }


            if ($mode === "urediCuSe") {    // pridobi seznam strank
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

                $result = UporabnikDB::getCustomers();

                foreach (new TableRows(new RecursiveArrayIterator($result)) as $k => $v) {
                    if (is_numeric($k)) {
                        continue;
                    }

                    if ($k == "id") {
                        echo "<td><a class='btn btn-default' href='sellerpanel.php?id=$v'>Uredi</a></td>";
                    } else {
                        echo "<td>$v</td>";
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

            if ($mode !== "urediCuSe") {            // urejamo stranko
                ?>
                <form action="userpanel.php" method="post" onsubmit="return validateRegistration()">
                    <table style="width:100%">
                        <?php
                        if ($mode === "urediAcc") {     // urejamo svoj racun, prikaz zgolj relavantnih polj
                            ?>
                            <tr>
                                <td>Ime</td>
                                <td><input
                                        class="fname form-control" <?php if ($mode != "create" && isset($result["ime"])) echo "value='" . $result["ime"] . "'"; ?>
                                        type="text" name="ime" required></td>
                            </tr>
                            <tr>
                                <td>Priimek</td>
                                <td><input
                                        class="lname form-control" <?php if ($mode != "create" && isset($result["priimek"])) echo "value='" . $result["priimek"] . "'"; ?>
                                        type="text" name="priimek" required></td>
                            </tr>
                            <tr>
                        <?php } elseif ($mode === "edit" || $mode === "create") {    // urejamo ali dodajamo stranko, prikaz relavantnih polj ?>
                            <tr>
                                <td>Ime</td>
                                <td><input
                                        class="fname form-control" <?php if ($mode != "create" && isset($result["ime"])) echo "value='" . $result["ime"] . "'"; ?>
                                        type="text" name="ime" required></td>
                            </tr>
                            <tr>
                                <td>Priimek</td>
                                <td><input
                                        class="lname form-control" <?php if ($mode != "create" && isset($result["priimek"])) echo "value='" . $result["priimek"] . "'"; ?>
                                        type="text" name="priimek" required></td>
                            </tr>
                            <tr>
                                <td>E-mail</td>
                                <td><input
                                        class="lname form-control" <?php if ($mode != "create" && isset($result["email"])) echo "value='" . $result["email"] . "'"; ?>
                                        type="text" name="email" required></td>
                            </tr>
                            <tr>
                                <td>Telefon</td>
                                <td><input
                                        class="lname form-control" <?php if ($mode != "create" && isset($result["telefon"])) echo "value='" . $result["telefon"] . "'"; ?>
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
									<input value="Save" class="fbtn btn-lg btn-primary btn-block" type="submit" style="width: 50%; margin-left: auto; margin-right: auto;" onclick="return checkpassword()"/>';
                    }
                    ?>
                </form>
            <?php }
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
