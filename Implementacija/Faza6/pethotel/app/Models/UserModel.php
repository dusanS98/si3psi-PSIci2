<?php
//Milica Janković 2013/0668

namespace App\Models;


class UserModel extends \CodeIgniter\Model
{
    protected $table = 'user';
    protected $primaryKey = 'username';

    protected $returnType = 'array';

    protected $allowedFields = ['username', 'password', 'firstName', 'lastName', 'email', 'phone', 'type'];
}
