<div class="container-fluid">
    
    <?php if(session()->get('uspesno')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->get('uspesno') ?>
        </div>
       <?php endif; ?>
    
    <div class="row">
        <div class="col-md-6 my-5">
            <div class="media mt-5">
                <div class="media-body text-center text-left">
                    <h5 class="mt-0 mb-1">
                        Dobrodošli na naš sajt: Hotel za kućne ljubimce!
                    </h5>
                    Možete se ulogovati na sledećoj formi.
                </div>
            </div>
        </div>       
        <div class="col-md-5 mx-auto my-5 bg-light rounded">
            <form method="post" action="<?php echo site_url('Autorizacija/logovanje'); ?>">
                <div class="form-row mt-4">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="validationDefaultUsername">Korisničko ime:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <input type="text" class="form-control" id="username" name="username" required/>
                    </div>
                </div>
                <div class="form-row">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="validationDefaultPassword">Lozinka:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <input type="password" class="form-control" id="password" name="password" required/>
                    </div>
                </div>
                <div class="form-row col-md-8 mx-auto mt-3 mb-4">
                    <button class="btn btn-primary mx-auto my-1" type="submit" onclick="">
                        Prijavi me
                    </button>
                    <button class="btn btn-primary mx-auto my-1" type="button"
                            onclick="window.location='<?php echo site_url("/forgetpassword");?>'">
                        Zaboravljena lozinka
                    </button>
                    <div class="col-md-12 col-sm-6 text-center mt-2">
                        <a href="/register">Nemate profil? Registrujte se </a>
                    </div>
                </div>
                <div class="form-row">
                    <?php
                        if (!empty($netacniPodaci))
                        echo $netacniPodaci
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>
