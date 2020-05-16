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
    } else if ($data["name"] == "cart") {
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js"
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
        echo '<li class="nav-item' . ($data["name"] == "cart" ? " active" : "") . '">
                <a class="nav-link" href="' . site_url('Shop/cart') . '">Korpa</a>
            </li>';
    echo '</ul>';
    if (session()->has("username")) {
        echo '<ul class="navbar-nav ml-auto mt-2 mt-lg-0"><li class="nav-item">
                <a class="nav-link" href="' . site_url('Logout/logout') . '">Izloguj se</a>
            </li></ul>';
    }
    echo '</div>
</nav>';

} else {
    echo '<nav class="sb-topnav navbar navbar-expand navbar-light bg-light">
    <a class="navbar-brand" href="' . site_url("Home/index") . '">
        <img src="' . base_url() . "/images/logo.jfif" . '" class="logo-img img-fluid rounded" alt="Logo"/>
    </a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i>
    </button>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="' . site_url("Logout/logout") . '">Izloguj se</a>
            </div>
        </li>
    </ul>
</nav>';

    echo '<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Administracija</div>
                    <a class="nav-link' . ($data["active"] == "index" ? " active" : "") . '" href="' . site_url("Admin/index") . '">
                        Upravljanje korisnicima
                    </a>
                    <div class="sb-sidenav-menu-heading">Moredacija</div>
                </div>
                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                    <a class="nav-link collapsed' . ($data["active"] == "input" ? " active" : "") . '" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth"
                       aria-expanded="false" aria-controls="pagesCollapseAuth">
                        Unos sadržaja
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </a>
                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                         data-parent="#sidenavAccordionPages">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link' . (($data["active"] == "input" && $data["type"] == "articles") ? " active" : "")
        . '" href="' . site_url("Admin/insertArticle") . '">Unos proizvoda</a>
                            <a class="nav-link' . (($data["active"] == "input" && $data["type"] == "pets") ? " active" : "")
        . '" href="' . site_url("Pet/unosLjubimca") . '">Unos ljubimaca</a>
                            <a class="nav-link' . (($data["active"] == "input" && $data["type"] == "rooms") ? " active" : "")
        . '" href="#">Unos smeštaja</a>
                        </nav>
                    </div>
                </nav>
                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages2">
                    <a class="nav-link collapsed' . ($data["active"] == "modifications" ? " active" : "") . '" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth2"
                       aria-expanded="false" aria-controls="pagesCollapseAuth">
                        Brisanje i izmena sadržaja
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </a>
                    <div class="collapse" id="pagesCollapseAuth2" aria-labelledby="headingOne"
                         data-parent="#sidenavAccordionPages2">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link' . (($data["active"] == "modifications" && $data["type"] == "articles") ? " active" : "")
        . '" href="' . site_url("Admin/manageArticles") . '">Proizvodi</a>
                            <a class="nav-link' . (($data["active"] == "modifications" && $data["type"] == "pets") ? " active" : "")
        . '" href="#">Ljubimci</a>
                            <a class="nav-link' . (($data["active"] == "modifications" && $data["type"] == "rooms") ? " active" : "")
        . '" href="#">Smeštaj</a>
                        </nav>
                    </div>
                </nav>
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Standardne funkcije</div>
                    <a class="nav-link" href="' . site_url("Shop/showArticles") . '">
                        Pregled prodavnice
                    </a>
                    <a class="nav-link" href="' . site_url("Pet/showPets") . '">
                        Pregled ljubimaca
                    </a>
                    <a class="nav-link" href="' . site_url("") . '">
                        Pregled smeštaja
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Ulogovani ste kao:</div>'
        . session()->get("username") .
        '</div>
        </nav>
    </div>';
}
?>
