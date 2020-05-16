<?php
//Autor: Dušan Stanivuković 2017/0605


namespace App\Controllers;

/**
 * User - Klasa za prikaz sadržaja za registrovane korisnike
 *
 * @package App\Controllers
 *
 * @version 1.0
 */
class User extends BaseController
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
        echo view("user/index");
        echo view("templates/footer");
    }

}
