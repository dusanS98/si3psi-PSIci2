<?php
//Autor: Dušan Stanivuković 2017/0605

namespace App\Models;

/**
 * ReservationRoomModel - klasa za dohvatanje, brisanje i ažuriranje podataka o rezervacijama smeštaja u bazi podataka
 *
 * @package App\Models
 *
 * @version 1.0
 */
class ReservationRoomModel extends \CodeIgniter\Model
{
    protected $table = 'reservationroom';
    protected $primaryKey = 'roomId';

    protected $returnType = 'array';

    protected $allowedFields = ['username', 'roomId', 'dateFrom', 'dateTo'];
}
