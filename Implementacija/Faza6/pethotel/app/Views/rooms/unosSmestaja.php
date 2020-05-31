<!--
Autori:
Jovan Penezic 0560/2016
Dušan Stanivuković 2017/0605
-->

<div class="container">
    <div class="row">
        <?php
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
        ?>
        <div class="col-md-10 mx-auto my-5 bg-light rounded">
            <form enctype="multipart/form-data" accept-charset="UTF-8" method='post'
                  action="<?php echo site_url('Room/sacuvajSmestaj'); ?>">
                <div class="form-row mt-4">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="roomType">Tip:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <select class="custom-select" name="type" required>
                            <option value="psi" selected>Psi</option>
                            <option value="macke">Macke</option>
                            <option value="ptice">Ptice</option>
                            <option value="ribe">Ribe</option>
                            <option value="maleZivotinje">Male životinje</option>
                        </select>
                    </div>
                </div>
                <div class="form-row mt-4">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="imageFile">Slika (do 5MB):</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <div class="form-group">
                            <input type="file" class="form-control-file" name="image" id="imageFile">
                        </div>
                    </div>
                </div>
                <div class="form-row mt-4">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="roomDescr">Opis:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <textarea class="form-control" name="description" required>
                        </textarea>
                    </div>
                </div>
                <div class="form-row col-md-4 mx-auto mt-3 mb-4">
                    <button class="btn btn-primary" type="submit">
                        Sacuvaj
                    </button>&nbsp;
                </div>
            </form>
        </div>
    </div>
</div>
