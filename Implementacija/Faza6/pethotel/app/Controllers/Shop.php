<?php
//Autor: Dušan Stanivuković 2017/0605

namespace App\Controllers;

use App\Models\ShopModel;
use CodeIgniter\HTTP\Response;

/**
 * Shop - klasa za prikaz, unos i naručivanje proizvoda iz prodavnice
 *
 * @version 1.0
 */
class Shop extends BaseController
{
    /**
     * @var int $itemsPerPage Maksimalan broj proizvoda koji se prikazuju na jednoj stranici
     */
    private $itemsPerPage = 12;

    /**
     * Funkcija za prikaz proizvoda
     *
     * @param int $page Redni broj stranice sa proizvodima
     *
     * @return string
     */
    public function showArticles($page = 1)
    {
        session()->set("dogs", "true");
        session()->set("cats", "true");
        session()->set("birds", "true");
        session()->set("fishes", "true");
        session()->set("littleAnimals", "true");
        session()->remove("searchName");

        $shopModel = new ShopModel();
        $articles = $shopModel->findAll($this->itemsPerPage, ($page - 1) * $this->itemsPerPage);
        $data["title"] = "Pregled prodavnice";
        $data["name"] = "shop";
        $pagination["page"] = $page;
        $pagination["numOfPages"] = ceil($shopModel->countAll() / $this->itemsPerPage);
        echo view("templates/header", ["data" => $data]);
        echo view("shop/review", ["articles" => $articles, "pagination" => $pagination]);
        echo view("templates/footer");
    }

    /**
     * Funkcija za prikaz odabranih kategorija proizvoda
     *
     * @param int $page Redni broj stranice sa proizvodima
     *
     * @return string
     */
    public function showArticlesByCategory($page = 1)
    {
        $data["title"] = "Pregled prodavnice";
        $data["name"] = "shop";

        $dogs = session()->get("dogs");
        $cats = session()->get("cats");
        $birds = session()->get("birds");
        $fishes = session()->get("fishes");
        $littleAnimals = session()->get("littleAnimals");

        if ($dogs == "true" && $cats == "true" && $birds == "true" && $fishes == "true" && $littleAnimals == "true"
            && !session()->has("articleName")) {
            return $this->showArticles($page);
        }

        $articles = $this->findArticles();

        $pagination["page"] = $page;
        $pagination["numOfPages"] = ceil(sizeof($articles) / $this->itemsPerPage);

        $offset = ($page - 1) * $this->itemsPerPage;
        $articles = array_slice($articles, $offset, $this->itemsPerPage);

        echo view("templates/header", ["data" => $data]);
        echo view("shop/review", ["articles" => $articles, "pagination" => $pagination, "categories" => true]);
        echo view("templates/footer");
    }

    /**
     * Pomoćna funkcija za dohvatanje proizvoda iz baze
     *
     * @return array
     */
    private function findArticles()
    {
        $shopModel = new ShopModel();

        $dogs = session()->get("dogs");
        $cats = session()->get("cats");
        $birds = session()->get("birds");
        $fishes = session()->get("fishes");
        $littleAnimals = session()->get("littleAnimals");

        $articles = [];

        if (session()->has("searchName")) {
            $articleName = session()->get("searchName");
            if ($dogs == "true")
                $articles = array_merge($articles, $shopModel->like("description", "psi#")
                    ->like("name", $articleName)
                    ->findAll());
            if ($cats == "true")
                $articles = array_merge($articles, $shopModel->like("description", "macke#")
                    ->like("name", $articleName)
                    ->findAll());
            if ($birds == "true")
                $articles = array_merge($articles, $shopModel->like("description", "birds#")
                    ->like("name", $articleName)
                    ->findAll());
            if ($fishes == "true")
                $articles = array_merge($articles, $shopModel->like("description", "fishes#")
                    ->like("name", $articleName)
                    ->findAll());
            if ($littleAnimals == "true")
                $articles = array_merge($articles, $shopModel->like("description", "littleAnimals#")
                    ->like("name", $articleName)
                    ->findAll());
        } else {
            if ($dogs == "true")
                $articles = array_merge($articles, $shopModel->like("description", "psi#")->findAll());
            if ($cats == "true")
                $articles = array_merge($articles, $shopModel->like("description", "macke#")->findAll());
            if ($birds == "true")
                $articles = array_merge($articles, $shopModel->like("description", "birds#")->findAll());
            if ($fishes == "true")
                $articles = array_merge($articles, $shopModel->like("description", "fishes#")->findAll());
            if ($littleAnimals == "true")
                $articles = array_merge($articles, $shopModel->like("description", "littleAnimals#")->findAll());
        }

        for ($i = 0; $i < sizeof($articles); $i++) {
            $pos = strpos($articles[$i]["description"], "#");
            $category = substr($articles[$i]["description"], 0, $pos);

            if (($dogs != "true" && $category == "psi")
                || ($cats != "true" && $category == "macke")
                || ($birds != "true" && $category == "ptice")
                || ($fishes != "true" && $category == "ribe")
                || ($littleAnimals != "true" && $category == "maleZivotinje")) {
                unset($articles[$i]);
                $articles = array_values($articles);
            }
        }

        return $articles;
    }

