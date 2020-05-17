<!--Autor: Dušan Stanivuković 2017/0605-->


<div class="container">
    <div class="row">
        <?php
        if (session()->has("orderId")) {
            $orderId = session()->get("orderId");
        }
        if (session()->getFlashdata("messages") != null) {
            echo "<div class='col-md-10 mx-auto mt-4'>";
            echo "<div class='alert alert-info alert-dismissible text-center mx-auto my-4'>";
            echo "<strong>" . session()->getFlashdata("messages") . "</strong>";
            echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
            echo "<span aria-hidden='true'>&times;</span>";
            echo "</button>";
            echo "</div>";
            echo "</div>\n";
        }
        echo "\n";
        ?>
        <div class="col-md-10 mx-auto my-4 bg-light rounded">
            <form enctype="multipart/form-data" accept-charset="UTF-8" method="post"
                  action="<?php echo site_url("Shop/finishOrder"); ?>">
                <div class="form-row mt-4">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="validationDefaultStreet">Ulica i broj:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <input type="text" class="form-control" name="street" id="validationDefaultStreet" required/>
                    </div>
                </div>
                <div class="form-row mt-4">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="validationDefaultCity">Grad:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <input type="text" class="form-control" name="city" id="validationDefaultCity" required/>
                    </div>
                </div>
                <div class="form-row mt-4">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="validationDefaultState">Država:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <select class="custom-select" name="state" id="validationDefaultState" required>
                            <option value="Srbija" selected>Srbija</option>
                            <option value="Crna Gora">Crna Gora</option>
                            <option value="Bosna i Hercegovina">Bosna i Hercegovina</option>
                        </select>
                    </div>
                </div>
                <div class="form-row mt-4">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="validationDefaultPostalCode">Poštanski broj:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <input type="number" class="form-control" name="postalCode"
                               id="validationDefaultPostalCode" required/>
                    </div>
                </div>
                <div class="form-row col-md-4 mx-auto mt-3 mb-4">
                    <input type="hidden" name="orderId" value="<?php echo(isset($orderId) ? $orderId : ''); ?>">
                    <button class="btn btn-primary" type="submit">
                        Potvrdi narudžbinu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
