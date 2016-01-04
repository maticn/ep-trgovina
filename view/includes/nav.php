<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <a class="navbar-brand" href="shop">
            <div id="logo"></div>
        </a>
    </div>
    <!-- /.navbar-header -->

    <section id="login">
        <ul class="nav navbar-top-links navbar-right">
            <li><a href="customerpanel"><i class="fa fa-user fa-fw"></i></a></li>
            <li><a href="logout"><i class="fa fa-sign-out fa-fw"></i></a></li>
        </ul>
    </section>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="customerpanel"><span><i class="fa fa-user fa-fw"></i> Upravljaj račun</span></a>
                </li>
                <li>
                    <a href="store"><span><i class="fa fa-laptop fa-fw"></i> Trgovina</span></a>
                </li>
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
                        <li><a href="#">Pregled</a></li></li>
                        <li><a href="#">Dodaj produkt</a></li></li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>

                <li>
                    <a href="#"><span><i class="fa fa-book fa-fw"></i> Naročila</span></a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>