<?php

//autor: Milica Kaitović 2014/0584

namespace App\Models;

class RegModel extends \CodeIgniter\Model{
    
    protected $table= 'user';
    protected $allowedFields = ['username', 'password', 'firstname', 'lastname', 'email', 'phone', 'type'];
    
    //sifrovanje password-a, da ne bi bio vidljiv svima 
    
//    protected $beforeInsert = ['beforeInsert'];
//    protected $beforeUpdate = ['beforeUpdate'];
//    
//    protected function beforeInsert(array $data){
//        $data=$this->passhash($data);
//        return $data;
//    }
//    
//    protected function beforeUpdate(array $data){
//        $data=$this->passhash($data);
//        return $data;
//    }
//    
//    protected function passhash(array $data){
//        if(isset($data['data']['password']))
//            $data['data']['password'] = password_hash ($data['data']['password'], PASSWORD_DEFAULT);
//        return $data;
//    }
    
    
    
}

