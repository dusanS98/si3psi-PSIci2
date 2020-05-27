<?php

//autor: Milica Kaitović 2014/0584

namespace App\Models;

class RegModel extends \CodeIgniter\Model{
    
    protected $table= 'user';
    protected $allowedFields = ['username', 'password', 'firstname', 'lastname', 'email', 'phone', 'type'];
    
    
}

