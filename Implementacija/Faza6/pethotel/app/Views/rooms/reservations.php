<!--Autor: Dušan Stanivuković 2017/0605-->


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($reservations)) {
                $i = 0;
                foreach ($reservations as $reservation) {
                    if ($i % 3 == 0)
                        echo '<div class="card-group">';

                    echo '<div class="card mx-auto my-3" style="width: 18rem;">
                                  <form method="post" action="' . site_url("Room/room") . '">
                                      <div class="card-body">
                                        <h5 class="card-title">Rezervacija</h5>
                                        <p class="card-text">'
                        . 'Datum od: ' . $reservation["dateFrom"]
                        . '<br>Datum do: ' . $reservation["dateTo"]
                        . '</p>
                                        <input type="hidden" name="room" value="' . $reservation["roomId"] . '">
                                        <button type="submit" class="btn btn-primary">Detalji o smeštaju</button>
                                      </div>
                                  </form>
                              </div>';

                    $i++;
                    if ($i % 3 == 0)
                        echo '</div>';

                }
                if ($i % 3 != 0) echo "</div>";
            }
            ?>
        </div>
    </div>
</div>
