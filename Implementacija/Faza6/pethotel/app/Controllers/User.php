<?php


namespace App\Controllers;


class User extends BaseController
{
    public function index()
    {
        $data["title"] = "Početna stranica";
        $data["name"] = "index";

        echo view("templates/header", ["data" => $data]);
        echo view("user/index");
        echo view("templates/footer");
    }
}
