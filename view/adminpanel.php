<?php
/**
 * Created by PhpStorm.
 * User: ep
 * Date: 31.12.2015
 * Time: 11:37
 */

if (!isset($_SESSION["idUporabnik"])) {
    header("Location:login");
    exit;
}
if ($_SESSION["idVloga"] != 1) {
//    header("refresh:5;url=shop");
//    echo "Nimate pravic administratorja.";
    header("Location:store");
    exit;
}
?>

<!DOCTYPE html>
<head>
    <?php include 'includes/head.php' ?>
    <title>AdminPanel - eTrgovina</title>
</head>

<?php
$mode = "manage";
if (isset($_GET["id"]) && $_GET["id"] != null && $_GET["id"] != -1) {
    $mode = "edit";
}
if (isset($_GET["id"]) && $_GET["id"] != null && $_GET["id"] == -1) {
    $mode = "create";
}

if ($mode === "edit") {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
} else {
    $id = $_SESSION["idUporabnik"];
}

$user = UporabnikDB::get(["id" => $id]);

if ($user["aktivno"] === '1') {
    $active = "DA";
    $class = "btn btn-outline btn-danger btn-sm";
    $value = "Deaktiviraj";
    $aktivno = 0;
} else {
    $active = "NE";
    $class = "btn btn-outline btn-success btn-sm";
    $value = "Aktiviraj";
    $aktivno = 1;
}
?>

<body>
<?php include 'includes/nav.php' ?>

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">
                <?php
                if ($mode === "manage") {
                    echo "Upravljaj račun";
                } elseif ($mode === "edit") {
                    echo "Uredi prodajalca";
                } elseif ($mode === "create") {
                    echo "Ustvari prodajalca";
                }
                ?>
            </h1>

            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="userpanel" method="post">
                        <div class="form-group">
                            <label>Ime</label>
                            <input class="form-control" <?php if ($mode != "create") echo "value=" . $user["ime"]; ?>
                                   type="text" pattern="[A-zčžšČŽŠ]*" name="ime" required>
                        </div>
                        <div class="form-group">
                            <label>Priimek</label>
                            <input
                                class="form-control" <?php if ($mode != "create") echo "value=" . $user["priimek"]; ?>
                                type="text" pattern="[A-zčžšČŽŠ]*" name="priimek" required>
                        </div>

                        <?php
                        if ($mode === "edit")
                            echo "
                                <div class=\"form-group\">
                                    <label>Aktivno : $active</label> <br />
                                    <a class='$class' href='userpanel?aktivno=$aktivno&id=$id'>$value</a>
                                </div>
                            ";
                        ?>

                        <hr>
                        <div class="form-group">
                            <label>e-mail</label>
                            <input
                                class="form-control" <?php if ($mode != "create" && isset($user["email"])) echo "value='" . $user["email"] . "'"; ?>
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

                        <input type="hidden" name="idVloga" value="2"/>

                        <?php
                        if ($mode === "create") {
                            echo '	<input type="hidden" name="id" value=-1>
				                    <div class="form-group">
                                        <input type="submit" value="Ustvari novega prodajalca" class="btn btn-danger btn-block" name="submit" style="width: 50%; margin-left: auto; margin-right: auto;" onclick="return checkpassword()">
                                    </div>
				                 ';
                        } else {
                            echo '	<input type="hidden" name="id" value=' . $id . '>
                                    <input type="hidden" value="manage" name="mode"/>
                                    <div class="form-group">
                                        <input type="submit" value="Shrani" class="btn btn-danger btn-block" name="submit" style="width: 50%; margin-left: auto; margin-right: auto;" onclick="return checkpassword()">
                                    </div>
                                 ';
                        }
                        ?>
                    </form>

                    <?php
                    if ($mode === "edit")
                        echo '<a class=\'btn btn-default \' href=\'prodajalci\'>Nazaj</a>';
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