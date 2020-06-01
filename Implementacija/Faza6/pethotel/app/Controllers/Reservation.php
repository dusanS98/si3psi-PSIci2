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
            $petresmodel= new PetResModel();
            $poruka="";
            $alreadybooked=$petresmodel->where('username', $user)->where('petId',$petId)->first();
            //korisnik je vec rezervisao ovog ljubimca
            if($alreadybooked!=null){
                $session = session();
                $session->setFlashdata('vec', 'Vec ste rezervisali ovog ljubimca!' );
                return redirect()->to(site_url('Pet/showpets'));
            }
            $data["mess"]="";
            $now = new Time('now', 'Europe/Belgrade');
            $date= $this->request->getVar('date');
            $hours = $this->request->getVar('time');
            $hours = substr($hours,0,2);
            $time = Time::parse($date . $hours.':00:00', 'Europe/Belgrade');
 
            $when=$petresmodel->where('dateTime',$time)->first();
            $pet=$petresmodel->where('petID',$petId)->where('dateTime',$time)->first();
                       
            //postoji vec neko u tom terminu, ne moze neko drugi da dodje
            if($when!= null){
                 $data['mess']= " Ovaj termin je rezervisan ";
            }
            //da li je ljubimac vec zauzet u tom terminu
            else if($pet!=null){
                $data['mess']= $pet['name']. "je vec zauzet u ovom terminu";
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
            
        }
        
        $data["title"] = "Rezervacija ljubimca";
        $data["name"] = "petreservation";
        echo view("templates/header", ["data" => $data]);
        echo view("reservations/petreservation", $data);
        echo view("templates/footer");
    }
}
   

?>