<?php
//Autor: Dušan Stanivuković 2017/0605

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
