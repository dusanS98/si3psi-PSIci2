<!--Autor: Dušan Stanivuković 2017/0605-->


<div class="container">
    <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
        <li class="nav-item ml-auto">
            <a class="nav-link active" id="openOrder-tab" data-toggle="tab" href="#openOrder" role="tab"
               aria-controls="openOrder" aria-selected="true">
                Otvorene narudžbine
            </a>
        </li>
        <li class="nav-item mr-auto">
            <a class="nav-link" id="closedOrders-tab" data-toggle="tab" href="#closedOrders" role="tab"
               aria-controls="closedOrders" aria-selected="false">
                Gotove narudžbine
            </a>
        </li>
    </ul>
    <div class="tab-content text-center" id="myTabContent">
        <div class="tab-pane fade show active" id="openOrder" role="tabpanel" aria-labelledby="openOrder-tab">
            <?php
            if (isset($orders)) {
                foreach ($orders as $order) {
                    if ($order["status"] == "open") {
                        $dateTime = explode(" ", $order["dateTime"]);
                        echo '<form method="post" action="' . site_url("Shop/showOrder") . '">
                                  <div class="card mx-auto mt-4" style="width: 18rem;">
                                      <div class="card-body">
                                        <h5 class="card-title">Aktivna narudžbina</h5>
                                        <p class="card-text">'
                            . 'Datum kreiranja: ' . $dateTime[0]
                            . '<br>Vreme kreiranja: ' . $dateTime[1]
                            . '<br>Ukupan iznos: ' . $order["orderPrice"]
                            . '</p>
                                        <input type="hidden" name="orderId" value="' . $order["orderId"] . '">
                                        <button type="submit" class="btn btn-primary">Detalji</button>
                                      </div>
                                    </div>
                                </form>';
                    }
                }
            }
            ?>
        </div>
        <div class="tab-pane fade" id="closedOrders" role="tabpanel" aria-labelledby="closedOrders-tab">
            <?php
            if (isset($orders)) {
                $i = 0;
                foreach ($orders as $order) {
                    if ($order["status"] != "open") {
                        if ($i % 3 == 0)
                            echo '<div class="card-group">';

                        $dateTime = explode(" ", $order["dateTime"]);
                        echo '<div class="card mx-auto mt-4" style="width: 18rem;">
                                  <form method="post" action="' . site_url("Shop/showOrder") . '">
                                      <div class="card-body">
                                        <h5 class="card-title">Obrađena narudžbina</h5>
                                        <p class="card-text">'
                            . 'Datum kreiranja: ' . $dateTime[0]
                            . '<br>Vreme kreiranja: ' . $dateTime[1]
                            . '<br>Ukupan iznos: ' . $order["orderPrice"]
                            . '</p>
                                        <input type="hidden" name="orderId" value="' . $order["orderId"] . '">
                                        <button type="submit" class="btn btn-primary">Detalji</button>
                                      </div>
                                  </form>
                              </div>';

                        $i++;
                        if ($i % 3 == 0)
                            echo '</div>';
                    }
                }
            }
            ?>
        </div>
    </div>
</div>
