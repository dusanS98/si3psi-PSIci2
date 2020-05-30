<?php
//Autori:
// Dušan Stanivuković 2017/0605
// Jovan Penezic 2016/0560

namespace App\Controllers;

use App\Models\RoomModel;

/**
 * Room - klasa za prikaz, unos i rezervacije smeštaja
 *
 * @package App\Controllers
 *
 * @version 1.0
 */
class Room extends BaseController
{
    private $itemsPerPage = 12;

    public function showRooms($page = 1)
    {
        session()->set("dogs", "true");
        session()->set("cats", "true");
        session()->set("birds", "true");
        session()->set("fishes", "true");
        session()->set("littleAnimals", "true");

        $roomModel = new RoomModel();
        $rooms = $roomModel->findAll($this->itemsPerPage, ($page - 1) * $this->itemsPerPage);
        $data["title"] = "Pregled smestaja";
        $data["name"] = "room";
        $pagination["page"] = $page;
        $pagination["numOfPages"] = ceil($roomModel->countAll() / $this->itemsPerPage);
        echo view("templates/header", ["data" => $data]);
        echo view("shop/rooms", ["rooms" => $rooms, "pagination" => $pagination]);
        echo view("templates/footer");
    }

    public function showRoomsByCategory($page = 1)
    {
        $roomModel = new RoomModel();


        $data["title"] = "Pregled smestaja";
        $data["name"] = "room";

        $dogs = session()->get("dogs");
        $cats = session()->get("cats");
        $birds = session()->get("birds");
        $fishes = session()->get("fishes");
        $littleAnimals = session()->get("littleAnimals");

        if ($dogs == "true" && $cats == "true" && $birds == "true" && $fishes == "true" && $littleAnimals == "true")
        {
            return $this->showRooms($page);
        }

        $rooms = [];

        if ($dogs == "true")
            $rooms = array_merge($rooms, $roomModel->like("type", "Pas")->findAll());
        if ($cats == "true")
            $rooms = array_merge($rooms, $roomModel->like("type", "Mac", "after")->findAll());
        if ($birds == "true")
            $rooms = array_merge($rooms, $roomModel->like("type", "Ptica")->findAll());
        if ($fishes == "true")
            $rooms = array_merge($rooms, $roomModel->like("type", "Ribica")->findAll());
        if ($littleAnimals == "true")
            $rooms = array_merge($rooms, $roomModel
                ->notLike("type", "Pas")
                ->orNotLike("type", "Mac", "after")
                ->orNotLike("type", "Ptica")
                ->orNotLike("type", "Ribica")
                ->findAll());


        $pagination["page"] = $page;
        $pagination["numOfPages"] = ceil(sizeof($rooms) / $this->itemsPerPage);

        $offset = ($page - 1) * $this->itemsPerPage;
        $rooms = array_slice($rooms, $offset, $this->itemsPerPage);

        echo view("templates/header", ["data" => $data]);
        echo view("shop/rooms", ["rooms" => $rooms, "pagination" => $pagination, "categories" => true]);
        echo view("templates/footer");
    }

