<?php
?>

<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto my-5 bg-light rounded">
            <form>
                <div class="form-row mt-4">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="validationDefaultName">Naziv:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <input type="text" class="form-control" id="validationDefaultName" required/>
                    </div>
                </div>
                <div class="form-row mt-4">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="validationDefaultPrice">Cena:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <input type="number" class="form-control" id="validationDefaultPrice" required/>
                    </div>
                </div>
                <div class="form-row mt-4">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="validationDefaultQuantity">Količina:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <input type="number" class="form-control" id="validationDefaultQuantity" required/>
                    </div>
                </div>
                <div class="form-row mt-4">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="imageFile">Slika:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <div class="form-group">
                            <input type="file" class="form-control-file" id="imageFile">
                        </div>
                    </div>
                </div>
                <div class="form-row col-md-4 mx-auto mt-3 mb-4">
                    <button class="btn btn-primary" type="submit"
                            onclick="itemsInput('validationDefaultName','validationDefaultPrice','validationDefaultQuantity')">
                        Unesi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
