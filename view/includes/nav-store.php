<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="store">
            <div id="logo"></div>
        </a>
    </div>
    <!-- /.navbar-header -->

    <?php
    $manageUrl = "login";
    if (isset($_SESSION["idUporabnik"])) {
        $id = $_SESSION["idUporabnik"];
        if ($_SESSION["idVloga"] == 1) {
            $manageUrl = "adminpanel";
        } else if ($_SESSION["idVloga"] == 2) {
            $manageUrl = "sellerpanel";
        } else if ($_SESSION["idVloga"] == 3) {
            $manageUrl = "sellerpanel?id=$id";
        }
    }
    ?>

    <section id="login">
        <ul class="nav navbar-top-links navbar-right">
            <li><a href="<?php echo $manageUrl; ?>"><i class="fa fa-user fa-fw"></i></a></li>
            <li><a href="logout"><i class="fa fa-sign-out fa-fw"></i></a></li>
        </ul>
    </section>
    <!-- /.navbar-top-links -->

</nav>