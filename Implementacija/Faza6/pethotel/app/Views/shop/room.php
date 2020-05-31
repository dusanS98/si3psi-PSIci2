<!--Jovan Penezic 0560/2016-->

<?php
$image = base_url() . "/images/rooms/" . $room["image"];
$description = $room["description"];

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
?>
<div class="container">
    <div class="card mx-auto my-4" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?php echo $image; ?>" class="card-img h-100">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?php echo "Smestaj"; ?></h5>
                    <div class="mt-4">
                        <p class="card-text">
                            Smestaj pogodan za: <span class="font-weight-bold"><?php echo $type; ?></span>
                        </p>
                        <p class="card-text">
                            Opis smestaja: <span class="font-weight-bold"><?php echo $description; ?></span>
                        </p>
                        <p class='card-text'>
                            <a href=\"orders.php\">Ovde</a> možete rezervisati termin.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Količina</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="row">
                    <button class="btn btn-info ml-auto" onclick="minus()">&minus;</button>
                    <div class="col-md-3">
                        <input class="form-control" name="modalInput" id="modalAmount" type="number" value="1"
                               onchange="updateAmount()">
                    </div>
                    <button class="btn btn-info mr-auto" onclick="plus()">&plus;</button>
                </div>
            </div>
            <div class="modal-footer">
                <form method="post" action="<?php echo site_url('Room/order'); ?>">
                    <input type="hidden" name="amount" id="hiddenAmount" value="1">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                    <button type="submit" class="btn btn-primary">Potvrdi</button>
                </form>
            </div>
        </div>
    </div>
</div>
