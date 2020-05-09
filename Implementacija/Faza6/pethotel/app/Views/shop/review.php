<!--Dušan Stanivuković 2017/0605-->


<div class='container-fluid'>
    <div class='row mt-4'>
        <div class='col-md-2'>
            <div class="card" style="height: 98%;">
                <div class="card-header font-weight-bold">
                    Pretraga
                </div>
                <div class="card-body">
                    <div class="card-text">
                        <h5 class="card-title">Kategorije</h5>
                        <form>
                            <input type="hidden" id="base" value="<?php echo base_url(); ?>">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheckDogs"
                                    <?php if (session()->get("dogs") == "true") echo "checked"; ?>>
                                <label class="custom-control-label" for="customCheckDogs">Psi</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheckCats"
                                    <?php if (session()->get("cats") == "true") echo "checked"; ?>>
                                <label class="custom-control-label" for="customCheckCats">Mačke</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheckBirds"
                                    <?php if (session()->get("birds") == "true") echo "checked"; ?>>
                                <label class="custom-control-label" for="customCheckBirds">Ptice</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheckFishes"
                                    <?php if (session()->get("fishes") == "true") echo "checked"; ?>>
                                <label class="custom-control-label" for="customCheckFishes">Ribice</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheckLittleAnimals"
                                    <?php if (session()->get("littleAnimals") == "true") echo "checked"; ?>>
                                <label class="custom-control-label" for="customCheckLittleAnimals">Male
                                    životinje</label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class='col-md-10'>
            <div class="input-group mb-4">
                <input type="text" class="form-control" placeholder="Naziv proizvoda"
                       aria-label="Naziv proizvoda" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" id="search-button" type="button">Pretraži</button>
                </div>
            </div>
            <div class='row row-cols-1 row-cols-md-4 mr-2' id="articles">

                <?php

                $baseUrl = base_url();
                $id = "form";

                foreach ($articles as $article) {
                    $value = "                <div class='col-md-3'>\n";
                    $value .= "                    <form method='post' action='$baseUrl/Shop/article'>\n";
                    $value .= "                        <div class='card text-center mb-4'>\n";
                    $value .= "                            <img src=" . "$baseUrl/images/shop/" . $article["image"] . " class='card-img-top'>\n";
                    $value .= "                            <div class='card-body'>\n";
                    $value .= "                                 <input name='article' type='hidden' value='" . $article["articleId"] . "'>\n";
                    $value .= "                                 <input class='card-title btn btn-link button-link' type='submit' value='" . $article["name"] . "'>\n";
                    $value .= "                                 <p class='card-text'>\n";
                    $value .= "                                    Cena: <span class='font-weight-bold'>" . $article["price"] . " RSD</span><br>\n";

                    $value .= "                                    <input type='submit' class='btn btn-primary mt-2' value='Naruči'>\n";
                    $value .= "                                </p>\n";
                    $value .= "                            </div>\n";
                    $value .= "                        </div>\n";
                    $value .= "                    </form>\n";
                    $value .= "               </div>\n";
                    echo $value;
                }

                ?>

            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <nav>
                <ul class="pagination justify-content-end mr-4" id="pagination">
                    <?php
                    echo "<input type='hidden' id='page' value='" . $pagination["page"] . "'>\n";
                    $prevPage = $pagination["page"] - 1;
                    $nextPage = $pagination["page"] + 1;
                    $controllerMethod = 'showArticles';
                    if (isset($categories)) $controllerMethod = 'showCategories';
                    ?>
                    <li class="page-item <?php if ($pagination['page'] == 1) echo 'disabled' ?>">
                        <a id="prev-page" class="page-link"
                           href="<?php echo site_url('Shop/' . $controllerMethod . '/' . $prevPage); ?>"
                           tabindex="-1"
                           aria-disabled="true">Prethodna</a>
                    </li>
                    <?php
                    for ($i = $prevPage; $i < $prevPage + 3; $i++) {
                        if ($i >= 1 && $i <= $pagination["numOfPages"]) {
                            if ($i == $pagination["page"]) {
                                echo "<li class='page-item active'>\n "
                                    . "                     <a class='page-link' href='"
                                    . site_url('Shop/' . $controllerMethod . '/' . $i)
                                    . "'>$i <span class=\"sr-only\">(current)</span></a>\n  "
                                    . "                  </li>\n";
                            } else {
                                echo "                    <li class='page-item'>\n "
                                    . "                     <a class='page-link' href='"
                                    . site_url('Shop/' . $controllerMethod . '/' . $i) . "'>$i</a>\n  "
                                    . "                  </li>\n";
                            }
                        }
                    }
                    ?>
                    <li class="page-item <?php if ($pagination['page'] == $pagination['numOfPages']) echo 'disabled' ?>">
                        <a class="page-link"
                           href="<?php echo site_url('Shop/' . $controllerMethod . '/' . $nextPage); ?>">Sledeća</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

</div>

