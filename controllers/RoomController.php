<?php

namespace Controllers;

use Models\Room;
use Repositories\RoomRepository;
use Exception;

class RoomController
{
    public function index()
    {
        $repository = new RoomRepository();
        $room = $repository->findAll();

        // var_dump($posts);
        $title = "Liste des salons";
        $view = "postroom/room.phtml";

        require "views/layout.phtml";
    }

    public function show()
    {
        if (!isset($_GET['id'])) {
            echo "Salon non trouvé";
            return;
        }

        $repository = new RoomRepository();
        $room = $repository->findById($_GET['id']);
        // var_dump($room);
        $title = $room->getTitle();
        $view = "room/room.phtml";

        require "views/layout.phtml";
    }

    public function addRoom()
    {
        
        // tester la soumission du bouton ajouter un salon
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            try {
                $roomName = $_POST['title'];
                $room = new Room();
                $room->setTitle($roomName);
                
                $repository = new RoomRepository();
                $test = $repository->saveRoom($room); // On passe l'objet $room
                
                if ($test) {
                    $message = 'Salon enregistré !!';
                }
            } catch (Exception $e){
                $message = "Erreur : ".$e -> getMessage();
            }
        }
        
        $title = "Ajouter un salon";

        $view = "room/room.phtml";

        require "views/layout.phtml";
    }
}