<?php
/**
 * Created by PhpStorm.
 * User: ep
 * Date: 3.1.2016
 * Time: 20:24
 */

//if (!isset($_SESSION["idUporabnik"])) {
//    header("Location:" . $_SERVER["SCRIPT_NAME"] . "/login");
//    echo "Uporabnik ni prijavljen.";
//}
//if ($_SESSION["idVloga"] != 3) {
//    header("Location:" . $_SERVER["SCRIPT_NAME"] . "/login");
//    echo "Niste prijavljeni kot kupec.";
//}

$id = $_SESSION["idUporabnik"];
$result = UporabnikDB::get(["id" => $id]);

?>

    <!DOCTYPE html>
    <!-- saved from url=(0043)http://getbootstrap.com/examples/jumbotron/ -->
    <html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="http://shrani.si/f/t/GW/ThU5QMy/pageicon.png">

        <title>eMall</title>

        <!-- Bootstrap core CSS -->
        <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="http://getbootstrap.com/examples/jumbotron/jumbotron.css" rel="stylesheet">

        <!-- Custom CSS by design master himself, Matic Jazbec the great -->
        <link href="spletnatrgovina.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]>
        <script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="./store_files/ie-emulation-modes-warning.js"></script>
        <style type="text/css"></style>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="store.php">Home</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="navbar navbar-nav navbar-right">
                <li><a class="navbar-brand cart_button" href="#">Cart</a></li>
                <li><a class="navbar-brand" href="accountSettings.php">Account Settings</a></li>
                <li><a class="navbar-brand" href="history.php">History</a></li>
                <li><a class="navbar-brand" href="logout.php">Log out</a></li>
            </ul>

        </div>
    </div><!--/.navbar-collapse -->
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <h1 class="page-header"> Account Settings</h1>
            <form action="userpanel" method="post">
                <table style="width:100%">
                    <tr>
                        <td>Ime</td>
                        <td><input class="form-control" value="<?= $result["ime"] ?>" type="text"
                                   name="ime" required></td>
                    </tr>
                    <tr>
                        <td>Priimek</td>
                        <td><input class="form-control" value="<?= $result["priimek"] ?>" type="text"
                                   name="priimek" required></td>
                    </tr>
                    <tr>
                        <td>E-mail</td>
                        <td><input class="form-control" value="<?= $result["email"] ?>" type="email" name="email"
                                   required></td>
                    </tr>
                    <tr>
                        <td>Telefon</td>
                        <td><input class="form-control" value="<?= $result["telefon"] ?>" type="text"
                                   name="telefon" required></td>
                    </tr>
                    <tr>
                        <td>Naslov</td>
                        <td><input class="form-control" value="<?= $result["naslov"] ?>" type="text" name="naslov"
                                   required></td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <hr>
                        </td>
                    </tr>
                </table>
                <input type="hidden" value="<?= $id ?>" name="id">
                <input value="Shrani" class="fbtn btn-lg btn-primary btn-block" type="submit"
                       style="width: 50%; margin-left: auto; margin-right: auto;">
            </form>
        </div>
    </div>
</div>
