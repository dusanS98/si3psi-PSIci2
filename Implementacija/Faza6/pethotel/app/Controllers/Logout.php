<?php
//Autor: Dušan Stanivuković 2017/0605


namespace App\Controllers;

/**
 * Logout controller
 *
 * @package App\Controllers
 *
 * @version 1.0
 */
class Logout extends BaseController
{
    /**
     * Logout funkcija
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to(site_url("/"));
    }
}
