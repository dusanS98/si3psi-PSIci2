<?php
//Autor: Dušan Stanivuković 2017/0605

namespace App\Filters;


use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * ModeratorFilter - Klasa za redirekciju korisnika
 *
 * @package App\Filters
 *
 * @version 1.0
 */
class ModeratorFilter implements \CodeIgniter\Filters\FilterInterface
{

    /**
     * Funkcija za redirekciju korisnika na početnu stranicu ukoliko nije ulogovan
     *
     * @inheritDoc
     */
    public function before(RequestInterface $request)
    {
        if (!session()->has("username") ||
            session()->has("username") && session()->get("userType") != "moderator")
            return redirect()->to(site_url("Home/index"));
    }

    /**
     * @inheritDoc
     */
    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // TODO: Implement after() method.
    }
}
