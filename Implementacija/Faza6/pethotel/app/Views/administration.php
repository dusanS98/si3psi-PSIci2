<nav class="sb-topnav navbar navbar-expand navbar-light bg-light">
    <a class="navbar-brand logo mb-2" href="<?php echo site_url('Home/index'); ?>">
        <img src="<?php echo base_url() . '/images/logo.jfif'; ?>" class="logo-img img-fluid rounded" alt="Logo"/>
    </a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i>
    </button>
    <!-- Navbar-->
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

                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                Start Bootstrap
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main class="mb-4">
            <div class="container-fluid">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-table mr-1"></i>Tabela korisnika</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>E-mail</th>
                                    <th>Phone</th>
                                    <th>Type</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>E-mail</th>
                                    <th>Phone</th>
                                    <th>Type</th>
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

