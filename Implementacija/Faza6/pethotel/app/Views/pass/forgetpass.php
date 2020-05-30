<!-- autor: Milica Kaitovic 2014/0584-->

        <?php if(isset($data['poruka'])): ?>
            <div class='row'>
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <?= $poruka ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

<div class='container'>
    <div class='row'>
        <div class='col-md-8 mx-auto my-5 bg-light rounded'>
            <form method="post" action="<?php echo site_url('Forgetpassword/forget'); ?>">
                <div class="form-row mt-5">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="validationDefaultUsername">Korisničko ime:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <input type="text" class="form-control" value="<?= set_value('username')?>" id="validationDefaultUsername" name="username" required />
                    </div>
                </div>
                <div class="form-row col-md-4 mx-auto mt-3 mb-4">
                    <button class="btn btn-primary" type="submit" onclick="">
                        Pošalji lozinku
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

