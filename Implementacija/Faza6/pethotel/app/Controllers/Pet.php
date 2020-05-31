<?php
//Milica Jankovic 2013/0668

namespace App\Controllers;

use App\Models\PetModel;
use App\Models\ShopModel;

class Pet extends BaseController
{
    private $itemsPerPage = 12;

    public function showPets($page = 1)
    {
        session()->set("dogs", "true");
        session()->set("cats", "true");
        session()->set("birds", "true");
        session()->set("fishes", "true");
        session()->set("littleAnimals", "true");

        $petModel = new PetModel();
        $pets = $petModel->findAll($this->itemsPerPage, ($page - 1) * $this->itemsPerPage);
        $data["title"] = "Pregled ljubimaca";
        $data["name"] = "pets";
        $data["usertype"] = session()->get("userType");
        $pagination["page"] = $page;
        $pagination["numOfPages"] = ceil($petModel->countAll() / $this->itemsPerPage);
        echo view("templates/header", ["data" => $data]);
        echo view("shop/pets", ["pets" => $pets, "pagination" => $pagination]);
        echo view("templates/footer");
    }

    public function showCategoriesPets($page = 1)
    {
        $petsModel = new PetModel();

        $data["title"] = "Pregled ljubimaca";
        $data["name"] = "shop";

        $dogs = session()->get("dogs");
        $cats = session()->get("cats");
        $birds = session()->get("birds");
        $fishes = session()->get("fishes");
        $littleAnimals = session()->get("littleAnimals");

        if ($dogs == "true" && $cats == "true" && $birds == "true" && $fishes == "true" && $littleAnimals == "true") {
            return $this->showPets($page);
        }

        $pets = [];

        if ($dogs == "true")
            $pets = array_merge($pets, $petsModel->like("breed", "Pas")->findAll());
        if ($cats == "true")
            $pets = array_merge($pets, $petsModel->like("breed", "Mac", "after")->findAll());
        if ($birds == "true")
            $pets = array_merge($pets, $petsModel->like("breed", "Ptica")->findAll());
        if ($fishes == "true")
            $pets = array_merge($pets, $petsModel->like("breed", "Ribica")->findAll());
        if ($littleAnimals == "true")
            $pets = array_merge($pets, $petsModel
                ->notLike("breed", "Pas")
                ->orNotLike("breed", "Mac", "after")
                ->orNotLike("breed", "Ptica")
                ->orNotLike("breed", "Ribica")
                ->findAll());

        $pagination["page"] = $page;
        $pagination["numOfPages"] = ceil(sizeof($pets) / $this->itemsPerPage);

        $offset = ($page - 1) * $this->itemsPerPage;
        $articles = array_slice($pets, $offset, $this->itemsPerPage);

        echo view("templates/header", ["data" => $data]);
        echo view("shop/pets", ["pets" => $pets, "pagination" => $pagination, "categories" => true]);
        echo view("templates/footer");
    }

