<?php
//Autor: Dušan Stanivuković 2017/0605

namespace App\Models;

/**
 * RoomModel - klasa za dohvatanje, brisanje i ažuriranje podataka o smeštaju u bazi podataka
 *
 * @package App\Models
 *
 * @version 1.0
 */
class RoomModel extends \CodeIgniter\Model
{
    protected $table = 'room';
    protected $primaryKey = 'roomId';

    protected $returnType = 'array';

    protected $allowedFields = ['type', 'image', 'description'];
}
