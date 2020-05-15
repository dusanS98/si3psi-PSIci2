<?php
//Autor: Dušan Stanivuković 2017/0605

namespace App\Filters;


use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Klasa za redirekciju korisnika
 *
 * @package App\Filters
 *
 * @version 1.0
 */
class GuestFilter implements \CodeIgniter\Filters\FilterInterface
{

    /**
     * Funkcija za redirekciju ulogovanih korisnika na odgovarajuću početnu stranicu
     *
     * @inheritDoc
     */
    public function before(RequestInterface $request)
    {
        if (session()->has("username")) {
            $userType = session()->get("userType");
            if ($userType == "admin")
                return redirect()->to(site_url("Admin/index"));
            else if ($userType == "moderator")
                return redirect()->to(site_url(""));
            else
                return redirect()->to(site_url("User/index"));
        }
    }

    /**
     * @inheritDoc
     */
    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // TODO: Implement after() method.
    }
}
