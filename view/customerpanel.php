<?php
/**
 * Created by PhpStorm.
 * User: ep
 * Date: 3.1.2016
 * Time: 20:24
 */

// nc se rihtou

  require_once(dirname(__FILE__)."/lib/database.php");

  session_start();

  if (!isset($_SESSION["userid"])) {
      header("Location:login.html"); // upam da je to kul
  }
  $db = new dbConnector();
  $db->dbOpen();


  if(isset($_POST['firstname']))
  {

      $sql = "UPDATE users SET ";
      $params = array();
      if (isset($_POST["password"]) && $_POST["password"] === $_POST["confirm"] && !empty($_POST["password"])) {
          $sql .= "password = sha1(?),";
          $params[] = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
      }
      if (isset($_POST["firstname"]) && !empty($_POST["firstname"])) {
          $sql .= "firstname = ?,";
          $params[] = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
      }
      if (isset($_POST["lastname"]) && !empty($_POST["lastname"])) {
          $sql .= "lastname = ?,";
          $params[] = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);
      }
      if (isset($_POST["emso"]) && !empty($_POST["emso"])) {
          $sql .= "emso = ?,";
          $params[] = filter_input(INPUT_POST, 'emso', FILTER_SANITIZE_SPECIAL_CHARS);
      }

      // customers
      if (isset($_POST["email"]) && !empty($_POST["email"])) {
          $sql .= "email = ?,";
          $params[] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
      }
      if (isset($_POST["address"]) && !empty($_POST["address"])) {
          $sql .= "address = ?,";
          $params[] = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_SPECIAL_CHARS);
      }
      if (isset($_POST["phone_number"]) && !empty($_POST["phone_number"])) {
          $sql .= "phone_number = ?,";
          $params[] = filter_input(INPUT_POST, 'phone_number', FILTER_SANITIZE_SPECIAL_CHARS);
      }
      if (isset($_POST["city"]) && !empty($_POST["city"])) {
          $sql .= "city = ?,";
          $params[] = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_SPECIAL_CHARS);
      }
      if (isset($_POST["post"]) && !empty($_POST["post"])) {
          $sql .= "post = ?,";
          $params[] = filter_input(INPUT_POST, 'post', FILTER_SANITIZE_SPECIAL_CHARS);
      }
      if (isset($_POST["country"]) && !empty($_POST["country"])) {
          $sql .= "country = ?,";
          $params[] = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_SPECIAL_CHARS);
      }

      $sql = trim($sql, ",");
      $sql .= " WHERE id = ?";
      $params[] = $_SESSION["userid"];
      $db->execute($sql, $params);
  }

    $sql = "SELECT firstname, lastname, email, address, phone_number, city, post, country FROM users WHERE id = :userid";

    $params = array(":userid" => $_SESSION["userid"]);
    $result = $db->execute($sql, $params);
    $row = $result[0];

    $db->dbClose();


  ?>

    <!DOCTYPE html>
    <!-- saved from url=(0043)http://getbootstrap.com/examples/jumbotron/ -->
    <html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="./store_files/ie-emulation-modes-warning.js"></script><style type="text/css"></style>

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
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
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
            <form action="accountSettings.php" method="post">
                <table style="width:100%">
                    <tr>
                        <td>First name</td>
                        <td><input class="fname form-control" value="<?= $row["firstname"] ?>" type="text" name="firstname" required></td>
                    </tr>
                    <tr>
                        <td>Last name</td>
                        <td><input class="lname form-control" value="<?= $row["lastname"] ?>" type="text" name="lastname" required></td>
                    </tr>
                    <tr>
                        <td>E-mail</td>
                        <td><input class="lname form-control" value="<?= $row["email"] ?>" type="text" name="email" required></td>
                    </tr>
                    <tr>
                        <td>Phone number</td>
                        <td><input class="lname form-control" value="<?= $row["phone_number"] ?>" type="text" name="phone_number" required></td>
                    </tr>
                    <tr>
                        <td>Adress</td>
                        <td><input class="lname form-control" value="<?= $row["address"] ?>" type="text" name="address" required></td>
                    </tr>
                    <tr>
                        <td>Post</td>
                        <td><input class="lname form-control" value="<?= $row["post"] ?>" type="text" name="post" required></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><input class="lname form-control" value="<?= $row["city"] ?>" type="text" name="city" required></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td><input class="lname form-control" value="<?= $row["country"] ?>" type="text" name="country" required></td>
                    </tr>
                    <tr><td colspan=2>
                            <hr>
                        </td>
                    </tr>


                </table>

                <input value="Save" class="fbtn btn-lg btn-primary btn-block" type="submit" style="width: 50%; margin-left: auto; margin-right: auto;">
            </form>
        </div>
    </div>
</div>

<script>
    function pop_up(url){
        window.open(url,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=no,width=600,height=800,directories=no,location=no')
    }
</script>

<?php
  require_once(dirname(__FILE__)."/static/footer.php");
?>