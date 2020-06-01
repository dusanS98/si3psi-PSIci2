<!-- autor: Milica Kaitovic 2014/0584-->
<?php
    date_default_timezone_set('Europe/Belgrade');
    use CodeIgniter\I18n\Time;
?>
<div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto my-5 bg-light rounded">
                <form class="" method="post">
                    <div class="form-row mt-4">
                        <div class=" col-md-4 mb-3 ml-auto">
                            <label for="date">Datum:</label>
                        </div>
                        <div class="col-md-4 mb-3 mr-auto">
                            <input type="date" name='date' value="<?php echo date("Y-m-d"); ?>" min="<?php echo date("Y-m-d"); ?>" class="form-control" id="date" required />
                        </div>
                    </div>
                    <div class="form-row mt-4">
                        <div class=" col-md-4 mb-3 ml-auto">
                            <label for="time">Vreme:</label>
                        </div>
                        <div class="col-md-4 mb-3 mr-auto">
                            <select name='time' class="form-control" id="time" required />
                                <option value="10:11">10:00-11:00</option>
                                <option value="11:12">11:00-12:00</option>
                                <option value="12:13">12:00-13:00</option>
                                <option value="13:14">13:00-14:00</option>
                                <option value="14:15">14:00-15:00</option>
                                <option value="15:16">15:00-16:00</option>
                                <option value="16:17">16:00-17:00</option>
                                <option value="17:18">17:00-18:00</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row col-md-4 mx-auto mt-3 mb-4">
                        <button class="btn btn-primary" type="submit" onclick="reserve()">
                            Rezerviši
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

