<?php
//Autor: Milica Kaitovic 2014/0584

namespace App\Controllers;

use App\Models\ForgetPassModel;

/**
 * Forgetpassword - Klasa za dohvatanje zaboravljene lozinke
 * Korisnik unosi username i ukoliko postoji u bazi
 *  na mail mu se salje zaboravljeni password
 * @package App\Controllers
 *
 * @version 1.0
 */
class Forgetpassword extends BaseController{
    
    public function forget(){
        
        if(session()->get('username'))
            return redirect ()->to ("/");
        
        if($this->request->getMethod()=='post'){
            $username = $this->request->getVar("username");
            $forgetPassModel = new ForgetPassModel();
            $forgetPass = $forgetPassModel->where('username',$username)->first();

            //nismo nasli taj username
            if(empty($forgetPass))
               $data['poruka']= "Ne postoji korisnik sa unetim korisničkim imenom!";
            else{
                
                $email = \Config\Services::email();
                $email->setFrom('pethotelpsi@gmail.com', 'Pet hotel');
                $email->setTo($forgetPass['email']);
                $email->setSubject('Oporavak lozinke');
                $email->setMessage($forgetPass['password']);

                if(!$email->send(false)){
                   echo $email->printDebugger();
                }
                $session = session();
                $session->setFlashdata('uspesno', 'Lozinka je poslata, proverite email!' );
                
                return redirect()->to("/");
            }   
        }    
        $data["title"] = "Zaboravljena lozinka";
        $data["name"] = "forgetpass";
        echo view("templates/header",["data" => $data]);
        echo view('pass/forgetpass',$data);
        echo view("templates/footer"); 
    
    }
}

