<?php
//Autor: Dušan Stanivuković 2017/0605

namespace App\Controllers;

use App\Models\ShopModel;
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
        $data["title"] = "Administracija sistema";
        $data["name"] = "admin";

        $userModel = new UserModel();
        $users = $userModel->findAll();

        echo view("templates/header", ["data" => $data]);
        echo view("admin/administration", ["users" => $users]);
        echo view("templates/footer", ["data" => $data]);
    }

    /**
     * Funkcija za brisanje korisnika iz baze podataka
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function deleteUser()
    {
        $userModel = new UserModel();

        $username = $this->request->getVar("delete");
        if (isset($username)) {
            $userModel->delete($username);
        }

        return redirect()->to(site_url("Admin/index"));
    }

    /**
     * Funkcija za upravljanje privilegijama
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     * @throws \ReflectionException
     */
    public function menagePrivileges()
    {
        $userModel = new UserModel();

        $username = $this->request->getVar("privileges");
        if (isset($username)) {
            $user = $userModel->find($username);
            if ($user["type"] == "standard") {
                $user["type"] = "moderator";
                $userModel->update($username, $user);
            } else if ($user["type"] == "moderator") {
                $user["type"] = "standard";
                $userModel->update($username, $user);
            }
        }

        return redirect()->to(site_url("Admin/index"));
    }

    /**
     * Funkcija za prikaz forme za unos proizvoda
     *
     * @return string
     */
    public function insertArticle()
    {
        $data["title"] = "Administracija sistema";
        $data["name"] = "admin";

        echo view("templates/header", ["data" => $data]);
        echo view("admin/articleInput");
        echo view("templates/footer", ["data" => $data]);
    }

    /**
     * Funkcija za prikaz forme za izmenu informacija o proizvodima
     *
     * @return string
     */
    public function manageArticles()
    {
        $data["title"] = "Administracija sistema";
        $data["name"] = "admin";

        $shopModel = new ShopModel();
        $articles = $shopModel->findAll();

        echo view("templates/header", ["data" => $data]);
        echo view("admin/articleManaging", ["articles" => $articles]);
        echo view("templates/footer", ["data" => $data]);
    }

}


















