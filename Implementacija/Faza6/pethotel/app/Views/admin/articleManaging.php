<!--Autor: Dušan Stanivuković 2017/0605-->


<div id="layoutSidenav_content">
    <main class="mb-4">
        <div class="container-fluid">
            <h1 class="mt-4">Administracija</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Administracija</li>
                <li class="breadcrumb-item active">Upravljanje proizvodima</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header"><i class="fas fa-table mr-1"></i>Tabela proizvoda</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Naziv</th>
                                <th>Cena</th>
                                <th>Količina</th>
                                <th>Detalji</th>
                                <th>Akcije</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Naziv</th>
                                <th>Cena</th>
                                <th>Količina</th>
                                <th>Detalji</th>
                                <th>Akcije</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php
                            if (isset($articles)) {
                                foreach ($articles as $article) {
                                    echo "<tr>";
                                    echo "<td>" . $article["name"] . "</td>";
                                    echo "<td>" . $article["price"] . "</td>";
                                    echo "<td>" . $article["amount"] . "</td>";
                                    echo "<td><form method='post' action='"
                                        . site_url("Shop/article") . "'>
                                                        <button name='article' value='" . $article["articleId"] . "' type='submit' class='btn btn-info'>
                                                        Detalji</button></form></td>";
                                    echo "<td><form style='float: left;' method='post' action='"
                                        . site_url("Shop/deleteArticle") . "'>
                                                        <button name='delete' value='" . $article["articleId"] . "' type='submit' class='btn bg-transparent'>
                                                        <i class='far fa-trash-alt'></i></button></form>";
                                    echo "<form method='post' action='"
                                        . site_url("Shop/changeArticle") . "'>
                                                        <button name='change' value='" . $article["articleId"] . "' type='submit' class='btn btn-warning'>
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

