<!--Milica Janković 2013/0668-->


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
                                <input type="checkbox" class="custom-control-input" id="petCheckDogs"
                                    <?php if (session()->get("dogs") == "true") echo "checked"; ?>>
                                <label class="custom-control-label" for="petCheckDogs">Psi</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="petCheckCats"
                                    <?php if (session()->get("cats") == "true") echo "checked"; ?>>
                                <label class="custom-control-label" for="petCheckCats">Mačke</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="petCheckBirds"
                                    <?php if (session()->get("birds") == "true") echo "checked"; ?>>
                                <label class="custom-control-label" for="petCheckBirds">Ptice</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="petCheckFishes"
                                    <?php if (session()->get("fishes") == "true") echo "checked"; ?>>
                                <label class="custom-control-label" for="petCheckFishes">Ribice</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="petCheckLittleAnimals"
                                    <?php if (session()->get("littleAnimals") == "true") echo "checked"; ?>>
                                <label class="custom-control-label" for="petCheckLittleAnimals">Male
                                    životinje</label>
                            </div>
                        </form>
                    </div><br/><br/>
                    <div class="card-text">
                        <form method='post' action="<?php echo site_url('Pet/unosLjubimca'); ?>">
                            <input type='submit' class='btn btn-primary mt-2' value='Unesi ljubimca'>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class='col-md-10'>
            <div class="input-group mb-4">
                <input type="text" class="form-control" placeholder="Vrsta ljubimca"
                       aria-label="Vrsta ljubimca" aria-describedby="basic-addon2">

                <div class="input-group-append">
                    <button class="btn btn-primary"  id="search-button" type="button">Pretraži</button>

                </div>
            </div>
            <div class='row row-cols-1 row-cols-md-4 mr-2' id="pets">

                <?php

                $baseUrl = base_url();
                $id = "form";

                foreach ($pets as $pet) {
                    $value = "                <div class='col-md-3'>\n";
                    $value .= "                    <form method='post' action='$baseUrl/Pet/pet'>\n";
                    $value .= "                        <div class='card text-center mb-4'>\n";
                    $value .= "                            <img src=" . "$baseUrl/images/pets/" . $pet["image"] . " class='card-img-top'>\n";
                    $value .= "                            <div class='card-body'>\n";
                    $value .= "                                 <input name='pet' type='hidden' value='" . $pet["petId"] . "'>\n";
                    $value .= "                                 <input class='card-title btn btn-link button-link' type='submit' value='" . $pet["breed"] . " " . $pet["name"] . "'>\n";
                    $value .= "                                 <p class='card-text'>\n";
                    $value .= "                                    <a href=\"orders.php\">Ovde</a> možete rezervisati termin.\n";
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
                    $controllerMethod = 'showPets';
                    if (isset($categories)) $controllerMethod = 'showCategoriesPets';
                    ?>
                    <li class="page-item <?php if ($pagination['page'] == 1) echo 'disabled' ?>">
                        <a id="prev-page" class="page-link"
                           href="<?php echo site_url('Pet/' . $controllerMethod . '/' . $prevPage); ?>"
                           tabindex="-1"
                           aria-disabled="true">Prethodna</a>
                    </li>
                    <?php
                    for ($i = $prevPage; $i < $prevPage + 3; $i++) {
                        if ($i >= 1 && $i <= $pagination["numOfPages"]) {
                            if ($i == $pagination["page"]) {
                                echo "<li class='page-item active'>\n "
                                    . "                     <a class='page-link' href='"
                                    . site_url('Pet/' . $controllerMethod . '/' . $i)
                                    . "'>$i <span class=\"sr-only\">(current)</span></a>\n  "
                                    . "                  </li>\n";
                            } else {
                                echo "                    <li class='page-item'>\n "
                                    . "                     <a class='page-link' href='"
                                    . site_url('Pet/' . $controllerMethod . '/' . $i) . "'>$i</a>\n  "
                                    . "                  </li>\n";
                            }
                        }
                    }
                    ?>
                    <li class="page-item <?php if ($pagination['page'] == $pagination['numOfPages']) echo 'disabled' ?>">
                        <a class="page-link"
                           href="<?php echo site_url('Pet/' . $controllerMethod . '/' . $nextPage); ?>">Sledeća</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

</div>

