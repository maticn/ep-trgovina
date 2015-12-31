<?php
/**
 * Created by PhpStorm.
 * User: ep
 * Date: 31.12.2015
 * Time: 11:37
 */

if (!isset($_SESSION["idUporabnik"])) {
    header("Location:" . $_SERVER["SCRIPT_NAME"] . "/login");
    echo "Uporabnik ni prijavljen.";
}

$mode = "manage";
if (isset($_GET["id"]) && $_GET["id"] != null && $_GET["id"] != -1) {
    $mode = "edit";
}
if (isset($_GET["id"]) && $_GET["id"] != null && $_GET["id"] == -1) {
    $mode = "create";
}
?>

<ul class="nav nav-sidebar">
    <li <?php if ($mode === "create") echo 'class="active"'; ?>><a href="editstaff.php?id=-1">Ustvari prodajalca</a>
    </li>
    <li <?php if ($mode === "edit") echo 'class="active"'; ?>><a href="sellerActivation.php">Upravljaj prodajalce</a>
    </li>
</ul>

<?php
echo "MODE: " . $mode;
try {
    if ($mode === "manage") {
        echo "<h1 class='page-header'>Upravljaj racun</h1><div class='col-md-8'>";
    } elseif ($mode === "edit") {
        echo "<h1 class='page-header'>Uredi prodajalca</h1><div class='col-md-8'>";
    } elseif ($mode === "create") {
        echo "<h1 class='page-header'>Ustvari prodajalca</h1><div class='col-md-8'>";
    }

    if ($mode === "edit") {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
    } else {
        $id = $_SESSION["idUporabnik"];
    }

    echo "ID: " . $id;


    $user = UporabnikDB::get(["id" => $id]);

    if ($user["aktivno"] === '1') {
        $class = "btn deactivate";
        $value = "Deaktiviraj";
        $aktivno = 0;
    } else {
        $class = "btn activate";
        $value = "Aktiviraj";
        $aktivno = 1;
    }
} catch (Exception $e) {
    echo "napaka";
}
?>

<form action="userpanel.php" method="post" onsubmit="return validateRegistration()">
    <table style="width:100%">
        <tr>
            <td>Ime</td>
            <td><input class="fname form-control" <?php if ($mode != "create") echo "value=" . $user["ime"]; ?>
                       type="text" name="ime" required></td>
        </tr>
        <tr>
            <td>Priimek</td>
            <td><input class="lname form-control" <?php if ($mode != "create") echo "value=" . $user["priimek"]; ?>
                       type="text" name="priimek" required></td>
        </tr>
        <?php
        if ($mode === "edit")
            echo "<tr>
							<td>Aktivno</td>
							<td>
								<a class='$class' href='userpanel.php?aktivno=$aktivno&id=$id'>$value</a>
							</td>
						</tr>";
        ?>
        <tr>
            <td colspan="2">
                <hr>
            </td>
        </tr>
        <?php
        if ($mode === "create") {
            echo '<tr>
						          <td>e-mail</td>
						          <td><input class="lname form-control" type="text" name="email" required></td>
				  		        </tr>';
        }
        ?>
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
    <input type="hidden" value="seller" name="type"/>
    <?php
    if ($mode === "create") {
        echo '	<input type="hidden" value=-1 name="id">
								<input value="Ustvari novega prodajalca" class="fbtn btn-lg btn-primary btn-block" type="submit" name="submit" style="width: 50%; margin-left: auto; margin-right: auto;" onclick="return checkpassword()"/>';
    } else {
        echo '	<input type="hidden" value=' . $id . ' name="id">
				<input value="Shrani" class="fbtn btn-lg btn-primary btn-block" type="submit" style="width: 50%; margin-left: auto; margin-right: auto;" onclick="return checkpassword()"/>';
    }
    ?>
</form>

<?php
if ($mode === "edit")
    echo '<a href="sellerActivation.php" style="font-size:20px">Nazaj</a>';
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
