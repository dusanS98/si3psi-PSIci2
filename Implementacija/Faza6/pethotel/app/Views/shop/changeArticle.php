<!--Autor: Dušan Stanivuković 2017/0605-->


<div class="container">
    <?php
    if (session()->getFlashdata("messages")) {
        echo "<div class='alert alert-info alert-dismissible text-center mx-auto my-4'>";
        echo "<strong>" . session()->getFlashdata("messages") . "</strong>";
        echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
        echo "<span aria-hidden='true'>&times;</span>";
        echo "</button>";
        echo "</div>";
    }
    ?>
    <div class="row">
        <div class="col-md-10 mx-auto my-4 bg-light rounded">
            <form enctype="multipart/form-data" accept-charset="UTF-8" method="post"
                  action="<?php echo site_url("Shop/saveChanges"); ?>">
                <div class="form-row mt-4">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="validationDefaultName">Naziv:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <input type="text" value="<?php echo $article['name']; ?>" class="form-control" name="name"
                               id="validationDefaultName" required/>
                    </div>
                </div>
                <div class="form-row mt-4">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="validationDefaultPrice">Cena:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <input type="number" value="<?php echo $article['price']; ?>" class="form-control" name="price"
                               id="validationDefaultPrice" required/>
                    </div>
                </div>
                <div class="form-row mt-4">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="validationDefaultQuantity">Količina:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <input type="number" value="<?php echo $article['amount']; ?>" class="form-control"
                               name="amount" id="validationDefaultQuantity"
                               required/>
                    </div>
                </div>
                <div class="form-row mt-4">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="validationDefaultCategory">Kategorija:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <?php
                        $pos = strpos($article["description"], "#");
                        $category = substr($article["description"], 0, $pos);
                        $description = substr($article["description"], $pos + 1);
                        ?>
                        <select class="custom-select" name="category" id="validationDefaultCategory" required>
                            <option value="psi"<?php if ($category == "psi") echo " selected"; ?>>Psi</option>
                            <option value="macke"<?php if ($category == "macke") echo " selected"; ?>>Macke</option>
                            <option value="ptice"<?php if ($category == "ptice") echo " selected"; ?>>Ptice</option>
                            <option value="ribe"<?php if ($category == "ribe") echo " selected"; ?>>Ribe</option>
                            <option value="maleZivotinje"<?php if ($category == "maleZivotinje") echo " selected"; ?>>
                                Male životinje
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-row mt-4">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="validationDefaultDescription">Opis:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <textarea class="form-control" name="description" id="validationDefaultDescription"
                                  required><?php echo $description; ?>
                        </textarea>
                    </div>
                </div>
                <div class="form-row col-md-4 mx-auto mt-3 mb-4">
                    <button class="btn btn-primary" type="submit">
                        Sačuvaj
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
