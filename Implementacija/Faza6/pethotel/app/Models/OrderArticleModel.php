<?php
//Autor: Dušan Stanivuković 2017/0605

namespace App\Models;

/**
 * OrderArticleModel - Klasa za čuvanje podataka o naručenim proizvodima
 *
 * @package App\Models
 *
 * @version 1.0
 */
class OrderArticleModel extends \CodeIgniter\Model
{
    protected $table = 'orderarticle';
    protected $primaryKey = 'articleId';

    protected $returnType = 'array';

    protected $allowedFields = ['orderId', 'articleId', 'amount', 'articlePrice'];

    /**
     * @param string $primaryKey
     */
    public function setPrimaryKey(string $primaryKey): void
    {
        $this->primaryKey = $primaryKey;
    }
}