    public function searchCategoriesPets($page = 1)
    {
        $petModel = new PetModel();

        $dogs = $this->request->getVar("dogs");
        $cats = $this->request->getVar("cats");
        $birds = $this->request->getVar("birds");
        $fishes = $this->request->getVar("fishes");
        $littleAnimals = $this->request->getVar("littleAnimals");

        session()->set("dogs", $dogs);
        session()->set("cats", $cats);
        session()->set("birds", $birds);
        session()->set("fishes", $fishes);
        session()->set("littleAnimals", $littleAnimals);

        $pets = [];

        if ($dogs == "true")
            $pets = array_merge($pets, $petModel->like("breed", "Pas")->findAll());
        if ($cats == "true")
            $pets = array_merge($pets, $petModel->like("breed", "Mac", "after")->findAll());
        if ($birds == "true")
            $pets = array_merge($pets, $petModel->like("breed", "Ptica")->findAll());
        if ($fishes == "true")
            $pets = array_merge($pets, $petModel->like("breed", "Ribica")->findAll());
        if ($littleAnimals == "true")
            $pets = array_merge($pets, $petModel
                ->like("breed", "Kornjaca")
                ->orLike("breed", "Lasica")
                ->orLike("breed", "Zeka")
                ->orLike("breed", "Zec")
                ->orLike("breed", "Hrcak")
                ->findAll());

        $baseUrl = base_url();

        $offset = ($page - 1) * $this->itemsPerPage;
        $pets = array_slice($pets, $offset, $this->itemsPerPage);
        if (empty($pets)) {
            echo "<div class='alert alert-info alert-dismissible text-center mx-auto my-4'>";
            echo "<strong>Nema trazenog ljubimca</strong>";
            echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
            echo "<span aria-hidden='true'>&times;</span>";
            echo "</button>";
            echo "</div>";
        }
        foreach ($pets as $pet) {
            $value = "                <div class='col-md-3'>\n";
            $value .= "                    <form method='post' action='$baseUrl/Pet/pet'>\n";
            $value .= "                        <div class='card text-center mb-4'>\n";
            $value .= "                            <img src=" . "$baseUrl/images/pets/" . $pet["image"] . " class='card-img-top'>\n";
            $value .= "                            <div class='card-body'>\n";
            $value .= "                                 <input name='pet' type='hidden' value='" . $pet["petId"] . "'>\n";
            $value .= "                                 <input class='card-title btn btn-link button-link' type='submit' value='" . $pet["breed"] . " " . $pet["name"] . "'>\n";
            $value .= "                                 <p class='card-text'>\n";
            $value .= "                                    <a href='orders.php'>Ovde</a> možete rezervisati termin.\n";
            $value .= "                                </p>\n";
            $value .= "                            </div>\n";
            $value .= "                        </div>\n";
            $value .= "                    </form>\n";
            $value .= "               </div>\n";
            echo $value;
        }

        echo "#delimiter#";

        echo "<input type='hidden' id='page' value='" . $page . "'>\n";
        $prevPage = $page - 1;
        $nextPage = $page + 1;
        $prevDisabled = "";
        if ($page == 1) $prevDisabled = "disabled";
        echo "<li class='page-item $prevDisabled'>"
            . "<a id='prev-page' class='page-link' href='" . site_url('Pet/showCategoriesPets/' . $prevPage)
            . "' tabindex='-1' aria-disabled='true'>Prethodna</a>"
            . "</li>";

        $pets = [];
        if ($dogs == "true")
            $pets = array_merge($pets, $petModel->like("breed", "Pas")->findAll());
        if ($cats == "true")
            $pets = array_merge($pets, $petModel->like("breed", "Mac", "after")->findAll());
        if ($birds == "true")
            $pets = array_merge($pets, $petModel->like("breed", "Ptica")->findAll());
        if ($fishes == "true")
            $pets = array_merge($pets, $petModel->like("breed", "Ribica")->findAll());
        if ($littleAnimals == "true")
            $pets = array_merge($pets, $petModel
                ->like("breed", "Kornjaca")
                ->orLike("breed", "Lasica")
                ->orLike("breed", "Zeka")
                ->orLike("breed", "Zec")
                ->orLike("breed", "Hrcak")
                ->findAll());

        $numOfPages = ceil(sizeof($pets) / $this->itemsPerPage);

        for ($i = $prevPage; $i < $prevPage + 3; $i++) {
            if ($i >= 1 && $i <= $numOfPages) {
                if ($i == $page) {
                    echo "<li class='page-item active'>"
                        . "<a class='page-link' href='"
                        . site_url('Pet/showCategoriesPets/' . $i)
                        . "'>$i <span class=\"sr-only\">(current)</span></a>"
                        . "</li>";
                } else {
                    echo "<li class='page-item'>"
                        . "<a class='page-link' href='"
                        . site_url('Pet/showCategoriesPets/' . $i) . "'>$i</a>"
                        . "</li>";
                }
            }
        }

        $nextDisabled = "";
        if ($page >= $numOfPages) $nextDisabled = "disabled";
        echo "<li class='page-item $nextDisabled'>"
            . "<a class='page-link' href='" . site_url('Pet/showCategoriesPets/' . $nextPage)
            . "'>Sledeća</a>"
            . "</li>";
    }

    public function pet()
    {
        $petId = $this->request->getVar("pet");
        $petModel = new PetModel();
        $pet = $petModel->find($petId);
        $data["title"] = $pet["breed"] . " " . $pet["name"];
        $data["name"] = "pets";
        echo view("templates/header", ["data" => $data]);
        echo view("shop/pet", ["pet" => $pet]);
        echo view("templates/footer");
    }

    public function unosLjubimca($poruka = "")
    {
        $data["title"] = "Unos ljubimca";
        $data["name"] = "unosLjubimca";
        $data["poruka"] = $poruka;
        echo view("templates/header", ["data" => $data]);
        echo view("shop/unosLjubimca");
        echo view("templates/footer");
    }

