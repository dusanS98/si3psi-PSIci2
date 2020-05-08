<?php namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data["title"] = "Početna stranica";
        $data["name"] = "index";
        echo view("templates/header", ["data" => $data]);
        echo view('index');
        echo view("templates/footer");
    }

    //--------------------------------------------------------------------

}
