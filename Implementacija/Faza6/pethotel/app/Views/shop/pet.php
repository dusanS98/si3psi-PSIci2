<!--Milica Janković 2013/0668-->

<?php
$image = base_url() . "/images/pets/" . $pet["image"];
$petName = $pet["name"];
$petBreed = $pet["breed"];
$petBirth = $pet["dateOfBirth"];
$description = $pet["description"];
$category = "";

if (substr($petBreed, 0, 3) === "Pas") {
    $category = "Psi";
} else if (substr($petBreed, 0, 3) === "Mac") {
    $category = "Macke";
} else if (substr($petBreed, 0, 5) === "Ptica") {
    $category = "Ptice";
} else if (substr($petBreed, 0, 6) === "Ribica") {
    $category = "Ribice";
} else {
    $category = "Male zivotinje";
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
                    <h5 class="card-title"><?php echo $petName; ?></h5>
                    <div class="mt-4">
                        <p class="card-text">
                            Rasa: <span class="font-weight-bold"><?php echo $petBreed; ?></span>
                        </p>
                        <p class="card-text">
                            Kategorija: <span class="font-weight-bold"><?php echo ucfirst($category); ?></span>
                        </p>
                        <p class="card-text">
                            Datum rodjenja: <span class="font-weight-bold"><?php echo $petBirth; ?></span>
                        </p>
                        <p class="card-text">
                            Opis ljubimca: <span class="font-weight-bold"><?php echo $description; ?></span>
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
                <form method="post" action="<?php echo site_url('Pet/order'); ?>">
                    <input type="hidden" name="amount" id="hiddenAmount" value="1">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                    <button type="submit" class="btn btn-primary">Potvrdi</button>
                </form>
            </div>
        </div>
    </div>
</div>
