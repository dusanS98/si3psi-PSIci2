<!--Autor: Milica Kaitović 2014/0584-->

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($petres)) {
                if (empty($petres)) {
                    echo "<div class='col-md-10 mx-auto mt-4'>";
                    echo "<div class='alert alert-info alert-dismissible text-center mx-auto my-4'>";
                    echo "<strong>Nemate rezervacija</strong>";
                    echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
                    echo "<span aria-hidden='true'>&times;</span>";
                    echo "</button>";
                    echo "</div>";
                    echo "</div>\n";
                    echo "\n";
                }

                $i = 0;
                foreach ($petres as $res) {
                    if ($i % 3 == 0)
                        echo '<div class="card-group">';

                    echo '<div class="card mx-auto my-3" style="width: 18rem;">
                                  <form method="post" action="' . site_url("Reservation/res") . '">
                                      <div class="card-body text-center">
                                        <h5 class="card-title">Rezervacija</h5>
                                        <p class="card-text">'
                        . 'Datum: ' . $res["dateTime"].'<br/>'
                        . '</p>
                                        <input type="hidden" name="pet" value="' . $res["petId"] . '">
                                        <button type="submit" class="btn btn-primary">Detalji o rezervaciji</button>
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
