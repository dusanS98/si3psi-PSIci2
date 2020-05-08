<?php
//Dušan Stanivuković 2017/0605

namespace App\Models;


class ShopModel extends \CodeIgniter\Model
{
    protected $table = 'article';
    protected $primaryKey = 'articleId';

    protected $returnType = 'array';

    protected $allowedFields = ['name', 'price', 'amount', 'image', 'description'];
}
