<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
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

    $vloga = 0;
    if (isset($_SESSION["idVloga"])) {
        $vloga = $_SESSION["idVloga"];
    }
    ?>

    <section id="login">
        <ul class="nav navbar-top-links navbar-right">
            <li><a href="<?php echo $manageUrl; ?>"><i class="fa fa-user fa-fw"></i></a></li>
            <li><a href="logout"><i class="fa fa-sign-out fa-fw"></i></a></li>
        </ul>
    </section>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="<?php echo $manageUrl; ?>"><span><i
                                class="fa fa-user fa-fw"></i> Upravljaj račun</span></a>
                </li>
                <li>
                    <a href="store"><span><i class="fa fa-laptop fa-fw"></i> Trgovina</span></a>
                </li>
                <?php if ($vloga == 1) { ?>
                    <li>
                        <a href="#">
                            <i class="fa fa-share-alt fa-fw"></i> Upravljaj s prodajalci<span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a href="prodajalci">Pregled</a></li>
                            <li><a href="adminpanel?id=-1">Dodaj prodajalca</a></li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                <?php } ?>
                <?php if ($vloga == 1 || $vloga == 2) { ?>
                    <li>
                        <a href="#">
                            <i class="fa fa-users fa-fw"></i> Upravljaj s strankami<span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a href="sellerpanel?manage">Pregled</a></li>
                            <li><a href="sellerpanel?id=-1">Dodaj stranko</a></li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-cubes fa-fw"></i> Upravljaj s produkti<span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a href="#">Pregled</a></li>
                            <li><a href="#">Dodaj produkt</a></li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><span><i class="fa fa-book fa-fw"></i> Naročila</span></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