    public function sacuvajLjubimca()
    {
        $petName = $this->request->getVar("petName");

        $petBreed = $this->request->getVar("petBreed");
        if (strcmp($petBreed, "Pas") != 0 &&
            strcmp($petBreed, "Macka") != 0 &&
            strcmp($petBreed, "Macak") != 0 &&
            strcmp($petBreed, "Ptica") != 0 &&
            strcmp($petBreed, "Ribica") != 0 &&
            strcmp($petBreed, "Hrcak") != 0 &&
            strcmp($petBreed, "Lasica") != 0 &&
            strcmp($petBreed, "Kornjaca") != 0 &&
            strcmp($petBreed, "Zeka") != 0 &&
            strcmp($petBreed, "Zec") != 0) {
            $this->unosLjubimca("Uneta rasa je nevalidna. Moguce opcije su Pas, Macka/Macak, "
                . "Ptica, Ribica i male zivotinje (Hrcak, Lasica, Kornjaca, Zeka/Zec).");
            return;
        }

        $petDescr = $this->request->getVar("petDescr");
        if (empty($petDescr))
            $petDescr = "";

        $petBirthDate = $this->request->getVar("birthDate");

        $image = $this->request->getVar("imageFile");

        $data = array(
            'name' => $petName,
            'breed' => $petBreed,
            'dateOfBirth' => $petBirthDate,
            'image' => $image,
            'description' => $petDescr
        );

        $petModel = new PetModel();
        $petModel->insert($data);

        $this->unosLjubimca("Ljubimac uspesno sacuvan");
    }

    /**
     * Funkcija za brisanje ljubimaca iz baze
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function deletePet()
    {
        $petId = $this->request->getVar("delete");
        $petModel = new PetModel();
        $pet = $petModel->find($petId);
        unlink(realpath(ROOTPATH . "/public/images/pets/" . $pet["image"]));
        $petModel->delete($petId);
        if (session()->get("userType") == "admin")
            return redirect()->to(site_url("Admin/managePets"));
        else
            return redirect()->to(site_url("Moderator/managePets"));
    }

    /**
     * Funkcija za prikaz forme za promenu podataka o ljubimcima
     *
     * @param int $petId Identifikator ljubimca
     *
     * @return string
     */
    public function changePet($petId = null)
    {
        if ($petId == null)
            $petId = $this->request->getVar("change");
        $petModel = new PetModel();
        $pet = $petModel->find($petId);
        $data["title"] = "Ljubimac " . $pet["name"];
        $data["name"] = "pets";
        echo view("templates/header", ["data" => $data]);
        echo view("pets/changePet", ["pet" => $pet]);
        echo view("templates/footer");
    }

    /**
     * Funkcija za čuvanje novih podataka o ljubimcima u bazi
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     *
     * @throws \ReflectionException
     */
    public function saveChanges()
    {
        $userType = session()->get("userType");
        $petId = $this->request->getVar("petId");

        if (!$this->validate([
            "name" => "required|min_length[3]|max_length[32]",
            "breed" => "required",
            "date" => "required",
            "description" => "max_length[240]"
        ], [
            "name" => [
                "required" => "Morate uneti ime",
                "min_length" => "Ime mora sadržati najmanje 3 karaktera",
                "max_length" => "Ime može sadržati najviše 32 karaktera"
            ],
            "breed" => ["required" => "Morate uneti rasu"],
            "date" => ["required" => "Morate odabrati datum"],
            "description" => ["max_length" => "Opis može sadržati najviše 240 karaktera"]
        ])) {
            if ($userType == "admin" || $userType == "moderator")
                return redirect()->to(site_url("Pet/changePet/" . $petId))->with(
                    "messages", $this->validator->listErrors());
        }

        $name = $this->request->getVar("name");
        $breed = $this->request->getVar("breed");
        $dateOfBirth = $this->request->getVar("date");
        $description = $this->request->getVar("description");

        $petModel = new PetModel();
        $pet = $petModel->find($petId);

        $pet["name"] = $name;
        $pet["breed"] = $breed;
        $pet["dateOfBirth"] = $dateOfBirth;
        $pet["description"] = $description;

        $petModel->update($petId, $pet);

        if ($userType == "admin" || $userType == "moderator")
            return redirect()->to(site_url("Pet/changePet/" . $petId))->with(
                "messages", "Uspešno ste izmenili podatke o ljubimcu");
    }

}

















