<?php
//Milica Janković 2013/0668

namespace App\Models;


class PetModel extends \CodeIgniter\Model
{
    protected $table = 'pet';
    protected $primaryKey = 'petId';

    protected $returnType = 'array';

    protected $allowedFields = ['name', 'breed', 'dateOfBirth', 'image', 'description'];
}
