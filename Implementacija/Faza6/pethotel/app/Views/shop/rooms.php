<!--Autor: Jovan Penezic 0560/2016-->


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
                                <input type="checkbox" class="custom-control-input" id="roomCheckDogs"
                                    <?php if (session()->get("dogs") == "true") echo "checked"; ?>>
                                <label class="custom-control-label" for="roomCheckDogs">Psi</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="roomCheckCats"
                                    <?php if (session()->get("cats") == "true") echo "checked"; ?>>
                                <label class="custom-control-label" for="roomCheckCats">Mačke</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="roomCheckBirds"
                                    <?php if (session()->get("birds") == "true") echo "checked"; ?>>
                                <label class="custom-control-label" for="roomCheckBirds">Ptice</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="roomCheckFishes"
                                    <?php if (session()->get("fishes") == "true") echo "checked"; ?>>
                                <label class="custom-control-label" for="roomCheckFishes">Ribice</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="roomCheckLittleAnimals"
                                    <?php if (session()->get("littleAnimals") == "true") echo "checked"; ?>>
                                <label class="custom-control-label" for="roomCheckLittleAnimals">Male
                                    životinje</label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class='col-md-10'>
            <div class='row row-cols-1 row-cols-md-4 mr-2' id="rooms">

                <?php

                $baseUrl = base_url();
                $id = "form";

                if (isset($rooms)) {
                    foreach ($rooms as $room) {
                        $type = "";
                        switch ($room["type"]) {
                            case "psi":
                                $type = "Psi";
                                break;
                            case "macke":
                                $type = "Mačke";
                                break;
                            case "ptice":
                                $type = "Ptice";
                                break;
                            case "ribe":
                                $type = "Ribe";
                                break;
                            case "maleZivotinje":
                                $type = "Male Životinje";
                                break;
                        }
                        $value = "                <div class='col-md-3'>\n";
                        $value .= "                    <form method='post' action='$baseUrl/Room/room'>\n";
                        $value .= "                        <div class='card text-center mb-4'>\n";
                        $value .= "                            <input type='image' src=" . "$baseUrl/images/rooms/" . $room["image"] . " class='card-img-top'>\n";
                        $value .= "                            <div class='card-body'>\n";
                        $value .= "                                 <input name='room' type='hidden' value='" . $room["roomId"] . "'>\n";
                        $value .= "                                 <input class='card-title btn btn-link button-link' type='submit' value='Tip: " . $type . "'>\n";
                        $value .= "                                 <p class='card-text'>\n";
                        $value .= "                                         <a href=\"orders.php\">Ovde</a> možete rezervisati termin.\n";
                        $value .= "                                </p>\n";
                        $value .= "                            </div>\n";
                        $value .= "                        </div>\n";
                        $value .= "                    </form>\n";
                        $value .= "               </div>\n";
                        echo $value;
                    }
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
                    $controllerMethod = 'showRooms';
                    if (isset($categories)) $controllerMethod = 'showRoomsByType';
                    ?>
                    <li class="page-item <?php if ($pagination['page'] == 1) echo 'disabled' ?>">
                        <a id="prev-page" class="page-link"
                           href="<?php echo site_url('Room/' . $controllerMethod . '/' . $prevPage); ?>"
                           tabindex="-1"
                           aria-disabled="true">Prethodna</a>
                    </li>
                    <?php
                    for ($i = $prevPage; $i < $prevPage + 3; $i++) {
                        if ($i >= 1 && $i <= $pagination["numOfPages"]) {
                            if ($i == $pagination["page"]) {
                                echo "<li class='page-item active'>\n "
                                    . "                     <a class='page-link' href='"
                                    . site_url('Room/' . $controllerMethod . '/' . $i)
                                    . "'>$i <span class=\"sr-only\">(current)</span></a>\n  "
                                    . "                  </li>\n";
                            } else {
                                echo "                    <li class='page-item'>\n "
                                    . "                     <a class='page-link' href='"
                                    . site_url('Room/' . $controllerMethod . '/' . $i) . "'>$i</a>\n  "
                                    . "                  </li>\n";
                            }
                        }
                    }
                    ?>
                    <li class="page-item <?php if ($pagination['page'] == $pagination['numOfPages']) echo 'disabled' ?>">
                        <a class="page-link"
                           href="<?php echo site_url('Room/' . $controllerMethod . '/' . $nextPage); ?>">Sledeća</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

</div>

