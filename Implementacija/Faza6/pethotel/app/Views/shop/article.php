<!--Autor: Dušan Stanivuković 2017/0605-->

<?php
$image = base_url() . "/images/shop/" . $article["image"];
$articleName = $article["name"];
$articlePrice = $article["price"];
$pos = strpos($article["description"], "#");
$category = substr($article["description"], 0, $pos);
$description = substr($article["description"], $pos + 1);
?>
<div class="container">
    <?php
    if (isset($messages)) {
        echo "<div class='alert alert-info alert-dismissible text-center mx-auto my-4'>";
        echo "<strong>$messages</strong>";
        echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
        echo "<span aria-hidden='true'>&times;</span>";
        echo "</button>";
        echo "</div>";
    }
    ?>
    <div class="card mx-auto my-4" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?php echo $image; ?>" class="card-img h-100">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $articleName; ?></h5>
                    <div class="mt-4">
                        <p class="card-text">
                            Cena: <span class="font-weight-bold"><?php echo $articlePrice; ?> RSD</span>
                        </p>
                        <p class="card-text">
                            Kategorija: <span class="font-weight-bold"><?php echo ucfirst($category); ?></span>
                        </p>
                        <p class="card-text">
                            Opis proizvoda: <span class="font-weight-bold"><?php echo $description; ?></span>
                        </p>
                        <p class="card-text mb-2">
                            <?php
                            if (session()->has("username")) {
                                echo '<button style="float: left;" class="btn btn-primary mb-2" data-toggle="modal"
                                    data-target="#exampleModalCenter">
                                Dodaj u korpu
                            </button>';
                            }
                            if (session()->get("userType") == "admin" || session()->get("userType") == "moderator") {
                                echo '
                                    <form style="float: left;" method="post" action="' . site_url("Shop/changeArticle") . '">
                                        <button class="btn btn-info ml-3" type="submit" name="change" value="'
                                    . $article["articleId"] . '">
                                        Izmeni
                                        </button>
                                    </form>
                                    <form method="post" action="' . site_url("Shop/deleteArticle") . '">
                                        <button class="btn btn-danger ml-2" type="submit" name="delete" value="'
                                    . $article["articleId"] . '">
                                        Izbriši
                                        </button>
                                    </form>
                                ';
                            }
                            ?>
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
                <form method="post" action="<?php echo site_url('Shop/order'); ?>">
                    <input type="hidden" name="amount" id="hiddenAmount" value="1">
                    <input type="hidden" name="articleId" value="<?php echo $article['articleId']; ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                    <button type="submit" class="btn btn-primary">Potvrdi</button>
                </form>
            </div>
        </div>
    </div>
</div>
