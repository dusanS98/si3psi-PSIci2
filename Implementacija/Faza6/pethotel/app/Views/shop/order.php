<!--Autor: Dušan Stanivuković 2017/0605-->


<?php
function findAmount($orderArticles, $article)
{
    foreach ($orderArticles as $orderArticle) {
        if ($orderArticle["articleId"] == $article["articleId"])
            return $orderArticle["amount"] . "#" . $article["articleId"];
    }
    return "";
}

$orderId = 0;
if (isset($order))
    $orderId = $order["orderId"];
?>


<div class="container">
    <div class='row row-cols-1 row-cols-md-4 mx-auto my-4' id="articles">
        <input type="hidden" id="base" value="<?php echo base_url(); ?>">
        <?php
        if (isset($orderArticles) && isset($articles)) {
            $baseUrl = base_url();
            foreach ($articles as $article) {
                $amountId = findAmount($orderArticles, $article);
                $amount = explode("#", $amountId);

                $value = "                <div class='col-md-3'>\n";
                $value .= "                    <div class='card text-center mb-4'>\n";
                $value .= "                         <img src=" . "$baseUrl/images/shop/" . $article["image"] . " class='card-img-top'>\n";
                $value .= "                         <div class='card-body'>\n";
                $value .= "                             <input name='article' type='hidden' value='" . $article["articleId"] . "'>\n";
                $value .= "                             <h5 class='card-title'>" . $article["name"] . "</h5>\n";
                $value .= "                             <p class='card-text'>\n";
                $value .= "                                 Količina: <span id='articleAmount" . $article["articleId"] . "' class='font-weight-bold'>"
                    . $amount[0] . "</span><br>\n";
                $value .= "                                 Cena: <span class='font-weight-bold'>" . $article["price"] . " RSD</span><br>\n";
                $value .= "                                 Ukupna cena: <span id='articlePrice" . $article["articleId"] . "' class='font-weight-bold'>"
                    . intval($amount[0] * $article["price"]) . " RSD</span><br>\n";

                if ($order["status"] == "open") {
                    $value .= "                                 <button type='button' onclick='removeArticle(\"" . $article["articleId"]
                        . "\")' class='btn bg-transparent'><i class='far fa-trash-alt'></i></button>\n";
                    $value .= "                                 <button data-toggle='modal' data-target='#exampleModalCenter' onclick='showAmount(\""
                        . $amountId . "\")' type='button' class='btn btn-primary mt-2'>Promeni količinu</button>\n";
                }
                $value .= "                             </p>\n";
                $value .= "                         </div>\n";
                $value .= "                    </div>\n";
                $value .= "               </div>\n";
                echo $value;
            }
        }
        ?>
    </div>
    <?php
    if ($order["status"] == "open") {
        echo '<div class="row">
        <div class="col-md-8 mx-auto mb-4">
            <div class="alert alert-info text-center font-weight-bold" id="priceAlert">
                Ukupan iznos: ' . $order["orderPrice"] . ' RSD
            </div>
        </div>
    </div>';
        echo '<div class="row">
        <div class="col-md-4 mb-4 mx-auto">
            <form style="float: left;" method="post" action="' . site_url("Shop/cancelOrder") . '">
                <button type="submit" name="orderId" value="' . $orderId . '" class="btn btn-danger m-2">
                    Otkaži kupivinu
                </button>
            </form>
            <form method="post" action="' . site_url("Shop/finishOrderForm") . '">
                <button type="submit" name="orderId" value="' . $orderId . '" class="btn btn-success m-2">
                    Potvrdi kupivinu
                </button>
            </form>
        </div>
    </div>';
    } else {
        echo '<div class="row">
        <div class="col-md-8 mx-auto mb-4">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Ulica</th>
                    <th>Grad</th>
                    <th>Država</th>
                    <th>Poštanski kod</th>
                    <th>Ukupan iznos</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>' . $order["recipientAddress"] . '</th>
                        <th>' . $order["recipientCity"] . '</th>
                        <th>' . $order["recipientState"] . '</th>
                        <th>' . $order["recipientPostalCode"] . '</th>
                        <th>' . $order["orderPrice"] . ' RSD</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>';
    }
    echo "\n";
    ?>
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
                <input type="hidden" name="amount" id="modalHiddenAmount" value="1">
                <input type="hidden" name="articleId" id="modalHiddenArticleId" value="1">
                <input type="hidden" name="orderId" id="modalHiddenOrderId" value="<?php echo $orderId; ?>">
                <button type="button" class="btn btn-secondary" id="modalCloseButton" data-dismiss="modal">
                    Zatvori
                </button>
                <button type="button" class="btn btn-primary" onclick="changeAmount()">Potvrdi</button>
            </div>
        </div>
    </div>
</div>
