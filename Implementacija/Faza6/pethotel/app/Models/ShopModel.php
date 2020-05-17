<?php
//Autor: Dušan Stanivuković 2017/0605

namespace App\Models;

/**
 * ShopModel - klasa za dohvatanje, brisanje i ažuriranje podataka o proizvodima u bazi podataka
 *
 * @package App\Models
 *
 * @version 1.0
 */
class ShopModel extends \CodeIgniter\Model
{
    protected $table = 'article';
    protected $primaryKey = 'articleId';

    protected $returnType = 'array';

    protected $allowedFields = ['name', 'price', 'amount', 'image', 'description'];
}
