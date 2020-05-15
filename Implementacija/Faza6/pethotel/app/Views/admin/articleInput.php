<!--Autor: Dušan Stanivuković 2017/0605-->


<div id="layoutSidenav_content">
    <main class="mb-4">
        <div class="container-fluid">
            <h1 class="mt-4">Unos proizvoda</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Administracija</li>
                <li class="breadcrumb-item active">Unos proizvoda</li>
            </ol>
        </div>

        <div class="container">
            <div class="row">
                <?php
                if (isset($messages)) {
                    echo "<div class='col-md-10 mx-auto mt-4'>";
                    echo "<div class='alert alert-info alert-dismissible text-center mx-auto my-4'>";
                    echo "<strong>$messages</strong>";
                    echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
                    echo "<span aria-hidden='true'>&times;</span>";
                    echo "</button>";
                    echo "</div>";
                    echo "</div>\n";
                } else if (session()->getFlashdata("messages") != null) {
                    echo "<div class='col-md-10 mx-auto mt-4'>";
                    echo "<div class='alert alert-info alert-dismissible text-center mx-auto my-4'>";
                    echo "<strong>" . session()->get("messages") . "</strong>";
                    echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
                    echo "<span aria-hidden='true'>&times;</span>";
                    echo "</button>";
                    echo "</div>";
                    echo "</div>\n";
                }
                echo "\n";
                ?>
                <div class="col-md-10 mx-auto my-4 bg-light rounded">
                    <form enctype="multipart/form-data" accept-charset="UTF-8" method="post"
                          action="<?php echo site_url("Shop/insertArticle"); ?>">
                        <div class="form-row mt-4">
                            <div class=" col-md-4 mb-3 ml-auto">
                                <label for="validationDefaultName">Naziv:</label>
                            </div>
                            <div class="col-md-4 mb-3 mr-auto">
                                <input type="text" class="form-control" name="name" id="validationDefaultName"
                                       required/>
                            </div>
                        </div>
                        <div class="form-row mt-4">
                            <div class=" col-md-4 mb-3 ml-auto">
                                <label for="validationDefaultPrice">Cena:</label>
                            </div>
                            <div class="col-md-4 mb-3 mr-auto">
                                <input type="number" class="form-control" name="price" id="validationDefaultPrice"
                                       required/>
                            </div>
                        </div>
                        <div class="form-row mt-4">
                            <div class=" col-md-4 mb-3 ml-auto">
                                <label for="validationDefaultQuantity">Količina:</label>
                            </div>
                            <div class="col-md-4 mb-3 mr-auto">
                                <input type="number" class="form-control" name="amount"
                                       id="validationDefaultQuantity"
                                       required/>
                            </div>
                        </div>
                        <div class="form-row mt-4">
                            <div class=" col-md-4 mb-3 ml-auto">
                                <label for="imageFile">Slika (do 5MB):</label>
                            </div>
                            <div class="col-md-4 mb-3 mr-auto">
                                <input type="file" class="form-control-file" name="image" id="imageFile">
                            </div>
                        </div>
                        <div class="form-row mt-4">
                            <div class=" col-md-4 mb-3 ml-auto">
                                <label for="validationDefaultCategory">Kategorija:</label>
                            </div>
                            <div class="col-md-4 mb-3 mr-auto">
                                <select class="custom-select" name="category" id="validationDefaultCategory"
                                        required>
                                    <option value="psi" selected>Psi</option>
                                    <option value="macke">Macke</option>
                                    <option value="ptice">Ptice</option>
                                    <option value="ribe">Ribe</option>
                                    <option value="maleZivotinje">Male životinje</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row mt-4">
                            <div class=" col-md-4 mb-3 ml-auto">
                                <label for="validationDefaultDescription">Opis:</label>
                            </div>
                            <div class="col-md-4 mb-3 mr-auto">
                                    <textarea class="form-control" name="description" id="validationDefaultDescription"
                                              required>
                                    </textarea>
                            </div>
                        </div>
                        <div class="form-row col-md-4 mx-auto mt-3 mb-4">
                            <button class="btn btn-primary" type="submit">
                                Unesi
                            </button>
                        </div>
                    </form>
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