    public function searchCategoriesRooms($page = 1)
    {
        $roomModel = new RoomModel();

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

        $rooms = [];

        if ($dogs == "true")
            $rooms = array_merge($rooms, $roomModel->like("type", "Pas")->findAll());
        if ($cats == "true")
            $rooms = array_merge($rooms, $roomModel->like("type", "Mac", "after")->findAll());
        if ($birds == "true")
            $rooms = array_merge($rooms, $roomModel->like("type", "Ptica")->findAll());
        if ($fishes == "true")
            $rooms = array_merge($rooms, $roomModel->like("type", "Ribica")->findAll());
        if ($littleAnimals == "true")
            $rooms = array_merge($rooms, $roomModel
                ->like("type", "Kornjaca")
                ->orLike("type", "Lasica")
                ->orLike("type", "Zeka")
                ->orLike("type", "Zec")
                ->orLike("type", "Hrcak")
                ->findAll());

        $baseUrl = base_url();

        $offset = ($page - 1) * $this->itemsPerPage;
        $rooms = array_slice($rooms, $offset, $this->itemsPerPage);
        if (empty($rooms)) {
            echo "<div class='alert alert-info alert-dismissible text-center mx-auto my-4'>";
            echo "<strong>Nema trazenog ljubimca</strong>";
            echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
            echo "<span aria-hidden='true'>&times;</span>";
            echo "</button>";
            echo "</div>";
        }
        foreach ($rooms as $room) {
            $value = "                <div class='col-md-3'>\n";
            $value .= "                    <form method='post' action='$baseUrl/Room/room'>\n";
            $value .= "                        <div class='card text-center mb-4'>\n";
            $value .= "                            <img src=" . "$baseUrl/images/rooms/" . $room["image"] . " class='card-img-top'>\n";
            $value .= "                            <div class='card-body'>\n";
            $value .= "                                 <input name='room' type='hidden' value='" . $room["roomId"] . "'>\n";
            $value .= "                                 <input class='card-title btn btn-link button-link' type='submit' value='" . $room["description"] . "'>\n";
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
            . "<a id='prev-page' class='page-link' href='" . site_url('Room/showRoomsByCategory/' . $prevPage)
            . "' tabindex='-1' aria-disabled='true'>Prethodna</a>"
            . "</li>";

        $rooms = [];
        if ($dogs == "true")
            $rooms = array_merge($rooms, $roomModel->like("type", "Pas")->findAll());
        if ($cats == "true")
            $rooms = array_merge($rooms, $roomModel->like("type", "Macka", "after")->findAll());
        if ($birds == "true")
            $rooms = array_merge($rooms, $roomModel->like("type", "Ptica")->findAll());
        if ($fishes == "true")
            $rooms = array_merge($rooms, $roomModel->like("type", "Ribica")->findAll());
        if ($littleAnimals == "true")
            $rooms = array_merge($rooms, $roomModel
                ->like("type", "Kornjaca")
                ->orLike("type", "Lasica")
                ->orLike("type", "Zeka")
                ->orLike("type", "Zec")
                ->orLike("type", "Hrcak")
                ->findAll());

        $numOfPages = ceil(sizeof($rooms) / $this->itemsPerPage);

        for ($i = $prevPage; $i < $prevPage + 3; $i++) {
            if ($i >= 1 && $i <= $numOfPages) {
                if ($i == $page) {
                    echo "<li class='page-item active'>"
                        . "<a class='page-link' href='"
                        . site_url('Room/showRoomsByCategory/' . $i)
                        . "'>$i <span class=\"sr-only\">(current)</span></a>"
                        . "</li>";
                } else {
                    echo "<li class='page-item'>"
                        . "<a class='page-link' href='"
                        . site_url('Room/showRoomsByCategory/' . $i) . "'>$i</a>"
                        . "</li>";
                }
            }
        }

        $nextDisabled = "";
        if ($page >= $numOfPages) $nextDisabled = "disabled";
        echo "<li class='page-item $nextDisabled'>"
            . "<a class='page-link' href='" . site_url('Room/showRoomsByCategory/' . $nextPage)
            . "'>Sledeća</a>"
            . "</li>";
    }

    public function room($roomId = null)
    {
        if ($roomId == null)
            $roomId = $this->request->getVar("room");
        $roomModel = new RoomModel();
        $room = $roomModel->find($roomId);
        $data["title"] = "Smestaj" . $room["type"];
        $data["name"] = "room";
        echo view("templates/header", ["data" => $data]);
        echo view("shop/room", ["room" => $room]);
        echo view("templates/footer");
    }

    public function unosSmestaja($poruka = "")
    {
        $data["title"] = "Unos smestaja";
        $data["name"] = "unosSmestaja";
        $data["poruka"] = $poruka;
        echo view("templates/header", ["data" => $data]);
        echo view("shop/unosSmestaja");
        echo view("templates/footer");
    }

    public function sacuvajSmestaj()
    {

        $roomType = $this->request->getVar("roomType");
        if (strcmp($roomType, "Pas") != 0 &&
            strcmp($roomType, "Macka") != 0 &&
            strcmp($roomType, "Macak") != 0 &&
            strcmp($roomType, "Ptica") != 0 &&
            strcmp($roomType, "Ribica") != 0 &&
            strcmp($roomType, "Hrcak") != 0 &&
            strcmp($roomType, "Lasica") != 0 &&
            strcmp($roomType, "Kornjaca") != 0 &&
            strcmp($roomType, "Zeka") != 0 &&
            strcmp($roomType, "Zec") != 0) {
            $this->unosSmestaja("Uneta rasa je nevalidna. Moguce opcije su Pas, Macka/Macak, "
                . "Ptica, Ribica i male zivotinje (Hrcak, Lasica, Kornjaca, Zeka/Zec).");
            return;
        }

        $roomDescr = $this->request->getVar("roomDescr");
        if (empty($petDescr))
            $petDescr = "";


        $image = $this->request->getVar("imageFile");

        $data = array(
            'type' => $roomType,
            'image' => $image,
            'description' => $roomDescr
        );

        $roomModel = new RoomModel();
        $roomModel->insert($data);

        $this->unosSmestaja("Smestaj uspesno sacuvan");
    }


    /**
     * Funkcija za brisanje smeštaja iz baze
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function deleteRoom()
    {
        $roomId = $this->request->getVar("delete");
        $roomModel = new RoomModel();
        $room = $roomModel->find($roomId);
        unlink(realpath(ROOTPATH . "/public/images/rooms/" . $room["image"]));
        $roomModel->delete($roomId);
        if (session()->get("userType") == "admin")
            return redirect()->to(site_url("Admin/manageRooms"));
        else
            return redirect()->to(site_url(""));
    }

    /**
     * Funkcija za prikaz forme za promenu podataka o smeštaju
     *
     * @param int $roomId Identifikator smeštaja
     *
     * @return string
     */
    public function changeRoom($roomId = null)
    {
        if ($roomId == null)
            $roomId = $this->request->getVar("change");
        $roomModel = new RoomModel();
        $room = $roomModel->find($roomId);
        $data["title"] = "Izmena smeštaja";
        $data["name"] = "rooms";
        echo view("templates/header", ["data" => $data]);
        echo view("rooms/changeRoom", ["room" => $room]);
        echo view("templates/footer");
    }

    /**
     * Funkcija za čuvanje novih podataka o smeštaju u bazi
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     *
     * @throws \ReflectionException
     */
    public function saveChanges()
    {
        $userType = session()->get("userType");
        $roomId = $this->request->getVar("roomId");

        if (!$this->validate([
            "type" => "required|max_length[16]",
            "description" => "max_length[240]"
        ], [
            "type" => [
                "required" => "Morate uneti tip",
                "max_length" => "Tip može sadržati najviše 16 karaktera"
            ],
            "description" => ["max_length" => "Opis može sadržati najviše 240 karaktera"]
        ])) {
            if ($userType == "admin")
                return redirect()->to(site_url("Room/changeRoom/" . $roomId))->with(
                    "messages", $this->validator->listErrors());
            else if ($userType == "moderator")
                return redirect()->to(site_url(""));
        }

        $type = $this->request->getVar("type");
        $description = $this->request->getVar("description");

        $roomModel = new RoomModel();
        $room = $roomModel->find($roomId);

        $room["type"] = $type;
        $room["description"] = $description;

        $roomModel->update($roomId, $room);

        if ($userType == "admin")
            return redirect()->to(site_url("Room/changeRoom/" . $roomId))->with(
                "messages", "Uspešno ste izmenili podatke o smeštaju");
        else if ($userType == "moderator")
            return redirect()->to(site_url(""));
    }
}
