<?php
//Milica Janković 2013/0668

namespace App\Controllers;


use App\Models\UserModel;

class Autorizacija extends BaseController
{
    public function logovanje()
    {
        $usern = $this->request->getVar("username");
        $pass = $this->request->getVar("password");

        $userModel = new UserModel();
        $user = $userModel->find($usern);

        if (empty($user) || (!empty($user) && strcmp($user["password"], $pass) != 0)) {
            $data["title"] = "Početna stranica";
            $data["name"] = "index";
            echo view("templates/header", ["data" => $data]);
            echo view('index', ["netacniPodaci" => "Korisnicko ime i/ili lozinka nisu ispravni!"]);
            echo view("templates/footer");
        } else {
            session()->set("username", $user["username"]);
            session()->set("userType", $user["type"]);
            if ($user["type"] == "admin") {
                return redirect()->to(site_url("Admin/index"));
            } else if ($user["type"] == "moderator") {
                echo view("autorizacija/moderator");
            } else {
                return redirect()->to(site_url("User/index"));
            }
        }

        //echo view("shop/test", ["usern" => $tst, "pass" => $pass]);
    }

}

















