<?php
//Autor: Dušan Stanivuković 2017/0605

namespace App\Models;

/**
 * UserModel - klasa za dohvatanje, brisanje i ažuriranje podataka o korisnicima u bazi podataka
 *
 * @package App\Models
 *
 * @version 1.0
 */
class UserModel extends \CodeIgniter\Model
{
    protected $table = 'user';
    protected $primaryKey = 'username';

    protected $returnType = 'array';

    protected $allowedFields = ['firstName', 'lastName', 'password', 'email', 'phone', 'type'];
}
