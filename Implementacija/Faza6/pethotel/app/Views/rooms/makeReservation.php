<!--Autor: Dušan Stanivuković 2017/0605-->


<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto my-5 bg-light rounded">
            <form method="post" action="<?php echo site_url('Room/createReservation'); ?>">
                <div class="form-row mt-4">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="validationDefaultDateFrom">Datum od:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <input type="date" name="dateFrom" class="form-control" id="validationDefaultDateFrom"
                               required/>
                    </div>
                </div>
                <div class="form-row mt-4">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="validationDefaultDateTo">Datum do:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <input type="date" name="dateTo" class="form-control" id="validationDefaultDateTo" required/>
                    </div>
                </div>
                <div class="form-row col-md-4 mx-auto mt-3 mb-4">
                    <input type="hidden" name="roomId" value="<?php if (isset($room)) echo $room['roomId']; ?>">
                    <button class="btn btn-primary" type="submit">
                        Rezerviši
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
