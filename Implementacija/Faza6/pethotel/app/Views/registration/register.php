<!-- autor: Milica Kaitovic 2014/0584-->

<div class="container-fluid">
    <div class="row">
        <div class="col-md-7 mx-auto my-5 bg-light rounded">
            <form class="" method="post" action="/register">
                <div class="form-row mt-4">
                    <div class="col-md-4 mb-3 ml-auto">
                        <label for="firstname">Ime:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <input type="text" class="form-control" id="name" name="firstname" required value="<?= set_value('firstname')?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3 ml-auto">
                        <label for="lastname">Prezime:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <input type="text" class="form-control" id="lastname" name="lastname" value="<?= set_value('lastname')?>" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="username">Korisničko ime:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <input type="text" class="form-control" id="username" name="username" value="<?= set_value('username')?>" required/>
                    </div>
                </div>
                <div class="form-row">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="password">Lozinka:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <input type="password" class="form-control" id="password" name="password" required/>
                    </div>
                </div>
                <div class="form-row">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="passwordconfirm">Potvrda lozinke:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <input type="password" class="form-control" id="passwordconfirm" name="passwordconfirm" required/>
                    </div>
                </div>
                <div class="form-row">
                    <div class=" col-md-4 mb-3 ml-auto">
                        <label for="email">Email:</label>
                    </div>
                    <div class="col-md-4 mb-3 mr-auto">
                        <input type="text" class="form-control" id="email" name="email" value="<?= set_value('email')?>" required/>
                    </div>
                </div>
                <div class="form-row">
                        <div class=" col-md-4 mb-3 ml-auto">
                            <label for="phone">Broj telefona :</label>
                        </div>
                        <div class="col-md-4 mb-3 mr-auto">
                            <input type="text" class="form-control" placeholder="0640000000" pattern="[0-9]{9,10}" title="Neispravan format" 
                                   id="phone" name='phone' value="<?= set_value('phone')?>" required />
                        </div>
                </div>
                <?php if(isset($validation)): ?>
                <div class='row'>
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <?= $validation->listErrors() ?>
                    </div>
                </div>
                </div>
                <?php endif; ?>
                
                <div class="form-row col-md-8 mx-auto mt-3 mb-4">
                    <button class="btn btn-primary mx-auto my-1" type="submit" onclick="">
                        Registruj me
                    </button>
                    <div class="col-md-12 col-sm-6 text-center mt-2">
                        <a href="/">Već imate profil?</a>
                    </div>
                </div>
                <div class="form-row">
                
                </div>
            </form>
        </div>
    </div>
</div>