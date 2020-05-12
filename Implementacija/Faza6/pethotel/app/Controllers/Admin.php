<?php
//Autor: Dušan Stanivuković 2017/0605

namespace App\Controllers;

use App\Models\UserModel;

/**
 * Admin - klasa koja obezbeđuje administratorske funkcije
 *
 * @package App\Controllers
 *
 * @version 1.0
 */
class Admin extends BaseController
{
    /**
     * Funkcija za prikaz početne stranice za administratore
     *
     * @return string
     */
    public function index()
    {
        $data["title"] = "Administrator";
        $data["name"] = "admin";

        $userModel = new UserModel();
        $users = $userModel->findAll();

        echo view("templates/header", ["data" => $data]);
        echo view("administration", ["users" => $users]);
        echo view("templates/footer", ["data" => $data]);
    }
}