    /**
     * Funkcija koja vraća određene kategorije proizvoda kao odgovor na ajax zahtev
     *
     * @param int $page Redni broj stanice sa prozvodima
     *
     * @return string
     */
    public function searchCategories($page = 1)
    {
        $dogs = $this->request->getVar("dogs");
        $cats = $this->request->getVar("cats");
        $birds = $this->request->getVar("birds");
        $fishes = $this->request->getVar("fishes");
        $littleAnimals = $this->request->getVar("littleAnimals");

        session()->set("dogs", $dogs);
        session()->set("cats", $cats);
        session()->set("birds", $birds);
        session()->set("fishes", $fishes);
        session()->set("littleAnimals", $littleAnimals);

        $articles = $this->findArticles();
        $baseUrl = base_url();

        $offset = ($page - 1) * $this->itemsPerPage;
        $articles = array_slice($articles, $offset, $this->itemsPerPage);

        if (empty($articles)) {
            echo "<div class='alert alert-info text-center mx-auto my-4'>Nema proizvoda</div>";
        }

        foreach ($articles as $article) {
            $value = "                <div class='col-md-3'>\n";
            $value .= "                    <form method='post' action='$baseUrl/Shop/article'>\n";
            $value .= "                        <div class='card text-center mb-4'>\n";
            $value .= "                            <img src=" . "$baseUrl/images/shop/" . $article["image"] . " class='card-img-top'>\n";
            $value .= "                            <div class='card-body'>\n";
            $value .= "                                 <input name='article' type='hidden' value='" . $article["articleId"] . "'>\n";
            $value .= "                                 <input class='card-title btn btn-link button-link' type='submit' value='" . $article["name"] . "'>\n";
            $value .= "                                 <p class='card-text'>\n";
            $value .= "                                    Cena: <span class='font-weight-bold'>" . $article["price"] . " RSD</span><br>\n";

            $value .= "                                    <input name='order-btn' type='submit' class='btn btn-primary mt-2' value='Naruči'>\n";
            $value .= "                                </p>\n";
            $value .= "                            </div>\n";
            $value .= "                        </div>\n";
            $value .= "                    </form>\n";
            $value .= "               </div>\n";
            echo $value;
        }

        echo "#delimiter#";

        echo "<input type='hidden' id='page' value='" . $page . "'>\n";
        $prevPage = $page - 1;
        $nextPage = $page + 1;
        $prevDisabled = "";
        if ($page == 1) $prevDisabled = "disabled";
        echo "<li class='page-item $prevDisabled'>"
            . "<a id='prev-page' class='page-link' href='" . site_url('Shop/showArticlesByCategory/' . $prevPage)
            . "' tabindex='-1' aria-disabled='true'>Prethodna</a>"
            . "</li>";

        $articles = $this->findArticles();
        $numOfPages = ceil(sizeof($articles) / $this->itemsPerPage);

        for ($i = $prevPage; $i < $prevPage + 3; $i++) {
            if ($i >= 1 && $i <= $numOfPages) {
                if ($i == $page) {
                    echo "<li class='page-item active'>"
                        . "<a class='page-link' href='"
                        . site_url('Shop/showArticlesByCategory/' . $i)
                        . "'>$i <span class=\"sr-only\">(current)</span></a>"
                        . "</li>";
                } else {
                    echo "<li class='page-item'>"
                        . "<a class='page-link' href='"
                        . site_url('Shop/showArticlesByCategory/' . $i) . "'>$i</a>"
                        . "</li>";
                }
            }
        }

        $nextDisabled = "";
        if ($page >= $numOfPages) $nextDisabled = "disabled";
        echo "<li class='page-item $nextDisabled'>"
            . "<a class='page-link' href='" . site_url('Shop/showArticlesByCategory/' . $nextPage)
            . "'>Sledeća</a>"
            . "</li>";
    }

    /**
     * Funkcija za prikaz odabranih proizvoda na osnovu imena
     *
     * @param int $page Redni broj stranice sa proizvodima
     *
     * @return string
     */
    public function showArticlesByName($page = 1)
    {
        $shopModel = new ShopModel();

        $data["title"] = "Pregled prodavnice";
        $data["name"] = "shop";

        $name = session()->get("searchName");

        $articles = $shopModel->like("name", $name)->findAll();

        $pagination["page"] = $page;
        $pagination["numOfPages"] = ceil(sizeof($articles) / $this->itemsPerPage);

        $offset = ($page - 1) * $this->itemsPerPage;
        $articles = array_slice($articles, $offset, $this->itemsPerPage);

        echo view("templates/header", ["data" => $data]);
        echo view("shop/review", ["articles" => $articles, "pagination" => $pagination, "names" => true]);
        echo view("templates/footer");
    }

