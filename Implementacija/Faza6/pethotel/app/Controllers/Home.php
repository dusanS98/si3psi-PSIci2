<?php
//Autor: Dušan Stanivuković 2017/0605

namespace App\Controllers;

/**
 * Klasa za prikaz sadržaja sa goste sajta
 *
 * @package App\Controllers
 *
 * @version 1.0
 */
class Home extends BaseController
{
    /**
     * Funkcija za prikaz početne stranice
     *
     * @return string
     */
    public function index()
    {
        $data["title"] = "Početna stranica";
        $data["name"] = "index";
        echo view("templates/header", ["data" => $data]);
        echo view('index');
        echo view("templates/footer");
    }

}
