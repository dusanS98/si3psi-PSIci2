<?php

//autor: Milica Kaitović 2014/0584

namespace App\Controllers;

use App\Models\PetResModel;
use App\Models\UserModel;
use App\Models\PetModel;

use CodeIgniter\I18n\Time;

class Reservation extends BaseController{
    
    public function petreservation($petId){
       
        //korisnik nije ulogovan i ne moze rezervisati
        
        if(!session()->get('username')){
            $session = session();
            $session->setFlashdata('uspesno', 'Prijavite se da biste mogli da rezervišete ljubimce' );
            return redirect ()->to ("/");
        }
        if($this->request->getMethod()=='post'){
            $user = session()->get("username");
            $date= $this->request->getVar('date');
            
            $hours = $this->request->getVar('time');
            $hours = substr($hours,0,2);
            
            $time = Time::parse($date . $hours.':00:00', 'Europe/Belgrade');

            
            $petresmodel= new PetResModel();
            
            $when=$petresmodel->where('dateTime',$time)->first();
            $pet=$petresmodel->where('petID',$petId)->where('dateTime',$time)->first();
            
            
            //postoji vec neko u tom terminu, ne moze neko drugi da dodje
            if($when!= null){
                echo $when['username']. " Ovaj termin je rezervisan ";    
            }
            //da li je ljubimac vec zauzet u tom terminu
            else if($pet!=null){
                echo $pet['name']. "je vec zauzet u ovom terminu";
            }
            else{
                $new= [
                    'username'=> $user,
                    'petId'=> $petId,
                    'dateTime'=> $time
                 ];
                
                //cuvamo vremena ovde, da bismo izbacili opcije iz select-a
                $datearray[]=$time;

                $petresmodel->save($new);
                
                //uspesno ubaceno u bazu
                $session = session();
                $session->setFlashdata('uspesno', 'Uspešna rezervacija!' );
                return redirect()->to(site_url("User/index"));
            }

            
          //  foreach ($datearray as $dat) {
                // echo $dat;


//            $userModel = new UserModel();
//            $userr = $userModel->where('username',$user)->getInsertId();
//            $petModel = new PetModel();
//            $pet = $petModel->where('petId',$petId)->getInsertId();
            
        }
        
        $data["title"] = "Rezervacija ljubimca";
        $data["name"] = "petreservation";
        echo view("templates/header", ["data" => $data]);
        echo view("reservations/petreservation");
        echo view("templates/footer");
    }
}
   



?>