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
class UserFilter implements \CodeIgniter\Filters\FilterInterface
{

    /**
     * Funkcija za redirekciju korisnika na početnu stranicu ukoliko nisu ulogovani
     *
     * @inheritDoc
     */
    public function before(RequestInterface $request)
    {
        if (!session()->has("username"))
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
