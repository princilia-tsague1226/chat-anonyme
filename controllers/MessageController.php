<?php

namespace Controllers;

use Models\Message;
use Repositories\MessageRepository;
use Exception;

class MessageController
{
    public function show()
    {
        
        if (!isset($_GET['id'])) {
            header('Location: index.php?page=room');
            exit();
        }

        $roomId = $_GET['id'];
        $msgRepository = new MessageRepository();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content'])) {
            try {
                $msg = new Message();
                $msg->setContent($_POST['content']);
                $msg->setRoomId($roomId);

                $msgRepository->saveMessage($msg);

                header("Location: index.php?page=message&id=" . $roomId);
                exit();
                
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }

        $messages = $msgRepository->findByRoom($roomId);
        
        $title = "Discussion";
        $view = "chat/chat.phtml";
        
        // var_dump($roomId);
        // var_dump($messages);
        require "views/layout.phtml";
    }
}