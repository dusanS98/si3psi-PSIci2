<!--Autor: Dušan Stanivuković 2017/0605-->


<div id="layoutSidenav_content">
    <main class="mb-4">
        <div class="container-fluid">
            <h1 class="mt-4">Moderacija</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Moderacija</li>
                <li class="breadcrumb-item active">Upravljanje smeštajem</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header"><i class="fas fa-table mr-1"></i>Tabela smeštaja</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Tip</th>
                                <th>Opis</th>
                                <th>Detalji</th>
                                <th>Akcije</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Tip</th>
                                <th>Opis</th>
                                <th>Detalji</th>
                                <th>Akcije</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php
                            if (isset($rooms)) {
                                foreach ($rooms as $room) {
                                    echo "<tr>";
                                    echo "<td>" . $room["type"] . "</td>";
                                    echo "<td>" . $room["description"] . "</td>";
                                    echo "<td><form method='post' action='"
                                        . site_url("Room/room") . "'>
                                                        <button name='room' value='" . $room["roomId"] . "' type='submit' class='btn btn-info'>
                                                        Detalji</button></form></td>";
                                    echo "<td><form style='float: left;' method='post' action='"
                                        . site_url("Room/deleteRoom") . "'>
                                                        <button name='delete' value='" . $room["roomId"] . "' type='submit' class='btn bg-transparent'>
                                                        <i class='far fa-trash-alt'></i></button></form>";
                                    echo "<form method='post' action='"
                                        . site_url("Room/changeRoom") . "'>
                                                        <button name='change' value='" . $room["roomId"] . "' type='submit' class='btn btn-warning'>
                                                        Izmeni</button></form></td>";
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

