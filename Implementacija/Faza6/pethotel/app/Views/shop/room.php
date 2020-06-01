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
                        <?php
                        if (session()->has("username")) {
                            echo '<form method="post" action="' . site_url("Room/makeReservation") . '">
                            <p class="card-text">
                                <input type="hidden" name="roomId" value="' . $room["roomId"] . '">
                                <input class="btn btn-primary" type="submit" value="Rezerviši">
                            </p>
                        </form>';
                            echo "\n";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

