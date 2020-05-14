

<!--Milica Janković 2013/0668-->

<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto my-5 bg-light rounded">
            <form method='post' action="<?php echo site_url('Pet/sacuvajLjubimca'); ?>">
                <div class="form-row mt-4">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="petName">Ime:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <input type="text" class="form-control" id="petName" name="petName" required />
                    </div>
                </div>
                <div class="form-row mt-4">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="petBreed">Rasa:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <input type="text" class="form-control" id="petBreed" name="petBreed" required />
                    </div>
                </div>
                <div class="form-row mt-4">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="birthDate">Datum rođenja:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <input type="date" class="form-control" id="birthDate" name="birthDate" required />
                    </div>
                </div>
                <div class="form-row mt-4">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="imageFile">Slika:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <div class="form-group">
                            <input type="file" class="form-control-file" id="imageFile" name="imageFile">
                        </div>
                    </div>
                </div>
                <div class="form-row mt-4">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="petName">Opis:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <input type="text" class="form-control" id="petDescr" name="petDescr" />
                    </div>
                </div>
                <div class="form-row col-md-4 mx-auto mt-3 mb-4">
                    <button class="btn btn-primary" type="submit"
                            onclick="input('petName','petBreed','birthDate')">
                        Sacuvaj
                    </button>&nbsp;
                    <?php echo $data["poruka"]; ?>
                </div>
            </form>
        </div>
    </div>
</div>