    /**
     * Funkcija za pretragu proizvoda po imenima koja vraća određene proizvode kao odgovor na ajax zahtev
     *
     * @return string
     */
    public function searchNames($page = 1)
    {
        $shopModel = new ShopModel();

        $name = $this->request->getVar("name");

        session()->set("searchName", $name);

        $offset = ($page - 1) * $this->itemsPerPage;
        $articles = $shopModel->like("name", $name)->findAll($this->itemsPerPage, $offset);

        $baseUrl = base_url();

        if (empty($articles)) {
            echo "<div class='alert alert-info text-center mx-auto my-4'>Nema proizvoda</div>";
        }

        foreach ($articles as $article) {
            $value = "                <div class='col-md-3'>\n";
            $value .= "                    <form method='post' action='$baseUrl/Shop/article'>\n";
            $value .= "                        <div class='card text-center mb-4'>\n";
            $value .= "                            <img src=" . "$baseUrl/images/shop/" . $article["image"] . " class='card-img-top'>\n";
            $value .= "                            <div class='card-body'>\n";
            $value .= "                                 <input name='article' type='hidden' value='" . $article["articleId"] . "'>\n";
            $value .= "                                 <input class='card-title btn btn-link button-link' type='submit' value='" . $article["name"] . "'>\n";
            $value .= "                                 <p class='card-text'>\n";
            $value .= "                                    Cena: <span class='font-weight-bold'>" . $article["price"] . " RSD</span><br>\n";

            $value .= "                                    <input name='order-btn' type='submit' class='btn btn-primary mt-2' value='Naruči'>\n";
            $value .= "                                </p>\n";
            $value .= "                            </div>\n";
            $value .= "                        </div>\n";
            $value .= "                    </form>\n";
            $value .= "               </div>\n";
            echo $value;
        }

        echo "#delimiter#";

        echo "<input type='hidden' id='page' value='" . $page . "'>\n";
        $prevPage = $page - 1;
        $nextPage = $page + 1;
        $prevDisabled = "";
        if ($page == 1 || sizeof($articles) == 0) $prevDisabled = "disabled";
        echo "<li class='page-item $prevDisabled'>"
            . "<a id='prev-page' class='page-link' href='" . site_url('Shop/showArticlesByName/' . $prevPage)
            . "' tabindex='-1' aria-disabled='true'>Prethodna</a>"
            . "</li>";

        $numOfPages = ceil(sizeof($shopModel->like("name", $name)->findAll()) / $this->itemsPerPage);

        if (sizeof($articles) > 0) {
            for ($i = $prevPage; $i < $prevPage + 3; $i++) {
                if ($i >= 1 && $i <= $numOfPages) {
                    if ($i == $page) {
                        echo "<li class='page-item active'>"
                            . "<a class='page-link' href='"
                            . site_url('Shop/showArticlesByName/' . $i)
                            . "'>$i <span class=\"sr-only\">(current)</span></a>"
                            . "</li>";
                    } else {
                        echo "<li class='page-item'>"
                            . "<a class='page-link' href='"
                            . site_url('Shop/showArticlesByName/' . $i) . "'>$i</a>"
                            . "</li>";
                    }
                }
            }
        }

        $nextDisabled = "";
        if ($page >= $numOfPages || sizeof($articles) == 0) $nextDisabled = "disabled";
        echo "<li class='page-item $nextDisabled'>"
            . "<a class='page-link' href='" . site_url('Shop/showArticlesByName/' . $nextPage)
            . "'>Sledeća</a>"
            . "</li>";
    }

    /**
     * Funkcija za prikaz detalja o pojedinačnim proizvodima
     *
     * @return string
     */
    public function article()
    {
        $articleId = $this->request->getVar("article");
        $shopModel = new ShopModel();
        $article = $shopModel->find($articleId);
        $data["title"] = "Proizvod " . $article["name"];
        $data["name"] = "shop";
        echo view("templates/header", ["data" => $data]);
        echo view("shop/article", ["article" => $article]);
        echo view("templates/footer");
    }

    /**
     * Funkcija za naručivanje proizvoda
     *
     * @return string
     */
    public function order()
    {
        $amount = $this->request->getVar("amount") . "<br>";
        $articleId = $this->request->getVar("articleId") . "<br>";
        $shopModel = new ShopModel();
        $article = $shopModel->find($articleId);
        $data["title"] = "Proizvod " . $article["name"];
        $data["name"] = "shop";
        $errors = "Proizvod nije na stanju";
        echo view("templates/header", ["data" => $data]);
        echo view("shop/article", ["article" => $article, "errors" => $errors]);
        echo view("templates/footer");
    }

}

















