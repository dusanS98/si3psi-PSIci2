<!--Autor: Dušan Stanivuković 2017/0605-->

<!doctype html>
<html lang="en">
<head>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <title><?php echo "Hotel za kućne ljubimce - " . $data["title"]; ?></title>
    <?php $baseUrl = base_url();
    echo "\n"; ?>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $baseUrl; ?>/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/site.css">
    <?php
    if ($data["name"] == "admin") {
        echo '<link href="' . $baseUrl . '/css/styles.css" rel="stylesheet"/>
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
                        crossorigin="anonymous"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js"
                        crossorigin="anonymous"></script>';
    }
    ?>
</head>
<body<?php if ($data["name"] == "admin") echo " class='sb-nav-fixed'"; ?>>

<?php
if ($data["name"] != "admin") {
    echo '<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand logo mb-2" href="' . site_url('Home/index') . '">
        <img src="' . $baseUrl . '/images/logo.jfif" class="logo-img img-fluid rounded" alt="Logo"/>
    </a>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item' . ($data["name"] == "index" ? " active" : "") . '">
                <a class="nav-link" href="' . site_url('Home/index') . '">Početna</a>
            </li>
            <li class="nav-item' . ($data["name"] == "shop" ? " active" : "") . '">
                <a class="nav-link" href="' . site_url('Shop/showArticles') . '">Prodavnica</a>
            </li>
            <li class="nav-item' . ($data["name"] == "pets" ? " active" : "") . '">
                <a class="nav-link" href="' . site_url('Pet/showPets') . '">Ljubimci</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="' . site_url('Home/index') . '">Smeštaj</a>
            </li>';
    if (session()->has("username"))
        echo '<li class="nav-item">
                <a class="nav-link" href="' . site_url('Home/index') . '">Korpa</a>
            </li>';
    echo '</ul>';
    if (session()->has("username")) {
        echo '<ul class="navbar-nav ml-auto mt-2 mt-lg-0"><li class="nav-item">
                <a class="nav-link" href="' . site_url('Admin/logout') . '">Izloguj se</a>
            </li></ul>';
    }
    echo '</div>
</nav>';

}
?>
