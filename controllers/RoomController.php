<?php

namespace Controllers;

use Models\Room;
use Models\Message;
use Repositories\MessageRepository;
use Repositories\RoomRepository;
use Exception;

class RoomController
{
    public function room()
    {
        $roomRepo = new RoomRepository();
        $msgRepo = new MessageRepository();
        
        $error = "";
        $success = "";
        $selectedRoom = null;
        $messages = [];
    
        
        if (isset($_GET['action']) && isset($_GET['msgId']) && isset($_GET['id'])) {
            $msgId = (int)$_GET['msgId'];
            $roomId = (int)$_GET['id'];
            
            if ($_GET['action'] === 'pin') {
                $msgRepo->pinMessage($msgId, $roomId);
            } elseif ($_GET['action'] === 'unpin') {
                $msgRepo->unpinMessage($msgId);
            }
            
            
            header("Location: index.php?page=room&id=" . $roomId);
            exit();
        }
        
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
           
            if (isset($_POST['content']) && isset($_GET['id'])) {
                try {
                    $msg = new Message();
                    $msg->setContent($_POST['content']);
                    $msg->setRoomId($_GET['id']);
                    $msgRepo->saveMessage($msg);
                    
                    header("Location: index.php?page=room&id=" . $_GET['id']);
                    exit();
                } catch (Exception $e) {
                    $error = $e->getMessage();
                }
            }
    
            
            if (isset($_POST['title'])) {
                try {
                    $roomName = trim($_POST['title']);
                    if (!empty($roomName)) {
                        $room = new Room();
                        $room->setTitle($roomName);
                        $roomRepo->saveRoom($room);
                        $success = "Salon créé !";
                        header("Location: index.php?page=room");
                        exit();
                    }
                } catch (Exception $e) {
                    $error = $e->getMessage();
                }
            }
        }
    
        
        $rooms = $roomRepo->findAll();
    
        if (isset($_GET['id'])) {
            $selectedRoom = $roomRepo->findById($_GET['id']);
            if ($selectedRoom) {
                $messages = $msgRepo->findByRoom($_GET['id']);
            }
        }
    
        $title = "Chat Anonyme";
        $view = "room/room.phtml"; 
        require "views/layout.phtml";
    }
}