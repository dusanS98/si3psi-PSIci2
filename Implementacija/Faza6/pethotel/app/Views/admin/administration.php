<!--Autor: Dušan Stanivuković 2017/0605-->


<div id="layoutSidenav_content">
    <main class="mb-4">
        <div class="container-fluid">
            <h1 class="mt-4">Administracija</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Administracija</li>
                <li class="breadcrumb-item active">Upravljanje korisnicima</li>
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

