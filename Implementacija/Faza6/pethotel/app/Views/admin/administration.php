<!--Autor: Dušan Stanivuković 2017/0605-->


<nav class="sb-topnav navbar navbar-expand navbar-light bg-light">
    <a class="navbar-brand" href="<?php echo site_url('Admin/index'); ?>">
        <img src="<?php echo base_url() . '/images/logo.jfif'; ?>" class="logo-img img-fluid rounded" alt="Logo"/>
    </a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i>
    </button>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">Izloguj se</a>
            </div>
        </li>
    </ul>
</nav>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Administracija</div>
                    <a class="nav-link active" href="<?php echo site_url("Admin/index"); ?>">
                        Upravljanje korisnicima
                    </a>
                    <div class="sb-sidenav-menu-heading">Moredacija</div>
                </div>
                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth"
                       aria-expanded="false" aria-controls="pagesCollapseAuth">
                        Unos sadržaja
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </a>
                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                         data-parent="#sidenavAccordionPages">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?php echo site_url("Admin/insertArticle"); ?>">Unos proizvoda</a>
                            <a class="nav-link" href="#">Unos ljubimaca</a>
                            <a class="nav-link" href="#">Unos smeštaja</a>
                        </nav>
                    </div>
                </nav>
                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages2">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth2"
                       aria-expanded="false" aria-controls="pagesCollapseAuth">
                        Brisanje i izmena sadržaja
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </a>
                    <div class="collapse" id="pagesCollapseAuth2" aria-labelledby="headingOne"
                         data-parent="#sidenavAccordionPages2">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?php echo site_url("Admin/manageArticles"); ?>">Proizvodi</a>
                            <a class="nav-link" href="#">Ljubimci</a>
                            <a class="nav-link" href="#">Smeštaj</a>
                        </nav>
                    </div>
                </nav>
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Standardne funkcije</div>
                    <a class="nav-link" href="<?php echo site_url("Shop/showArticles"); ?>">
                        Pregled prodavnice
                    </a>
                    <a class="nav-link" href="<?php echo site_url(""); ?>">
                        Pregled ljubimaca
                    </a>
                    <a class="nav-link" href="<?php echo site_url(""); ?>">
                        Pregled smeštaja
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Ulogovani ste kao:</div>
                <?php echo "Username"; ?>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main class="mb-4">
            <div class="container-fluid">
                <h1 class="mt-4">Administracija</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Administracija</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-table mr-1"></i>Tabela korisnika</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Ime i prezime</th>
                                    <th>Korisničko ime</th>
                                    <th>E-mail</th>
                                    <th>Telefon</th>
                                    <th>Tip naloga</th>
                                    <th>Akcije</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Ime i prezime</th>
                                    <th>Korisničko ime</th>
                                    <th>E-mail</th>
                                    <th>Telefon</th>
                                    <th>Tip naloga</th>
                                    <th>Akcije</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                if (isset($users)) {
                                    foreach ($users as $user) {
                                        echo "<tr>";
                                        echo "<td>" . $user["firstName"] . " " . $user["lastName"] . "</td>";
                                        echo "<td>" . $user["username"] . "</td>";
                                        echo "<td>" . $user["email"] . "</td>";
                                        echo "<td>" . $user["phone"] . "</td>";
                                        echo "<td>" . $user["type"] . "</td>";
                                        if ($user["type"] == "admin") {
                                            echo "<td></td>";
                                        } else {
                                            if ($user["type"] != "admin")
                                                echo "<td><form style='float: left;' method='post' action='"
                                                    . site_url("Admin/deleteUser") . "'>
                                                        <button name='delete' value='" . $user["username"] . "' type='submit' class='btn bg-transparent'>
                                                        <i class='far fa-trash-alt'></i></button></form>";
                                            if ($user["type"] == "standard")
                                                echo "<form method='post' action='"
                                                    . site_url("Admin/menagePrivileges") . "'>
                                                        <button name='privileges' value='" . $user["username"] . "' type='submit' class='btn btn-success'>
                                                        Dodeli privilegije</button></form>";
                                            if ($user["type"] == "moderator")
                                                echo "<form method='post' action='"
                                                    . site_url("Admin/menagePrivileges") . "'>
                                                        <button name='privileges' value='" . $user["username"] . "' type='submit' class='btn btn-danger'>
                                                        Oduzmi privilegije</button></form>";
                                            echo "</td>";
                                        }
                                        echo "</tr>";
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <div class="mt-4">
            <footer class="border-top footer text-muted mt-auto bg-light">
                <div class="container text-center">
                    &copy; Hotel za kućne ljubimce, Copyright 2020
                </div>
            </footer>
        </div>
    </div>
</div>

