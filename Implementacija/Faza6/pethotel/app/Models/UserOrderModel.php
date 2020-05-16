<?php
//Autor: Dušan Stanivuković 2017/0605

namespace App\Models;

/**
 * UserOrderModel - Klasa za čuvanje podataka o narudžbinama
 *
 * @package App\Models
 *
 * @version 1.0
 */
class UserOrderModel extends \CodeIgniter\Model
{
    protected $table = 'userorder';
    protected $primaryKey = 'orderId';

    protected $returnType = 'array';

    protected $allowedFields = ['username', 'dateTime', 'status', 'recipientAddress', 'recipientCity',
        'recipientState', 'recipientPostalCode', 'orderPrice'];
}
