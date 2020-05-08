<?php
//Dušan Stanivuković 2017/0605

namespace App\Controllers;

use App\Models\ShopModel;

class Shop extends BaseController
{
    private $itemsPerPage = 12;

    public function showArticles($page = 1)
    {
        session()->set("dogs", "true");
        session()->set("cats", "true");
        session()->set("birds", "true");
        session()->set("fishes", "true");
        session()->set("littleAnimals", "true");

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

    public function showCategories($page = 1)
    {
        $shopModel = new ShopModel();

        $data["title"] = "Pregled prodavnice";
        $data["name"] = "shop";

        $dogs = session()->get("dogs");
        $cats = session()->get("cats");
        $birds = session()->get("birds");
        $fishes = session()->get("fishes");
        $littleAnimals = session()->get("littleAnimals");

        if ($dogs == "true" && $cats == "true" && $birds == "true" && $fishes == "true" && $littleAnimals == "true") {
            return $this->showArticles($page);
        }

        $articles = [];

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

        $pagination["page"] = $page;
        $pagination["numOfPages"] = ceil(sizeof($articles) / $this->itemsPerPage);

        $offset = ($page - 1) * $this->itemsPerPage;
        $articles = array_slice($articles, $offset, $this->itemsPerPage);

        echo view("templates/header", ["data" => $data]);
        echo view("shop/review", ["articles" => $articles, "pagination" => $pagination, "categories" => true]);
        echo view("templates/footer");
    }

    public function searchCategories($page = 1)
    {
        $shopModel = new ShopModel();

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

        $articles = [];

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

        $baseUrl = base_url();

        $offset = ($page - 1) * $this->itemsPerPage;
        $articles = array_slice($articles, $offset, $this->itemsPerPage);

        foreach ($articles as $article) {
            $value = "                <div class='col-md-3'>\n";
            $value .= "                    <div class='card mb-4'>\n";
            $value .= "                         <img src=" . "$baseUrl/images/shop/" . $article["image"] . " class='card-img-top'>\n";
            $value .= "                         <div class='card-body'>\n";
            $value .= "                            <h5 class='card-title'>" . $article["name"] . "</h5>\n";
            $value .= "                            <p class='card-text'>\n";
            $value .= "                                Cena: <span class='font-weight-bold'>" . $article["price"] . " RSD</span><br>\n";

            $description = $article["description"];
            if ($description != null) {
                $description = explode("#", $description);
                if (sizeof($description) >= 2)
                    $value .= "                                Opis: " . $description[1] . "<br>\n";
            }

            $value .= "                                <a href='#'>Ovde</a> možete naručiti.\n";
            $value .= "                            </p>\n";
            $value .= "                         </div>\n";
            $value .= "                    </div>\n";
            $value .= "                </div>\n";
            echo $value;
        }

        echo "#delimiter#";

        echo "<input type='hidden' id='page' value='" . $page . "'>\n";
        $prevPage = $page - 1;
        $nextPage = $page + 1;
        $prevDisabled = "";
        if ($page == 1) $prevDisabled = "disabled";
        echo "<li class='page-item $prevDisabled'>"
            . "<a class='page-link' href='" . site_url('Shop/showCategories/' . $prevPage)
            . "' tabindex='-1' aria-disabled='true'>Prethodna</a>"
            . "</li>";

        $articles = [];
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

        $numOfPages = ceil(sizeof($articles) / $this->itemsPerPage);

        for ($i = $prevPage; $i < $prevPage + 3; $i++) {
            if ($i >= 1 && $i <= $numOfPages) {
                if ($i == $page) {
                    echo "<li class='page-item active'>"
                        . "<a class='page-link' href='"
                        . site_url('Shop/showCategories/' . $i)
                        . "'>$i <span class=\"sr-only\">(current)</span></a>"
                        . "</li>";
                } else {
                    echo "<li class='page-item'>"
                        . "<a class='page-link' href='"
                        . site_url('Shop/showCategories/' . $i) . "'>$i</a>"
                        . "</li>";
                }
            }
        }

        $nextDisabled = "";
        if ($page >= $numOfPages) $nextDisabled = "disabled";
        echo "<li class='page-item $nextDisabled'>"
            . "<a class='page-link' href='" . site_url('Shop/showCategories/' . $nextPage)
            . "'>Sledeća</a>"
            . "</li>";
    }
}

