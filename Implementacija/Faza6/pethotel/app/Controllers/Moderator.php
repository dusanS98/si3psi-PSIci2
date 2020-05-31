<?php
//Autor: Dušan Stanivuković 2017/0605

namespace App\Controllers;

use App\Models\PetModel;
use App\Models\RoomModel;
use App\Models\ShopModel;

/**
 * Moderator - Klasa koja obezbeđuje moderatorske funkcije
 *
 * @package App\Controllers
 *
 * @version 1.0
 */
class Moderator extends BaseController
{
    /**
     * Funkcija za prikaz početne stranice za moderatore
     *
     * @return string
     */
    public function index()
    {
        $data["title"] = "Moderacija sistema";
        $data["name"] = "moderator";
        $data["active"] = "index";

        echo view("templates/header", ["data" => $data]);
        echo view("moderator/index");
        echo view("templates/footer", ["data" => $data]);
    }

    /**
     * Funkcija za prikaz forme za unos proizvoda
     *
     * @return string
     */
    public function insertArticle()
    {
        $data["title"] = "Unos proizvoda";
        $data["name"] = "moderator";
        $data["active"] = "input";
        $data["type"] = "articles";

        echo view("templates/header", ["data" => $data]);
        echo view("moderator/articleInput");
        echo view("templates/footer", ["data" => $data]);
    }

    /**
     * Funkcija za prikaz forme za izmenu informacija o proizvodima
     *
     * @return string
     */
    public function manageArticles()
    {
        $data["title"] = "Upravljanje proizvodima";
        $data["name"] = "moderator";
        $data["active"] = "modifications";
        $data["type"] = "articles";

        $shopModel = new ShopModel();
        $articles = $shopModel->findAll();

        echo view("templates/header", ["data" => $data]);
        echo view("moderator/articleManaging", ["articles" => $articles]);
        echo view("templates/footer", ["data" => $data]);
    }

    /**
     * Funkcija za prikaz forme za izmenu informacija o ljubimcima
     *
     * @return string
     */
    public function managePets()
    {
        $data["title"] = "Upravljanje ljubimcima";
        $data["name"] = "moderator";
        $data["active"] = "modifications";
        $data["type"] = "pets";

        $petModel = new PetModel();
        $pets = $petModel->findAll();

        echo view("templates/header", ["data" => $data]);
        echo view("moderator/petManaging", ["pets" => $pets]);
        echo view("templates/footer", ["data" => $data]);
    }

    /**
     * Funkcija za prikaz forme za izmenu informacija o smeštaju
     *
     * @return string
     */
    public function manageRooms()
    {
        $data["title"] = "Upravljanje smeštajem";
        $data["name"] = "moderator";
        $data["active"] = "modifications";
        $data["type"] = "rooms";

        $roomModel = new RoomModel();
        $rooms = $roomModel->findAll();

        echo view("templates/header", ["data" => $data]);
        echo view("moderator/roomManaging", ["rooms" => $rooms]);
        echo view("templates/footer", ["data" => $data]);
    }
}
