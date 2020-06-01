<?php
//Autori:
// Dušan Stanivuković 2017/0605
// Jovan Penezic 2016/0560

namespace App\Controllers;

use App\Models\ReservationRoomModel;
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
        $data["title"] = "Pregled smeštaja";
        $data["name"] = "room";
        $pagination["page"] = $page;
        $pagination["numOfPages"] = ceil($roomModel->countAll() / $this->itemsPerPage);
        echo view("templates/header", ["data" => $data]);
        echo view("shop/rooms", ["rooms" => $rooms, "pagination" => $pagination]);
        echo view("templates/footer");
    }

    /**
     * Pomoćna funkcija za dohvatanje smeštaja iz baze
     *
     * @return array
     */
    private function findRooms()
    {
        $roomModel = new RoomModel();

        $dogs = session()->get("dogs");
        $cats = session()->get("cats");
        $birds = session()->get("birds");
        $fishes = session()->get("fishes");
        $littleAnimals = session()->get("littleAnimals");

        $rooms = [];

        if ($dogs == "true")
            $rooms = array_merge($rooms, $roomModel->like("type", "psi")->findAll());
        if ($cats == "true")
            $rooms = array_merge($rooms, $roomModel->like("type", "macke")->findAll());
        if ($birds == "true")
            $rooms = array_merge($rooms, $roomModel->like("type", "ptice")->findAll());
        if ($fishes == "true")
            $rooms = array_merge($rooms, $roomModel->like("type", "ribe")->findAll());
        if ($littleAnimals == "true")
            $rooms = array_merge($rooms, $roomModel->like("type", "maleZivotinje")->findAll());

        return $rooms;
    }

    /**
     * Funkcija koja vraća određene tipove smeštaja kao odgovor na ajax zahtev
     *
     * @param int $page Redni broj stanice sa smeštajem
     *
     * @return string
     */
    public function searchTypes($page = 1)
    {
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

        $rooms = $this->findRooms();
        $baseUrl = base_url();

        $offset = ($page - 1) * $this->itemsPerPage;
        $rooms = array_slice($rooms, $offset, $this->itemsPerPage);

        if (empty($rooms)) {
            echo "<div class='alert alert-info alert-dismissible text-center mx-auto my-4'>";
            echo "<strong>Nema smeštaja</strong>";
            echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
            echo "<span aria-hidden='true'>&times;</span>";
            echo "</button>";
            echo "</div>";
        }

        foreach ($rooms as $room) {
            $type = "";
            switch ($room["type"]) {
                case "psi":
                    $type = "Psi";
                    break;
                case "macke":
                    $type = "Mačke";
                    break;
                case "ptice":
                    $type = "Ptice";
                    break;
                case "ribe":
                    $type = "Ribe";
                    break;
                case "maleZivotinje":
                    $type = "Male Životinje";
                    break;
            }
            $value = "                <div class='col-md-3'>\n";
            $value .= "                    <form method='post' action='$baseUrl/Room/room'>\n";
            $value .= "                        <div class='card text-center mb-4'>\n";
            $value .= "                            <input type='image' src=" . "$baseUrl/images/rooms/" . $room["image"] . " class='card-img-top'>\n";
            $value .= "                            <div class='card-body'>\n";
            $value .= "                                 <input name='room' type='hidden' value='" . $room["roomId"] . "'>\n";
            $value .= "                                 <input class='card-title btn btn-link button-link' type='submit' value='Tip: " . $type . "'>\n";
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
            . "<a id='prev-page' class='page-link' href='" . site_url('Room/showRoomsByType/' . $prevPage)
            . "' tabindex='-1' aria-disabled='true'>Prethodna</a>"
            . "</li>";

        $rooms = $this->findRooms();
        $numOfPages = ceil(sizeof($rooms) / $this->itemsPerPage);

        for ($i = $prevPage; $i < $prevPage + 3; $i++) {
            if ($i >= 1 && $i <= $numOfPages) {
                if ($i == $page) {
                    echo "<li class='page-item active'>"
                        . "<a class='page-link' href='"
                        . site_url('Room/showRoomsByType/' . $i)
                        . "'>$i <span class=\"sr-only\">(current)</span></a>"
                        . "</li>";
                } else {
                    echo "<li class='page-item'>"
                        . "<a class='page-link' href='"
                        . site_url('Room/showRoomsByType/' . $i) . "'>$i</a>"
                        . "</li>";
                }
            }
        }

        $nextDisabled = "";
        if ($page >= $numOfPages) $nextDisabled = "disabled";
        echo "<li class='page-item $nextDisabled'>"
            . "<a class='page-link' href='" . site_url('Room/showRoomsByType/' . $nextPage)
            . "'>Sledeća</a>"
            . "</li>";
    }

    /**
     * Funkcija za prikaz odabranih tipova smeštaja
     *
     * @param int $page Redni broj stranice sa smeštajem
     *
     * @return string
     */
    public function showRoomsByType($page = 1)
    {
        $data["title"] = "Pregled smeštaja";
        $data["name"] = "room";

        $dogs = session()->get("dogs");
        $cats = session()->get("cats");
        $birds = session()->get("birds");
        $fishes = session()->get("fishes");
        $littleAnimals = session()->get("littleAnimals");

        if ($dogs == "true" && $cats == "true" && $birds == "true" && $fishes == "true" && $littleAnimals == "true") {
            return $this->showRooms($page);
        }

        $rooms = $this->findRooms();

        $pagination["page"] = $page;
        $pagination["numOfPages"] = ceil(sizeof($rooms) / $this->itemsPerPage);

        $offset = ($page - 1) * $this->itemsPerPage;
        $rooms = array_slice($rooms, $offset, $this->itemsPerPage);

        echo view("templates/header", ["data" => $data]);
        echo view("shop/rooms", ["rooms" => $rooms, "pagination" => $pagination, "categories" => true]);
        echo view("templates/footer");
    }

    /**
     * Funkcija za prikaz forme za rezervaciju smeštaja
     *
     * @return string
     */
    public function makeReservation()
    {
        $data["title"] = "Rezervisanje smeštaja";
        $data["name"] = "room";

        $roomId = $this->request->getVar("roomId");

        echo view("templates/header", ["data" => $data]);
        echo view("rooms/makeReservation", ["roomId" => $roomId]);
        echo view("templates/footer");
    }

    public function createReservation()
    {
        $dateFrom = $this->request->getVar("dateFrom");
        $dateTo = $this->request->getVar("dateTo");
        $roomId = $this->request->getVar("roomId");

        session()->set("roomId", $roomId);

        if ($dateFrom > $dateTo) {
            return redirect()->to(site_url("Room/makeReservation"))
                ->with("messages", "Datum kraja rezervacije ne može biti veći od datuma početka");
        } else if ($dateFrom < date("Y-m-d")) {
            return redirect()->to(site_url("Room/makeReservation"))
                ->with("messages", "Datum početka rezervacije ne može biti manji od tekućeg datuma");
        }

        $reservationRoomModel = new ReservationRoomModel();
        $reservations = $reservationRoomModel->where("roomId", $roomId)->findAll();

        $taken = false;
        foreach ($reservations as $reservation) {
            if ($reservation["username"] == session()->get("username")) {
                return redirect()->to(site_url("Room/makeReservation"))
                    ->with("messages", "Već imate rezervaciju za odabrani smeštaj");
            }

            if (($dateFrom <= $reservation["dateTo"]) && ($dateTo >= $reservation["dateFrom"])) {
                $taken = true;
                break;
            }
        }

        if ($taken) {
            return redirect()->to(site_url("Room/makeReservation"))
                ->with("messages", "Odabrani termin je zauzet");
        } else {
            $reservationRoomModel->setPrimaryKey("");
            $reservationRoomModel->save([
                "roomId" => $roomId,
                "username" => session()->get("username"),
                "dateFrom" => $dateFrom,
                "dateTo" => $dateTo
            ]);
            $reservationRoomModel->setPrimaryKey("roomId");

            session()->remove("roomId");

            return redirect()->to(site_url("Room/showReservations"));
        }
    }

    /**
     * Funkcija za prikaz rezervisanog smeštaja
     *
     * @return string
     */
    public function showReservations()
    {
        $data["title"] = "Rezervacije smeštaja";
        $data["name"] = "roomReservations";

        $username = session()->get("username");

        $reservationRoomModel = new ReservationRoomModel();
        $reservations = $reservationRoomModel->where("username", $username)->findAll();

        echo view("templates/header", ["data" => $data]);
        echo view("rooms/reservations", ["reservations" => $reservations]);
        echo view("templates/footer");
    }

    public function room($roomId = null)
    {
        if ($roomId == null)
            $roomId = $this->request->getVar("room");
        $roomModel = new RoomModel();
        $room = $roomModel->find($roomId);
        $data["title"] = "Smeštaj " . $room["type"];
        $data["name"] = "room";
        echo view("templates/header", ["data" => $data]);
        echo view("shop/room", ["room" => $room]);
        echo view("templates/footer");
    }

    public function unosSmestaja($poruka = "")
    {
        $data["title"] = "Unos smestaja";
        $data["name"] = "room";
        $data["poruka"] = $poruka;
        echo view("templates/header", ["data" => $data]);
        echo view("rooms/unosSmestaja");
        echo view("templates/footer");
    }

    public function sacuvajSmestaj()
    {
        if (!$this->validate([
            "image" => "uploaded[image]|max_size[image,5120]|ext_in[image,jpg,jpeg,png,jfif,gif]",
            "description" => "max_length[240]"
        ], [
            "image" => [
                "uploaded" => "Morate odabrati sliku",
                "max_size" => "Veličina slike je veća od dozvoljene",
                "ext_in" => "Pogrešna ekstenzija odabrane slike"
            ],
            "description" => ["max_length" => "Opis može sadržati najviše 240 karaktera"]
        ])) {
            $userType = session()->get("userType");
            if ($userType == "admin" || $userType == "moderator")
                return redirect()->to(site_url("Room/unosSmestaja"))->with(
                    "messages", $this->validator->listErrors());
        }

        $type = $this->request->getVar("type");
        $image = $this->request->getFile("image");
        $description = $this->request->getVar("description");

        $image->move(ROOTPATH . "/public/images/rooms");

        $roomModel = new RoomModel();
        $roomModel->save([
            "type" => $type,
            "image" => $image->getName(),
            "description" => $description
        ]);

        return redirect()->to(site_url("Room/unosSmestaja"))->with(
            "messages", "Uspešno ste uneli smeštaj");
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
            return redirect()->to(site_url("Moderator/manageRooms"));
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
        $data["name"] = "room";
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
            if ($userType == "admin" || $userType == "moderator")
                return redirect()->to(site_url("Room/changeRoom/" . $roomId))->with(
                    "messages", $this->validator->listErrors());
        }

        $type = $this->request->getVar("type");
        $description = $this->request->getVar("description");

        $roomModel = new RoomModel();
        $room = $roomModel->find($roomId);

        $room["type"] = $type;
        $room["description"] = $description;

        $roomModel->update($roomId, $room);

        if ($userType == "admin" || $userType == "moderator")
            return redirect()->to(site_url("Room/changeRoom/" . $roomId))->with(
                "messages", "Uspešno ste izmenili podatke o smeštaju");
    }
}
