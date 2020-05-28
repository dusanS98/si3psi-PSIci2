<?php

namespace App\Controllers;

use App\Models\RegModel;

//autor: Milica Kaitović 2014/0584
  
class Registration extends BaseController {
    
    public function register(){
       $data=[];
       helper(['form']);
       
      if(session()->get('username'))
          return redirect ()->to ("/");
       
       if($this->request->getMethod()=='post'){
           
           $rules =[
                'firstname'=>'required|min_length[2]|max_length[20]|alpha_space',
                'lastname' => 'required|min_length[2]|max_length[20]|alpha_space',
                'username' => 'required|min_length[2]|max_length[20]|is_unique[user.username]',
                'email' => 'required|valid_email|min_length[6]|max_length[30]|is_unique[user.email]',
                'password'=> 'required|min_length[6]|max_length[20]',
                'passwordconfirm' => 'matches[password]',
                'phone' => 'required|regex_match[/^[0-9]{9,10}$/]'
            ];
           
           
           $rules_errors =[
                'firstname'=>['min_length' => 'Ime mora biti minimalne duzine 2 slova',
                              'max_length' => 'Ime ne sme biti duže od 20 slova',
                              'alpha_space' => 'Ime ne sme sadržati cifre'
                    ],
               'lastname'=> ['min_length' => 'Prezime mora biti minimalne duzine 2 slova',
                              'max_length' => 'Prezime ne sme biti duže od 20 slova',
                              'alpha_space' => 'Prezime ne sme sadržati cifre'
                    ],
               'username'=> ['is_unique' => 'Korisničko ime je zauzeto',
                            'min_length' => 'Korisničko ime mora biti minimalne duzine 2 znaka',
                            'max_length' => 'Korisničko ime ne sme biti duže od 20 znakova',       
                    ],
               'email' =>[ 'valid_email' => 'Uneti e-mail nije validan',
                            'is_unique'  => 'Postoji korisnik koji je registrovan sa ovim e-mailom'
               ],
               'password' => ['min_length' => 'Lozinka mora biti minimalne dužine 6 znakova ',
                            'max_length' => 'Lozinka ne sme biti duže od 20 znakova'
                   ],
                'passwordconfirm' => ['matches' => 'Lozinke se ne podudaraju '
                    ],
                'phone' =>['regex_match' => 'Unesite ispravan broj telefona']
            ];
          
           if(! $this->validate($rules, $rules_errors)){
               //neuspesna registracija
               //neko od pravila nije ispostovano i prikazuju se greske
               $data['validation']=$this->validator;
           }
           else{
               //registracija uspesna
               //sva pravila su ispostovana i cuvamo korisnika u bazi
               $regmodel= new RegModel();
               
               $new= [
                   'username'=> $this->request->getVar('username'),
                   'password'=> $this->request->getVar('password'),
                   'firstname'=> $this->request->getVar('firstname'),
                   'lastname'=> $this->request->getVar('lastname'),
                   'email'=> $this->request->getVar('email'),
                   'phone'=> $this->request->getVar('phone'),
                   'type' => 'standard'
               ];
                       
               $regmodel->save($new);
               $session = session();
               $session->setFlashdata('uspesno', 'Uspešna registracija!' );
               
               return redirect()->to('/');
           }
           
    }
        $data["title"] = "Registracija";
        $data["name"] = "register";
        echo view("templates/header",["data" => $data]);
        echo view('registration/register',$data);
        echo view("templates/footer"); 
          
    }	
}
?>
