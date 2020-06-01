<!--Autor: Dušan Stanivuković 2017/0605-->


<div class="container-fluid">
	 <?php if(session()->get('uspesno')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->get('uspesno') ?>
        </div>
     <?php endif; ?>
	   
    <div class="row">
        <div class="col-md-6 mx-auto my-5">
            <div class="media mt-5">
                <div class="media-body text-center text-left">
                    <h5 class="mt-0 mb-1">
                        Dobrodošli na naš sajt: Hotel za kućne ljubimce!
                    </h5>
                </div>
            </div>
        </div>
    </div>
</div>
