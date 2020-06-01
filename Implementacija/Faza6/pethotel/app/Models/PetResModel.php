<?php
//Autor: Milica KAitovic 584/2014

namespace App\Models;

/**
 * PetResModel - klasa za rad sa bazom za rezervisanje termina 
 *
 * @package App\Models
 *
 * @version 1.0
 */
class PetResModel extends \CodeIgniter\Model{
    protected $table = 'reservationpet';
  
    protected $returnType = 'array';

    protected $allowedFields = ['username','petId','dateTime'];
    
    public function setPrimaryKey(string $primaryKey): void
    {
        $this->primaryKey = $primaryKey;
    }
    
}