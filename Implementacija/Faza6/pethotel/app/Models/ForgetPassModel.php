<?php
//autor: Milica Kaitović 2014/0584

namespace App\Models;


class ForgetPassModel extends \CodeIgniter\Model{
    
    protected $table = 'user';
    protected $primaryKey = 'username';
    protected $returnType = 'array';
    protected $allowedFields = ['username', 'password', 'email'];
    
}
