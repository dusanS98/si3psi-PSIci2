<!--Autor: Dušan Stanivuković 2017/0605-->


<div class="container">
    <div class='row row-cols-1 row-cols-md-4 mx-auto my-4' id="articles">
        <input type="hidden" id="base" value="<?php echo base_url(); ?>">
        <?php
        if (isset($orderArticles) && isset($articles)) {
            $trash = "<i class='far fa-trash-alt'></i>";
            $baseUrl = base_url();
            foreach ($articles as $article) {
                $amountId = findAmount($orderArticles, $article);
                $amount = explode("#", $amountId);

                $value = "                <div class='col-md-3'>\n";
                $value .= "                    <form method='post' action='" . site_url("Shop/removeFromCart") . "'>\n";
                $value .= "                        <div class='card text-center mb-4'>\n";
                $value .= "                            <img src=" . "$baseUrl/images/shop/" . $article["image"] . " class='card-img-top'>\n";
                $value .= "                            <div class='card-body'>\n";
                $value .= "                                 <input name='article' type='hidden' value='" . $article["articleId"] . "'>\n";
                $value .= "                                 <h5 class='card-title'>" . $article["name"] . "</h5>\n";
                $value .= "                                 <p class='card-text'>\n";
                $value .= "                                    Cena: <span id='article" . $article["articleId"] . "' class='font-weight-bold'>" . $amount[0] . "x" . $article["price"] . " = " . intval($amount[0] * $article["price"]) . " RSD</span><br>\n";

                $value .= "                                    <button type='submit' class='btn bg-transparent'><i class='far fa-trash-alt'></i></button>\n";
                $value .= "                                    <button data-toggle='modal' data-target='#exampleModalCenter' onclick='showAmount(\"" . $amountId . "\")' type='button' class='btn btn-primary mt-2'>Promeni količinu</button>\n";
                $value .= "                                </p>\n";
                $value .= "                            </div>\n";
                $value .= "                        </div>\n";
                $value .= "                    </form>\n";
                $value .= "               </div>\n";
                echo $value;
            }
        }

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
                <input type="hidden" name="amount" id="modalHiddenAmount" value="1">
                <input type="hidden" name="articleId" id="modalHiddenArticleId" value="1">
                <input type="hidden" name="orderId" id="modalHiddenOrderId" value="<?php echo $orderId; ?>">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                <button type="button" class="btn btn-primary" onclick="changeAmount()">Potvrdi</button>
            </div>
        </div>
    </div>
</div>
