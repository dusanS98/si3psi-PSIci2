<?php
//Autor: Dušan Stanivuković 2017/0605

namespace App\Filters;


use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class GuestFilter implements \CodeIgniter\Filters\FilterInterface
{

    /**
     * @inheritDoc
     */
    public function before(RequestInterface $request)
    {
        if (session()->has("username")) {
            if (session()->get("userType") == "admin")
                return redirect()->to(site_url("Admin/index"));
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
