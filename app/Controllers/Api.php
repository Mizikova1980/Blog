<?php
namespace App\Controllers;

use App\Model\Message;
use Base\AbstractController;

class Api extends AbstractController
{
    public function getUserMessagesAction()
    {
        $userId = $_GET['user_id'] ?? null;
        $messages = Message::getUserMessages($userId, 20);

        if(!$userId) {
            return $this->response(['error' => 'no user_id']);
        }
        
        if(!$messages) {
            return $this->response(['error' => 'no messages']);
        }

        $data = array_map(function(Message $message) {
            return $message->getData();
        }, $messages);
            return $this->response(['messages' => $data]);

    }

    public function response(array $data)
    {
        header('Content-type: application/json');
        return json_encode($data);
    }
}


?>